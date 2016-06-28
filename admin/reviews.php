<?php include 'header.php' ?>
<?php 
//DB::debugMode();
echo '<script LANGUAGE="JavaScript">
												function confirmSubmit()
												{
												var agree=confirm("Are you sure you wish to continue?");
												if (agree)
													return true ;
												else
													return false ;
												}
												</script>';

if(!empty($_POST['delete_data'])){
	DB::delete('comments', "id=%i", $_POST['id_number']);
}	
$results = DB::query("SELECT rank,comments.*,top_listing.name as topname, value_feature1 as type FROM `comments`,top_listing WHERE id_post=top_listing.id ORDER BY date DESC");
?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Options</h1>

		<div class="span5">
            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>id</th>
					  <th>Name</th>
                      <th>Email</th>
                      <th>Comment</th>    
					  <th>Date</th>  
					  <th></th> <th></th> 					  
                  </tr>
              </thead>   
              <tbody>
			<?php 	foreach ($results as $row) { ?>		
                <tr>
                    <td><b><?php echo '('.$row['id'].') '.$row['topname'].' '.$row['type']; ?></b></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo substr($row['comment'],0,100).'...'; ?></td>
					<td><?php echo $row['date']; ?></td>
                    <td><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-comment"></span></button></td>
					<td>	<form method="post">
							<input type="hidden" name="id_number" value="<?php echo $row['id']; ?>">
							<input type="submit" name="delete_data" onClick="return confirmSubmit()" class="btn btn-danger btn-xs" value="Delete"/>															
						</form></td>                                      
                </tr>
				<div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      				<div class="modal-dialog">
    					<div class="modal-content">
          					<div class="modal-header">
        						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        						<h4 class="modal-title custom_align" id="Heading">Comment details</h4>
      						</div>
							<div class="modal-body">	  
								<?php echo $row['comment']; ?>
							</div>
        				</div>
    					<!-- /.modal-content --> 
  					</div>
      <!-- /.modal-dialog --> 
				</div>
			<?php } ?>                                                 
              </tbody>
            </table>
            </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
<?php include 'footer.php' ?>