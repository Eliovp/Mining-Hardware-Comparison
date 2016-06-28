<?php function display_top($top_number=''){ ?>
<link rel="stylesheet" type="text/css" href="../lib/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../src/bootstrap-wysihtml5.css" />
    <script src="../lib/js/wysihtml5-0.3.0.js"></script>
    <script src="../lib/js/jquery-1.7.2.min.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <script src="../src/bootstrap3-wysihtml5.js"></script>
    <style type="text/css" media="screen">
        .btn.jumbo {
            font-size: 20px;
            font-weight: normal;
            padding: 14px 24px;
            margin-right: 10px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
        }
		.modal-dialog{
            left: 0%
        }
    </style>
<?php 
$row = DB::queryFirstRow("SELECT * FROM `options` WHERE id=0");
	if(!empty($row['feature1_name'])){ $feature1_name=$row['feature1_name'];  }else{ $feature1_name='Value of the Feature 1'; }
	if(!empty($row['feature2_name'])){ $feature2_name=$row['feature2_name'];  }else{ $feature2_name='Value of the Feature 2'; }
	if(!empty($row['feature3_name'])){ $feature3_name=$row['feature3_name'];  }else{ $feature3_name='Value of the Feature 3'; }
	if(!empty($row['feature4_name'])){ $feature4_name=$row['feature4_name'];  }else{ $feature4_name='Value of the Feature 4'; }
	if(!empty($row['feature5_name'])){ $feature5_name=$row['feature5_name'];  }else{ $feature5_name='Value of the Feature 5'; }	
	if(!empty($row['feature6_name'])){ $feature6_name=$row['feature6_name'];  }else{ $feature6_name='Value of the Feature 6'; }
	if(!empty($row['feature7_name'])){ $feature7_name=$row['feature7_name'];  }else{ $feature7_name='Value of the Feature 7'; }
	if(!empty($row['feature8_name'])){ $feature8_name=$row['feature8_name'];  }else{ $feature8_name='Value of the Feature 8'; }
	if(!empty($row['feature9_name'])){ $feature9_name=$row['feature9_name'];  }else{ $feature9_name='Value of the Feature 9'; }
	if(!empty($row['feature10_name'])){ $feature10_name=$row['feature10_name'];  }else{ $feature10_name='Value of the Feature 10'; }
	
if(!empty($_POST['update'])){
	if(empty($_POST['active'])){ $_POST['active']=$active='2'; }
	if($_POST['active']=='1' AND empty($_POST['name'])){
		echo '<div class="alert alert-danger">Error. Please insert a name.</div>';
	}else{
		if(!empty($_POST['name'])) { $name=$_POST['name']; }else { $name=''; }
		if(!empty($_POST['base'])) { $base=$_POST['base']; }
		if(!empty($_POST['active'])) { $active=$_POST['active']; }
		/*?>if(!empty($_POST['rank'])) { $rank=$_POST['rank']; }<?php */
		if(!empty($_POST['value_feature1'])) { $value_feature1=$_POST['value_feature1']; }else { $value_feature1=''; }
		if(!empty($_POST['value_feature2'])) { $value_feature2=$_POST['value_feature2']; }else { $value_feature2=''; }
		if(!empty($_POST['value_feature3'])) { $value_feature3=$_POST['value_feature3']; }else { $value_feature3=''; }
		if(!empty($_POST['value_feature4'])) { $value_feature4=$_POST['value_feature4']; }else { $value_feature4=''; }
		if(!empty($_POST['value_feature5'])) { $value_feature5=$_POST['value_feature5']; }else { $value_feature5=''; }		
		if(!empty($_POST['value_feature6'])) { $value_feature6=$_POST['value_feature6']; }else { $value_feature6=''; }
		if(!empty($_POST['value_feature7'])) { $value_feature7=$_POST['value_feature7']; }else { $value_feature7=''; }
		if(!empty($_POST['value_feature8'])) { $value_feature8=$_POST['value_feature8']; }else { $value_feature8=''; }
		if(!empty($_POST['value_feature9'])) { $value_feature9=$_POST['value_feature9']; }else { $value_feature9=''; }
		if(!empty($_POST['value_feature10'])) { $value_feature10=$_POST['value_feature10']; }else { $value_feature10=''; }		
		if(!empty($_POST['description'])) { $description=$_POST['description']; }else { $description=''; }
		if(!empty($_POST['link'])) { $link=$_POST['link']; }else { $link=''; }
		
		
		
		$insert=DB::insertUpdate('top_listing', array( 'id' => $top_number,
										'name' => $name,
										'base' => $base,
										'active' => "0",
										/*'rank' => $rank,*/
										'value_feature1' => $value_feature1,
										'value_feature2' => $value_feature2,
										'value_feature3' => $value_feature3,
										'value_feature4' => $value_feature4,
										'value_feature5' => $value_feature5,
										'value_feature6' => $value_feature6,
										'value_feature7' => $value_feature7,
										'value_feature8' => $value_feature8,
										'value_feature9' => $value_feature9,
										'value_feature10' => $value_feature10,
										'description' => $description,
										'link' => $link,
										'seo_title' => $seo_title,
										'seo_description' => $seo_description));
		if($insert){
			echo '<div class="alert alert-success">We have succesfully received your submission,<br > we will activate it within 12hrs. <br > Thank you!</div>';
		}else{
			echo '<div class="alert alert-warning">There was an error. Please try again.</div>';
		}
	}
}
	if(!empty($top_number)){
		$row = DB::queryFirstRow("SELECT * FROM top_listing WHERE id=$top_number");
		$name=$row['name'];
		$base=$row['base'];
		/*$rank=$row['rank'];*/
		$active=$row['active'];
		$value_feature1=$row['value_feature1'];  
		$value_feature2=$row['value_feature2'];
		$value_feature3=$row['value_feature3'];
		$value_feature4=$row['value_feature4'];
		$value_feature5=$row['value_feature5'];	
		$value_feature6=$row['value_feature6'];	
		$value_feature7=$row['value_feature7'];	
		$value_feature8=$row['value_feature8'];	
		$value_feature9=$row['value_feature9'];	
		$value_feature10=$row['value_feature10'];	
		$description=$row['description'];
		$link=$row['link'];
	}
?>
<form class="form-horizontal" method="post">
<fieldset>
<!-- Multiple Radios (inline) -->

<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Base</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="radios-0">
      <input type="radio" name="base" id="radios-0" value="AMD" <?php if(!empty($base) AND $base=='AMD'){ echo 'checked="checked"'; } ?>>AMD</label> 
    <label class="radio-inline" for="radios-1">
      <input type="radio" name="base" id="radios-1" value="NVidia" <?php if(!empty($base) AND $base=='NVidia'){ echo 'checked="checked"'; } ?>>NVidia</label> 
  </div>
</div>

<?php /*
<!-- Rank number -->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Number</label>  
  <div class="col-md-5">
  <input id="rank" name="rank" required type="text" placeholder="only number : 1,2,3,..." class="form-control input-md" 
  <?php if(!empty($rank)){ echo "value='".$rank."'"; } ?>
  >
    
  </div>
</div> */ ?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Manufacturer</label>  
  <div class="col-md-5">
  <input id="name" name="name" required type="text" placeholder="Sapphire, MSI, ASUS, .." class="form-control input-md" <?php if(!empty($name)){ echo "value='".$name."'"; } ?>>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature1_value"><?php echo $feature1_name; ?></label> 
  <div class="col-md-5">
	<input class="form-control input-md" required type="text" id="description" name="value_feature1" placeholder="R9 290, 980ti, .." <?php if(!empty($value_feature1)){ echo $value_feature1; } ?>>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature2_value"><?php echo $feature2_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" required type="text" id="description" name="value_feature2" placeholder="1000" <?php if(!empty($value_feature2)){ echo $value_feature2; } ?>>
</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature3_value"><?php echo $feature3_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" required type="text" id="description" name="value_feature3" placeholder="1500" <?php if(!empty($value_feature3)){ echo $value_feature3; } ?>>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature4_value"><?php echo $feature4_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" required type="text" id="description" name="value_feature4" placeholder="Ubuntu 14.04, Windows 10 Pro, .." <?php if(!empty($value_feature4)){ echo $value_feature4; } ?>>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature5_value"><?php echo $feature5_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" required type="text" id="description" name="value_feature5" placeholder="Crimson 16.10, Nvidia 361.43, .."><?php if(!empty($value_feature5)){ echo $value_feature5; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature6_value"><?php echo $feature6_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" id="description" name="value_feature6" placeholder="SGMiner 5.0.1, CCMiner sp release 78, .." ><?php if(!empty($value_feature6)){ echo $value_feature6; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature7_value"><?php echo $feature7_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" id="description" name="value_feature7" placeholder="X11, X13, Ethereum, .." ><?php if(!empty($value_feature7)){ echo $value_feature7; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature8_value"><?php echo '<br>'.$feature8_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature8" placeholder="" style="height: 100px"><?php if(!empty($value_feature8)){ echo $value_feature8; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature9_value"><?php echo $feature9_name; ?></label>  
  <div class="col-md-5">
  <input class="form-control input-md" id="description" name="value_feature9" placeholder="22Mh/s, 1500KH/s, .." ><?php if(!empty($value_feature9)){ echo $value_feature9; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<!--<div class="form-group">
  <label class="col-md-4 control-label" for="feature10_value"><?php /*echo '<br>'.$feature10_name; */?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature10" placeholder="-" style="height: 100px"><?php /*if(!empty($value_feature10)){ echo $value_feature10; } */?></textarea>
  </div>
</div>-->

<!-- Textarea -->
<!--<div class="form-group">
  <label class="col-md-4 control-label" for="description">Description</label>
  <div class="col-md-4"> 
	<textarea class="textarea form-control" id="description" name="description" placeholder="Enter text ..." style="height: 200px"><?php /*if(!empty($description)){ echo $description; } */?></textarea>
  </div>
</div>-->

<script>
    //$('.textarea').wysihtml5();
	$('.textarea').wysihtml5({
    "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true, //Italics, bold, etc. Default true
    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": false, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font
    "size": 'sm' //Button size like sm, xs etc.
});
</script>
<script type="text/javascript" charset="utf-8">
    $(prettyPrint);
</script>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="link">Link (for proof)</label>  
  <div class="col-md-5">
  <input id="link" name="link" type="text" placeholder="http://" class="form-control input-md" <?php if(!empty($link)){ echo "value='".$link."'"; } ?>> 
  </div>
</div>

</fieldset>
<input type="hidden" name="num_top" value="<?php echo $top_number; ?>">
</form>

</form>

<?php } ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header"></h1>-->
					<?php display_top($num_top); 	?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->