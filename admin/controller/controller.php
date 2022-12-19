<?php
include('../model/onlinemodel.php');
session_start();
$obj = new portal;

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $login=$obj->admin_lognin($username,$password);
        

        if($login != 0)
        {
           header("location:../view/dashboard.php");	
        }
       else
        {
           header("location:../index.php");
           	
        }
    }

    if(isset($_POST['create']))
    {
        $category_name = $_POST['category'];
        $description = $_POST['description'];

        $result = $obj->add_category($category_name,$description);
       
        
        if($result == "1")
        {
            $_SESSION['cat']="Category Created";
            header("location:../view/category.php");
            
            	
        }
        else
        {
            
        }
        echo json_encode($status);
        exit;
    }

    if(isset($_POST['update']))
    {
        $category = $_POST['category'];
        $description = $_POST['description'];

        $id =  $_POST['id'];

        $update = $obj->update_category($category,$description,$id);

        if($update != 0)
        {
            $_SESSION['cat-update']="Category Update";
            header("location:../view/category.php");
        }
        else
        {
            
        }
    }

    if(isset($_POST['subcategory']))
    {
        $category = $_POST['category'];
        $subcategory = $_POST['sub-category'];

        $insert = $obj->add_subcategory($category,$subcategory);

        if($insert != 0)
        {
            $_SESSION['subcat']="Sub-Category Created";
            header("location:../view/subcategory.php");
        }
        else
        {
            $_SESSION['subcat']="Sub-Category Error";
            header("location:../view/subcategory.php");
        }
    }
    if(isset($_POST['update-subcategory']))
    {
        $category = $_POST['category'];
        $subcategory = $_POST['sub-category'];

        $id =  $_POST['id'];

        

        $updatesubcat = $obj->update_subcategory($category,$subcategory,$id);

        if($updatesubcat != 0)
        {
            header("location:../view/subcategory.php");
        }
        else
        {
            
        }
    }

    if(isset($_GET['del']))
    {
        $id = $_GET['id'];
		$del = $obj->delete_category($id);
        if($del != 0)
        {   
            $_SESSION['delmsg']="Category deleted";
            header("location:../view/category.php");
            
        }
    }

    if(isset($_GET['subcategorydel']))
    {
        $id = $_GET['id'];
		$del = $obj->delete_subcategory($id);
        if($del != 0)
        {   
            $_SESSION['delsubmsg']="Sub-Category deleted";
            header("location:../view/subcategory.php");
            
        }
    }

    if(isset($_POST['insertproduct']))
    {
       
        $category=$_POST['category'];
	    $subcat=$_POST['subcategory'];
	    $productname=$_POST['productName'];
	    $productcompany=$_POST['productCompany'];
	    $productprice=$_POST['productprice'];
	    $productpricebd=$_POST['productpricebd'];
	    $productdescription=$_POST['productDescription'];
	    $productscharge=$_POST['productShippingcharge'];
	    $productavailability=$_POST['productAvailability'];
	    $productimage1=$_FILES["productimage1"]["name"];
	    $productimage2=$_FILES["productimage2"]["name"];
	    $productimage3=$_FILES["productimage3"]["name"];

        
        $pid = $obj->product_id();
        // $result=mysqli_fetch_array($query);
        
	    $productid=$pid['pid']+1;
	    $dir="../productimages/$productid";
        
        if(!is_dir($dir))
        {
		    mkdir("../productimages/".$productid);
	    }

	    move_uploaded_file($_FILES["productimage1"]["tmp_name"],"../productimages/$productid/".$_FILES["productimage1"]["name"]);
	    move_uploaded_file($_FILES["productimage2"]["tmp_name"],"../productimages/$productid/".$_FILES["productimage2"]["name"]);
	    move_uploaded_file($_FILES["productimage3"]["tmp_name"],"../productimages/$productid/".$_FILES["productimage3"]["name"]);

        $insetproduct = $obj->product($category,$subcat,$productname,$productcompany,$productprice,$productpricebd,$productdescription,$productscharge,$productavailability,$productimage1,$productimage2,$productimage3);
        
        if($insetproduct != 0)
        {
            header("location:../view/insert-product.php");
        }
        else
        {
            print_r($insetproduct);
            die;
        }
    }

	
?>