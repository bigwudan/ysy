<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19
 * Time: 8:36
 */

namespace CommonClass\Order;


class GetNeedApproveListFromDb
{

    private $_uid = null;



    /**
     * 初始化
     */
    public function initi($varUid){
        $this->_uid = $varUid;

    }

    /**
     * 得到总数
     */
    public function getCountByUid(){
        $uid = $this->_uid;
        $where = " AND wp.userid = {$uid}";
        $count = M('workflow_participation')->alias('wp')
            ->field("wp.userid , o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")
            ->join("think_workflow_task as wt ON wp.task = wt.dbid")
            ->join("think_ysy_order as o ON o.flowerid = wt.execution")
            ->join("think_user as u ON u.id = o.order_user")
            ->where("1 = 1 {$where}")
            ->count();
        return $count;
    }


    /**
     * 运行SQl
     */
    public function getOrderOfApproveList($varPage){
        $uid = $this->_uid;
        $where = " AND wp.userid = {$uid}";
        $orderList = M('workflow_participation')->alias('wp')
            ->field("wp.userid , o.order_id , o.order_user , o.addtime , o.status , u.realname as order_realname")
            ->join("think_workflow_task as wt ON wp.task = wt.dbid")
            ->join("think_ysy_order as o ON o.flowerid = wt.execution")
            ->join("think_user as u ON u.id = o.order_user")
            ->where("1 = 1 {$where}")
            ->limit($varPage['firstRow'].','.$varPage['listRows'])
            ->select();
        return $orderList;
    }


}