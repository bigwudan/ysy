<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15
 * Time: 21:44
 */

namespace CommonClass\Order\WorkFlowHandle;


class HandleChiefLeader
{

    /**
     * 执行文件
     * @param $varData 参数
     * @return array
     */
    public function decide($varData){
        return array('target' => 'to chiefleader',
                     'variable' => array(
                         array('key' => 'chiefleader','value' => 2 , 'class' => 'int')

                     ));
    }


}