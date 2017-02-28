<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2017-02-28
 * Time: 14:07
 */
namespace CommonClass\BaseFun;
class BaseFun {
    /**
     * 迭代 tree
     * @param array $varData
     * @param string $varParent
     * @param string $varChildren
     * @param int $varPVal
     */
    public function iterationTree($varData , $varPVal = 0 , $varParent = 'pid' , $varChildren = 'id' ){
        $data = $varData;
        $id = $varChildren;
        $parent_list = array($varPVal);
        $resData = array();
        $num = 0;
        while(!empty($data) && !empty($parent_list)){
            $isFlag = 0;
            $curPid = end($parent_list);
            foreach ($data as $k => $v) {
                if($v[$varParent] == $curPid){
                    $v['level'] = count($parent_list);
                    array_push($parent_list, $v[$id]);
                    array_push($resData, $v);
                    $isFlag = 1;
                    unset($data[$k]);
                    break;
                }
            }
            if($isFlag == 0) array_pop($parent_list);
            $num++ ;
        }
        return $resData;
    }
}