<?php include 'header.php' ?>
<?php
echo '<script LANGUAGE="JavaScript">
												function confirmSubmit()
												{
												var agree=confirm("Are you sure you wish to remove?");
												if (agree)
													return true ;
												else
													return false ;
												}
												</script>';

if(!empty($_GET['remove_banner1']) AND !empty($_GET['id'])){
	DB::update('top_listing', array(  'banner1' => ''  ), "id=%i", $_GET['id']);
 
}
if(!empty($_GET['remove_banner2']) AND !empty($_GET['id'])){
	DB::update('top_listing', array(  'banner2' => ''  ), "id=%i", $_GET['id']);
}
if(!empty($_GET['id'])){ $_GET['num_top']=$_GET['id']; } 
if(!empty($_GET['num_top']) AND $_GET['num_top']>0){
	$num_top = (int)$_GET['num_top'];
	}else{
	$num_top = '';
	}
?>
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
		.modal-dialog {
			left: 0%;
		}
    </style>

<?php 
//DB::debugMode();
if (isset($_POST['submitbanner1'])) {
  $file = uploadFile('file1', true, true);
  if (is_array($file['error'])) {
    $message = '';
    foreach ($file['error'] as $msg) {
		$message .= '<div class="alert alert-warning">'.$msg.'</div>';    
    }
  } else {
		$top_number=$_POST['num_top'];
		$filename = $file['filename'];
		$insert=DB::insertUpdate('top_listing', array( 'id' => $top_number,'banner1' => $filename));
		if($insert){
			$message = '<div class="alert alert-success">File uploaded successfully.</div>'; 
		}else{
			$message = '<div class="alert alert-danger">Error. Please try again in few seconds.</div>'; 
		}
  }
  echo $message;
}
if (isset($_POST['submitbanner2'])) {
  $file = uploadFile('file2', true, true);
  if (is_array($file['error'])) {
    $message = '';
    foreach ($file['error'] as $msg) {
		$message .= '<div class="alert alert-warning">'.$msg.'</div>';    
    }
  } else {
		$top_number=$_POST['num_top'];
		$filename = $file['filename'];
		$insert=DB::insertUpdate('top_listing', array( 'id' => $top_number,'banner2' => $filename));
		if($insert){
			$message = '<div class="alert alert-success">File uploaded successfully.</div>'; 
		}else{
			$message = '<div class="alert alert-danger">Error. Please try again in few seconds.</div>'; 
		}
  }
  echo $message;
}

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
		if(!empty($_POST['feature5link'])) { $feature5link=$_POST['feature5link']; }else { $feature5link=''; }		
		if(!empty($_POST['value_feature6'])) { $value_feature6=$_POST['value_feature6']; }else { $value_feature6=''; }
		if(!empty($_POST['value_feature7'])) { $value_feature7=$_POST['value_feature7']; }else { $value_feature7=''; }
		if(!empty($_POST['value_feature8'])) { $value_feature8=$_POST['value_feature8']; }else { $value_feature8=''; }
		if(!empty($_POST['value_feature9'])) { $value_feature9=$_POST['value_feature9']; }else { $value_feature9=''; }
		if(!empty($_POST['value_feature10'])) { $value_feature10=$_POST['value_feature10']; }else { $value_feature10=''; }		
		if(!empty($_POST['description'])) { $description=$_POST['description']; }else { $description=''; }
		if(!empty($_POST['link'])) { $link=$_POST['link']; }else { $link=''; }
		if(!empty($_POST['username'])) { $username=$_POST['username']; }else { $username=''; }
		if(!empty($_POST['seo_title'])) { $seo_title=$_POST['seo_title']; }else { $seo_title=''; }
		if(!empty($_POST['seo_description'])) { $seo_description=$_POST['seo_description']; }else { $seo_description=''; }
		
		
		
		$insert=DB::insertUpdate('top_listing', array( 'id' => $top_number,
										'name' => $name,
										'base' => $base,
										'active' => $active,
										/*'rank' => $rank,*/
										'value_feature1' => $value_feature1,
										'value_feature2' => $value_feature2,
										'value_feature3' => $value_feature3,
										'value_feature4' => $value_feature4,
										'value_feature5' => $value_feature5,
										'feature5link' => $feature5link,
										'value_feature6' => $value_feature6,
										'value_feature7' => $value_feature7,
										'value_feature8' => $value_feature8,
										'value_feature9' => $value_feature9,
										'value_feature10' => $value_feature10,
										'description' => $description,
										'link' => $link,
										'username' => $username,
										'seo_title' => $seo_title,
										'seo_description' => $seo_description));
		if($insert){
			echo '<div class="alert alert-success">Success.</div>';
		}else{
			echo '<div class="alert alert-warning">Error. Please try again.</div>';
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
		$feature5link=$row['feature5link'];	
		$value_feature6=$row['value_feature6'];	
		$value_feature7=$row['value_feature7'];	
		$value_feature8=$row['value_feature8'];	
		$value_feature9=$row['value_feature9'];	
		$value_feature10=$row['value_feature10'];	
		$description=$row['description'];
		$link=$row['link'];
		$username=$row['username'];
		$banner1=$row['banner1'];
		$banner2=$row['banner2'];
	}
