<?php
namespace Admin\Controller\Body;

use Think\Controller;

class BodyController extends Controller
{

    /**
     * 配置首页
     */
    private $_headConfigView = array(
        'Rbac/Rbac' => array(
            'url' => '/Rbac/Rbac/actionOperationUser.html',
            'title' => '登录用户管理 '
        ),
        'Financial/Financial' => array(
            'url' => '/Financial/Financial/actionOperationUser.html',
            'title' => '财务管理'
        )
    );
    public function operationHead(){
        foreach($this->_headConfigView as $k => $v){
            $this->_headConfigView[$k]['url'] = __MODULE__.$this->_headConfigView[$k]['url'];

        }
        $headTitleArr = $this->_headConfigView;
        foreach($headTitleArr as $k => $v){
            if($k == CONTROLLER_NAME){
                $headTitleArr[$k]['active'] = 1;
            }
        }
        $this->assign('active' , 'class="active"');
        $this->assign('headTitleArr' , $headTitleArr);
        $mainHeadHtml = $this->fetch('/Body/Head');
        return $mainHeadHtml;
    }
}