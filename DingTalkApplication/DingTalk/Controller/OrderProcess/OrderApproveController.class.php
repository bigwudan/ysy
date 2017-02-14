<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/16
 * Time: 15:03
 */

namespace DingTalk\Controller\OrderProcess;
use Think\Controller;

class OrderApproveController extends Controller
{

    /**
     * 主页
     */
    public function index(){
        $LogInfo = new \CommonClass\Login\ProcessLoginInfo();
        if(!$uid = $LogInfo->getLoginInfo()['id']){
            die('no login');
        }

        $orderId = intval(I('order'));
        $packageHtml = '';
        $dataFromDb = array();
        if($orderId){
            $Model = new \Think\Model();
            $sqlStr = "SELECT * FROM think_ysy_order as yo join think_ysy_ordergoods as yog on yo.order_id = yog.order_id where yo.order_id = {$orderId}";
            $dataFromDb = $Model->query("$sqlStr");
            foreach($dataFromDb as $k => $v){
                $packageHtml .= $this->_assPackageHtml($v);
            }
        }


        $goodsPackageList= $this->_getGoodsPackage();
        $goodsPackageList = json_encode($goodsPackageList , JSON_UNESCAPED_UNICODE);
        $ConfigObj = new \CommonClass\Config\BaseConfig();


        $configList = array(
            'sendType' => $ConfigObj->getSendType(),
            'orderType' => $ConfigObj->getOrderType(),
        );
        $this->assign('goodsInfo' , reset($dataFromDb));
        $this->assign('goodsPackageList' , $goodsPackageList);
        $this->assign('configList' , json_encode($configList , JSON_UNESCAPED_UNICODE));
        $this->assign('sendType',$ConfigObj->getSendType());
        $this->assign('packageHtml',$packageHtml);
        $this->assign('orderId' , $orderId);
        $this->display('/orderprocess/orderapprove');
    }

    /**
     * 组合详细商品
     */
    private function _assPackageHtml($varDataInfo){

        $goodsPackageFromDb = M('ysy_goodspackage')->where('status = 0')->select();
        $packSelectHtml = '';
        foreach($goodsPackageFromDb as $k => $v){
            if($varDataInfo['package_id'] == $v['id']){
                $packSelectHtml .= "<option selected value='{$v['id']}'>{$v['name']}</option>";
            }else{
                $packSelectHtml .= "<option value='{$v['id']}'>{$v['name']}</option>";
            }
        }
        $dataFromOrderAndMin = $this->_getOrderPriceAndMin($varDataInfo['package_id']);
        $orderPriceSelectHtml = '';
        $ConfigObj = new \CommonClass\Config\BaseConfig();
        $orderType = $ConfigObj->getOrderType();
        $curOrderTypeProce = 0;
        foreach($dataFromOrderAndMin['priceList'] as $k => $v){
            $tmpName = $orderType[$v['ordertype']];

            if($varDataInfo['ordertype'] == $v['ordertype']){
                $curOrderTypeProce = $v['price'];
                $orderPriceSelectHtml .= "<option selected data-price=\"{$v['price']}\" value=\"{$v['ordertype']}\">{$tmpName}(价格{$v['price']})</option>";
            }else{
                $orderPriceSelectHtml .= "<option data-price=\"{$v['price']}\" value=\"{$v['ordertype']}\">{$tmpName}(价格{$v['price']})</option>";
            }


        }

$htmlModel =<<<EOT
<div class="page__bd">
	<div class="weui-cells__title">商品明细<a onclick="OrderApporve.delPackage(this)" class="del-a">删除</a></div>
	<input type="hidden" name="price[]" value="{$curOrderTypeProce}">
	<div class="weui-cells" style="margin-top:0">
		<div class="weui-cell weui-cell_select weui-cell_select-after">
			<div class="weui-cell__hd"><label for="" class="weui-label">商品</label></div>
			<div class="weui-cell__bd"><select onchange="OrderApporve.onChange(this)" name="package_id[]" class="weui-select">{$packSelectHtml}</select></div>
		</div>
	</div>
	<div class="weui-cells" style="margin-top:0">
		<div class="weui-cell weui-cell_select weui-cell_select-after">
			<div class="weui-cell__hd"><label for="" class="weui-label">订单类别</label></div>
			<div class="weui-cell__bd"><select onchange="OrderApporve.onChangeOrderType(this)" class="weui-select" name="ordertype[]">{$orderPriceSelectHtml}</select></div>
		</div>
	</div>
	<div class="weui-cells" style="margin-top:0">
		<div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label num-label">数量(库存{$dataFromOrderAndMin['min']})</label></div>
		<div class="weui-cell__bd"><input name="num[]" class="weui-input" type="number" placeholder="必填" value="{$varDataInfo['num']}"></div></div>
	</div>
</div>
EOT;
        return $htmlModel;
    }

