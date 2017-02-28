<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class ManageGoodsController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \Admin\Common\AdminAuthor();
        $obj->init();
        $user = new \Admin\Controller\Body\BodyController();
        $body = $user->bodyFactory($obj->getAuthorList());
        $this->assign('body' , $body);
    }

    /**
     * 显示历史信息
     */
    public function index(){
        $GoodsAndFormatObj = new \CommonClass\Stockandsale\GoodsAndFormatClassify();
        $dataOfFormatBelongToGoods = $GoodsAndFormatObj->getByFormat(\CommonClass\Config\BaseConfig::getClassify()['goods']);
        $formatList = array();
        foreach($dataOfFormatBelongToGoods as $k => $v){
            array_push($formatList , $v['format_id']);
        }
        $tmpStr = implode(',' , $formatList);
        $goodsList = M('ysy_goods')
            ->alias('g')
            ->field("g.goods_id , s.goods_num , g.format_id , g.goods_name , f.format_id , f.format_name")
            ->join("think_ysy_stock AS s ON s.goods_id = g.goods_id")
            ->join("think_ysy_format AS f ON f.format_id = g.format_id")
            ->where("g.format_id in ({$tmpStr})")
            ->select();
        $this->assign('formatArr' , $dataOfFormatBelongToGoods);
        $this->assign('goodsList' , $goodsList);
        $this->display('/Stockandsale/ManageGoodsList');
    }

    /**
     * 新增加商品
     */
    public function actionEditGoods(){

        $this->display('/Stockandsale/EditGoods');
    }

    /**
     * actionRequestService
     */
    public function actionRequestService(){
        $type = I('type');
        if($type == 'addgoods'){
            $this->_editGoods(I('formatid') , I('goodsname') , I('remark'));
        }else{
            $this->_editFormat();
        }
    }

    /**
     * 增加规格
     */
    private function _editFormat(){
        $pId = intval(I('formatid'));
        $name = trim(trim(I('goodsname')));
        $remark = strip_tags(trim(I('remark')));
        $InsertFormatList = array(
            'format_name' => $name,
            'format_remark' => $remark,
            'format_pid' => $pId,
        );
        $flag = M('ysy_format')->add($InsertFormatList);
        if($flag){
            die(json_encode(array('error' => 0) , JSON_UNESCAPED_UNICODE));
        }else{
            die(json_encode(array('error' => 1) , JSON_UNESCAPED_UNICODE));
        }
    }


    /**
     * 新增商品
     * @param $varFormatId
     * @param $varGoodsName
     * @param $varRemark
     */
    private function _editGoods($varFormatId , $varGoodsName , $varRemark){
        $ysyGoodsOfForm = array(
            'format_id' => $varFormatId,
            'goods_name' => $varGoodsName,
            'remark' => trim(strip_tags($varRemark)),
            'addtime' => time()
        );

        $model = new \Think\Model();
        $model->startTrans();
        $flag = true;
        try{
            $goodsId = M('ysy_goods')->add($ysyGoodsOfForm);

            if(!$goodsId){
                new \Exception('histActinsterror');
            }
            $flagOfDb = M('ysy_stock')->add(array('goods_id' => $goodsId));
            $model->commit();
        }catch (\Exception $e){
            $model->rollback();
            $flag = false;
        }

        if($flag){
            die(json_encode(array('error' => 0) , JSON_UNESCAPED_UNICODE));
        }else{
            die(json_encode(array('error' => 1) , JSON_UNESCAPED_UNICODE));
        }

    }

}