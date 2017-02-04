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
        $goodsPackageInfo = M('ysy_goodspackageinfo')->where("packageid = {$this->_data['package_id']}")->select();
        if(!$goodsPackageInfo) return false;
        $responseSqlList = array();
        foreach($goodsPackageInfo as $k => $v){
            $tmpNum = $v['num'] * $this->_data['num'];
            $responseSqlList[] = array(
                'where' => array('format_id' => $v['format_id']),
                'num' => $tmpNum
            );
        }
        return $responseSqlList;
    }

}