<!DOCTYPE html>
<html lang="en">

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

        <!-- top tiles -->
        <div class="row tile_count">
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Yıllık 
Ziyaret</span>
              <div class="count"><b id="thisyear"></b></div>
              <span class="count_bottom"><i class="example"><i id="beforeyear"></i>%</i> Geçen Yıla 
Göre</span>
            </div>
          </div>
           <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-clock-o"></i> 
Aylık Ziyaret</span>
              <div class="count"><b id="thismonth"></b></div>
              <span class="count_bottom"><i class="example"><i id="beforemonth"></i>%</i> Geçen Aya 
Göre</span>
            </div>
          </div>

          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Haftalık Ziyaret</span>
              <div class="count green"><b id="thisweek"></b></div>
              <span class="count_bottom"><i class="example"><i id="beforeweek"></i>%</i> 
Geç. Haft. Göre</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Günlük 
Ziyaret</span>
              <div class="count"><b id=enter></b></div>
              <span class="count_bottom"><i class="example"><i id="beforeday"></i>%</i> 
Düne Göre</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Saatlik 
Ziyaret</span>
              <div class="count"><b id="thishour"></b></div>
              <span class="count_bottom"><i class="example"><i id="beforehour"></i>%</i> Bir Saat 
Önce</span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-cloud"></i> Hava 
Durumu</span>
              <div class="count"><b class="red"><?php echo floor($obj['main']['temp']-273);?></b>°C</div>
              <span class="count_bottom"><i class="green"><i class="owf owf-<?php echo $obj['weather'][0]['id'];?> owf-lg"></i></i><?php echo $durum ?></span>
            </div>
          </div>

        </div>
        <!-- /top tiles -->

	<div class="row">
            <div class="col-md-12">

              <!-- form date pickers -->
              <div class="x_panel" style="">
                <div class="x_title">
                  <h2>Tarih Seçimi <small> İstediğiniz tarih aralığını raporlayabilirsiniz.</small></h2>
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
	</div></div>


	 <div class="row">


            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
			<div class="col-md-4">
                  <h2>Haftalık Karşılaştırmalı Grafik<small></small></h2></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
			<div class="col-md-4">
                  	<h2>Günlük Karşılaştırmalı Grafik <small>
			</small></h2>
			</div>
	

		<div class="clearfix"></div>
	      </div>
	

                <div class="x_content">
                  <canvas id="mybarChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>



	 <div class="row">
            <div class="col-md-12 col-sm-8 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Aylık Grafik</h2>
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

                  <div id="mainb" style="height:350px;"></div>

                </div>
              </div>
            </div>
	<div class="row">
        <br />

	<div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Günlük Trafik(<?php  $objDateTime = new DateTime('NOW');
                                $objDateTime->modify('this week monday');
                                echo $objDateTime->format('d.m');
                                ?>-<?php  $objDateTime = new DateTime('NOW');
                                $objDateTime->modify('this week first sunday');
                                echo $objDateTime->format('d.m');
                                ?>)</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

		 <div id="myfirstchart" style="height: 250px;"></div>

              </div>
            </div>
          </div>
	
	  <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Haftalık Trafik (<?php  $objDateTime = new DateTime('NOW');
				$objDateTime->modify('first day of this month');
                                echo $objDateTime->format('d.m');
                                ?>-<?php  $objDateTime = new DateTime('NOW');
				$objDateTime->modify('last day of this month');
                                echo $objDateTime->format('d.m');
                                ?>)</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
		 <div id="myfirstline" style="height: 250px;"></div>

              </div>
            </div>
          </div>

	</div>		
	 </div>
	


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
  
  <!-- User Script -->
  <script>
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
    			var myObj = JSON.parse(this.responseText);
    			//console.log (myObj);
    			document.getElementById("enter").innerHTML = myObj[0].Giris;
    			//document.getElementById("exit").innerHTML = myObj[0].Cikis;
			document.getElementById("thisyear").innerHTML = myObj[0].BuYil;
			document.getElementById("thismonth").innerHTML = myObj[0].BuAy;
			document.getElementById("thisweek").innerHTML = myObj[0].BuHafta;
			document.getElementById("thishour").innerHTML = myObj[0].BuSaat;
			//document.getElementById("thisnow").innerHTML = myObj[0].Cikis-myObj[0].Giris;
			var oran = document.getElementById("beforeday").innerHTML = 
			(((myObj[0].Giris-myObj[0].DunOran)/myObj[0].DunOran)*100).toFixed(0);
			var saatoran = document.getElementById("beforehour").innerHTML =
			(((myObj[0].BuSaat-myObj[0].SaatOran)/myObj[0].SaatOran)*100).toFixed(0);
			if (myObj[0].YilOran == 0) {
			 var yiloran = document.getElementById("beforeyear").innerHTML =  "-";
			} else {
			var yiloran = document.getElementById("beforeyear").innerHTML =
			(((myObj[0].BuYil-myObj[0].YilOran)/myObj[0].YilOran)*100).toFixed(0);
			};
			var haftaoran = document.getElementById("beforeweek").innerHTML =
                        (((myObj[0].BuHafta-myObj[0].HaftaOran)/myObj[0].HaftaOran)*100).toFixed(0);
                        };
			if (myObj[0].AyOran == 0) {
                         var ayoran = document.getElementById("beforemonth").innerHTML =  "-";
                        } else {
                        var ayoran = document.getElementById("beforemonth").innerHTML =
                        (((myObj[0].BuAy-myObj[0].AyOran)/myObj[0].AyOran)*100).toFixed(0);
                        };
			//console.log(oran);
			var z =  document.getElementsByClassName("example")[0];
			var v =  document.getElementsByClassName("example")[1];
			var w =  document.getElementsByClassName("example")[2];
			var x =  document.getElementsByClassName("example")[3];
			var y =  document.getElementsByClassName("example")[4];	
			if (oran <= 0) {
			  x.style.color = "red";
			  x.classList.add("fa");
			  x.classList.add("fa-sort-desc");
			} else if (oran > 0) {
			  x.style.color = "#1ABB9C";
                          x.classList.add("fa");
                          x.classList.add("fa-sort-asc");
			};
                        if (saatoran <= 0) {
                          y.style.color = "red";
                          y.classList.add("fa");
                          y.classList.add("fa-sort-desc");
                        } else if (saatoran > 0) {
                          y.style.color = "#1ABB9C";
                          y.classList.add("fa");
                          y.classList.add("fa-sort-asc");
                        };
			if (yiloran <= 0) {
                          z.style.color = "red";
                          z.classList.add("fa");
                          z.classList.add("fa-sort-desc");
                        } else if (yiloran > 0) {
                          z.style.color = "#1ABB9C";
                          z.classList.add("fa");
                          z.classList.add("fa-sort-asc");
                        };
			if (haftaoran <= 0) {
                          w.style.color = "red";
                          w.classList.add("fa");
                          w.classList.add("fa-sort-desc");
                        } else if (haftaoran > 0) {
                          w.style.color = "#1ABB9C";
                          w.classList.add("fa");
                          w.classList.add("fa-sort-asc");
                        };
			if (ayoran <= 0) {
                          v.style.color = "red";
                          v.classList.add("fa");
                          v.classList.add("fa-sort-desc");
                        } else if (ayoran > 0) {
                          v.style.color = "#1ABB9C";
                          v.classList.add("fa");
                          v.classList.add("fa-sort-asc");
                        };
  		
	};
	xmlhttp.open("GET", "../../count.php", true);
	xmlhttp.send();
  </script>


  <script src="js/bootstrap.min.js"></script>

  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>


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

  <!-- dashbord linegraph -->
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var data = {
      labels: [
        "Kadın",
        "Erkek",
        "Çocuk-Bebek"
      ],
      datasets: [{
        data: [61, 18, 21],
        backgroundColor: [
          "#455C73",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#34495E",
          "#36CAAB",
          "#49A9EA"
        ]

      }]
    };

    var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: data
    });
  </script>
     <!-- skycons -->
  <script src="js/skycons/skycons.min.js"></script>
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);

    icons.play();


  </script>
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
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2019',
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
          'Bugün': [moment(), moment()],
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



	<!-- Default LineChart Script -->
	// Line chart
        var canvas = document.getElementById("lineChart");
        var ctx = canvas.getContext('2d');
        var chartType = 'line';
        var data = {
                labels: [],
                datasets: [{
                        label: ["Bu Hafta"],
                        backgroundColor: "rgba(38, 185, 154, 0.35)",
                        borderColor: "rgba(38, 185, 154, 0.7)",
                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointBorderWidth: 1,
                        data: []
                }, {
                        label: ["Geçen Hafta"],
                        backgroundColor: "rgba(3, 88, 106, 0.35)",
                        borderColor: "rgba(3, 88, 106, 0.70)",
                        pointBorderColor: "rgba(3, 88, 106, 0.70)",
                        pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(151,187,205,1)",
                        pointBorderWidth: 1,
                        data: []
                 }]
               };
		
		initLineChart();

        updateConfigByLine(window.lineChart);
        updateConfigByLine2(window.lineChart);
        
	 function updateConfigByLine(chart) {
           var myObject = {name: moment().format('DD.MM.YYYY'), s: "submit"};
           $.getJSON("../../pre_wcount.php", function(jd) {
                //console.log("jd",jd);
                var ldatax = jd.map(function(e) {return e.Week;});
                console.log("Week",ldatax);
                var ldatay = jd.map(function(e) {return e.Trafik; });
                console.log("Trafik",ldatay);
                chart.data.labels = ldatax;
                chart.data.datasets[1].data = ldatay;
                chart.update();
            });
        }
         function updateConfigByLine2(chart) {
           var myObject = {name: moment().subtract(1, 'days').format('DD.MM.YYYY'), s: 
"submit"};
           $.getJSON("../../wcount.php", function(jd) {
                var ldatay = jd.map(function(e) {return e.Trafik;});
                console.log("Week",ldatay);
                chart.data.datasets[0].data = ldatay;
                chart.update();
            });
        }
        function initLineChart() {
                //Chart declaration:
                if (window.lineChart != undefined)
                   //window.lineChart.destroy();
                window.lineChart = new Chart(ctx, {
                        type: chartType,
                        data: data
                });
        }


	<!-- /Default LineChart Script -->



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
         		backgroundColor: "#26B99A",
          		data: []
        	}, {
          		label: 'Bugün',
          		backgroundColor: "#03586A",
          		data: []
        	}]
      	};

      	var options = {
		responsive: true,
                maintainAspectRatio: true,
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
	<!-- /Defaul Bar Script Data-->

       

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
          		label: 'İlk Seçilen,bu saatte',
         		backgroundColor: "#26B99A",
          		data: []
        	}, {
          		label: 'Son Seçilen, bu saat',
          		backgroundColor: "#03586A",
          		data: []
        	}]
      	};

      	var options = {
		responsive: true,
                maintainAspectRatio: true,
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
		chart.data.datasets[0].label = picker.startDate.locale('tr').format('D MMMM') + "'da bu saatte";


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
		chart.data.datasets[1].label = picker.endDate.locale('tr').format('D MMMM') + "'da bu saatte";
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
	<!-- LineChart Script -->
	// Line chart
        var canvas = document.getElementById("lineChart");
        var ctx = canvas.getContext('2d');
        var chartType = 'line';
        var data = {
                labels: [],
                datasets: [{
                        label: [],
                        backgroundColor: "rgba(38, 185, 154, 0.35)",
                        borderColor: "rgba(38, 185, 154, 0.7)",
                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointBorderWidth: 1,
                        data: []
                }, {
                        label: [],
                        backgroundColor: "rgba(3, 88, 106, 0.35)",
                        borderColor: "rgba(3, 88, 106, 0.70)",
                        pointBorderColor: "rgba(3, 88, 106, 0.70)",
                        pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(151,187,205,1)",
                        pointBorderWidth: 1,
                        data: []
                 }]
               };
		
		initLineChart();

        updateConfigByLine(window.lineChart);
        updateConfigByLine2(window.lineChart);
        
	 function updateConfigByLine(chart) {
           var myObject = {name: picker.startDate.locale('tr').format('W'), s: "submit"};
           $.getJSON("../../wcountSearch.php", myObject, function(jd) {
                //console.log("jd",jd);
                var ldatax = jd.map(function(e) {return e.Week;});
                console.log("Week",ldatax);
                var ldatay = jd.map(function(e) {return e.Trafik; });
                console.log("Trafik",ldatay);
                chart.data.labels = ldatax;
                chart.data.datasets[0].data = ldatay;
		chart.data.datasets[0].label = picker.startDate.locale('tr').format('W') + ". Hafta";
                chart.update();
            });
        }
         function updateConfigByLine2(chart) {
           var myObject = {name: picker.endDate.locale('tr').format('W'), s: "submit"};
           $.getJSON("../../wcountSearch.php", myObject, function(jd) {
                var ldatay = jd.map(function(e) {return e.Trafik;});
                console.log("Week",ldatay);
                chart.data.datasets[1].data = ldatay;
		chart.data.datasets[1].label = picker.endDate.locale('tr').format('W') + ". Hafta";
                chart.update();
            });
        }
        function initLineChart() {
                //Chart declaration:
                if (window.lineChart != undefined)
                   window.lineChart.destroy();
                window.lineChart = new Chart(ctx, {
                        type: chartType,
                        data: data
                });
        }


	<!-- /LineChart Script -->

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

	<!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  	<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>


        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>

	
	<script>

	

	</script>


	<script>

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var obj = this.responseText;
                        var day_data = JSON.parse(obj);

		/*Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[2] ) || 0; // use data for the age column
 
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                        ( isNaN( min ) && age <= max ) ||
                        ( min <= age   && isNaN( max ) ) ||
                        ( min <= age   && age <= max ) )
                {
                return true;
        }
	return false;
        }
        );      
 

          var handleDataTableButtons = function() {
              "use strict";
              var table = 0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
		data: day_data,
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
		"order": [[ 1, "desc" ]],
		"columnDefs": [
                	{ "type": "date-de", targets: [1] }
            	],
		"language": {
           		"url": "js/datatables/Turkish.json"
        	},
                responsive: !0
              });
		// Event listener to the two range filtering inputs to redraw on input
        	$('#min, #max').keyup( function() {
        	table.draw();
        	} );
            },
	     
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
	
	 TableManageButtons.init();

	 }
        };
        xmlhttp.open("GET", "../../dcount.php", true);
        xmlhttp.send(); // chart.	
	
        </script>
        

   <!-- moris js -->


  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>

  <script>

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var obj = this.responseText;
                        //console.log (obj);
                        // document.getElementById("graph").innerHTML = obj;
	 var week_data = JSON.parse(obj);
	 //console.log(week_data);
	//var x = "";
	//for (i in week_data) {
	//	x +=week_data[i].Week + " ";
	//};
	
	 //var x = week_data[0].Week;
	 //document.getElementById("wgraph").innerHTML = x;

  	$(function() {
	  new Morris.Bar({
	  	element: 'myfirstchart',
		hideHover: 'true',
		lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		//xLabels: 'week',
		fillOpacity: 0.6,
  		data: week_data,
  		xkey: 'Week',
		parseTime: false,
		smooth: false,
  		ykeys: ['Trafik'],
  		labels: ['Trafik']
	  });
	 });
	}

	};

        xmlhttp.open("GET", "../../wcount.php", true);
        xmlhttp.send();	// chart.
	

  </script>

<script>

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var obj = this.responseText;
                        //console.log (obj);
			//var x;
	 var week_data = JSON.parse(obj);
		//console.log(week_data);
		//x = week_data[1].Giris;
		
                //document.getElementById("graph").innerHTML = x;

  	$(function() {
	  new Morris.Area({
	  	element: 'myfirstline',
		hideHover: 'true',
		lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		//xLabels: 'Hafta',
		fillOpacity: 1,
		parseTime: false,
		resize: true,
  		data: week_data,
  		xkey: 'Hafta',
  		ykeys: ['Giris'],
  		labels: ['Giris']
	  });
	 });
	}

	};

        xmlhttp.open("GET", "../../ucount.php", true);
        xmlhttp.send();	// chart.
	


  </script>

   <script>
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var myObj = this.responseText;
			var x, city, wmonday,wsunday,wtuesday,wwednesday,wthursday;
			var data = JSON.parse(myObj);
			console.log(data);
	                x = data.list[0].main.temp-273;
			city = data.city.name;
			wmonday = data.list[0].main.temp-273;
			wsunday = data.list[5].main.temp-273;
			wtuesday = data.list[13].main.temp-273;
			wwednesday = data.list[21].main.temp-273;
			wthursday = data.list[29].main.temp-273;
			wstatus = data.list[5].weather[0].main;
			//console.log(city); 

                //document.getElementById("graph").innerHTML = x.toFixed(1);
		//document.getElementById("wcity").innerHTML = city;
		//document.getElementById("wmonday").innerHTML = wmonday.toFixed(0);
		//document.getElementById("wsunday").innerHTML = wsunday.toFixed(0);
		//document.getElementById("wtuesday").innerHTML = wtuesday.toFixed(0);
		//document.getElementById("wwednesday").innerHTML = wwednesday.toFixed(0);
		//document.getElementById("wthursday").innerHTML = wthursday.toFixed(0);
		
		//var ws =  document.getElementsByTagName("P");



		}

        };

        xmlhttp.open("GET", "http://api.openweathermap.org/data/2.5/forecast?q=Mersin&appid=541515afee797cfd215e0b69dfe8c5d9", true);
        xmlhttp.send(); // chart.

   </script>

   <script>

	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        var obj = this.responseText;
		 	var day_data = JSON.parse(obj);
			//console.log(day_data);
			//x = day_data[1].Giris;
			var x = [];

				for (i in day_data) {
					x += day_data[i].Gun;
                                        x += day_data[i].Tarih;
                                        x += day_data[i].Giris;
                                        x += "null";
                                        x += "null";
                                        x += "null";
				//console.log(x);
				}
			//console.log(x);
				//document.getElementById("myTr").innerHTML = x;

				//x=day_data[0].Gun;
	
	 		//var x = day_data[0].Week;
	

	/*Custom filtering function which will search data in column four between two values */
	$.fn.dataTable.ext.search.push(
    	function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[2] ) || 0; // use data for the age column
 
        	if ( ( isNaN( min ) && isNaN( max ) ) ||
             		( isNaN( min ) && age <= max ) ||
             		( min <= age   && isNaN( max ) ) ||
         	    	( min <= age   && age <= max ) )
        	{
            	return true;
        }
        return false;
    	}
	);	
 
	$(document).ready(function() {
	//console.log(day_data);
	var table = $('#example').DataTable( {
        data: day_data,
	deferRender: true,
	select: true,
        columns: [
            { title: "Name" },
            { title: "Position" },
            { title: "Salary" }
        ],
	"order": [[ 1, "desc" ]]
    } );
	
	// Event listener to the two range filtering inputs to redraw on input
    	$('#min, #max').keyup( function() {
        table.draw();
    	} );
	   } );	

		}
	};
        xmlhttp.open("GET", "../../dcount.php", true);
        xmlhttp.send();	// chart.
	


  </script>
  <script src="js/custom.js"></script>

  <!-- echart -->
  <script src="js/echart/echarts-all.js"></script>
  <script src="js/echart/green.js"></script>

  <script>
	 $.getJSON('../../daycount.php', function(jd) {
                console.log("jd",jd);
		var datax = jd.map(function(e) {
        	        return e.Count;
	             });
		console.log("x",datax);
		 var datay = jd.map(function(e) {
                        return e.Tarih;
                     });
		console.log("y",datay);

    var myChart9 = echarts.init(document.getElementById('mainb'), theme);
     myChart9.setOption({
      title: {
        text: 'Aylık Trafik',
        subtext: '(<?php  $objDateTime = new DateTime('NOW');
                                $objDateTime->modify('first day of this month'); 
                                echo $objDateTime->format('d.m.Y');
                                ?>-<?php  $objDateTime = new DateTime('NOW');
                                $objDateTime->modify('last day of this month'); 
                                echo $objDateTime->format('d.m.Y');
                                ?>)'
      },
      //theme : theme,
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        data: ['Bar', 'Cizgi']
      },
      toolbox: {
        show: false
      },
      calculable: false,
      xAxis: [{
        type: 'category',
	data: datay
	// data: ["1?", "2?", "3?", "4?", "5?", "6?", "7?", "8?", "9", "10?", "11?", "12?"]
      }],
      yAxis: [{
        type: 'value'
      }],
      series: [{
        name: 'Bar',
        type: 'bar',
        data: datax,
        markPoint: {
          data: [{
            type: 'max',
            name: 'Max'
          }, {
            type: 'min',
            name: 'Min'
          }]
        },
        markLine: {
          data: [{
            type: 'average',
            name: '200 Trafik Sınırı'
          }]
        }
      }, {
        name: 'Cizgi',
        type: 'line',
        data: datax,
        markPoint: {
          data: [{
            name: 'Tarih',
            value: 200,
            xAxis: 7,
            yAxis: 200,
            symbolSize: 18
          }, {
            name: 'BuAy',
            value: 2.3,
            xAxis: 11,
            yAxis: 3
          }]
        },
        markLine: {
          data: [{
            type: 'average',
            name: 'Averaj'
          }]
        }
      }]
    });

	
	});

 </script>
  <!-- /footer content -->
</body>

</html>