?>
<form class="form-horizontal" method="post">
<fieldset>
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Active</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="radios-0">
      <input type="radio" name="active" id="radios-0" value="1" <?php if(!empty($active) AND $active=='1'){ echo 'checked="checked"'; } ?>>Yes</label> 
    <label class="radio-inline" for="radios-1">
      <input type="radio" name="active" id="radios-1" value="2" <?php if(!empty($active) AND $active=='2'){ echo 'checked="checked"'; } ?>>No</label> 
  </div>
</div>

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
  <label class="col-md-4 control-label" for="name">Manufacturer (Sapphire, MSI, ASUS, ...)</label>  
  <div class="col-md-5">
  <input id="name" name="name" required type="text" placeholder="-" class="form-control input-md" <?php if(!empty($name)){ echo "value='".$name."'"; } ?>>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature1_value"><?php echo $feature1_name; ?></label> 
  
  <div class="col-md-5">
	<textarea class="textarea form-control" id="description" name="value_feature1" placeholder="-" style="height: 100px"><?php if(!empty($value_feature1)){ echo $value_feature1; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature2_value"><?php echo '<br>'.$feature2_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature2" placeholder="-" style="height: 100px"><?php if(!empty($value_feature2)){ echo $value_feature2; } ?></textarea>
</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature3_value"><?php echo '<br>'.$feature3_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature3" placeholder="-" style="height: 100px"><?php if(!empty($value_feature3)){ echo $value_feature3; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature4_value"><?php echo '<br>'.$feature4_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature4" placeholder="-" style="height: 100px"><?php if(!empty($value_feature4)){ echo $value_feature4; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature5_value"><?php echo '<br>'.$feature5_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature5" placeholder="-" style="height: 100px"><?php if(!empty($value_feature5)){ echo $value_feature5; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature6_value"><?php echo '<br>'.$feature6_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature6" placeholder="-" style="height: 100px"><?php if(!empty($value_feature6)){ echo $value_feature6; } ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="feature5link"> Link to mining software</label>  
  <div class="col-md-5">
  <input id="feature5link" name="feature5link" type="text" placeholder="http://" class="form-control input-md" <?php if(!empty($feature5link)){ echo "value='".$feature5link."'"; } ?>> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature7_value"><?php echo '<br>'.$feature7_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature7" placeholder="-" style="height: 100px"><?php if(!empty($value_feature7)){ echo $value_feature7; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature8_value"><?php echo '<br>'.$feature8_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature8" placeholder="-" style="height: 100px"><?php if(!empty($value_feature8)){ echo $value_feature8; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature9_value"><?php echo '<br>'.$feature9_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature9" placeholder="-" style="height: 100px"><?php if(!empty($value_feature9)){ echo $value_feature9; } ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="feature10_value"><?php echo '<br>'.$feature10_name; ?></label>  
  <div class="col-md-5">
  <textarea class="textarea form-control" id="description" name="value_feature10" placeholder="-" style="height: 100px"><?php if(!empty($value_feature10)){ echo $value_feature10; } ?></textarea>
  </div>
</div>
<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Description</label>
  <div class="col-md-4"> 
	<textarea class="textarea form-control" id="description" name="description" placeholder="Enter text ..." style="height: 200px"><?php if(!empty($description)){ echo $description; } ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="name">Submitted by</label>  
  <div class="col-md-5">
  <input id="username" name="username" required type="text" placeholder="Your name" class="form-control input-md" <?php if(!empty($username)){ echo "value='".$username."'"; } ?>>
    
  </div>
</div>

<script>
    //$('.textarea').wysihtml5();
	$('.textarea').wysihtml5({
    "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true, //Italics, bold, etc. Default true
    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": true, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font
    "size": 'sm' //Button size like sm, xs etc.
});
</script>
<script type="text/javascript" charset="utf-8">
    $(prettyPrint);
</script>

<div class="form-group">
  <label class="col-md-4 control-label" for="link"> Link</label>  
  <div class="col-md-5">
  <input id="link" name="link" type="text" placeholder="http://" class="form-control input-md" <?php if(!empty($link)){ echo "value='".$link."'"; } ?>> 
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" class="btn btn-default btn-primary btn-lg" name="update" value="Insert/Update"/>    
  </div>
</div>

</fieldset>
<input type="hidden" name="num_top" value="<?php echo $top_number; ?>">
</form>

<div class="panel panel-primary">
  <div class="panel-heading">Image</div>
  <div class="panel-body">
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <!-- File Button --> 
	<div class="form-group">
	  <label class="col-md-4 control-label" for="filebutton"><?php if(!empty($banner1)){ echo '<a href="../banner/'.$banner1.'" target="_blank">(Actual banner)</a>'; } ?> Image 1 </label>
	  <div class="col-md-4">
		<input id="file1" name="file1" class="input-file" type="file">
	  </div>
	  <div class="col-md-4">
		<input type="hidden" name="num_top" value="<?php echo $top_number; ?>">
		<input type="submit" class="btn btn-default btn-primary btn-lg" name="submitbanner1" value="Insert/Update"/>   
		<a href="top.php?remove_banner1=yes&id=<?php echo $top_number; ?>" onClick="return confirmSubmit()" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>
	  </div>
	</div>		
	</form>
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
	<!-- File Button --> 
	<div class="form-group">
	  <label class="col-md-4 control-label" for="filebutton"><?php if(!empty($banner2)){ echo '<a href="../banner/'.$banner2.'" target="_blank">(Actual banner)</a>'; } ?> Image 2 </label>
	  <div class="col-md-4">
		<input id="file2" name="file2" class="input-file" type="file">
	  </div>
	  <div class="col-md-4">
		<input type="hidden" name="num_top" value="<?php echo $top_number; ?>">
		<input type="submit" class="btn btn-default btn-primary btn-lg" name="submitbanner2" value="Insert/Update"/>    
		<a href="top.php?remove_banner2=yes&id=<?php echo $top_number; ?>" onClick="return confirmSubmit()" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>	  
	  </div>
	</div>		
	</form>
  </div>
</div>
</form>

<?php } ?>
<?php
/**
 * uploadFile()
 * 
 * @param string $file_field name of file upload field in html form
 * @param bool $check_image check if uploaded file is a valid image
 * @param bool $random_name generate random filename for uploaded file
 * @return array
 */
function uploadFile ($file_field = null, $check_image = false, $random_name = false) {
       
  //Config Section    
  //Set file upload path
  $path = '../banner/'; //with trailing slash
  //Set max file size in bytes
  $max_size = 1000000;
	//Set default file extension whitelist
	$whitelist_ext = array('jpg', 'jpeg', 'png','gif');
	//Set default file type whitelist
	$whitelist_type = array('image/jpg', 'image/pjpeg', 'image/png','image/gif');

  

  //The Validation
  // Create an array to hold any output
  $out = array('error'=>null);
               
  if (!$file_field) {
    $out['error'][] = "Please specify a valid form field name";           
  }

  if (!$path) {
    $out['error'][] = "Please specify a valid upload path";               
  }
       
  if (count($out['error'])>0) {
    return $out;
  }

  //Make sure that there is a file
  if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {
         
    // Get filename
    $file_info = pathinfo($_FILES[$file_field]['name']);
    $name = $file_info['filename'];
    $ext = $file_info['extension'];
               
    //Check file has the right extension           
    if (!in_array($ext, $whitelist_ext)) {
      $out['error'][] = "Invalid file Extension";
    }
               
    //Check that the file is of the right type
    if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) {
      $out['error'][] = "Invalid file Type";
    }
               
    //Check that the file is not too big
    if ($_FILES[$file_field]["size"] > $max_size) {
      $out['error'][] = "File is too big";
    }
               
    //If $check image is set as true
    if ($check_image) {
      if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
        $out['error'][] = "Uploaded file is not a valid image";
      }
    }

    //Create full filename including path
    if ($random_name) {
      // Generate random filename
      $tmp = str_replace(array('.',' '), array('',''), microtime());
                       
      if (!$tmp || $tmp == '') {
        $out['error'][] = "File must have a name";
      }     
      $newname = $tmp.'.'.$ext;                                
    } else {
        $newname = $name.'.'.$ext;
    }
               
    //Check if file already exists on server
    if (file_exists($path.$newname)) {
      $out['error'][] = "A file with this name already exists";
    }

    if (count($out['error'])>0) {
      //The file has not correctly validated
      return $out;
    } 

    if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname)) {
      //Success
      $out['filepath'] = $path;
      $out['filename'] = $newname;
      return $out;
    } else {
      $out['error'][] = "Server Error!";
    }
         
  } else {
    $out['error'][] = "No file uploaded";
    return $out;
  }      
}
?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Options</h1>	
					<?php display_top($num_top); 	?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php include 'footer.php' ?>