<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/17
 * Time: 16:00
 */

namespace Admin\Controller\Stockandsale;

use Think\Controller;
class ManageFormatController extends Controller
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
        $formatList = $this->_processFormat();
        $this->assign('formatList' , $formatList);
        $this->display('/Stockandsale/ManageFormatList');
    }


    /**
     * 排序
     */
    private function _processFormat(){

        $formatFromDb = M('ysy_format')->select();

        $parentList = array(0);
        $num = 0;
        $newList = array();
        while(count($parentList) > 0 && $num <1000){
            $flag = 0;
            foreach($formatFromDb as $k => $v){
                if($v['format_pid'] == end($parentList)){
                    $v['level'] = count($parentList);
                    $newList[] = $v;
                    array_push($parentList , $v['format_id']);
                    unset($formatFromDb[$k]);

                    $flag = 1;
                }
            }
            $flag == 0 && array_pop($parentList);
            $num++;
        }
        return $newList;
    }


    /**
     * actionRequestService
     */
    public function actionRequestService(){
        $id = intval(I('id'));
        $name = I('name');
        $upData = array('format_name' => $name);
        $flag = M('ysy_format')->where("format_id = {$id}")->save($upData);
        if($flag){
            die('ok');
        }else{
            die('no');
        }

    }


}