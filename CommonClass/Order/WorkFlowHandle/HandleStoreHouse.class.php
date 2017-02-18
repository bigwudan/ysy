<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/18
 * Time: 21:01
 */

namespace CommonClass\Order\WorkFlowHandle;


class HandleStoreHouse
{
    /**
     * 执行文件
     * @param $varData 参数
     * @return array
     */
    public function decide($varData){

        return array('target' => 'to storehouse',
                     'variable' => array(
                         array('key' => 'storehouse','value' => 1 , 'class' => 'int')

                     ));
    }
}