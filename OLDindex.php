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

        $durum = "Hava Güneşli";
  }
  if (in_array($obj['weather'][0]['id'], $status7)) {

        $durum = "Bulutlu";
  }


?>


  <body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
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

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3 class="green">Demo Mode</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="index.php">B&G Store - MERSİN</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Analiz <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="#">Bar Grafik</a>
                    </li>
                    <li><a href="#">Tablo</a>
                    </li>
                    <li><a href="#">Çizgi Grafik</a>
                    </li>
                    <li><a href="#">Pasta Grafik</a>
                    </li>
                    <li><a href="#">Sıcaklık Haritası</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> Raporlar <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="#">Mağaza Önü Trafiği</a>
		    </li>
		    <li><a href="#">Dönüşüm Oranı</a>
                    </li>
                    <li><a href="#">Bekleme Süreleri</a>
                    </li>
                    <li><a href="#">Karşılaştırmalar</a>
                    </li>
                    <li><a href="#">Personel Girişi</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Ayarlar <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="#">Cihaz Verileri</a>
                    </li>
                    <li><a href="reset-password.php">Şifre İşlemleri</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

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
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" 
data-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.png" alt=""><?php echo htmlspecialchars($_SESSION["username"]); 
?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="javascript:;">  Profil</a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Ayarlar</span>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">Yardım</a>
                  </li>
                  <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Çıkış</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">

                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>Mustafa Aydın</span>
                      <span class="time">4 dk. önce</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a href="inbox.html">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
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
Geç. Haft.  Göre</span>
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
              <div class="count"><b class="red"><?php echo floor($obj['main']['temp']-273);?>°</b></div>
              <span class="count_bottom"><i class="green"><i class="owf owf-<?php echo $obj['weather'][0]['id'];?>"></i></i><?php echo $durum ?></span>
            </div>
          </div>

        </div>
        <!-- /top tiles -->
	<div class="row">

	 <div class="col-md-12 col-sm-6 col-xs-12 widget_tally_box">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Saatlik Trafik (<?php  $objDateTime = new DateTime('NOW');
				$objDateTime->modify('-1 day'); 
				echo $objDateTime->format('d.m.Y');
				?>)</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                  <div id="graph_bar" style="width:100%; height:200px;"></div>
		</div></div>
               
        <br />

        <div class="row">

	<div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Günlük Trafik(Geçen Hafta)</h2>
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
		 <div id="myfirstline" style="height: 250px;"></div>

              </div>
            </div>
          </div>

		
	 </div>
          </div>
	
		 

	

        <div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Hızlı Aylık Trafik Tablosu  <small>Morven-Optimum</small></h2>
		
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa 
fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
		<table border="0" cellspacing="5" cellpadding="5">
                          <tbody>
                                <tr>
                                    	<td>Minimum Trafik:</td>
                                        <td><input type="text" id="min" name="min"></td>
                                
                                        <td>&nbsp&nbspMaximum Trafik:</td>
                                        <td><input type="text" id="max" name="max"></td>
                                </tr>
                          </tbody>
                        </table>

                <div class="x_content">
                  <p class="text-muted font-13 m-b-30">
                   
                  </p>
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Gün</th>
                        <th>Tarih</th>
                        <th>Trafik</th>
                      </tr>
                    </thead>


                    <tbody>
                     
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
				
            </div>



        </div>
	<small id="wgraph"></small>

        <!-- footer content -->

        <footer>
          <div class="copyright-info">
            <p class="pull-right">SiriCount v2.0 <a href="https://siriteknoloji.com">Siri Teknoloji</a>  
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
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
			document.getElementById("thisnow").innerHTML = myObj[0].Cikis-myObj[0].Giris;
			document.getElementById("thisnow").innerHTML = myObj[0].Cikis-myObj[0].Giris;
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
			console.log(oran);
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
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>

  <script src="js/custom.js"></script>

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
  <script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });
  </script>

  <!-- worldmap -->
  <script type="text/javascript" src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(function() {
      $('#world-map-gdp').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        series: {
          regions: [{
            values: gdpData,
            scale: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script>
  <!-- dashbord linegraph -->
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var data = {
      labels: [
        "Symbian",
        "Blackberry",
        "Other",
        "Android",
        "IOS"
      ],
      datasets: [{
        data: [15, 20, 30, 10, 30],
        backgroundColor: [
          "#BDC3C7",
          "#9B59B6",
          "#455C73",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#CFD4D8",
          "#B370CF",
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
  <!-- /dashbord linegraph -->
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
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
    });
  </script>
  <script>
    NProgress.done();
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
                        // console.log (obj);
			//document.getElementById("graph").innerHTML = obj;
		

	
    $(function() {
      
      var day_data = JSON.parse(obj);
	//console.log (obj);

      Morris.Bar({
        element: 'graph_bar',
        data: day_data,
        hideHover: 'true',
        xkey: 'Tarih',
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        ykeys: ['Giris'],
        labels: ['Ziyaret'],
        xLabelAngle: 60
      });
    });
	}

	};
        xmlhttp.open("GET", "../../tcount.php", true);
        xmlhttp.send();
  </script>

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
	  new Morris.Area({
	  	element: 'myfirstchart',
		hideHover: 'true',
		lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
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
	  new Morris.Line({
	  	element: 'myfirstline',
		hideHover: 'true',
		lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
		//xLabels: 'Hafta',
		fillOpacity: 0.6,
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
			wstatus = data.list[05].weather[0].main;
			//console.log(city); 

                document.getElementById("graph").innerHTML = x.toFixed(1);
		document.getElementById("wcity").innerHTML = city;
		document.getElementById("wmonday").innerHTML = wmonday.toFixed(0);
		document.getElementById("wsunday").innerHTML = wsunday.toFixed(0);
		document.getElementById("wtuesday").innerHTML = wtuesday.toFixed(0);
		document.getElementById("wwednesday").innerHTML = wwednesday.toFixed(0);
		document.getElementById("wthursday").innerHTML = wthursday.toFixed(0);
		
		//var ws =  document.getElementsByTagName("P");

		if (wstatus == "Rain") {
		//document.getElementsByTagName("P")[0].innerHTML = "<canvas height='32' width='32' id='rain'> </canvas>";	
		//	console.log(wstatus);
		};


	

		}

        };

        xmlhttp.open("GET", 
	
"http://api.openweathermap.org/data/2.5/forecast?q=Mersin&appid=541515afee797cfd215e0b69dfe8c5d9", 
true);
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

  

  <!-- /footer content -->
</body>

</html>

