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

<style>

    .select-type{
        display: inline-block;
        height: 34px;


    }


</style>

<?php echo ($body['head']); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <select name="customer">
                <?php if(is_array($customerList)): foreach($customerList as $k=>$vo): ?><option value="<?php echo ($vo['customername']); ?>"><?php echo ($vo['customername']); ?></option><?php endforeach; endif; ?>
            </select>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" value="0" name="mode" id="option1" autocomplete="off" checked>销售
                </label>
                <label class="btn btn-primary">
                    <input type="radio" value="1" name="mode" id="option2" autocomplete="off">销量
                </label>
            </div>

            <button name="btn-input" type="button" class="btn btn-info pull-right">搜索</button>
            <div id="container" style="min-width:400px;height:400px;"></div>
        </div>
    </div>
</div>
<script>
    var MyChart = function(){
        var _chart = null;
        var _changeFun = function(jsonData){
            var tmpList = [];
            for(var k1 in jsonData){
                if(jsonData.hasOwnProperty(k1)){
                    var tmpK1List = k1.split('-');
                    tmpK1List = Date.UTC(tmpK1List[0],tmpK1List[1]-1,1);
                    tmpList.push([tmpK1List , jsonData[k1]]);
                }
            }
            return tmpList;
        };
        var _research = function(){
            var customer = $('select[name="customer"]').val();
            var url = '<?php echo U('Statistics/Customerstatistics/actionAjaxFactory') ?>';
            var mode = $('input[name="mode"]:checked').val();
            var yTitle = mode==0 ? '销售' : '销量';
            $.get( url , {mode:mode,customer:customer} , function(data){
                data = JSON.parse(data);
                data = _changeFun(data);
                _chart.yAxis[0].setTitle({
                    text: yTitle
                });
                _chart.series[0].update({name:customer,data:data});
            });
        };
        var _initi = function(){
            $('.pull-right').on('click' , _research);
            _chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '销售排名'
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
                yAxis: {
                },
                series: [{
                    name:'请选择',
                    data: []
                }]
            });
        }();
    }();






</script>



</body>
</html>