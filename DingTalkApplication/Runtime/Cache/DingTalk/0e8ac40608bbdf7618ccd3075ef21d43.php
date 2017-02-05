<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>
		<title></title>
	</head>
	<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
	<body>

		<div class="main operation-div hide">
			<textarea name="" placeholder="请输入同意/不同意理由" rows="" cols="" class="pad15 ft14 c333 w100 block bbt" ></textarea>
		</div>

		<div class="main applyinfo">
			<div class="pl10 bgfff bbt">
				<a href="" class="bbt pt10 pb10 pr10 clearfix block">
					<div class="fl ell-width">
						<p class="ellipsis ft15">吴丹吴丹 的申请</p>
						<p class="c999 ft12">2016.02.03</p>
					</div>
					<p class="fr orange ft16 pt10">待审批</p>
				</a>
				<div class="pt10 pb10 pr10">
					<div class="clearfix mb5">
						<p class="c949f dib fl ft14">基本信息：</p>
						<p class="ft14 information">及第三方哈师大发贺卡上的家伙发卡上的回复看见爱上的话费卡手机话费</p>
					</div>
					<div class="clearfix mb5">
						<p class="c949f dib fl ft14">基本信息：</p>
						<p class="ft14 information">及第三方哈师大发贺卡上的家伙发卡上的回复看见爱上的话费卡手机话费</p>
					</div>
				</div>
				<div class="pt10 pb10 pr10 btop">
					<p class="ft16">抄送人<span class="c999 ft14">(审批人全部处理后，将抄送给以下人员)</span></p>
					<div class="clearfix mt15">
						<div class="fl mr15">
							<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="round30"/>
							<p class="ftc">黄思琪</p>
						</div>
						<div class="fl mr15">
							<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="round30"/>
							<p class="ftc">黄思琪</p>
						</div>
					</div>
				</div>
			</div>
			<div class="pl20 mb60">
				<div class="bleft rela pt15 pr20 pl15">
					<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>
					<div class="b-all round5 bgfff pad10 clearfix">
						<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>
						<div class="ml60">
							<p class="ft15 mt5">黄思琪</p>
							<p class="cgreen ft14">发起申请</p>
						</div>
					</div>
				</div>
				<div class="bleft rela pt15 pr20 pl15">
					<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>
					<div class="b-all round5 bgfff pad10 clearfix">
						<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>
						<div class="ml60">
							<p class="ft15 mt5">黄思琪</p>
							<p class="cgreen ft14">审批中</p>
						</div>
					</div>
				</div>
				<div class="bleft rela pt15 pr20 pl15">
					<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>
					<div class="b-all round5 bgfff pad10 clearfix">
						<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>
						<div class="ml60">
							<p class="ft15 mt5">黄思琪</p>
							<p class="cred ft14">已拒绝<span class="c999">(留言留言留言留言留言留言留言留言留言留言)</span></p>
						</div>
					</div>
				</div>
				<div class="bleft rela pt15 pr20 pl15">
					<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>
					<div class="b-all round5 bgfff pad10 clearfix">
						<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>
						<div class="ml60">
							<p class="ft15 mt5">黄思琪</p>
							<p class="cred ft14"><span class="c999">(留言留言留言留言留言留言留言留言留言留言)</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--待申请 开始-->
		<div class="fixed clearfix bgfff btop fix-position w100 btn-applyinfo">
			<a href="" class="ftc w33 cblue lh40 ft16 block fl">同意</a>
			<a href="" class="ftc w33 cblue lh40 ft16 block fl">不同意</a>
			<a href="" class="ftc w33 cblue lh40 ft16 block fl">转交</a>
		</div>
		<!--待申请 结束-->
		<!--拒绝 开始-->
		<div class="fixed fix-position bgfff pt10 pb10 pr20 pl20 w100 hide btn-operation">
			<a href="javascript:;" class="bgblue cfff block w100 round5 ft16 ftc pad5">同意</a>
		</div>
		<!--拒绝 结束-->


	<script>

		var showApplyInfo = function(){
			$('.applyinfo').hide();
			$('.operation-div').show();

			$('.btn-applyinfo').hide();
			$('.btn-operation').show();


		}



	</script>

	</body>
</html>