<?php if (!defined('THINK_PATH')) exit();?><nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">后台管理</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if(is_array($headTitleArr)): foreach($headTitleArr as $k=>$vo): ?><li <?php if($vo['active'] == 1 ): ?>class="active"<?php else: endif; ?>><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?><span class="sr-only">(current)</span></a></li><?php endforeach; endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">首页</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>