    /**
     * 得到商品
     */
    private function _getGoodsPackage(){
        $goodsPackageFromDb = M('ysy_goodspackage')->where('status = 0')->select();
        return $goodsPackageFromDb;
    }

    /**
     * ajax服务器
     */
    public function actionRequestService(){
        $type = trim(I('type'));
        if($type == 'changepackage'){
            $res = $this->_getGoodsPackageInfo();
            die($res);
        }elseif($type == 'getaddress'){
            $res = $this->_getAddress();
            die($res);
        }elseif($type == 'submitform'){
            $res = $this->_processSubmit();
            die($res);
        }
    }


    /**
     * 地址处理
     */
    private function _dealAddr($varAddrData){
        $telFromDb = M('ysy_address')->where("tel='{$varAddrData['order']['rece_tel']}'")->find();
        if(!$telFromDb){
            return array('tel' => $varAddrData['order']['rece_tel'] , 'addr' => $varAddrData['order']['rece_addr'] , 'name' => $varAddrData['order']['rece_name']);
        }else{
            return false;
        }
    }

    /**
     * 处理提交
     */
    private function _processSubmit(){
        $data = I('data');
        $orderId = 0;
        foreach($data as $k => $v){
            if($v['name'] == 'orderid')$orderId = $v['value'];
        }
        if($orderId){
            $ReBackObj = new \CommonClass\Order\Dealpackage\RebackOrderGoods();
            $ReBackObj->initi($orderId);
            $reBackInfo = $ReBackObj->prcessToSQL();
            if(!$reBackInfo) return json_encode(array('error'=>1 , 'msg' => '返回库存错误') ,JSON_UNESCAPED_UNICODE);
        }
        $AssembleOrderObj = new \CommonClass\Order\AssembleOrderOfForm();
        $AssembleOrderObj->initi($data , $orderId);
        $orderInfo = $AssembleOrderObj->processData();
        $resFlag = $this->_dealAddr($orderInfo);
        $needSql = array();
        if($resFlag !== false){
            $needSql['addr'] = $resFlag;
        }
        if($orderInfo['error']){
            return json_encode(array('error'=>1 , 'msg' => $orderInfo['msg']) ,JSON_UNESCAPED_UNICODE);
        }
        $ProcessOrderObj = new \CommonClass\Order\ProcessOrderInfoService();
        $ProcessOrderObj->initi( $orderInfo , $orderId);
        $res = $ProcessOrderObj->process();

        $needSql['order'] = $res['order'];
        $needSql['ordergoods']['insert'] = $res['orderGoods'];
        $needSql['stock']['dec'] = $res['stock'];
        if(!empty($reBackInfo['orderGoods'])){
            $needSql['ordergoods']['del'] = $reBackInfo['orderGoods'];
        }

        if(!empty($reBackInfo['stock'])){
            $needSql['stock']['inc'] = $reBackInfo['stock'];
        }
        $OrderUpdata = new \CommonClass\Order\OrderUpdata();
        $OrderUpdata->initi($needSql);
        $flag = $OrderUpdata->process();
        if(!$flag){
            return json_encode(array('error' => 1 , 'msg' => '提交异常') ,JSON_UNESCAPED_UNICODE);
        }
        $FlowerService = new \Vendor\Jbpm\Service\ExecutionService();
        $responseFlowData = $FlowerService->startProcessInstanceById('orderapprove');
        $ExecutionObj = reset($responseFlowData->getExecution()['insert']);
        if(!$ExecutionObj['dbid'] && !$ExecutionObj['activityname']){
            return json_encode(array('error' => 1 , 'msg' => '流程错误') ,JSON_UNESCAPED_UNICODE);
        }
        $tmp['flowerid'] = $ExecutionObj['dbid'];
        $tmp['status'] = $ExecutionObj['activityname'];
        $sqlFlag = M('ysy_order')->where("order_id = {$orderInfo['order']['order_id']}")->save($tmp);
        if($flag){
            return json_encode(array('msg' => '正常') ,JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(array('error' => 1 , 'msg' => '写入流程异常') ,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 获得地址
     */
    private function _getAddress(){
        $tel = I('tel');
        $telFromDb = M('ysy_address')->where("tel='{$tel}'")->find();
        if($telFromDb){
            $responseJson = json_encode($telFromDb , JSON_UNESCAPED_UNICODE);
        }else{
            $responseJson = json_encode(array('tel'=>0) , JSON_UNESCAPED_UNICODE);
        }

        return $responseJson;
    }

    /**
     * 获得价格和最小库存
     */
    private function _getOrderPriceAndMin($varId){
        $packagePriceFromDb = M('ysy_packageprice')->where("packageid = {$varId}")->select();
        if(!$packagePriceFromDb) return false;
        $packageInfoFromDb = M('ysy_goodspackageinfo')->where("packageid = {$varId}")->select();
        if(!$packageInfoFromDb) return false;
        $flag = true;
        $minList = array();
        foreach($packageInfoFromDb as $k => $v){
            $tmpList = M('ysy_stock')->where("format_id={$v['format_id']}")->find();
            if(!$tmpList || $tmpList['goods_num'] == 0){
                $flag = false;
                break;
            }
            $tmpNum = intval($tmpList['goods_num'] / $v['num']);
            if($tmpNum == 0){
                $flag = false;
                break;
            }
            array_push($minList , $tmpNum);
        }
        if($flag){
            sort($minList);
            $min = $minList[0];
        }else{
            $min = 0;
        }
        $priceList = $packagePriceFromDb;
        return array('min' => $min , 'priceList' => $priceList);
    }


    /**
     * 获得商品详情
     */
    private function _getGoodsPackageInfo(){
        $id = intval(I('id'));
        $packagePriceFromDb = M('ysy_packageprice')->where("packageid = {$id}")->select();
        if(!$packagePriceFromDb) return json_encode(array('error'=>1 , 'msg' => '无效商品') ,JSON_UNESCAPED_UNICODE);
        $packageInfoFromDb = M('ysy_goodspackageinfo')->where("packageid = {$id}")->select();
        if(!$packageInfoFromDb) return json_encode(array('error'=>1 , 'msg' => '商品对应库存未设置') ,JSON_UNESCAPED_UNICODE);
        $flag = true;
        $minList = array();
        foreach($packageInfoFromDb as $k => $v){
            $tmpList = M('ysy_stock')->where("goods_id={$v['goods_id']}")->find();
            if(!$tmpList || $tmpList['goods_num'] == 0){
                $flag = array('error'=>1 , 'msg' => '库存为0');
                break;
            }
            $tmpNum = intval($tmpList['goods_num'] / $v['num']);
            if($tmpNum == 0){
                $flag = array('error'=>2 , 'msg' => '库存为0');
                break;
            }
            array_push($minList , $tmpNum);
        }
        sort($minList);
        $min = $minList[0];
        $priceList = $packagePriceFromDb;

        $responsejson = array(
            'min' => $min,
            'priceList' => $priceList

        );
        return json_encode($responsejson ,JSON_UNESCAPED_UNICODE);
    }

}