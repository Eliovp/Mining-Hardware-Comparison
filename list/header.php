<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php
		$brand=$_GET['brand'];
        require_once '../admin/db.php';
		require_once "../recaptchalib.php";
        $results_features = DB::queryFirstRow('SELECT *,seo_title_hp ,seo_description_hp FROM options WHERE id=0');
        $seo_title = $results_features['seo_title_hp'];
        $seo_description = $results_features['seo_description_hp'];
        $feature1_name = $results_features['feature1_name'];
        $feature2_name = $results_features['feature2_name'];
        $feature3_name = $results_features['feature3_name'];
        $feature4_name = $results_features['feature4_name'];
        $feature5_name = $results_features['feature5_name'];
        $feature6_name = $results_features['feature6_name'];
        $feature7_name = $results_features['feature7_name'];
        $feature8_name = $results_features['feature8_name'];
        $feature9_name = $results_features['feature9_name'];
        $feature10_name = $results_features['feature10_name'];
		
    ?>
		<title>Mining Hardware Comparison</title>
		<meta name="description" content="<?php echo $seo_description; ?>">
    	<meta name="google-site-verification" content="" />
		<meta property="og:title" content="<?php echo $seo_title; ?>" />
		<meta property="og:description" content="<?php echo $seo_description; ?>" />
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    	<link rel="stylesheet" type="text/css" href="../src/bootstrap-wysihtml5.css" />
    	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>

		 <style type="text/css">
                .row{
                margin-top:10px;
                margin-bottom:-10px;
                padding: 0 0px;
            }
            .clickable{
                cursor: pointer;
            }
    
            .panel-heading div{
                margin-top: -18px;
                font-size: 15px;
                cursor: pointer;
    
            }
            .panel-heading{
                cursor: pointer;
    
            }
            .panel-heading:hover
            {
                -moz-box-shadow: 0 0 10px #ccc;
                -webkit-box-shadow: 0 0 10px #ccc;
                box-shadow: 0 0 10px #ccc;
                opacity: 0.8;
            }
            .panel-heading div span{
                margin-left:10px;
            }
            /*.panel-body{
                display: none;
            }*/
            .tooltip-inner {
                max-width: 500px !important;
            }
			.page-header {	
				margin: 0px 0 20px;
			}
			body {
			  padding-top: 0;
			}
			
            </style>

</head>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                      </button>
                      <a class="navbar-brand" href="index.php">Mining Hardware Comparison <span style="font-size:small">Beta</span></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                      <ul style="margin-left: 50px;" class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                        <li><button style="margin-top:7px; margin-right: 10px;" class="btn btn-success btn" data-title="Submit" data-toggle="modal" data-target="#submission" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-ok"></span>  Submit your card/configuration</button></li>
                        <li class="disabled"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                       
                    </ul>
                </li>
                      </ul>
                    </div>
                  </div>
                </nav>   </nav>