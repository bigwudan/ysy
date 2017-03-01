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
        $count = M('ysy_goods')
            ->alias('g')
            ->field("g.goods_id , s.goods_num , g.format_id , g.goods_name , f.format_id , f.format_name")
            ->join("think_ysy_stock AS s ON s.goods_id = g.goods_id")
            ->join("think_ysy_format AS f ON f.format_id = g.format_id")
            ->where("g.format_id in ({$tmpStr})")
            ->count();
        $Page       = new \Think\NewPage($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $showPage       = $Page->show();// 分页显示输出
        $pageList = array(
            'firstRow' => $Page->firstRow,
            'listRows' => $Page->listRows,
        );

        $goodsList = M('ysy_goods')
            ->alias('g')
            ->field("g.goods_id , s.goods_num , g.format_id , g.goods_name , f.format_id , f.format_name")
            ->join("think_ysy_stock AS s ON s.goods_id = g.goods_id")
            ->join("think_ysy_format AS f ON f.format_id = g.format_id")
            ->limit($pageList['firstRow'].','.$pageList['listRows'])
            ->where("g.format_id in ({$tmpStr})")
            ->select();
        $this->assign('showPage' , $showPage);
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
        }elseif($type == 'getgoodinfo'){
            $this->_getGoodsInfo();
        }elseif($type == 'submitgoods'){
            $this->_submitGoods();
        }else{
            $this->_editFormat();
        }
    }

    /**
     * 提交数据
     */
    private function _submitGoods(){
        $formatId = intval(I('formatid'));
        $goodsId = intval(I('goodsid'));
        $goodsName = trim(I('goodsname'));
        $goodsNum = intval(I('goodsnum'));
        $model = new \Think\Model();
        $model->startTrans();
        $flag = true;
        try{
            $flagOfDb = M('ysy_goods')->where("goods_id = {$goodsId}")->save(array('format_id' => $formatId , 'goods_name' => $goodsName));
            $flagOfDb = M('ysy_stock')->where("goods_id = {$goodsId}")->save(array('goods_num' => $goodsNum));
            $model->commit();
        }catch (\Exception $e){
            var_dump($e);
            $model->rollback();
            $flag = false;
            die('失败');
        }
        die('成功');
    }

    /**
     * 获得库存和商品信息
     */
    private function _getGoodsInfo(){
        $goodsId = intval(I('goodsid'));
        $goodsList = M('ysy_goods')
            ->alias('g')
            ->field("g.goods_id , s.goods_num , g.format_id , g.goods_name , f.format_id , f.format_name")
            ->join("think_ysy_stock AS s ON s.goods_id = g.goods_id")
            ->join("think_ysy_format AS f ON f.format_id = g.format_id")
            ->where("g.goods_id = $goodsId")
            ->find();
        $jsonGoodsList = json_encode($goodsList , JSON_UNESCAPED_UNICODE);
        die($jsonGoodsList);
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