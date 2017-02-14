<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>
    <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/weui.css"/>
    <title>订单申请</title>

</head>
<body>

<style>
    .font84{
        font-size: 84px;

    }



</style>


<div id="loadingToast" style="opacity: 0; display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <!--<i class="weui-loading weui-icon_toast"></i>-->
        <!--<i class="weui-icon-cancel font84"></i>-->
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>

<form id="orderapprove">
    <input name="orderid" value="<?php echo ($orderId); ?>" type="hidden">
<div class="page">

    <div class="page__bd">
        <div class="weui-cells__title">订单申请</div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">客户电话</label></div>
                <div class="weui-cell__bd">
                    <input name="rece_tel" value="<?php echo ($goodsInfo['rece_tel']); ?>" class="weui-input" type="text"  placeholder="必填">
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">收货人姓名</label></div>
                <div class="weui-cell__bd">
                    <input name="rece_name" value="<?php echo ($goodsInfo['rece_name']); ?>" class="weui-input"   placeholder="必填">
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">收货人地址</label></div>
                <div class="weui-cell__bd">
                    <input name="rece_addr" class="weui-input" value="<?php echo ($goodsInfo['rece_addr']); ?>"  placeholder="必填">
                </div>
            </div>
        </div>


        <div class="weui-cells contracttime" style="margin-top: 0">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>要求发货时间</p>
                </div>
                <input name="requireddeliverytime" value="<?php if($goodsInfo['requireddeliverytime']){echo date("Y-m-d" , $goodsInfo['requireddeliverytime']);}else{echo date("Y-m-d");} ?>" type="hidden">
                <div  class="weui-cell__ft requireddeliverytime"><?php if($goodsInfo['requireddeliverytime']){echo date("Y-m-d" , $goodsInfo['requireddeliverytime']);}else{echo date("Y-m-d");} ?></div>
            </a>
        </div>



        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">配送方式</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="deliveryttpe">
                        <?php if(is_array($sendType)): foreach($sendType as $k=>$v): if($goodsInfo['deliveryttpe'] == $k ): ?><option selected value="<?php echo ($k); ?>"><?php echo ($v); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($k); ?>"><?php echo ($v); ?></option><?php endif; endforeach; endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="weui-cells" style="margin-top:0">
            <div class="page__bd page__bd_spacing">
                <a href="javascript:;" class="addgoodsinfo-a weui-btn weui-btn_primary">+增加商品</a>
            </div>
        </div>

        <div class="package-container-div" style="margin-bottom: 60px">
            <?php echo ($packageHtml); ?>
        </div>
    </div>

<style>
    .page__bd .del-a{
        color: #0BB20C;
        float: right;
    }
</style>
    <div class="fixed fix-position bgfff pt10 pb10 pr20 pl20 w100">
        <a href="javascript:;" class="bgblue cfff block w100 round5 ft16 ftc pad5 submit-a">提交</a>
    </div>
</div>
</form>
<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/myysy/Public/Dingtalk/Js/weui.min.js" type="text/javascript" charset="utf-8"></script>

