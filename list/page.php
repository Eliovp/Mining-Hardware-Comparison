<?php
if(empty($_GET['id']) OR !is_numeric($_GET['id'])) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html ng-app="ether" lang="en">
<head>
    <meta charset="utf-8">
	<?php	
		require_once 'admin/db.php'; 
		$id=$_GET['id'];
		$str = $_GET['hash'];
		$result = filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT,
    	FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);
		$cardHash = $result;
	
	$row = DB::queryFirstRow("SELECT * FROM top_listing,options WHERE top_listing.id ='".$id."'");
	$feature1_name	 = $row['feature1_name'];
	$feature2_name   = $row['feature2_name'];
	$feature3_name   = $row['feature3_name'];
	$feature5_name   = $row['feature5_name'];
	$feature5link = $row['feature5link'];
	$feature6_name   = $row['feature6_name'];
	$feature7_name   = $row['feature7_name'];
	$feature9_name   = $row['feature9_name'];
	$link = $row['link'];
		$seo_title	= $row['seo_title'];
		$seo_description  = $row['seo_description'];
		
	?>
		<title><?php echo $seo_title; ?></title>
		<meta name="description" content="<?php echo $seo_description; ?>">	
		<meta property="og:title" content="<?php echo $seo_title; ?>" />
		<meta property="og:description" content="<?php echo $seo_description; ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
        	.row{
		    margin-top:40px;
		    padding: 0 10px;
		}
		.clickable{
		    cursor: pointer;   
		}

		.panel-heading div {
			margin-top: -18px;
			font-size: 15px;
		}
		.panel-heading div span{
			margin-left:5px;
		}
		.panel-body{
			display: none;
		}    </style>

    <link type="text/css" rel="stylesheet" href="css/example.css">
	<link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-resource.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bignumber.js/2.0.7/bignumber.js"></script>
    <script src="http://alpha61.com/ethereum.json"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>
    
    <script>
    angular.module('ether', ['ngResource']).config(['$controllerProvider', function($controllerProvider) {
        $controllerProvider.allowGlobals();
    }]);
    
    function EtherMiningCtrl($scope, $http, $log) {
        
        $scope.ethPrice = ethereumStats.priceUsd;
        $scope.netHashGH = (ethereumStats.difficulty / ethereumStats.blockTime) / 1e9;
        $scope.blockTime = ethereumStats.blockTime;
        $scope.earnings = {};
        $scope.cardHash = "<?php echo $cardHash; ?>"
        $scope.computeProfits = function() {
            var userRatio = $scope.cardHash * 1e6 / ($scope.netHashGH * 1e9);
            var blocksPerMin = 60.0 / $scope.blockTime;
            var ethPerMin = blocksPerMin * 5.0;
            $scope.earnings.min = userRatio * ethPerMin;
            $scope.earnings.hour = $scope.earnings.min * 60;
            $scope.earnings.day = $scope.earnings.hour * 24;
            $scope.earnings.week = $scope.earnings.day * 7;
            $scope.earnings.month = $scope.earnings.day * 30;
        };
    }
    </script>
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
</head>
<body ng-controller="EtherMiningCtrl">
<hr>
	<div class="container">


<h1><?php echo $row['name']. ' '.$row['value_feature1']; ?></h1>
<?php if(!empty($row['banner1'])){echo '<center><img src="./banner/'.$row['banner1'].'" alt="'.$row['name'].'"></center><br><br>'; } ?>
    <p><?php echo $row['description']; ?></p>
    <div>
    
<span class="btn btn-danger"><a style="color:white" onclick="goBack()">Back</a></span>
<a target="_blank" href="<?php echo $row['feature5link'];?>"
class="btn btn-default btn-medium <?php if ($row['feature5link'] == '') { echo 'disabled';}?>" data-toggle="tooltip" title="<?php echo $row['feature5link']; ?>">
<?php if (!empty($feature6_name)) { echo $row['value_feature6'];}?></a>
<button class="btn btn-default btn-medium" data-title="Config"
                                        data-id='<?php if (!empty($feature8_name)) { echo '<td style="text-align:center;">'.$row['value_feature8'].'</td>';}        ?>'
                                        data-toggle="modal" data-target="#config" data-placement="top" rel="tooltip">Config</button>
