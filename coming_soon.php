<?php
/**
 * Created by PhpStorm.
 * User: musta
 * Date: 25.02.2019
 * Time: 08:34
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WiseBoard : Coming Soon</title>
    <!-- REQUIRED STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- main.min.css - WISEBOARD CORE CSS -->
    <link href="css/main.min.css" rel="stylesheet" type="text/css">
     <!-- Coming soon css -->
    <link href="css/page-coming-soon.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="coming-soon-wrapper">
      <h1 class="coming-soon-heading">Coming Soon</h1>
      <p class="coming-soon-description">We are working hard to get back to you.</p>

      <div class="row">
        <div class="col-sm-3">
          <div class="panel">
            <div class="panel-heading">Days</div>
            <div class="panel-body" id="days-countdown"></div>
          </div><!-- /.panel -->
        </div><!-- /.col-sm-3 -->

        <div class="col-sm-3">
          <div class="panel">
            <div class="panel-heading">Hours</div>
            <div class="panel-body" id="hours-countdown"></div>
          </div><!-- /.panel -->
        </div><!-- /.col-sm-3 -->

        <div class="col-sm-3">
          <div class="panel">
            <div class="panel-heading">Minutes</div>
            <div class="panel-body" id="minutes-countdown"></div>
          </div><!-- /.panel -->
        </div><!-- /.col-sm-3 -->

        <div class="col-sm-3">
          <div class="panel">
            <div class="panel-heading">Seconds</div>
            <div class="panel-body" id="seconds-countdown"></div>
          </div><!-- /.panel -->
        </div><!-- /.col-sm-3 -->
      </div><!-- /.row -->

      <form>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Subscribe to our latest news!">
          <span class="input-group-btn">
            <button type="button" class="btn">Subscribe</button>
          </span>
        </div>
      </form>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- REQUIRED PLUGINS -->
    <script src="js/jquery.countdown/js/jquery.countdown.min.js"></script>
    <script src="js/page-coming-soon.min.js"></script>
  </body>
</html>