<script>

    $('.contracttime').on('click', function () {
        var obj = $(this);
        obj.attr('date-type');
        weui.datePicker({
            start: new Date().getFullYear(),
            end: new Date().getFullYear(),
            onChange: function (result) {
            },
            onConfirm: function (result) {
                if((result[1]/10) < 1){
                    result[1] = '0'+ result[1];
                }
                var contractDate = result[0]+'-'+result[1]+'-'+result[2];
                console.log(contractDate);
                $('.requireddeliverytime').html(contractDate);
                $('input[name="requireddeliverytime"]').val(contractDate);
            }
        });
    });


    var OrderApporve = function(){
        var _goodsPackageListJson = <?php echo ($goodsPackageList); ?>;
        var _config = <?php echo ($configList); ?>;

        //提示框
        var _promptBox = function(varType , varMsg){
            if(varType == 'showLoading'){
                $('#loadingToast i').attr('class','weui-loading weui-icon_toast');
                $('#loadingToast .weui-toast__content').html('加载中');
                $('#loadingToast').css({'opacity':1 , 'display':'block'});
            }else if(varType == 'hide'){
                $('#loadingToast').css({'opacity':0 , 'display':'none'});
                $('#loadingToast i').attr('class','weui-loading weui-icon_toast');
                $('#loadingToast .weui-toast__content').html('加载中');
            }else if(varType == 'warm'){
                $('#loadingToast i').attr('class' , 'weui-icon-cancel font84');
                $('#loadingToast .weui-toast__content').html(varMsg);
            }

        };


        //增加商品
        var _addPackageHtml = function(){
            var html = '<option value="">请选择</option>';
            for(var k in _goodsPackageListJson){
                if(_goodsPackageListJson.hasOwnProperty(k)){
                    html += '<option value="'+_goodsPackageListJson[k]['id']+'">'+_goodsPackageListJson[k]['packagename']+'</option>';
                }
            }
            html = '<select onchange="OrderApporve.onChange(this)" name="package_id[]" class="weui-select">'+html+'</select>';
            return html;
        };

        var _addGoodsInfo = function(){
            var packageHtml = _addPackageHtml();
            var html = '<div class="page__bd"><div class="weui-cells__title">商品明细<a onclick="OrderApporve.delPackage(this)" class="del-a">删除</a></div>'+
                            '<input type="hidden" name="price[]" value="">'+
                    '<div class="weui-cells" style="margin-top:0"><div class="weui-cell weui-cell_select weui-cell_select-after"><div class="weui-cell__hd"><label for="" class="weui-label">商品</label></div><div class="weui-cell__bd">'+packageHtml+'</div></div></div>'+
                    '<div class="weui-cells" style="margin-top:0"><div class="weui-cell weui-cell_select weui-cell_select-after"><div class="weui-cell__hd"><label for="" class="weui-label">订单类别</label></div><div class="weui-cell__bd"><select onchange="OrderApporve.onChangeOrderType(this)" class="weui-select" name="ordertype[]"><option value="1">请选择商品</option></select></div></div></div>'+
                    '<div class="weui-cells" style="margin-top:0"><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label num-label">数量(库存0)</label></div><div class="weui-cell__bd"><input name="num[]" class="weui-input" type="number"  placeholder="必填"></div></div></div>'+
                    '</div>';
            return html;
        };

        //根据商品获得订单类型
        var _onChangePackage = function(obj){
            _promptBox('showLoading');
            $.get('<?php echo U('OrderProcess/OrderApprove/actionRequestService') ?>',{type:'changepackage',id:$(obj).val()},function(data){
                var dataJson = JSON.parse(data);
                var parentObj = $(obj).parent().parent().parent().parent();
                if(dataJson.error){
                    _promptBox('warm' , dataJson.msg);
                    parentObj.find('.num-label').html('数量(库存0)');
                    parentObj.find('select[name="ordertype[]"]').html('<option>请选择商品</option>');
                }else{
                    var min = dataJson['min'];
                    var dataJson = dataJson['priceList'];

                    parentObj.find('.num-label').html('数量(库存'+min+')');
                    html = '';
                    for(var k in dataJson){
                        if(dataJson.hasOwnProperty(k)){
                            var tmpName = _config['orderType'][dataJson[k]['ordertype']];
                            var tmpPrice = dataJson[k]['price'];
                            if(k == 0) parentObj.find('input[name="price[]"]').val(tmpPrice);
                            html += '<option data-price="'+tmpPrice+'" value="'+dataJson[k]['ordertype']+'">'+tmpName+'(价格'+tmpPrice+')</option>';
                        }
                    }
                    parentObj.find('select[name="ordertype[]"]').html(html);
                    _promptBox('hide');
                }
            });
        };

        var _delPackage = function(obj){
            console.log($(obj).parent().parent().remove());
        };

        var _onChangeOrderType = function(obj){
            var objList = $(obj).find('option');
            var val = $(obj).val();
            var parentObj = $(obj).parent().parent().parent().parent();
            for(var k in objList){
                if(objList.hasOwnProperty(k)){
                    if(objList[k].tagName == 'OPTION'){
                        //console.log($(objList[k]).attr('data-price'));
                        if(val == $(objList[k]).attr('value')){
                            parentObj.find('input[name="price[]"]').val($(objList[k]).attr('data-price'));
                            return true;
                        }
                    }
                }
            }
        };

        var _initi = function(){
            $('body').on('click' , function(){
                if($('#loadingToast').css('opacity') == 1 && $('#loadingToast i').hasClass('weui-icon-cancel')){
                    _promptBox('hide');
                }
            });

            $('.addgoodsinfo-a').on('click',function(){
                var html = _addGoodsInfo();
                $('.package-container-div').append(html);
            });

            $('.submit-a').on('click' , function(){
                _promptBox('showLoading');
                var dataStrFromForm = $("form").serializeArray();
                $.get('<?php echo U('OrderProcess/OrderApprove/actionRequestService') ?>',{type:'submitform',data:dataStrFromForm},function(data){
                    var dataJson = JSON.parse(data);
                    if(dataJson.error){
                        _promptBox('warm' , dataJson.msg);
                    }else{
                        window.location.href='<?php echo U('ApproveCenter/ApproveCenter') ?>';
                    }
                });
            });
            //获取用户信息
            $('input[name="rece_tel"]').on('blur' , function(){
                _promptBox('showLoading');
                $.get('<?php echo U('OrderProcess/OrderApprove/actionRequestService') ?>',{type:'getaddress',tel:$(this).val()},function(data){
                    var responseJson = JSON.parse(data);
                    if(responseJson['tel'] != 0){
                        $('input[name="rece_name"]').val(responseJson['name']);
                        $('input[name="rece_addr"]').val(responseJson['addr']);
                    }
                    _promptBox('hide');
                });
            });

        }();



        return {
            delPackage:_delPackage,
            onChange:_onChangePackage,
            onChangeOrderType : _onChangeOrderType
        }

    }();




</script>

</body>
</html>