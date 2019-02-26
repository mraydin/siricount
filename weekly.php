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
	</div>
              </div>


    <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
			<div class="col-md-4">
                  <h2>Haftalık Trend<small></small></h2></div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><b id="weekName"></b>.Hafta</th>
                            <th>Bu Yıl</th>
                            <th>Geçen Yıl</th>
                            <th>Değişim</th>
                        </tr>
                        </thead>
                        <tbody id="theWeek">
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Toplam</td>
                            <td><b id="totalWeek"></b></td>
                            <td>--</td>
                            <td>%-</td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>


                <div class="row">
                    <br />

                    <div class="col-md-12 col-sm-8 col-xs-12">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h2>Haftalık Trend</h2>
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

                                <div id="myfirstchart" style="width: 20%; height: 220px"></div>

                            </div>
                        </div>
                    </div>

                </div>



                <div class="row">
            <div class="col-md-12 col-sm-8 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
            <div class="col-md-4">
                    <h2>Saatlik Trend <small>
            </small></h2>
            </div>
        <div class="clearfix"></div>
	      </div>
              <div class="x_content" >
                  <canvas id="mybarChart""></canvas>
                </div>
              </div>
            </div>
    </div>
          <div class="clearfix"></div>


	 <div class="row">
            <div class="col-md-12 col-sm-8 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Aylık Trend</h2>
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

	 </div>

    <div class="row">
        <div class="col-md-12 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Aylık Trend</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="chart_div" style="width: 100%; height: 500px;"></div>

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
           var myObject = {name: moment().subtract(1, 'week').locale('tr').format('W'), s: "submit"};
           $.getJSON("../../wcountSearch.php",myObject, function(jd) {
                console.log("jd Trafik",jd[1].Trafik);
                var ldatax = jd.map(function(e) {return e.Week;});
                console.log("Week",ldatax);
                var ldatay = jd.map(function(e) {return e.Trafik; });
                console.log("TrafikXX",ldatay);
                chart.data.labels = ldatax;
                chart.data.datasets[1].data = ldatay;
                chart.update();
                var total = 0;
               for (i = 0; i < jd.length; i++) {
                   total += parseInt(jd[i].Trafik);
               }
               text = "<tr>";
               for (i = 0; i < ldatay.length; i++) {
                   text += "<tr><td>" + ldatax[i] + "</td>";
                   text += "<td>" + ldatay[i] + "</td>";
                   text += "<td>" + "--" + "</td>";
                   text += "<td>" + "%" + "</td></tr>";
               }
               text += "</tr>";
               document.getElementById("totalWeek").innerHTML = total;
               document.getElementById("theWeek").innerHTML = text;
               document.getElementById("weekName").innerHTML = moment().subtract(1, 'week').locale('tr').format('W');

            });
     }


         function updateConfigByLine2(chart) {
           var myObject = {name: moment().locale('tr').format('W'), s:
"submit"};
           $.getJSON("../../wcountSearch.php",myObject, function(jd) {
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
                var ldatax = jd.map(function(e) {return e.Week; });
                console.log("Week",ldatax);
                var ldatay = jd.map(function(e) {return e.Trafik; });
                console.log("Trafik",ldatay);
                chart.data.labels = ldatax;
                chart.data.datasets[0].data = ldatay;
		        chart.data.datasets[0].label = picker.startDate.locale('tr').format('W') + ". Hafta";
                chart.update();

               var total = 0;
                for (i = 0; i < jd.length; i++) {
                   total += parseInt(jd[i].Trafik);
               }

               text = "<tr>";
               for (i = 0; i < ldatay.length; i++) {
                   text += "<tr><td>" + ldatax[i] + "</td>";
                   text += "<td>" + ldatay[i] + "</td>";
                   text += "<td>" + "--" + "</td>";
                   text += "<td>" + "%" + "</td></tr>";
               }
               text += "</tr>";
               document.getElementById("totalWeek").innerHTML = total;
               document.getElementById("weekName").innerHTML = picker.startDate.locale('tr').format('W');
               document.getElementById("theWeek").innerHTML = text;

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
      $.getJSON("../../full_ucount.php", function(jd) {

  	$(function() {
	  new Morris.Bar({
	  	element: 'myfirstchart',
		hideHover: 'true',
		lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		barColors: ['#34495E', '#26B99A', '#ACADAC', '#3498DB'],
		//xLabels: 'week',
		fillOpacity: 0.6,
  		data: jd,
  		xkey: 'Hafta',
		parseTime: false,
		smooth: false,
        resize: true,
  		ykeys: ['Giris'],
  		labels: ['Giris']
	  });
	 });

      });




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
                                        x += day_data[i].Trafik;
                                        x += day_data[i].Week;
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

	   } );	

		}
	};
        xmlhttp.open("GET", "../../wcount.php", true);
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script>

     console.log("GetValue :",getValue()[0].Tarih);

     function getValue() {

         var datax = $.ajax({
             type: 'GET',
             url: "../../tcountSearch.php?name=22.02.2019&s=submit",
             async: false,
             dataType: 'json'
             }).responseJSON;
             return datax;
     }
     console.log("Console",updateConfigByMutating());
     function updateConfigByMutating() {
         var myObject = {name: moment().subtract(1, 'days').format('DD.MM.YYYY'), s: "submit"};
         var data = $.getJSON("../../tcountSearch.php", myObject, function(jd) {
             //console.log("jd",jd);
             var datax = jd.map(function(e) {return e.Tarih;});
             //console.log("TarihGoogle",datax);
             var datay = jd.map(function(e) {return e.Giris; });
             var items = jd.map(function (item) {
                 return item.Giris;
         });
     }
     //var pazartesi = updateConfigByMutating().datay;

     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawVisualization);

     function drawVisualization() {
         // Some raw data (not necessarily accurate)
         var data = google.visualization.arrayToDataTable([
             ['Month', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'],
             ['Pazartesi',  135, 1120, 599, 1268, 288, 682, 30, 139, 1110, 615, 968, 215],
             ['Salı',  135, 1120, 599, 1268, 288, 682, 30, 157, 1167, 587, 807, 397],
             ['Çarşamba',  157, 1167, 587, 807, 397, 623, 20, 139, 1110, 615, 968, 215],
             ['Perşembe',  139, 1110, 615, 968, 215, 609.4, 30, 139, 1110, 615, 968, 215],
             ['Cuma',  139, 1110, 615, 968, 215, 609.4, 40,  136, 691, 629, 1026, 366],
             ['Cumartesi',  139, 1110, 615, 968, 215, 609.4, 50, 136, 691, 629, 1026, 366],
             ['Pazar',  136, 691, 629, 1026, 366, 569.6, 60, 136, 691, 629, 1026, 366]
         ]);

         var options = {
             title : 'Haftalık ziyaretçi Sayısı',
             vAxis: {title: 'Ziyaretçi Sayısı'},
             colors: ['#34495E', '#26B99A', '#ACADAC', '#3498DB', '#26B99A', '#ACADAC', '#3498DB'],
             hAxis: {title: 'Gün'},
             seriesType: 'bars'

         };

         var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
         chart.draw(data, options);
     }
 </script>

  <!-- /footer content -->
</body>

</html>

