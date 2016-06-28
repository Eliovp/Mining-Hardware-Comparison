<?php
if(!empty($_POST)){
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $email = htmlentities($email);
    $comment = htmlentities($comment);
	
	require_once 'admin/db.php';
	//DB::debugMode();
	// Get gravatar Image 
	$default = "mm";
	$size = 35;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . $default . "&s=" . $size;

	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
	$insert=DB::insert('comments', array(  'name' => $name,  'email' => $email, 'comment' => $comment,  'id_post' => $id_post));

    if($insert){
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5>
			<b>Rating : </b><?php echo $rating; ?>			
			<span  class="com-dt"><?php echo date('d-m-Y H:i'); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div>

	<?php } ?>
<?php endif; ?>
<?php } ?>