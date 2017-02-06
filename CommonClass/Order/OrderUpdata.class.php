<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order;


class OrderUpdata
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
     * 执行
     */
    public function process(){
        if(!$data = $this->_data) return false;
        $flag = true;
        try{
            $Model = new \Think\Model();
            $Model->db()->startTrans();
            if(!empty($data['order']['insert'])){
                $dealFlag = M('ysy_order')->add($data['order']['insert']);
                if(!$dealFlag) E('新增失败');
            }

            if(!empty($data['order']['update'])){
                $dealFlag = M('ysy_order')->where("order_id = {$data['order']['update']['where']['order_id']}")->data($data['order']['update']['data'])->save();
                if(!$dealFlag) E('新增失败');
            }


            if(!empty($data['ordergoods']['del'])){
                $dealFlag = M('ysy_ordergoods')->where("order_id = {$data['ordergoods']['del']['order_id']}")->delete();
                if(!$dealFlag) E('新增失败');
            }

            if(!empty($data['ordergoods']['insert'])){
                $dealFlag = M('ysy_ordergoods')->addAll($data['ordergoods']['insert']);
                if(!$dealFlag) E('新增失败');
            }

            if(!empty($data['stock']['inc'])){
                foreach($data['stock']['inc'] as $k => $v){
                    $v['where']['format_id'] = intval($v['where']['format_id']);
                    $dealFlag = M('ysy_stock')->where("format_id={$v['where']['format_id']}")->setInc('goods_num' , $v['num']);
                    if(!$dealFlag) E('新增失败');
                }
            }

            if(!empty($data['stock']['dec'])){
                foreach($data['stock']['dec'] as $k => $v){
                    $v['where']['format_id'] = intval($v['where']['format_id']);
                    $dealFlag = M('ysy_stock')->where("format_id={$v['where']['format_id']}")->setDec('goods_num' , $v['num']);
                    if(!$dealFlag)E('新增失败');
                }
            }

            $Model->db()->commit();
        }catch (\Exception $e){
            $Model->db()->rollback();
            $flag = false;
        }
        return $flag;
    }


}