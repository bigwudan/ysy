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
			<div class="clearfix tab-top">
				<p class="fl w50 ftc pt10 pb10 tabblue">待我审批的(3)</p>
				<p class="fr w50 ftc pt10 pb10">我已审批的</p>
			</div>
			<div class="tab-box bgfff">
				<div class="tabone pl10">
					<a href="<?php echo U('ApproveCenter/ApproveCenter/actionApproveInfo') ?>" class="bbt pt10 pb10 pr10 clearfix block">
						<div class="fl ell-width">
							<p class="ellipsis ft14">吴丹吴111丹的申请</p>
							<p class="c999 ft12">2016.02.03</p>
						</div>
						<p class="fr orange ft16 pt10">待审批</p>
					</a>
				</div>
				<div class="tabone pl10 hide">
					<a href="" class="bbt pt10 pb10 pr10 clearfix block">
						<div class="fl ell-width">
							<p class="ellipsis ft14">吴丹吴丹的申请</p>
							<p class="c999 ft12">2016.02.03</p>
						</div>
						<p class="fr cgreen ft16 pt10">审批通过</p>
					</a>
					<a href="" class="bbt pt10 pb10 pr10 clearfix block">
						<div class="fl ell-width">
							<p class="ellipsis ft14">吴丹吴丹的申请</p>
							<p class="c999 ft12">2016.02.03</p>
						</div>
						<p class="fr cred ft16 pt10">审核不通过</p>
					</a>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(".tab-top p").bind('tap',function(){
			$(this).addClass("tabblue").siblings().removeClass('tabblue');
			var index=$(".tab-top p").index(this);
			$(".tab-box .tabone").eq(index).show().siblings().hide();
		})
	</script>
</html>