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
        $formatList = M('ysy_format')->where("status = 1")->select();
        $this->assign('formatList' , $formatList);
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
        if($type == 'editgoods'){
            $this->_editGoods(I('formatid') , I('goodsname') , I('reamrk'));
        }


        die('11');

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
        }
    }

}