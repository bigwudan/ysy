<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class GoodspackageController extends Controller
{

    /**
     * 订单信息
     */
    private $_orderType = array('销售订单','送样订单','赠送订单','兑券订单','损耗订单','次品销售订单','预售订单订单');






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
        $this->display('/Stockandsale/GoodsPackageList');
    }

    /**
     * 编辑
     */
    public function actionEditGoodsPackage(){
        $formatFromDb = M('ysy_format')->field('format_id,format_name')->select();
        $formatJson = json_encode($formatFromDb , JSON_UNESCAPED_UNICODE);

        $orderType = array(
            array('销售订单', 0),
            array('送样订单', 0),
            array('赠送订单', 0),
            array('兑券订单', 0),
            array('损耗订单', 0),
            array('次品销售订单', 0),
            array('预售订单订单', 0),
        );

        $this->assign('formatJson' , $formatJson);
        $this->assign('orderType' , $orderType);
        $this->display('/Stockandsale/GoodsPackage');
    }

    /**
     *
     */
    public function actionRequestService(){
        $type = I('type');
        if($type == 'package'){
            $this->_package();
        }

    }

    /**
     *
     */
    private function _package(){
        $data = I('data');
        $packageId =  intval(date('Ymdhis'));
        $goodspackage = array();
        $goodspackage['addtime'] = time();
        $goodspackage['id'] = $packageId;

        $packageprice = array();
        $goodspackageinfo = array();
        foreach($data as $k => $v){
            if($v['name'] == 'packagename'){
                $goodspackage['packagename'] = $v['value'];
            }elseif($v['name'] == 'remark'){
                $goodspackage['remark'] = $v['value'];
            }elseif(strstr($v['name'] , 'packageprice-')){
                $tmp = intval(substr($v['name'] , 13));
                array_push($packageprice ,array('packageid' => $packageId , 'ordertype' => $tmp , 'price' => $v['value']) );
            }else{
                array_push($goodspackageinfo , $v);
            }
        }
        $goodspackageinfoList = array();
        for($num = 0 ; $num < count($goodspackageinfo) ; $num = $num + 2){
            array_push($goodspackageinfoList , array(
                'packageid' => $packageId,
                'format_id' => $goodspackageinfo[$num]['value'],
                'num' => $goodspackageinfo[$num+1]['value'],
                'addtime' => time(),

            ));
        }

        $flag = true;
        try{
            $Model = new \Think\Model();
            $Model->db()->startTrans();
            $flag = M('ysy_goodspackage')->add($goodspackage);
            if(!$flag) E('新增失败');
            $flag =  M('ysy_packageprice')->addAll($packageprice);
            if(!$flag) E('新增失败');
            $flag = M('ysy_goodspackageinfo')->addAll($goodspackageinfoList);
            if(!$flag) E('新增失败');
            $Model->db()->commit();
        }catch (\Exception $e){
            $Model->db()->rollback();
            $flag = false;
        }
        var_dump($flag);
        die();
        return $flag;
    }

}