<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>
		<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
		<title></title>
	</head>
	<body>
		<div class="main">
			<div class="bgfff clearfix bbt mb10">
				<a href="<?php echo U('ApproveCenter/ApproveCenter/actionWaitOfMyApprove') ?>">
					<div class="fl w33 pt15 pb15">
						<div class="apply-icon ct ai1"></div>
						<p class="c949f ftc ft14">待我审批</p>
					</div>
				</a>

				<a href="<?php echo U('ApproveCenter/ApproveCenter/actionMyApprove') ?>">
				<div class="fl w33 pt15 pb15">
					<div class="apply-icon ct ai2"></div>
					<p class="c949f ftc ft14">我发起的</p>
				</div>
				</a>

				<div class="fl w33 pt15 pb15">
					<div class="apply-icon ct ai3"></div>
					<p class="c949f ftc ft14">待我审批</p>
				</div>
			</div>
			<div class="bbt clearfix bgfff">
				<a class="w33 fl blockflame block" href="<?php echo U('OrderProcess/OrderApprove') ?>">
					<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply1.png" class="ct block" width="36px"/>
					<p class="c949f ft14 mt5 ftc">订单申请</p>
				</a>
				<!--<a class="w33 fl blockflame block" href="">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" class="ct block" width="36px"/>-->
					<!--<p class="c949f ft14 mt5 ftc">请假申请</p>-->
				<!--</a>-->
				<!--<a class="w33 fl blockflame block" href="">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply3.png" class="ct block" width="36px"/>-->
					<!--<p class="c949f ft14 mt5 ftc">请假申请</p>-->
				<!--</a>-->
				<!--<a class="w33 fl blockflame block" href="">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply4.png" class="ct block" width="36px"/>-->
					<!--<p class="c949f ft14 mt5 ftc">请假申请</p>-->
				<!--</a>-->
				<!--<a class="w33 fl blockflame block" href="">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply5.png" class="ct block" width="36px"/>-->
					<!--<p class="c949f ft14 mt5 ftc">请假申请</p>-->
				<!--</a>-->
				<!--<a class="w33 fl blockflame block" href="">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply6.png" class="ct block" width="36px"/>-->
					<!--<p class="c949f ft14 mt5 ftc">请假申请</p>-->
				<!--</a>-->
			</div>
		</div>
	</body>
	<script type="text/javascript">
		var blockwidth=$(".blockflame").width();
		var pad=blockwidth/2-31;
		$(".blockflame").css("padding",pad);
	</script>
</html>