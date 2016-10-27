<?php
namespace Admin\Controller\Body;

use Think\Controller;

class BodyController extends Controller
{

    /**
     * 整个数据
     */
    private $_authData = array();

    /**
     * 得到html
     */
    public function bodyFactory($varAuthList){
        $this->_authData = $varAuthList;
        $sider = $this->operationSider();
        $head = $this->operationHead();
        return array('sider' => $sider , 'head' => $head);
    }



//    /**
//     * 数据库
//     */
//    private function _getAuthDataFromDb(){
//        $uid = session('uid');
//        $data = M('user')->alias('u')
//            ->field(" u.username as username , ru.user_id , ru.role_id , r.name as role_name , a.node_id , n.name as node_name , n.title as node_title , n.pid , n.level , n.url")
//            ->join('think_role_user AS ru ON ru.user_id = u.id')
//            ->join('think_role AS r ON r.id = ru.role_id')
//            ->join('think_access AS a ON a.role_id = r.id')
//            ->join('think_node AS n ON a.node_id = n.id')
//            ->where("ru.user_id = {$uid} AND n.status = 1")->select();
//        $existList = array();
//        $newArr = array();
//        foreach($data as $k => $v){
//            if(!in_array( $v['node_id'], $existList)){
//                $newArr[] = $v;
//                $existList[] = $v['node_id'];
//            }
//        }
//        $this->_authData = $newArr;
//    }

    /**
     * 获得侧边栏
     */
    public function operationSider(){
        $siderList = array();
        if(defined("CONTROLLER_1_NAME")){
            $authData = $this->_authData['controller_2'][MODULE_NAME][CONTROLLER_1_NAME];
            $controller = CONTROLLER_1_NAME;
        }else{
            $authData = $this->_authData['controller_2'][MODULE_NAME][strtolower(CONTROLLER_NAME)];
            $controller = strtolower(CONTROLLER_NAME);
        }

        if($authData){
            foreach($authData as $k => $v){
                if($v['url'] == '' || !$v['url']){
                    $v['url'] = __MODULE__.'/'.$controller.'/'.$v['node_name'];
                }
                $siderList[] = $v;
            }
        }else{
            die('no silder');
        }
        $html = $this->_buildSilderHtml($siderList);

        return $html;
    }

    /**
     * 侧边组合html
     * @param $varActionList array 侧边栏数据
     * @return array
     */
    private function _buildSilderHtml($varActionList){
        $html = '';
        foreach($varActionList as $k => $v){
            $action = '';
            if($v['node_name'] == CONTROLLER_2_NAME ){
                $v['url'] = '#';
                $action = 'class="active"';
            }
            $html .= "<li role=\"presentation\" $action ><a href=\"{$v['url']}\">{$v['node_title']}</a></li>";
        }
$html =<<<EOT
<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked nav-pills-stacked-example">
    $html
    </ul>
</div>
EOT;
        return $html;
    }


    /**
     * 首页
     */
    public function operationHead(){
        $controllerData = $this->_getControllerData();
        $headHtml = $this->_buildHeadHtml($controllerData);
        return $this->_buildMainHtml($headHtml);
    }

    /**
     * 组合整个html
     */
    private function _buildMainHtml($headHtml){
$html =<<<EOT
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">后台管理</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {$headHtml}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">首页</a></li>
            </ul>
        </div>
    </div>
</nav>
EOT;
        return $html;
    }

    /**
     * 组合成head
     * @param $varControllerData array 数据
     * @return array
     */
    private function _buildHeadHtml($varControllerData){
        $headHtml = '';
        $controller = defined("CONTROLLER_1_NAME") ? CONTROLLER_1_NAME : strtolower(CONTROLLER_NAME);
        foreach($varControllerData as $k => $v){
            $active =$v['node_name'] == $controller ? 'class="active"' : '';
            $headHtml .="<li $active><a href=\"{$v['url']}\">{$v['node_title']}<span class=\"sr-only\">(current)</span></a></li>";
        }
        return $headHtml;
    }

    /**
     * 得到控制器数据
     */
    private function _getControllerData(){
        $this->_authData['controller_1'][MODULE_NAME] || die('no head');
        foreach($this->_authData['controller_1'][MODULE_NAME] as $k => $v){
            if($v['url'] == '' || !$v['url']){
                $v['url'] = __MODULE__.'/'.$v['node_name'];
            }
            $headList[] = $v;
        }
        return $headList;
    }
}