<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order\Dealpackage;


class BaseDealPackage implements \CommonClass\Order\Dealpackage\IDealPackage
{
    /**
     * 数据
     */
    private $_data = null;

    /**
     * 初始化
     */
    public function initi($varData){
        $this->_data = $varData;
    }

    /**
     * 处理
     */
    public function prcessToSQL(){
        $CommonObjList = array();
        $goodsPackageInfo = M('ysy_goodspackageinfo')->where("packageid = {$this->_data['package_id']}")->select();
        if(!$goodsPackageInfo) return false;
        foreach($goodsPackageInfo as $k => $v){
            $tmpNum = $v['num'] * $this->_data['num'];
            $CommonObj = new \CommonClass\DbModel\CombinStatement('ysy_stock');
            $CommonObj->where("goods_id = {$v['goods_id']}")->where("goods_id = {$v['goods_id']}")->dec(array('name' => 'goods_num' , 'value' => $tmpNum));
            $CommonObjList[] = $CommonObj;
        }
        return $CommonObjList;
    }

}