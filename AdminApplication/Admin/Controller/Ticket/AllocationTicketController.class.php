<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/23
 * Time: 7:55
 */
namespace Admin\Controller\Ticket;

use Think\Controller;

class AllocationTicketController extends Controller
{
    /**
     * 初始化
     */
    protected function _initialize(){
        $obj = new \Admin\Common\AdminAuthor();
        $obj->init();
    }
    /**
     * 分配卷
     */
    public function actionViewTicket(){
        $user = new \Admin\Controller\Body\BodyController();
        $body = $user->bodyFactory();
        $ticketDataFromDb = M('ticket')->field('id , count(0) as amount,recvcompany,deadline,saleuid')
            ->where("deadline != 0")
            ->group('recvcompany')
            ->select();
        $this->assign('ticketDataFromDb' , $ticketDataFromDb);

        $this->assign('body' , $body);
        $this->display('/Ticket/ViewTicket');
    }

    /**
     * 分配卷号到系统
     */
    public function actionDistributeTicketToDb(){
        $amount = intval(I('amount'));
        $recvCompany = trim(I('recvcompany'));
        $saleUid = intval(I('saleuid'));
        $deadline = strtotime(I('deadline'));
        $begId = intval(I('begid'));

        $log = array(
            'amout' => $amount,
            'recvcompany' => $recvCompany,
            'saleuid' => $saleUid,
            'deadline' => $deadline,
            'begid' => $begId
        );

        $log = serialize($log);
        $insertLog = array(
            'uid'=>1,
            'time' => time(),
            'ip' => get_client_ip(),
            'content' => $log,
            'action' => ACTION_NAME
        );
        if(!$amount || !$recvCompany || !$saleUid || !$deadline || !$begId){
            $this->error('新增失败,请填写完整资料');
            die();
        }
        $newArr = array();
        for($num = $begId; $num < $amount + $begId ; $num ++){
            $newArr[$num] = array(
                'recvcompany' => $recvCompany,
                'saleuid' => $saleUid,
                'deadline' => $deadline
            );
        }
        $Model = new \Think\Model();
        $Model->db()->startTrans();
        foreach($newArr as $k => $v){
            $upDataFlag = M('ticket')->where("id = {$k} AND deadline = 0")->save($v);
            if(!$upDataFlag){
                $Model->db()->rollback();
                $this->error('新增失败,有编号已经使用');
                die();
                break;
            }
        }
        M('log')->add($insertLog);
        $Model->db()->commit();
        $this->success('新增成功');
        die();
    }

    /**
     * 插入5万
     */
    public function actionInsert5wTo(){

    }


    /**
     * 选择条件
     */
    private function _getWhere(){

        return '';
    }


    /**
     * 分配卷
     */
    public function actionEditTicket(){
        $where = $this->_getWhere();
        $count      = M('ticket')->where("1 = 1 {$where}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $ticketData = M('ticket')->where("1 = 1 {$where}")->limit($Page->firstRow.','.$Page->listRows)->select();
        $user = new \Admin\Controller\Body\BodyController();
        $body = $user->bodyFactory();
        $this->assign('show' , $show);
        $this->assign('ticketData' ,  $ticketData);
        $this->assign('body' , $body);
        $this->display('/Ticket/EditTicket');
    }

}