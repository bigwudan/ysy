<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/myysy/Public/Js/jquery-ui-1.10.3.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<body>
<?php echo ($body['head']); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <?php if($flag == 0 ): ?><a href="<?php echo U('statistics/Customerstatistics') ?>?type=1" type="button" class="btn btn-info pull-right">显示销售额</a>
            <?php else: ?>
                <a href="<?php echo U('statistics/Customerstatistics') ?>?type=0" type="button" class="btn btn-info pull-right">显示销量</a><?php endif; ?>
            <div id="container" style="min-width:400px;height:400px;"></div>
        </div>
    </div>

</div>
<script>
    var jsonData = <?php echo ($jsonData); ?>;
    var newList = [];
    var num = 0;
    for(var k in jsonData){
        if(jsonData.hasOwnProperty(k)){
            var tmpList = [];
            for(var k1 in jsonData[k]){
                if(jsonData[k].hasOwnProperty(k1)){
                    var tmpK1List = k1.split('-');
                    tmpK1List = Date.UTC(tmpK1List[0],tmpK1List[1]-1,1);
                    tmpList.push([tmpK1List , jsonData[k][k1]]);
                }
            }
            num ++;
            newList.push({name:k,data:tmpList});
        }
    }
    // create the chart
    $('#container').highcharts({
        chart: {

        },
        title: {
            text: '客户统计'
        },
        xAxis:{
            title:{
                text:'时间'
            },
            tickInterval:30*24 * 3600 * 1000,
            type: 'datetime',
            dateTimeLabelFormats:{
                millisecond:"%H:%M:%S.%L",
                second:"%H:%M:%S",
                minute:"%H:%M",
                hour:"%H:%M",
                day:"%m月%d日",
                week:"w-%m-%d",
                month:"%Y-%m",
                year:"%Y"
            }
        },

        yAxis:{
            title:{
            <?php if($flag == 0 ): ?>text:'销量'
            <?php else: ?>
                text:'销售额'<?php endif; ?>

            },

        } ,
        tooltip:{
            dateTimeLabelFormats:{
                millisecond:"%H:%M:%S.%L",
                second:"%H:%M:%S",
                minute:"%H:%M",
                hour:"4%H:4%M",
                day:"%Y-%m-%d",
                week:"%m-%d",
                month:"%Y-%m",
                year:"%Y"
            }

        },
        series:newList
    });

</script>



</body>
</html>