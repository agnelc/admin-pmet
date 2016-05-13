<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ADMIN</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
        <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <?php
       $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (strpos($url,'index.php') !== false) {
        echo "<script type=\"text/javascript\" src=\"assets/js/core/app_1.js\"></script>";
        }
     else {
        echo "<script type=\"text/javascript\" src=\"assets/js/core/app.js\"></script>";
        }
    ?>
        <script type="text/javascript" src="assets/js/pages/dashboard.js"></script>
        <script type="text/javascript" src="assets/js/pages/layout_fixed_custom.js"></script>
	<script type="text/javascript" src="assets/js/pages/editor_ckeditor.js"></script>
	
        <!-- /theme JS files -->

    </head>

    <body class="navbar-top">

        <!-- Main navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>

                <p class="navbar-text" id="cusddemo">
                    
  
                    <?php
                      

                    
                        function check_internet_connection($sCheckHost = 'www.google.com') 
                        {
                            return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
                        }

                     $bIsConnected = check_internet_connection();
                     if($bIsConnected){
                           $statustext = "Online";
                            $status_css_class = "bg-success-400";
                            echo "<span class=\"label {$status_css_class}\">{$statustext}</span>";
                     } else {
                            $statustext = "Offline";
                            $status_css_class = "bg-danger-400";
                            echo "<span class=\"label {$status_css_class}\">{$statustext}</span>";
                        }
                    
                    ?>
                </p> 

                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['username'])){ ?>
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/images/placeholder.jpg" alt="">
                            <span>USER <?php 
                            
                            echo strtoupper($_SESSION['username']);
                            
                            ?></span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                            <li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                    </li>
                    <?php }
                            ?>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->
