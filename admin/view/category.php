<?php
    include('../model/onlinemodel.php');
	session_start();
    $obj = new portal;
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
								<h3>Category</h3>
							</div>
							
							<div class="module-body">
								<?php if(isset($_SESSION['cat']))
								{
									$cat = $_SESSION['cat'];
									unset($_SESSION['cat']) ;
								?>
                                <div class="alert alert-success ">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong><?php echo $cat?></strong>
								</div>
								<?php } ?>
								<?php if(isset($_SESSION['delmsg']))
								{
									$msg = $_SESSION['delmsg'];
									unset($_SESSION['delmsg']) ;
								
								?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong><?php echo $msg;?></strong>
                                </div>
								<?php }?>
                                <br />
                                <form class="form-horizontal row-fluid" id="category_form" method="post" action="../controller/controller.php">
								    <div class="control-group">
                                        <label class="control-label" for="basicinput">Category Name</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Enter category Name" id="cat_name" name="category" class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
										<label class="control-label" for="basicinput">Description</label>
                                        <div class="controls">
                                            <textarea class="span8" name="description" id="cat_description" rows="5"></textarea>
                                        </div>
									</div>

	                                <div class="control-group">
									    <div class="controls">
                                        <!-- <input type="button" value="Create" class="btn btn-primary" id="create"> -->
										<button class="btn btn-primary" name="create">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>


	                    <div class="module">
							<div class="module-head">
								<h3>Manage Categories</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Category</th>
											<th>Description</th>
											<th>Creation date</th>
											<th>Last Updated</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $counter =1;
                                        foreach($category as $cat)
                                        {

                                        ?>
                                        
										<tr>
											<td><?php echo $counter++;?></td>
											<td><?php echo $cat['category']; ?></td>
											<td><?php echo $cat['description']; ?></td>
											<td><?php echo $cat['creationDate']; ?> </td>
											<td><?php echo $cat['updationDate']; ?></td>
											<td>
											<a href="edit-category.php?id=<?php echo $cat['id'];?>" ><i class="icon-edit"></i></a>
											<a href="../controller/controller.php?id=<?php echo $cat['id'];?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
										
								</table>
							</div>
						</div>						
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

			// $('.alert-error').fadeOut(3000);

            // $('#create').click(function(){
            //     var category_name = $('#cat_name').val();
            //     var description = $('#cat_description').val();
			// 	var count = 0;
			// 	if(category_name == "")
			// 	{
			// 		$('#category-error').show();
            //         $('#category-error').text("Please Enter Category");
            //         $('#category-error').css({"color":"red"});
			// 	}
			// 	else
			// 	{
			// 		count++;
			// 	}

			// 	if(count == 1)
			// 	{
			// 		$.ajax(
			// 		{
			// 			type: "POST",
			// 			url: "../controller/controller.php",
			// 			data: 
			// 			{
			// 				type : "addcategory",
			// 				category_name : category_name,
			// 				description : description
			// 			},

			// 			success:function(data)
			// 			{
			// 				var result = $.parseJSON(data);

			// 				if(result == "success")
			// 				{
			// 					$('.alert-success').show();
			// 					$('.cat-success').show();
			// 					$('.cat-success').text("Category Created");
			// 					$('.cat-success').css({"color":"green"});

			// 				}
			// 			}
			// 		});
			// 		$("#category_form")[0].reset();
			// 	}
            // });
            
		} );
	</script>
</body>