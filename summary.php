<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Europe/Istanbul');

?>
<?php

include 'inc/head.php';
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
$json_string = 'http://77.245.158.71/count.php';
$jsondata = file_get_contents($json_string);
$subobj = json_decode($jsondata, true);
?>
<?php
$json_string = 'http://api.openweathermap.org/data/2.5/weather?q=Mersin&appid=541515afee797cfd215e0b69dfe8c5d9';
$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata, true);

$status = array("200","201","202","210","211","212","221","230","231","232");
$status2 = array("300","301","302","310","311","312","313","314","321");
$status3 = array("500","501","502","503","504","511","520","521","522","531");
$status4 = array("600","601","602","611","612","615","616","620","621","622");
$status5 = array("701","711","721","731","741","751","761","762","771","781");
$status6 = array("800");
$status7 = array("801","802","803","804");
if (in_array($obj['weather'][0]['id'], $status)) {

    $durum = "Sağnak Yağmurlu";
}
if (in_array($obj['weather'][0]['id'], $status2)) {

    $durum = "Yağmur Çiseliyor";
}
if (in_array($obj['weather'][0]['id'], $status3)) {

    $durum = "Hafif Yağmurlu";
}
if (in_array($obj['weather'][0]['id'], $status4)) {

    $durum = "Kar Yağışlı";
}
if (in_array($obj['weather'][0]['id'], $status5)) {

    $durum = "Sisli";
}
if (in_array($obj['weather'][0]['id'], $status6)) {

    $durum = "Hava Açık";
}
if (in_array($obj['weather'][0]['id'], $status7)) {

    $durum = "Bulutlu";
}


?>


<body class="nav-md">

<div class="container body">


    <div class="main_container">

        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php" class="site_title"><i class="fa
