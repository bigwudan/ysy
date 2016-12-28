<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2016/12/28
 * Time: 10:25
 */

namespace Admin\Controller\Ticket;

use Think\Controller;


class EditTicketController extends Controller {
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

    private function _getWhere(){
        $where = '';
        if(($style = I('style'))){
            $where .= ($style == 0) ? " AND id <= 1000" : " AND id > 1000";
        }

        if(($number = I('number'))){
            $where .=" AND number = {$number}";
        }

        if(($is_spend = I('is_spend')) != ''){
            $where .=" AND is_spend = {$is_spend}";
        }

        if(($rec_name = I('rec_name')) != ''){
            $where .=" AND rec_name like '%{$rec_name}%'";
        }

        if(($rec_addr = I('rec_addr')) != ''){
            $where .=" AND rec_addr like '%{$rec_addr}%'";
        }

        if(($rec_tel = I('rec_tel')) != ''){
            $where .=" AND rec_tel = '{$rec_tel}'";
        }



        return $where;
    }

    public function index(){
        $where = $this->_getWhere();
        $count      = M('ticket')->where("1 = 1 {$where}")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $ticketData = M('ticket')->where("1 = 1 {$where}")->limit($Page->firstRow.','.$Page->listRows)->select();
        $html = '';
        $count = array(
            'remain' => 0,
            'spend' => 0,
        );
        $count['remain']      = M('ticket')->where("is_spend = 0")->count();

        $count['styleqiuyueremain']      = M('ticket')->where("is_spend = 0 AND id <= 1000")->count();
        $count['stylehaishangremain']      = M('ticket')->where("is_spend = 0 AND id > 1000")->count();
        $count['spend']      = M('ticket')->where("is_spend = 1")->count();
        $count['wuliuNum'] = $count['spend'] - M('ticket')->where("wuliunum != ''")->count();
        foreach($ticketData as $k => $v){
            if($v['is_spend'] == 0){

                $v['is_spend'] = '未消费';
            }else{

                $v['is_spend'] = '已经消费';
            }
            if($sessAdminInfo['username'] == 'view'){
                $curlHtml = '';
                $v['checknum'] = 'XXXXXXX';
            }else{

                if($sessAdminInfo['username'] == 'guest' || $sessAdminInfo['username'] == 'lanmeike2015' || $sessAdminInfo['username'] == 'languifang'){

                    $v['checknum'] = 'XXXXXXX';
                }

                $curlHtml = "<a class=\"modify\" data-id=\"{$v['id']}\"  >[修改]</a>";
            }

            $styleName = $this->_checkStyle($v['id']);

            $html .=<<<EOT
<tr>
    <th scope="row">{$v['id']}</th>
    <td>{$v['number']}</td>
	<td>{$styleName}</td>
    <td>{$v['checknum']}</td>
    <td>{$v['rec_name']}</td>
    <td>{$v['rec_province']}</td>
    <td>{$v['rec_addr']}</td>
    <td>{$v['rec_tel']}</td>
    <td>{$v['remark']}</td>
    <td>{$v['is_spend']}</td>
    <td>{$v['wuliunum']}</td>
    <td>{$v['adminremark']}</td>
    <td>{$curlHtml}</td>
</tr>
EOT;
        }
        $this->assign('loginName' , $sessAdminInfo['username']);
        $this->assign('count' , $count);
        $this->assign('show' , $show);
        $this->assign('html' ,  $html);
//        $this->display('/Admin/showorder');


        $this->display('/Ticket/ViewTicket');
    }

    //判断款式
    private function _checkStyle($varId){
        return $varId <= 1000 ? '海上明月' : '秋月明辉' ;
    }



    public function actionFactoryCenter(){
        if(I('mode') == 'showorder'){
            $id = I('id');
            $id || die('0');
            $resultHtml = $this->_ajaxShowOrder($id);
        }else{
            $data = I('get.');
            $resultHtml = $this->_upOrder($data);
            $resultHtml = $resultHtml ? 1 : 0;
        }
        die($resultHtml);
    }




    public function _ajaxShowOrder($varId){
        $id = intval($varId);
        $ticketData = M('ticket')->where("id =  {$id}")->find();
        $sessArr = array('level' => 1);
        if(!is_array($sessArr)){
            die('0');
        }else{
            if($sessArr['level'] == 0){
                $html =<<<EOT
<input value={$id} name="modifyid" type="hidden">
<div class="form-group">
    <label  class="control-label">是否消费</label>
    <input value="{$ticketData['is_spend']}" name="is_spend" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人姓名</label>
    <input value="{$ticketData['rec_name']}" name="rec_name" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人地址</label>
    <input value="{$ticketData['rec_addr']}" name="rec_addr" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人电话</label>
    <input value="{$ticketData['rec_tel']}" name="rec_tel" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">物流号</label>
    <input name="wuliunum" value="{$ticketData['wuliunum']}" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">客服备注</label>
    <input name="adminremark" value="{$ticketData['adminremark']}" type="text" class="form-control" >
</div>
EOT;
            }else if($sessArr['level'] == 1){
                $html =<<<EOT
<input value={$id} name="modifyid" type="hidden">
<div class="form-group">
    <label  class="control-label">卷号</label>
    <input value="{$ticketData['number']}" name="number" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">验证号</label>
    <input value="{$ticketData['checknum']}" name="checknum" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">是否消费</label>
    <input value="{$ticketData['is_spend']}" name="is_spend" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人姓名</label>
    <input value="{$ticketData['rec_name']}" name="rec_name" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人省</label>
    <input value="{$ticketData['rec_province']}" name="rec_province" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人地址</label>
    <input value="{$ticketData['rec_addr']}" name="rec_addr" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">收货人电话</label>
    <input value="{$ticketData['rec_tel']}" name="rec_tel" type="text" class="form-control" >
</div>

<div class="form-group">
    <label  class="control-label">物流号</label>
    <input name="wuliunum" value="{$ticketData['wuliunum']}" type="text" class="form-control" >
</div>
<div class="form-group">
    <label  class="control-label">客服备注</label>
    <input name="adminremark" value="{$ticketData['adminremark']}" type="text" class="form-control" >
</div>
EOT;
            }else if($sessArr['level'] == 2){
                $html = "<input value={$id} name=\"modifyid\" type=\"hidden\"><div class=\"form-group\"><label  class=\"control-label\">客服备注</label><input name=\"adminremark\" value=\"{$ticketData['adminremark']}\" type=\"text\" class=\"form-control\" ></div>";
            }
            return $html;
        }
        return false;
    }

    private function _upOrder($varData){
        $data = $varData;//$varData
        $id = $data['modifyid'];
        $id || die('0');
        unset($data['modifyid']);
        $sessArr = array('level' => 1);
        if(!is_array($sessArr)){
            die('0');
        }else{
            /*if($sessArr['level'] == 0) {
                $upData = array(
                    'wuliunum' => $data['wuliunum'],
                    'adminremark' => $data['adminremark']
                );
            }else{
                $upData = $data;
            }*/
            $upData = $data;

            $upLog = array(
                'orderid' => $id,
                'uid' => session('uid'),
                'time' => time(),
                'ip' => get_client_ip(),
                'remark' => json_encode($data)
            );
            $ticketData = M('ticket')->where("id =  {$id}")->limit(1)->save($upData);
            M('log')->add($upLog);
            return true;
        }
        return false;
    }
}