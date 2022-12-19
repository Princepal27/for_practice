<?php
// include('bean.php');
class portal
{
    var $con;
    public function __construct()
	{
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "onlineportal";

        $this->con = new mysqli($servername, $username, $password, $dbname);

        if ($this->con->connect_error)
        {
            die("Connection failed: " . $this->con->connect_error);
        } 

	}

    public function admin_lognin($username,$password)
    {
        $query=mysqli_query($this->con,"SELECT * from admin where username = '$username' and a_password = '$password' ");
        $result = mysqli_fetch_array($query);

        if ($result>0) 
        {
            $this->com=$result;
            return $this->com;
        }
        else
        {
            $this->com=$result;
            return $this->com;

        }    
    }

    public function add_category($category_name,$description)
    {
        $query = mysqli_query($this->con,"INSERT into category (category,description) values ('$category_name','$description')");
        if($query>0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function fetch_category()
    {
        $query = mysqli_query($this->con,"SELECT * from category");
        return $query;

        // $array = [];

        // if(mysqli_num_rows($query)>0)
        // {
            
        //     while($row = mysqli_fetch_array($query))
        //     {
                    
        //             $obj = new category;
        //             $obj->cat_id=$row['id'];  
        //             $obj->category=$row['category'];
        //             $obj->description=$row['description'];
        //             $obj->creationDate=$row['creationDate'];
        //             $obj->updationDate=$row['updationDate'];
                    
        //             $array[]=$obj;
        //     }

        // }
        // return $array;
    }

    public function category_by_id($id)
    {
        $query = mysqli_query($this->con,"SELECT * FROM category where id = '$id'");
        $result = mysqli_fetch_array($query);
            return $result;
       
    }

    public function update_category($category,$description,$id)
    {
        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $date=date('Y-m-d H:i:s');
        $query = mysqli_query($this->con,"UPDATE category SET category = '$category',description = '$description', updationDate='$date' WHERE id='$id'");

        if($query>0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function delete_category($id)
    {
        $query = mysqli_query($this->con,"DELETE from category where id='$id'");

        if($query > 0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function add_subcategory($category,$subcategory)
    {
        $query = mysqli_query($this->con,"INSERT into subcategory (categoryid,subcategory) VALUES ('$category','$subcategory')");

        if($query>0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function fetch_subcategory()
    {
        $query = mysqli_query($this->con,"select category.id,category.category,subcategory.* from subcategory join category on category.id=subcategory.categoryid");
        return $query;
    }

    public function get_subcategory_by_id($id)
    {
        $query = mysqli_query($this->con,"select category.id as categoryid,category.category,subcategory.* from subcategory join category on category.id=subcategory.categoryid where subcategory.id='$id'");
        $result = mysqli_fetch_array($query);
        return $result;
    }

    public function update_subcategory($category,$subcategory,$id)
    {
        date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
        $date=date('Y-m-d H:i:s');
        $query = mysqli_query($this->con,"UPDATE subcategory SET categoryid = '$category', subcategory = '$subcategory', updationDate = '$date' where id = '$id'");
        

        if($query > 0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function delete_subcategory($id)
    {
        $query = mysqli_query($this->con,"DELETE from subcategory where id='$id'");

        if($query > 0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function product_id()
    {
        $query = mysqli_query($this->con,"Select max(id) as pid from products");
        $result = mysqli_fetch_array($query);
        return $result;
    }

    
    public function product($category,$subcat,$productname,$productcompany,$productprice,$productpricebd,$productdescription,$productscharge,$productavailability,$productimage1,$productimage2,$productimage3)
    {
        $query=mysqli_query($this->con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");

        if($query > 0)
        {
            $this->com = "1";
            return $this->com;
        }
        else
        {
            $this->com = "0";
            return $this->com;
        }
    }

    public function fetch_product()
    {
        $query = mysqli_query($this->con,"SELECT products.*,category.category as category_name,subcategory.subcategory as subcategory_name from products join category on products.category = category.id join subcategory on products.subcategory = subcategory.id ");
        
        return $query;
    }

    


}





?>