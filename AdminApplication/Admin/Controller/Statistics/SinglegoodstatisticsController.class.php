<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/16
 * Time: 13:57
 */

namespace Admin\Controller\Statistics;

use Think\Controller;
class SinglegoodstatisticsController extends Controller {

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

    public function index(){
        $data = M('order')->field('goodsname')->group('goodsname')->select();

        $this->assign('goodsname' , $data);
        $this->display('/Statistics/Singlegoodstatistics');
    }

    /**
     * ajax请求
     */
    public function actionAjaxFactory(){
        if(!I('data')) return array('error'=>1 , 'msg' => 'worry');
        $data = trim(I('data'));
        $mode = intval(I('mode'));

        if($mode == 1){
            $data = $this->_getRankOfGoodsName($data);
        }else{
            $data = $this->_getRankOfPriceAndNum($data);
        }
        if(empty($data)) return array('error' => 1);
        $data = json_encode($data);
        die($data);
    }

    /**
     * 获得销量和单价
     */
    private function _getRankOfPriceAndNum($varGoodsName){
        if(!$varGoodsName){
            return array('error'=>1 , 'msg' => 'no var');
        }
        $Model = new \Think\Model();
        $data = $Model->db()->query("select goodprice , max(goodsnum) AS goodsum from think_order where customername != '' AND  goodsname = '{$varGoodsName}' AND goodprice != 0.00 Group By goodprice");
        return $data;
    }

    /**
     * 获得数据
     */
    private function _getRankOfGoodsName($varGoodsName){
        if(!$varGoodsName){
            return array('error'=>1 , 'msg' => 'no var');
        }
        $Model = new \Think\Model();
        $data = $Model->db()->query("select customername , max(goodsnum) AS goodsum from think_order where customername != '' AND  goodsname = '{$varGoodsName}' AND ordertime != 0 Group By customername");
        return $data;
    }



}