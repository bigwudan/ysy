<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>
    <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/weui.css"/>
    <title>Document</title>

</head>
<body>
<div class="page">

    <div class="page__bd">
        <div class="weui-cells__title">订单申请</div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">客户电话</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  placeholder="必填">
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">收货人姓名</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number"  placeholder="必填">
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">收货人地址</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number"  placeholder="必填">
                </div>
            </div>
        </div>


        <div class="weui-cells contracttime" style="margin-top: 0">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p>要求发货时间</p>
                </div>
                <div class="weui-cell__ft">2017-11-01</div>
            </a>
        </div>



        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">配送方式</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="0">自提</option>
                        <option value="1">物流</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">商品</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="1">xx</option>
                        <option value="2">xxx</option>
                        <option value="3">xxxxx</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">订单类别</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="select2">
                        <option value="1">xx</option>
                        <option value="2">xxx</option>
                        <option value="3">xxxxx</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="weui-cells" style="margin-top:0">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">数量(库存20)</label></div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="number"  placeholder="必填">
                </div>
            </div>
        </div>





    </div>
    <div class="fixed fix-position bgfff pt10 pb10 pr20 pl20 w100">
        <a href="javascript:;" class="bgblue cfff block w100 round5 ft16 ftc pad5">提交</a>
    </div>
</div>
<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/myysy/Public/Dingtalk/Js/weui.min.js" type="text/javascript" charset="utf-8"></script>

<script>

    $('.contracttime').on('click', function () {
        var obj = $(this);
        obj.attr('date-type');
        weui.datePicker({
            start: 1990,
            end: new Date().getFullYear(),
            onChange: function (result) {
            },
            onConfirm: function (result) {
//                if((result[1]/10) < 1){
//                    result[1] = '0'+ result[1];
//                }
//                var contractDate = result[0]+'-'+result[1]+'-'+result[2];
//                $('p.'+obj.attr('date-type')).html(contractDate);
//
//                $('input[name="'+obj.attr('date-type')+'"]').val(contractDate);
            }
        });
    });


</script>

</body>
</html>