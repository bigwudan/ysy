<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>角色管理</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<body>
<div class="container">
    <h1>后台管理系统</h1>
    <form method="get" action="<?php echo U("Login/Login/actionCheckUserInfo") ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">账号</label>
            <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="账号">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>


</body>
</html>