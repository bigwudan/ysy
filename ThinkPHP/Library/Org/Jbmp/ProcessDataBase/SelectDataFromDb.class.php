<?php
namespace Org\Jbmp\ProcessDataBase;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 21:39
 */
class SelectDataFromDb
{
    /**
     * 更加模板名称查询查询rule
     * @param $varModuleName string 名称
     * @return array
     */
    public function getRuleByModuleName($varModuleName){
        $data = M('flow_modulerule')->where("rulename = '{$varModuleName}'")->find();
        return $data;
    }

    /**
     * 得到getProperty
     */
    public function getProperty(){
        if($data = M('flow_property')->find()){
            return $data;
        }else{
            $data['key'] = 'next.dbid';
            $data['version'] = 1;
            $data['value'] = 1;
            M('flow_property')->add($data);
            return $data;
        }
    }

}