fa-paw"></i> <span>SiriCount v2.0!</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="images/user.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Hoşgeldin,</span>
                        <h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <?php
                include 'inc/sidebar.php';
                ?>


                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Ayarlar">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Tam Ekran">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Kilit">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Oturumu Kapat">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <?php include 'inc/navigation.php';?>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">

            <div class="row">
                <div class="col-md-12">

                    <!-- form date pickers -->
                    <div class="x_panel" style="">
                        <div class="x_title">
                            <h2><b id="buTarih"></b><small>tarihine ait raporları inceliyorsunuz.</small></h2>

                            <div class="col-md-8">
                                <form name="name" method="GET" >
                                    <div id="reportrange" class="pull-right"
                                         style="background: #fff; cursor: pointer;
                                    padding: 5px 10px; border: 1px solid #ccc">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span><?php  $objDateTime = new DateTime('NOW');
                                            echo $objDateTime->format('d.m.Y');
                                            ?>-<?php  $objDateTime = new DateTime('NOW');
                                            $objDateTime->modify('last day of this month');
                                            echo $objDateTime->format('d.m.Y');
                                            ?></span> <b class="caret"></b>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>


                        </div>
                    </div>


                    <div class="row top_tiles" style="margin: 10px 0;">

                        <div class="col-md-3 tile">
                            <span>Günlük Toplam</span>
                            <h2 id="dunOran"></h2>
                            <span class="sparkline_two" style="height: 160px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                        </div>
                        <div class="col-md-3 tile">
                            <span>Saatlik Toplam</span>
                            <h2 id="buSaat"></h2>
                            <span class="sparkline_two" style="height: 160px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                        </div>
                        <div class="col-md-3 tile">
                            <span>Dış Alan</span>
                            <h2>------</h2>
                            <span class="sparkline_two" style="height: 160px;">
                                    <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                        </div>
                        <div class="col-md-3 tile_stats_count">
                            <div class="left"></div>
                            <div class="right">
                                <span class="count_top"><i class="fa fa-cloud"></i> HavaDurumu</span>
                                <div class="count"><b class="red">
                                        <?php echo floor($obj['main']['temp']-273);?></b>°C</div>
                                <span class="count_bottom"><i class="green">
                                    <i class="owf owf-<?php echo $obj['weather'][0]['id'];?> owf-lg">
                                    </i>
                                </i><?php echo $durum ?>
                            </span>
                            </div>
                        </div>


                    </div>



                    <div class="row">
                        <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="col-md-4">
                                        <h2>Saatlik Trend <small></small></h2>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style="margin: auto; height: 40vh; width: 80vw;">
                                    <canvas id="mybarChart""></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-- Daily Trend -->

                    <div class="row">
                        <div class="col-md-12 col-sm-8 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Günlük Trend</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <canvas id="mydaychart"></canvas>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /Daily Trend -->





                    <!-- footer content -->
                    <?php include 'inc/footer.php'; ?>
                    <!-- /footer content -->
                </div>
                <!-- /page content -->

            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>


        !-- sparkline -->
        <script src="js/sparkline/jquery.sparkline.min.js"></script>
        <!-- User Script -->


        <script src="js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
        <!-- chart js -->

        <script data-require="chart.js@2.6.0" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>


        <!-- flot js -->
        <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
        <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
        <script type="text/javascript" src="js/flot/date.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
        <script type="text/javascript" src="js/flot/curvedLines.js"></script>
        <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>



        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>

        <!-- datepicker -->
        <script type="text/javascript">
            $(document).ready(function() {

                var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.locale('tr').format('MMMM D, YYYY') + ' - '
                        + end.locale('tr').format('MMMM D, YYYY'));
                    //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
                }

                var optionSet1 = {
                    startDate: moment().subtract(15, 'days'),
                    endDate: moment(),
                    minDate: '31/01/2019',
                    maxDate: '31/12/2019',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Bugün': [moment(), moment().subtract(1, 'days')],
                        'Dün': [moment().subtract(1, 'days'), moment()],
                        'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
                        'Son 30 Gün': [moment().subtract(29, 'days'), moment()],
                        'Bu Ay': [moment().startOf('month'), moment().endOf('month')],
                        'Son Ay': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    locale: {
                        applyLabel: 'Uygula',
                        cancelLabel: 'Temizle',
                        fromLabel: 'Tarihinden',
                        toLabel: 'Tarihine',
                        customRangeLabel: 'Özel',
                        daysOfWeek: ['Pz', 'Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct'],
                        monthNames: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz',
                            'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                        firstDay: 1
                    }
                };
                $('#reportrange span').html(moment().locale('tr').subtract(29,
                    'days').locale('tr').format('MMMM D, YYYY') + ' - ' +
                    moment().locale('tr').format('MMMM D, YYYY'));
                $('#reportrange').daterangepicker(optionSet1, cb);
                $('#reportrange').on('show.daterangepicker', function() {
                    console.log("show event fired");
                });
                $('#reportrange').on('hide.daterangepicker', function() {
                    console.log("hide event fired");
                });



                <!-- Menu Widget Data -->
                console.log(getValue().datax);
                document.getElementById("dunOran").innerHTML = getValue().datax;
                document.getElementById("buSaat").innerHTML = getValue().busaat;
                document.getElementById("buTarih").innerHTML = moment().locale('tr').format('DD.MMMM.YYYY');
                function getValue() {

                    var datax;
                    var busaat;
                    $.ajax({
                        type: 'GET',
                        url: "../../count.php",
                        async: false,
                        dataType: 'json',
                        success: function (resp) {
                            datax = resp.map(function(e) {return e.Giris;});
                            //datax.unshift("Pazartesi");
                            busaat = resp.map(function(e) {return e.BuSaat;});
                            //datatarih.unshift("Month");
                            //console.log ("Resp",datax);
                        }
                    });
                    return { datax: datax,
                        busaat: busaat}
                }


                <!-- /Menu Widget Data-->

                <!-- Default Bar Script -->
                // Bar chart
                var canvas = document.getElementById("mybarChart");
                var ctx = canvas.getContext('2d');
                var chartType = 'bar';
                var myBarChart;
                var data = {
                    labels: [],
                    datasets: [{
                        label: 'Dün, bu saatte',
                        backgroundColor: "rgba(3, 88, 106, 0.65)",
                        data: []
                    }, {
                        label: 'Bugün',
                        backgroundColor: "rgba(38, 185, 154, 0.65)",
                        data: []
                    }]
                };

                var options = {
                    barPercentage: 0.7,
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };
                //destroyChart(myBarChart);

                init();

                updateConfigByMutating(window.myBarChart);
                updateConfigByMutating2(window.myBarChart);
                function updateConfigByMutating(chart) {
                    var myObject = {name: moment().format('DD.MM.YYYY'), s: "submit"};
                    $.getJSON("../../tcountSearch.php",myObject, function(jd) {
                        //console.log("jd",jd);
                        var datax = jd.map(function(e) {return e.Tarih;});
                        //console.log("Tarih",datax);
                        var datay = jd.map(function(e) {return e.Giris; });
                        //console.log("tcounty",datay);
                        chart.data.labels = datax;
                        chart.data.datasets[1].data = datay;
                        chart.update();
                    });
                }
                function updateConfigByMutating2(chart) {
                    var myObject = {name: moment().subtract(1, 'days').format('DD.MM.YYYY'), s: "submit"};
                    $.getJSON("../../tcountSearch.php",myObject, function(jd) {
                        var datay = jd.map(function(e) {return e.Giris;});
                        console.log("Son Tarih",datay);
                        chart.data.datasets[0].data = datay;
                        chart.update();
                    });
                }
                function init() {
                    //Chart declaration:
                    if (window.myBarChart != undefined)
                        window.myBarChart.destroy();
                    window.myBarChart = new Chart(ctx, {
                        type: chartType,
                        data: data,
                        options: options
                    });
                }
                <!-- /Default Bar Script Data-->


                <!-- Default Daily Trend Script -->

                console.log("Month Value", getMonthValue().datax);

                // Bar chart
                var canvasd = document.getElementById("mydaychart");
                var ctxd = canvasd.getContext('2d');
                // We are only changing the chart type, so let's make that a global variable along with the chart object:
                var chartTyped = 'bar';
                var myBarChartd;
                var datad = {
                    labels: getMonthValue().datatarih,
                    datasets: [{
                        label: "Aylık Ziyaret",
                        fill: true,
                        lineTension: 0.1,
                        backgroundColor: "rgba(3, 88, 106,0.6)",
                        borderCapStyle: 'square',
                        pointBorderColor: "white",
                        pointBackgroundColor: "green",
                        pointBorderWidth: 1,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: "yellow",
                        pointHoverBorderColor: "green",
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                        pointHitRadius: 10,
                        data: getMonthValue().datax,
                        spanGaps: true,
                        datalabels: {
                            align: 'end',
                            anchor: 'end'
                        }
                    }]
                };

                // Notice the scaleLabel at the same level as Ticks
                var optionsd = {
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 20,
                            bottom: 0
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 500,
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        fontSize: 12,
                        display: false,
                        text: 'Aylık Ziyaret Tablosu',
                        position: 'top'
                    }
                };


                initd();
                getMonthValue(myBarChartd);

                function getMonthValue(chart) {

                    var datax;
                    var datatarih;
                    $.ajax({
                        type: 'GET',
                        url: "../../daycount.php",
                        async: false,
                        dataType: 'json',
                        success: function (resp) {
                            datax = resp.map(function(e) {return e.Count;});
                            //datax.unshift("Pazartesi");
                            datatarih = resp.map(function(e) {return e.Tarih;});
                            //datatarih.unshift("Month");
                            //console.log ("Resp",datax);
                            chart.update();
                        }
                    });
                    return { datax: datax,
                        datatarih: datatarih}
                }

                function initd() {
                    // Chart declaration:
                    myBarChartd = new Chart(ctxd, {
                        type: chartTyped,
                        data: datad,
                        options: optionsd
                    });

                }


                <!-- /Default Daily Trend Script -->







                $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.locale('tr').format('DD.MM.YYYY') + " to " +
                        picker.endDate.locale('tr').format('DD.MM.YYYY') + " to " + picker.startDate.locale('tr').format('W'));

                    // Get Metodu ile JSON Cagirma

                    //document.name.action = "../../tcountSearch.php";
                    //document.name.method = 'POST';
                    //z= picker.startDate.locale('tr').format('DD.MM.YYYY');
                    //document.name.innerHTML = '<input name="name"'+'value='+z+'>';
                    //input = document.createElement("input");
                    //input.name = 's';
                    //input.value = 'submit';
                    //document.name.appendChild(input);
                    //document.getElementById("reportrange").appendChild(input);
                    //document.name.submit();
                    //
                    //var startDate = picker.startDate.locale('tr').format('DD.MM.YYYY');
                    //console.log (startDate);



                    // Bar chart
                    var canvas = document.getElementById("mybarChart");
                    var ctx = canvas.getContext('2d');
                    var chartType = 'bar';
                    var myBarChart;
                    var data = {
                        labels: [],
                        datasets: [{
                            label: picker.startDate.locale('tr').format('DD.MM.YYYY')+' bu saatte',
                            backgroundColor: "rgba(3, 88, 106, 0.65)",
                            data: []
                        }, {
                            label: picker.endDate.locale('tr').format('DD.MM.YYYY')+' bu saat',
                            backgroundColor: "rgba(38, 185, 154, 0.65)",
                            data: []
                        }]
                    };

                    var options = {
                        responsive: true,
                        barPercentage: 0.7,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };
                    //destroyChart(myBarChart);


                    init();

                    updateConfigByMutating(window.myBarChart);
                    updateConfigByMutating2(window.myBarChart);
                    function updateConfigByMutating(chart) {
                        //chart.destroy();
                        var myObject = {name: picker.startDate.locale('tr').format('DD.MM.YYYY'), s: "submit"};

                        $.getJSON("../../tcountSearch.php",myObject, function(jd) {
                            console.log("jd",jd);
                            var datax = jd.map(function(e) {
                                return e.Tarih;
                            });
                            console.log("tcountx",datax);
                            var datay = jd.map(function(e) {
                                return e.Giris;
                            });
                            console.log("tcounty",datay);
                            chart.data.labels = datax;
                            chart.data.datasets[0].data = datay;
                            chart.data.datasets[0].label = picker.startDate.locale('tr').format('D MMMM');


//		 chart.data.labels = ["2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012",
//"2013", "2014", "2015", "2016"];
                            //   		chart.data.datasets[0].data = [10, 13, 17, 12, 30, 47, 60, 120, 230, 300, 310, 400];
                            chart.update();

                        });
                    }

                    function updateConfigByMutating2(chart) {
                        //chart.destroy();
                        var myObject = {name: picker.endDate.locale('tr').format('DD.MM.YYYY'), s: "submit"};

                        $.getJSON("../../tcountSearch.php",myObject, function(jd) {
                            console.log("jd",jd);
                            var datay = jd.map(function(e) {
                                return e.Giris;
                            });
                            //console.log("tcounty",datay);
                            chart.data.datasets[1].data = datay;
                            chart.data.datasets[1].label = picker.endDate.locale('tr').format('D MMMM');
                            chart.update();

                        });
                    }



                    function init() {
                        //Chart declaration:
                        if (window.myBarChart != undefined)
                            window.myBarChart.destroy();
                        window.myBarChart = new Chart(ctx, {
                            type: chartType,
                            data: data,
                            options: options
                        });
                        //myBarChart.destroy();
                    }

                    //function destroyChart(chart) {
                    //	 //destroy chart:
                    //	chart.destroy();
                    //restart chart:
                    //	init();
                    //}

                    <!-- Dynamic Menu Widget Data -->
                    //console.log(getValue().datax);
                    document.getElementById("dunOran").innerHTML = getValue().datax;
                    document.getElementById("buSaat").innerHTML = getValue().busaat;
                    document.getElementById("buTarih").innerHTML = picker.startDate.locale('tr').format('DD.MMMM.YYYY');
                    function getValue() {

                        var datax;
                        var busaat;
                        $.ajax({
                            type: 'GET',
                            url: "../../countSearch.php?s=submit&name="+picker.startDate.locale('tr').format('DD'),
                            async: false,
                            dataType: 'json',
                            success: function (resp) {
                                datax = resp.map(function(e) {return e.Giris;});
                                //datax.unshift("Pazartesi");
                                busaat = resp.map(function(e) {return e.BuSaat;});
                                //datatarih.unshift("Month");
                                //console.log ("Resp",datax);
                            }
                        });
                        return { datax: datax,
                            busaat: busaat}
                    }


                    <!-- /Menu Widget Data-->





                });
                $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                    console.log("cancel event fired");
                    mybarChart.destroy();
                    mybarChart = new Chart(ctx, {
                        data: [12, 19, 3, 5, 2, 3],
                        type: 'line',
                    });
                });
            });
            $('#options1').click(function() {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function() {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function() {
                $('#reportrange').data('daterangepicker').remove();
            });


        </script>
        <!-- /datepicker -->



        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>

        <script src="js/custom.js"></script>
        <script>
            $('document').ready(function() {
                $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                    type: 'bar',
                    height: '40',
                    barWidth: 9,
                    colorMap: {
                        '7': '#a1a1a1'
                    },
                    barSpacing: 2,
                    barColor: '#26B99A'
                });

                $(".sparkline_two").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                    type: 'line',
                    width: '200',
                    height: '40',
                    lineColor: '#26B99A',
                    fillColor: 'rgba(223, 223, 223, 0.57)',
                    lineWidth: 2,
                    spotColor: '#26B99A',
                    minSpotColor: '#26B99A'
                });
            })
        </script>


        <!-- /footer content -->
</body>

</html>

