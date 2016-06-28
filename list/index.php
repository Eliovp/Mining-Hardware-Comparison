<?php include 'header.php';?>

       <div class="container">
             <!--<div class="alert alert-info" role="alert"><b>Mining Hardware Comparison v1 </b>-->
            <div class="row">
      			<?php
					
					// your secret key
					$secret = "";
					$response = null;
					$reCaptcha = new ReCaptcha($secret);
		
					if (!empty($_POST['submission'])) 
					{
						if (empty($_POST['name'])) 
						{
							$_POST['active'] = $active = '0';
						}
						if ($_POST['active'] == '1' and empty($_POST['name'])) 
						{
							echo '<div class="alert alert-danger">Error. Please insert a name.</div>';
						}
						{
								if (!empty($_POST['name'])) {
									$name = $_POST['name'];
								} else {
									$name = '';
								}
								if (!empty($_POST['base'])) {
									$base = $_POST['base'];
								} else {
									$base = '';
								}
								if (!empty($_POST['feature1'])) {
									$value_feature1 = $_POST['feature1'];
								} elseif (!empty($_POST['feature2'])) {
									$value_feature1 = $_POST['feature2'];
								} else {
									$value_feature2 = '';
								}
								if (!empty($_POST['value_feature2'])) {
									$value_feature2 = $_POST['value_feature2'];
								} else {
									$value_feature2 = '';
								}
								if (!empty($_POST['value_feature3'])) {
									$value_feature3 = $_POST['value_feature3'];
								} else {
									$value_feature3 = '';
								}
								if (!empty($_POST['value_feature4'])) {
									$value_feature4 = $_POST['value_feature4'];
								} else {
									$value_feature4 = '';
								}
								if (!empty($_POST['value_feature5'])) {
									$value_feature5 = $_POST['value_feature5'];
								} else {
									$value_feature5 = '';
								}
								if (!empty($_POST['feature5link'])) {
									$feature5link = $_POST['feature5link'];
								} else {
									$feature5link = '';
								}
								if (!empty($_POST['value_feature6'])) {
									$value_feature6 = $_POST['value_feature6'];
								} else {
									$value_feature6 = '';
								}
								if (!empty($_POST['value_feature7'])) {
									$value_feature7 = $_POST['value_feature7'];
								} else {
									$value_feature7 = '';
								}
								if (!empty($_POST['value_feature8'])) {
									$value_feature8 = $_POST['value_feature8'];
								} else {
									$value_feature8 = '';
								}
								if (!empty($_POST['feature9'])) {
									$value_feature9 = $_POST['feature9'] . $_POST['feature9speed'];
								} else {
									$value_feature9 = 'Foutje';
								}
								if (!empty($_POST['value_feature10'])) {
									$value_feature10 = $_POST['value_feature10'];
								} else {
									$value_feature10 = '';
								}
								if (!empty($_POST['link'])) {
									$link = $_POST['link'];
								} else {
									$link = '';
								}
								if (!empty($_POST['username'])) {
									$username = $_POST['username'];
								} else {
									$username = '';
								}
			
								$insert = DB::insertUpdate('top_listing', array('id' => $top_number,
																'name' => $name,
																'base' => $base,
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
																'link' => $link,
																'username' => $username, ));
								
								if ($_POST["g-recaptcha-response"]) 
								{
									$response = $reCaptcha->verifyResponse(
										$_SERVER["REMOTE_ADDR"],
										$_POST["g-recaptcha-response"]
									);
								}
								if ($response != null && $response->success) 
								{
									if ($insert) {
										echo '<div class="alert alert-success">We have succesfully received your submission. We will activate it as soon as possible!</div>';
									} else {
										echo '<div class="alert alert-warning">Error. Please try again.</div>';
									}
								} 
							}
					}
				?>
            </div>
            <div class="modal fade" id="submission" tabindex="-1" role="dialog" aria-labelledby="submission" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 style="text-align:center;" class="modal-title custom_align" id="Heading">Submit your config</h4>
                                </div>
                                <div class="modal-body">
    
                                    <?php function display_top($top_number = ''){    ?>
    
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
                                    $row = DB::queryFirstRow('SELECT * FROM `options` WHERE id=0');
                                        if (!empty($row['feature1_name'])) {
                                            $feature1_name = $row['feature1_name'];
                                        } else {
                                            $feature1_name = 'Value of the Feature 1';
                                        }
                                        if (!empty($row['feature2_name'])) {
                                            $feature2_name = $row['feature2_name'];
                                        } else {
                                            $feature2_name = 'Value of the Feature 2';
                                        }
                                        if (!empty($row['feature3_name'])) {
                                            $feature3_name = $row['feature3_name'];
                                        } else {
                                            $feature3_name = 'Value of the Feature 3';
                                        }
                                        if (!empty($row['feature4_name'])) {
                                            $feature4_name = $row['feature4_name'];
                                        } else {
                                            $feature4_name = 'Value of the Feature 4';
                                        }
                                        if (!empty($row['feature5_name'])) {
                                            $feature5_name = $row['feature5_name'];
                                        } else {
                                            $feature5_name = 'Value of the Feature 5';
                                        }
                                        if (!empty($row['feature6_name'])) {
                                            $feature6_name = $row['feature6_name'];
                                        } else {
                                            $feature6_name = 'Value of the Feature 6';
                                        }
                                        if (!empty($row['feature7_name'])) {
                                            $feature7_name = $row['feature7_name'];
                                        } else {
                                            $feature7_name = 'Value of the Feature 7';
                                        }
                                        if (!empty($row['feature8_name'])) {
                                            $feature8_name = $row['feature8_name'];
                                        } else {
                                            $feature8_name = 'Value of the Feature 8';
                                        }
                                        if (!empty($row['feature9_name'])) {
                                            $feature9_name = $row['feature9_name'];
                                        } else {
                                            $feature9_name = 'Value of the Feature 9';
                                        }
                                        if (!empty($row['feature10_name'])) {
                                            $feature10_name = $row['feature10_name'];
                                        } else {
                                            $feature10_name = 'Value of the Feature 10';
                                        }
                                    
                                        if (!empty($top_number)) {
                                            $row = DB::queryFirstRow("SELECT * FROM top_listing WHERE id=$top_number");
                                            $name = $row['name'];
                                            $base = $row['base'];
                                            /*$rank=$row['rank'];*/
                                            /*$active=$row['active'];*/
                                            $value_feature1 = $row['value_feature1'];
                                            $value_feature2 = $row['value_feature2'];
                                            $value_feature3 = $row['value_feature3'];
                                            $value_feature4 = $row['value_feature4'];
                                            $value_feature5 = $row['value_feature5'];
                                            $feature5link = $row['feature5link'];
                                            $value_feature6 = $row['value_feature6'];
                                            $value_feature7 = $row['value_feature7'];
                                            $value_feature8 = $row['value_feature8'];
                                            $value_feature9 = $row['value_feature9'];
                                            $value_feature10 = $row['value_feature10'];
                                            $link = $row['link'];
                                            $username = $row['username'];
                                        }
                                        ?>
                                    <form id="submitForm" role="form" class="form-horizontal" method="post">
                                    <fieldset>
                                    <!-- Multiple Radios (inline) -->
                                    
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="radios">Base</label>
                                      <div class="col-md-4">
                                        <label class="radio-inline" for="radios-0">
                                          <input type="radio" name="base" id="radios-0" value="AMD" <?php if (!empty($base) and $base == 'AMD') {
                                        echo 'checked="checked"';
                                    }
                                        ?>>AMD</label>
                                        <label class="radio-inline" for="radios-1">
                                          <input type="radio" name="base" id="radios-1" value="NVidia" <?php if (!empty($base) and $base == 'NVidia') {
                                        echo 'checked="checked"';
                                    }
                                        ?>>NVidia</label>
                                      </div>
                                    </div>
                                    
									
									<div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="name">Manufacturer</label>
									  <div class="col-md-5">
									  <select class="form-control" id="name" name="name" required>
										<option value="" disabled>Please choose a manufacturer</option>
										<option value="AMD">AMD</option>
										<option value="ASUS">Asus</option>
										<option value="ATI">ATI</option>
										<option value="Club3D">Club 3D</option>
										<option value="EVGA">EVGA</option>
										<option value="Gainward">Gainward</option>
										<option value="Galax">Galax</option>
										<option value="Gigabyte">Gigabyte</option>
										<option value="HIS">HIS</option>
										<option value="Inno3D">Inno 3D</option>
										<option value="MSI">MSI</option>
										<option value="NVIDIA">nVidia</option>
										<option value="Palit">Palit</option>
										<option value="PNY">PNY</option>
										<option value="PowerColor">PowerColor</option>
										<option value="Sapphire">Sapphire</option>
										<option value="VTX3D">VTX3D</option>
										<option value="XFX">XFX</option>
										<option value="Zotac">Zotac</option>
										<option value="Other">Other</option>
									  </select>
									  </div>
									  
                                    </div>
                                    
                                    
										<div class="form-group has-feedback" id="AMD" style="display:none">
										  <label class="col-md-4 control-label" for="feature1_value" id="amd"> 
                                          </label>
										  <div class="col-md-5">
											<input class="form-control input-md" id="description" name="feature1" 
											placeholder="R9 390X, R9290X, ..">
										  </div>
										</div>
                                    
									
									
										<div class="form-group has-feedback" id="nVidia" style="display:none">
										  <label class="col-md-4 control-label" for="feature1_value" id="nvidia"> 
                                          </label>
										
										  <div class="col-md-5">
											<input class="form-control input-md" id="description" name="feature2" 
											placeholder="GTX980, GTX550 ..">
										  </div>
										</div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature2_value"><?php echo $feature2_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <input class="form-control input-md" id="description" name="value_feature2" 
                                      placeholder="1000, 1050, .." <?php if (!empty($value_feature2)) {
                                        echo $value_feature2;
                                    }
                                        ?> required>
                                    	</div>
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature3_value"><?php echo $feature3_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <input class="form-control input-md" id="description" name="value_feature3" 
                                      placeholder="1500, 1250, .." <?php if (!empty($value_feature3)) {
                                        echo $value_feature3;
                                    }
                                        ?> required>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature4_value"><?php echo $feature4_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <input class="form-control input-md" id="description" name="value_feature4" 
                                      placeholder="Ubuntu 14.04, Windows 7, .." <?php if (!empty($value_feature4)) {
                                        echo $value_feature4;
                                    }
                                        ?> required>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature5_value"><?php echo $feature5_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <input class="form-control input-md" id="description" name="value_feature5" 
                                      placeholder="Catalyst 15.11, Cuda 14, .." <?php if (!empty($value_feature5)) {
                                        echo $value_feature5;
                                    }
                                        ?> required>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature6_value"><?php echo $feature6_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <input class="form-control input-md" id="description" name="value_feature6" 
                                      placeholder="sgminer 5, ccminer, .." <?php if (!empty($value_feature6)) {
                                        echo $value_feature6;
                                    }
                                        ?>>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature5link"> Link to mining software</label>
                                      <div class="col-md-5">
                                      <input id="feature5link" name="feature5link" type="url" placeholder="http://" class="form-control input-md" <?php if (!empty($feature5link)) {
                                        echo "#";
                                    }
                                        ?>>
                                      </div>
                                    </div>
									
									<div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature7_value"><?php echo $feature7_name;
                                        ?></label>
									  <div class="col-md-5">
									  <select class="form-control" id="sel1" name="value_feature7" required>
										<option value="" disabled>Algorithm?</option>
										<option value="Ethereum">Ethereum</option>
										<option value="Blake256(Decred)">Decred</option>
										<option value="X11">X11</option>
										<option value="X13">X13</option>
										<option value="X15">X15</option>
										<option value="Quark">Quark</option>
										<option value="Lyra2RE">Lyra2RE</option>
										<option value="Lyra2REv2">Lyra2REv2</option>
										<option value="Groestl">Groestl</option>
										<option value="Keccak">Keccak</option>
										<option value="Keccak">Nist5</option>
										<option value="Neoscrypt">Neoscrypt</option>
										<option value="Qubit">Qubit</option>
										<option value="Scrypt">Scrypt</option>
										<option value="Scrypt-Chacha">Scrypt-Chacha</option>
										<option value="Blake256(Vanilla)">Vanilla</option>
										<option value="WhirlpoolX">WhirlpoolX</option>
									  </select>
									  </div>
									  
                                    </div>
									
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature8_value"><?php echo '<br>'.$feature8_name;
                                        ?></label>
                                      <div class="col-md-5">
                                      <textarea class="textarea form-control" id="description" name="value_feature8" 
                                      placeholder="" style="height: 100px" required></textarea>
                                      </div>
                                    </div>
                                    
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="feature9_value"><?php echo $feature9_name;
                                        ?></label>
                                      <div class="col-md-3">
                                      <input class="form-control input-md" id="description" name="feature9" 
                                      placeholder="" required>
                                      </div>
									  <div class="col-md-3">
									  <select class="form-control" id="sel1" name="feature9speed">
										<option value="" disabled>Kh, Mh or Gh ?</option>
										<option value="Kh/s">Kh/s</option>
										<option value="Mh/s" selected>Mh/s</option>
										<option value="Gh/s">Gh/s</option>
									  </select>
									  </div>
									  
                                    </div>
                                    
                                    <div class="form-group has-feedback">
                                      <label class="col-md-4 control-label" for="name">Submitted by</label>
                                      <div class="col-md-5">
                                      <input id="username" name="username" type="text" placeholder="Your name" 
                                      class="form-control input-md" <?php if (!empty($username)) {
                                        echo ".";
                                    }
                                        ?> required>
                                      </div>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="description">Description</label>
                                      <div class="col-md-4">
                                        <textarea class="textarea form-control" id="description" name="description" placeholder="Enter text ..." style="height: 200px"><?php /*?><?php if(!empty($description)){ echo $description; } ?><?php */?></textarea>
                                      </div>
                                    </div>-->
                                    
                                    <!--<div class="form-group">
                                         <label class="col-md-4 control-label" id="captchaOperation"></label>
                                            <div class="col-md-5">
                                          <input type="text" class="form-control" name="captcha" />
                                       </div>
                                    </div>-->
                                    
                                    <!-- Button -->
                                    <div class="form-group">
                                      <label class="col-md-4 control-label" for="singlebutton"></label>
                                      <div class="g-recaptcha" data-sitekey="6LdbLiATAAAAAAMBxkNB0bZ00kjELXco4O9Q5keO"></div>
                                      <div class="col-md-4">
                                        <input type="submit" class="btn btn-default btn-primary btn-lg" name="submission" value="Submit"/>
                                      </div>
                                    </div>
                                    
                                    </fieldset>
                                    <input type="hidden" name="num_top" value="<?php echo $top_number;?>">
                                    </form>
    
									<?php } ?>
           							<div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!--<h1 class="page-header">Options</h1>-->
                        <?php display_top($num_top);    ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
          <!-- /.modal-dialog -->
            </div>
        <!-- <h5>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h5>-->
        <?php if ($brand == 'amd') { ?>
            <div class="row">
            <?php	    $results = DB::query("SELECT * FROM top_listing WHERE active=1 AND base='AMD' ORDER BY name");        ?>
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">AMD</h3>
                            <div class="pull-right">
                                <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                    <i class="glyphicon glyphicon-filter"></i>
                                </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter by text or click on a header below to sort rows." />
    
                        <table class="table table-hover table-responsive" id="dev-table">
                            <thead>
                                <tr>
                                    <!--<th style="text-align:center;">#</th>-->
                                    <th style="text-align:center;">Manufacturer</th>
                                    <!--<th style="text-align:center;"></th>-->
                                    <?php if (!empty($feature1_name)) {    echo '<th style="text-align:center;">'.$feature1_name.'</th>';} ?>
                                    <?php if (!empty($feature2_name)) {    echo '<th style="text-align:center;">'.$feature2_name.'</th>';} ?>
                                    <?php if (!empty($feature3_name)) {    echo '<th style="text-align:center;">'.$feature3_name.'</th>';} ?>
                                    <?php if (!empty($feature4_name)) {    echo '<th style="text-align:center;">'.$feature4_name.'</th>';} ?>
                                    <?php if (!empty($feature5_name)) {    echo '<th style="text-align:center;">'.$feature5_name.'</th>';} ?>
                                    <?php if (!empty($feature7_name)) {    echo '<th style="text-align:center;">'.$feature7_name.'</th>';} ?>
                                    <?php if (!empty($feature9_name)) {    echo '<th style="text-align:center;">'.$feature9_name.'</th>';} ?>
                                   
                                    <!--<th style="text-align:center;">&nbsp;</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php     foreach ($results as $row) {        ?>
                                    <tr data-toggle="tooltip" title="Submitted by <?php echo $row['username'];        ?>">
                                        <!--<td style="text-align:center;"><?php /*?><?php echo $row['rank']; ?><?php */?></td>-->
                                        <td style="text-align:center;"><b><?php echo strtoupper($row['name']);        ?></b></td>
                                        <?php if (!empty($row['banner1'])) {    echo '<td style="text-align:center;"><img src="../banner/'.$row['banner1'].'" alt="'.$row['name'].'"></td>';}        ?>
                                        <?php if (!empty($feature1_name)) {    echo '<td style="text-align:center;">'.$row['value_feature1'].'</td>';}        ?>
                                        <?php if (!empty($feature2_name)) {    echo '<td style="text-align:center;">'.$row['value_feature2'].'</td>';}        ?>
                                        <?php if (!empty($feature3_name)) {    echo '<td style="text-align:center;">'.$row['value_feature3'].'</td>';}        ?>
                                        <?php if (!empty($feature4_name)) {    echo '<td style="text-align:center;">'.$row['value_feature4'].'</td>';}        ?>
                                        <?php if (!empty($feature5_name)) {    echo '<td style="text-align:center;">'.$row['value_feature5'].'</td>';}        ?>
                                        <?php if (!empty($feature7_name)) {    echo '<td style="text-align:center;">'.$row['value_feature7'].'</td>';}        ?>
                                        <?php if (!empty($feature9_name)) {    echo '<td style="text-align:center;">'.$row['value_feature9'].'</td>';}        ?>
                                        <td style="text-align:center;">
                                        <a href="../page.php?id=<?php echo $row['id'];?>&hash=<?php if ($row['value_feature7'] == 'Ethereum') { echo $row['value_feature9'];}?>" 
                                        class="btn btn-default btn-medium" >More Info</a></td>
                                    </tr>
                                <?php    } ?>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php } else if ($brand == 'nvidia') { ?>
            <div class="row">
            <?php	    $results = DB::query("SELECT * FROM top_listing WHERE active=1 AND base='NVidia' ORDER BY name");        ?>
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">nVidia</h3>
                            <div class="pull-right">
                                <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                    <i class="glyphicon glyphicon-filter"></i>
                                </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter by text or click on a header below to sort rows." />
    
                        <table class="table table-hover table-responsive" id="dev-table">
                            <thead>
                                <tr>
                                    <!--<th style="text-align:center;">#</th>-->
                                    <th style="text-align:center;">Manufacturer</th>
                                    <!--<th style="text-align:center;"></th>-->
                                    <?php if (!empty($feature1_name)) {    echo '<th style="text-align:center;">'.$feature1_name.'</th>';} ?>
                                    <?php if (!empty($feature2_name)) {    echo '<th style="text-align:center;">'.$feature2_name.'</th>';} ?>
                                    <?php if (!empty($feature3_name)) {    echo '<th style="text-align:center;">'.$feature3_name.'</th>';} ?>
                                    <?php if (!empty($feature4_name)) {    echo '<th style="text-align:center;">'.$feature4_name.'</th>';} ?>
                                    <?php if (!empty($feature5_name)) {    echo '<th style="text-align:center;">'.$feature5_name.'</th>';} ?>
                                    <?php if (!empty($feature7_name)) {    echo '<th style="text-align:center;">'.$feature7_name.'</th>';} ?>
                                    <?php if (!empty($feature9_name)) {    echo '<th style="text-align:center;">'.$feature9_name.'</th>';} ?>
                                    
                                    <!--<th style="text-align:center;">&nbsp;</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php     foreach ($results as $row) {        ?>
                                    <tr data-toggle="tooltip" title="Submitted by <?php echo $row['username'];        ?>">
                                        <!--<td style="text-align:center;"><?php /*?><?php echo $row['rank']; ?><?php */?></td>-->
                                        <td style="text-align:center;"><b><?php echo strtoupper($row['name']);        ?></b></td>
                                        <?php if (!empty($row['banner1'])) {    echo '<td style="text-align:center;"><img src="../banner/'.$row['banner1'].'" alt="'.$row['name'].'"></td>';}        ?>
                                        <?php if (!empty($feature1_name)) {    echo '<td style="text-align:center;">'.$row['value_feature1'].'</td>';}        ?>
                                        <?php if (!empty($feature2_name)) {    echo '<td style="text-align:center;">'.$row['value_feature2'].'</td>';}        ?>
                                        <?php if (!empty($feature3_name)) {    echo '<td style="text-align:center;">'.$row['value_feature3'].'</td>';}        ?>
                                        <?php if (!empty($feature4_name)) {    echo '<td style="text-align:center;">'.$row['value_feature4'].'</td>';}        ?>
                                        <?php if (!empty($feature5_name)) {    echo '<td style="text-align:center;">'.$row['value_feature5'].'</td>';}        ?>
                                        <?php if (!empty($feature7_name)) {    echo '<td style="text-align:center;">'.$row['value_feature7'].'</td>';}        ?>
                                        <?php if (!empty($feature9_name)) {    echo '<td style="text-align:center;">'.$row['value_feature9'].'</td>';}        ?>
                                        <td style="text-align:center;">
                                        <a href="../page.php?id=<?php echo $row['id'];?>&hash=<?php if ($row['value_feature7'] == 'Ethereum') { echo $row['value_feature9'];}?>" 
                                        class="btn btn-default btn-medium" >More Info</a></td>
                                    </tr>
                                <?php    } ?>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php } else if ($brand == 'both') { ?>
        
            <div class="row">
            <?php	    $results = DB::query("SELECT * FROM top_listing WHERE active=1 ORDER BY name");        ?>
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">All</h3>
                            <div class="pull-right">
                                <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                    <i class="glyphicon glyphicon-filter"></i>
                                </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter by text or click on a header below to sort rows." />
    
                        <table class="table table-hover table-responsive" id="dev-table">
                            <thead>
                                <tr>
                                    <!--<th style="text-align:center;">#</th>-->
                                    <th style="text-align:center;">Manufacturer</th>
                                    <!--<th style="text-align:center;"></th>-->
                                    <?php if (!empty($feature1_name)) {    echo '<th style="text-align:center;">'.$feature1_name.'</th>';} ?>
                                    <?php if (!empty($feature2_name)) {    echo '<th style="text-align:center;">'.$feature2_name.'</th>';} ?>
                                    <?php if (!empty($feature3_name)) {    echo '<th style="text-align:center;">'.$feature3_name.'</th>';} ?>
                                    <?php if (!empty($feature4_name)) {    echo '<th style="text-align:center;">'.$feature4_name.'</th>';} ?>
                                    <?php if (!empty($feature5_name)) {    echo '<th style="text-align:center;">'.$feature5_name.'</th>';} ?>
                                    <?php if (!empty($feature7_name)) {    echo '<th style="text-align:center;">'.$feature7_name.'</th>';} ?>
                                    <?php if (!empty($feature9_name)) {    echo '<th style="text-align:center;">'.$feature9_name.'</th>';} ?>
                                    <!--<th style="text-align:center;">&nbsp;</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php     foreach ($results as $row) {        ?>
                                    <tr data-toggle="tooltip" title="Submitted by <?php echo $row['username'];        ?>">
                                        <!--<td style="text-align:center;"><?php /*?><?php echo $row['rank']; ?><?php */?></td>-->
                                        <td style="text-align:center;"><b><?php echo strtoupper($row['name']);        ?></b></td>
                                        <?php if (!empty($row['banner1'])) {    echo '<td style="text-align:center;"><img src="../banner/'.$row['banner1'].'" alt="'.$row['name'].'"></td>';}        ?>
                                        <?php if (!empty($feature1_name)) {    echo '<td style="text-align:center;">'.$row['value_feature1'].'</td>';}        ?>
                                        <?php if (!empty($feature2_name)) {    echo '<td style="text-align:center;">'.$row['value_feature2'].'</td>';}        ?>
                                        <?php if (!empty($feature3_name)) {    echo '<td style="text-align:center;">'.$row['value_feature3'].'</td>';}        ?>
                                        <?php if (!empty($feature4_name)) {    echo '<td style="text-align:center;">'.$row['value_feature4'].'</td>';}        ?>
                                        <?php if (!empty($feature5_name)) {    echo '<td style="text-align:center;">'.$row['value_feature5'].'</td>';}        ?>
                                        <?php if (!empty($feature7_name)) {    echo '<td style="text-align:center;">'.$row['value_feature7'].'</td>';}        ?>
                                        <?php if (!empty($feature9_name)) {    echo '<td style="text-align:center;">'.$row['value_feature9'].'</td>';}        ?>
                                        <td style="text-align:center;">       
                                        <a href="../page.php?id=<?php echo $row['id'];?>&hash=<?php if ($row['value_feature7'] == 'Ethereum') { echo $row['value_feature9'];}?>" 
                                        class="btn btn-default btn-medium" >More Info</a></td>
                                    </tr>
                                <?php    } ?>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php } else { ?>
        <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                        
                            <a href="index.php?brand=amd" class="btn btn-primary btn-block" >Complete list of AMD Based Cards</a>
                            
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                        	<a href="index.php?brand=both" class="btn btn-primary btn-block" >Complete list of all GPU's</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                        	<a href="index.php?brand=nvidia" class="btn btn-primary btn-block" >Complete list of Nvidia Based Cards</a>
                        </div>
                    </div>
                </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="jumbotron">
                          <h1 style="text-align:center">Welcome!</h1>      
                          <p style="text-align:center">Here you will be able to find a various amount of Graphic Cards and Configurations for the mining scene.</p>
                          <p style="text-align:center; color:#F00">
                          <b>All the info you find on this website is submitted by users. <br />
                          In other words, data found here could defer from reality! <br />
                          The admin will however try to keep this as correct and realistic as possible!
                          </b></p>
                          <p style="text-align:center; font-size:medium">
                          <b>If you have a card/config that isn't listed yet, or you have a better config. <br /> 
                          Please don't hesitate to submit your configuration by clicking on the green button in the top right corner.</b> </p>
                          <p style="text-align:center; font-size:medium"><b>
                          Ethereum Profitability Calculator added to every card/config in the Ethereum section. <br /> 
                          Click on "More info"<small>"(Every card/config has it's own page)</small> if you wish to leave a comment for a specific card/config. </b></p>
                          <p style="text-align:center; font-size:medium; color:#0C0;">
                          You can use the filter options to filter for your specific need. <br />
                          Just enter something in the search box on top of every list view. <br />
                          You can also click on the column headers to sort Ascending or Descending.
                          <br /><br />
                          
                          Thank you!</p>
                        </div>
                       
                    </div>
                    
                </div>
            
        <?php } ?>
        </div>
        <div class="modal fade" id="config" tabindex="-1" role="dialog" aria-labelledby="config" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Config</h4>
                                </div>
                                <div class="modal-body">
                                <table>
                                    <tbody>
                                        <tr id="configField" name="configField" style="height:300px" value="">
    
                                        </tr>
                                    </tbody>
                                </table>
    
                                    <!--<div id="configField" name="configField" style="height:300px; width:300px" value"">-->
                                </div>
                            </div>
                        </div>
        </div>
        <div style="height:63px;" class="push"><!--//--></div>
    </div>
<?php include 'footer.php'; ?>