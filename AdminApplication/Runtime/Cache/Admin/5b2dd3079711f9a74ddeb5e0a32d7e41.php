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
            <select name="goodsname">
                <?php if(is_array($goodsname)): foreach($goodsname as $k=>$vo): ?><option value="<?php echo ($vo['goodsname']); ?>"><?php echo ($vo['goodsname']); ?></option><?php endforeach; endif; ?>
            </select>
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
            var goodsname = $('select[name="goodsname"]').val();
            var url = '<?php echo U('Statistics/Channelstatistics/actionAjaxFactory') ?>';
            $.get( url , {goodsname:goodsname} , function(data){

                var channelList = JSON.parse(data);
//                channelList['个人']
//                channelList['团购']
//                channelList['渠道']
                var tmp = null;

                if(channelList['渠道']){
                    tmp = _changeFun(channelList['渠道']);
                    _chart.get('series-1').setData(tmp);
                }else{
                    _chart.get('series-1').setData([]);
                }

                if(channelList['个人']){
                    tmp = _changeFun(channelList['个人']);
                    _chart.get('series-2').setData(tmp);
                }else{
                    _chart.get('series-2').setData([]);
                }

                if(channelList['团购']){
                    tmp = _changeFun(channelList['团购']);
                    _chart.get('series-3').setData(tmp);
                }else{
                    _chart.get('series-3').setData([]);
                }

            });
        };
        var _initi = function(){
            $('.pull-right').on('click' , _research);
            _chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '销售占比'
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
                    title:{
                        text:'销售'
                    }
                },
                plotOptions: {
                    column: {
                        stacking: 'percent'
                    }
                },
                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                    shared: true
                },
                series: [{
                    id:'series-1',
                    name: '渠道',
                    data: []
                }, {
                    id:'series-2',
                    name: '个人',
                    data: []
                }, {
                    id:'series-3',
                    name: '团购',
                    data: []
                }]
            });
        }();
    }();






</script>



</body>
</html>