<div class="pull-right"> 
	<span class="label label-primary"><?php echo $feature2_name.' : '.$row['value_feature2']; ?></span> 
	<span class="label label-success"><?php echo $feature3_name.' : '.$row['value_feature3']; ?></span> 
    <span class="label label-danger"><?php echo $feature5_name.' : '.$row['value_feature5']; ?></span>
    <span class="label label-info"><?php echo $feature6_name.' : '.$row['value_feature6']; ?></span>
    <span class="label label-default"><?php echo $feature7_name.' : '.$row['value_feature7']; ?></span>
    <span class="label label-success"><?php echo $feature9_name.' : '.$row['value_feature9']; ?></span>
</div>     
     </div>
     
<?php if ($row['value_feature7'] == 'Ethereum') { ?>
<div id="wrapper">
    	<div class="row">
                <div class="col-md-6">
                                <form ng-submit="computeProfits()" class="form-horizontal">
                                    <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                           <th><?php echo $row['name']. ' '.$row['value_feature1']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Hashrate:</th>
                                        <td>
                                            <input type="text" ng-model="cardHash" ng-init="computeProfits()" ng-change="computeProfits()"/> MH/s
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Network Hashrate:</th>
                                        <td><input type="text" ng-model="netHashGH" ng-init="computeProfits()" ng-change="computeProfits()"/> GH/s</td>
                                    </tr>
                                    <tr>
                                        <th>Blocktime:</th>
                                        <td><input type="text" ng-model="blockTime" ng-init="computeProfits()" ng-change="computeProfits()"/> seconds</td>
                                    </tr>
                                    <tr>
                                        <th>1 ETH Price:</th>
                                        <td><input type="text" ng-model="ethPrice" ng-init="computeProfits()" ng-change="computeProfits()"/> USD</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </form>
                  </div>
                  <div class="col-md-6">
                                <!--<h2>Earnings (ETH)</h2>-->
                                <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>ETH</th>
                                            <th>USD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Minute</td>
                                            <td>{{earnings.min|number:6}}</td>
                                            <td>{{earnings.min*ethPrice|currency}}</td>            
                                        </tr>
                                        <tr>
                                            <td>Hour</td>
                                            <td>{{earnings.hour|number:6}}</td>
                                            <td>{{earnings.hour*ethPrice|currency}}</td>
                                        </tr>
                                        <tr>
                                            <td>Day</td>
                                            <td>{{earnings.day|number:6}}</td>
                                            <td>{{earnings.day*ethPrice|currency}}</td>
                                        </tr>
                                        <tr>
                                            <td>Week</td>
                                            <td>{{earnings.week|number:6}}</td>
                                            <td>{{earnings.week*ethPrice|currency}}</td>
                                        </tr>
                                        <tr>
                                            <td>Month</td>
                                            <td>{{earnings.month|number:6}}</td>
                                            <td>{{earnings.month*ethPrice|currency}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                		</div>
         </div>
</div>
<?php } ?>
<?php if(!empty($row['banner2'])){echo '<br><br><center><img src="./banner/'.$row['banner2'].'" alt="'.$row['name'].'"></center>'; } ?>
<br><hr>
<h3>Comments</h3>
		
<?php
$id_post = $id;
?>	 
	<div class="cmt-container" >
	
    <?php 	
	$results = DB::query("SELECT * FROM comments WHERE id_post = '$id_post'");	

	foreach ($results as $affcom) {	
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
		$rating = $affcom['rating'];
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

    ?>
	
	
	
    <div class="cmt-cnt">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5>
			<!--<input id="input-5a" class="rating" value="<?php echo $rating; ?>" data-size="xs" data-show-clear="false" data-show-caption="false" data-readonly="true">-->
			<span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
    <?php } ?>
	
	

    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">
        <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
        <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" />
		<!--<input name="starrating" id="starrating" value="1" type="number" class="rating" min=0 max=5 step=1 data-size="xs2" >-->
		<textarea class="the-new-com"></textarea>
		
        <div class="bt-add-com">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->	 
	 <script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');
			var starrating = $('#starrating');			
			
            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&rating='+starrating.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
						starrating.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script> 
	</div>	

</body>
</html>
