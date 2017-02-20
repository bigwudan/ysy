<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 21:24
 */

namespace CommonClass\Order;


class GetOrderInfo
{

    /**
     * orderId
     */
    private $_orderId = null;

    /**
     * 基础信息
     */
    private $_orderBase = null;

    /**
     * 详细信息
     */
    private $_orderInfo = null;

    /**
     * 得到log
     */
    private $_log = null;

    /**
     * 初始化
     * @param array $varOrderId
     */
    public function initi($varOrderId){
        $this->_orderId = $varOrderId;
        $orderList = $this->_runSql();
        $this->_orderBase = $orderList['orderOfBase'];
        $this->_orderInfo = $orderList['orderInfo'];
        $this->_log =$this->_getApproveLog();
    }

    /**
     * 得到
     */
    public function getOrderbase(){
        return $this->_orderBase;
    }

    /**
     * 得到数据
     */
    public function getOrderInfo(){
        return $this->_orderInfo;
    }

    /**
     * 得到数据
     */
    public function getLog(){
        return $this->_log;
    }

    /**
     * 运行SQL
     */
    public function _runSql(){
        $orderList = M('ysy_order')->alias('yo')
            ->field("rece_tel,rece_addr,rece_name,yo.status , yo.order_id , yo.rece_name , yo.addtime, yog.package_id , yog.num , yog.price , yog.ordertype , u.realname , ygp.packagename")
            ->join("think_user AS u ON u.id = yo.order_user")
            ->join('think_ysy_ordergoods AS yog ON yo.order_id = yog.order_id')
            ->join('think_ysy_goodspackage AS ygp ON yog.package_id = ygp.id')
            ->where("yo.order_id = {$this->_orderId}")
            ->select();
        if(!$orderList) return false;
        $orderOfBase = reset($orderList);
        $orderOfBase = array(
            'orderId' => $orderOfBase['order_id'],
            'receName' => $orderOfBase['rece_name'],
            'addtime' => $orderOfBase['addtime'],
            'realname' => $orderOfBase['realname'],
            'status' => $orderOfBase['status'],

            'rece_name' => $orderOfBase['rece_name'],
            'rece_addr' => $orderOfBase['rece_addr'],
            'rece_tel' => $orderOfBase['rece_tel'],

        );
        $orderInfo = array();
        foreach($orderList as $k => $v){
            $orderInfo[] = array(
                'package_id' => $v['package_id'],
                'num' => $v['num'],
                'price' => $v['price'],
                'ordertype' => $v['ordertype'],
                'packagename' => $v['packagename']
            );
        }
        foreach($orderInfo as $k => $v){
            if($v['package_id']){
                $data = M('ysy_goodspackage')->alias('gp')
                    ->field('packagename , g.goods_id, num , goods_name')
                    ->join("think_ysy_goodspackageinfo AS gpi ON gp.id = gpi.packageid")
                    ->join("think_ysy_goods AS g ON g.goods_id = gpi.goods_id")
                    ->where("gp.id = {$v['package_id']}")
                    ->select();
                $orderInfo[$k]['goodspackageinfo'] = $data;
            }

        }
        return array('orderOfBase' => $orderOfBase , 'orderInfo' => $orderInfo);
    }

    /**
     * 获得备注
     */
    private function _getApproveLog(){
        $data = M('ysy_approvelog')
            ->alias('al')
            ->field("al.addtime , al.uid , u.realname , al.remark , al.nodename")
            ->join('think_user AS u ON al.uid = u.id')
            ->where("al.orderid = {$this->_orderId}")
            ->select();
        return $data;
    }


}