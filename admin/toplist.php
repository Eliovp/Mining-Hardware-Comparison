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
	DB::delete('top_listing', "id=%i", $_POST['id_number']);
}	

$results = DB::query("SELECT * FROM top_listing ORDER BY id ASC");
?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List</h1>

		<div class="span5">
            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th>id</th>
					  <th>Name</th>
                      <th>Base</th>
                      <th>Status</th> 
					  <th></th> 					  
                  </tr>
              </thead>   
              <tbody>
			<?php 	
			$id='';
			foreach ($results as $row) { 
			if($row['active']=='1'){ 
				if($id == $row['id']){ echo '<td colspan="4"><div class="alert alert-danger"><strong>Warning: </strong>Same id than precedent</div></td>'; }
				$rank = $row['rank'];
			}
			?>		
                <tr>
                    <td><b><?php echo $row['id']; ?></b></td>
					<td><?php echo $row['name']. ' ' .$row['value_feature1']; ?></td>
                    <td><?php echo $row['base']; ?></td>
					<td><?php if($row['active']=='1'){  echo '<span class="label label-success">Active</span>'; }else{ echo '<span class="label label-danger">Inactive</span>';} ?></td>
                    <td>
						<form method="post">
							<a href="top.php?num_top=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>&nbsp;&nbsp;
							<input type="hidden" name="id_number" value="<?php echo $row['id']; ?>">
							<input type="submit" name="delete_data" onClick="return confirmSubmit()" class="btn btn-danger btn-xs" value="Delete"/>															
						</form>
					</td>                                      
                </tr>
				
			<?php } ?>                                                 
              </tbody>
            </table>
            </div>
					<br><a href="top.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> New Entry</a>
                </div>
            </div>
        </div>
<?php include 'footer.php' ?>