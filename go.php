<!-- broken, needs fix.. -->
<?php
if(!empty($_GET['top']) AND is_numeric($_GET['top'])){
	require_once 'admin/db.php'; 
	if(!empty($_SERVER['HTTP_USER_AGENT']) and preg_match('~(bot|crawl)~i', $_SERVER['HTTP_USER_AGENT'])){
		// this is a crawler 
	}else{
		$insert=DB::insert('tracking_table', array( 'rec_use_topnumber' => $_GET['top'],'rec_use_date' => date('Y-m-d H:i:s')));
	}
	$row = DB::queryFirstRow("SELECT link FROM top_listing WHERE id=%i LIMIT 1",$_GET['top']);
	$redirect=$row['link'];
	header("Location: $redirect");
}
?>