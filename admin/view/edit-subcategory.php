<?php
include('../model/onlinemodel.php');
$obj =  new portal;

if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

$subcat = $obj->get_subcategory_by_id($id);
$category = $obj->fetch_category();
	


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Category</title>
	<link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="../css/theme.css" rel="stylesheet">
	<link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
    <?php include('../include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
                <?php include('../include/sidebar.php');?>				
			    <div class="span9">
				    <div class="content">
                        <div class="module">
							<div class="module-head">
								<h3>Sub Category</h3>
							</div>
							<div class="module-body">
                                <!-- <div class="alert alert-success ">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong class="cat-success"></strong>
								</div>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	
                                </div> -->
                                <br />
                                <form class="form-horizontal row-fluid" id="subcategory_form" action="../controller/controller.php" method="post">
								    <div class="control-group">
                                        <input type="hidden" name="id" id="" value="<?php echo $subcat['id'];?>">
                                        <label class="control-label" for="basicinput">Category Name</label>
                                        <div class="controls">
                                            <!-- <input type="text" placeholder="Enter category Name" id="cat_name" name="category" class="span8 tip" required> -->
                                            <select name="category" class="span8 tip" id="category"  required>    
                                                <option value="<?php echo $subcat['categoryid'];?>"><?php echo $catname=$subcat['category'];?></option>
                                                <?php foreach($category as $cat) 
                                                {
                                                    echo $category = $cat['category'];
                                                    if($catname==$category)
                                                    {
	                                                    continue;
                                                    }
                                                    else{
                                                    ?>
                                                    <option value="<?php echo $cat['id'];?>"><?php echo $cat['category'];?></option>
                                                <?php } }?>
                                            </select>
                                            <p id="category-error"></p>
                                        </div>
                                        
                                    </div>

                                    <div class="control-group">
										<label class="control-label" for="basicinput">Sub Category</label>
                                        <div class="controls">
                                        <input type="text" placeholder="Enter Sub-category Name" id="sub-cat" name="sub-category" class="span8 tip" value="<?php echo $subcat['subcategory']?>"required>
                                        <p id="subcategory-error"></p>
                                        </div>
                                        
									</div>

	                                <div class="control-group">
									    <div class="controls">
                                        <!-- <input type="button" value="Create" class="btn btn-primary" id="create"> -->
                                        <button class="btn btn-primary" name="update-subcategory">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>s					
                    </div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

    <?php include('../include/footer.php');?>

	<script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="../scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
            // $('.alert-success').hide();  

		} );
	</script>
</body>