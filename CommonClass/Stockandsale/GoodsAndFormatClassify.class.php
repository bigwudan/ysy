<?php
/**
 * Created by PhpStorm.
 * User: 丹
 * Date: 2017-02-28
 * Time: 13:43
 */

namespace CommonClass\Stockandsale;


class GoodsAndFormatClassify {

    /**
     * 得到数据
     */
    public function getByFormat($varFormatId){
        $dataOfFormatFromDb = M('ysy_format')->select();
        $BaseFunObj = new \CommonClass\BaseFun\BaseFun();
        $dataList = $BaseFunObj->iterationTree($dataOfFormatFromDb , $varFormatId , 'format_pid' , 'format_id');
        return $dataList;
    }




}