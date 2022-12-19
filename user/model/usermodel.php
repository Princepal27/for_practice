<?php

    class userportal
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

        public function user_register($name,$email,$contactno,$password)
        {
            $query = mysqli_query($this->con,"INSERT into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
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
        
        public function email_verification($email)
        {
            $query = mysqli_query($this->con,"SELECT email from users where email = '$email'");
            $count=mysqli_num_rows($query);
            return $count;
        }

        public function user_login($email,$password)
        {
            $query = mysqli_query($this->con,"SELECT * from users where email = '$email' and password = '$password'");
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

        public function fetch_user_by_id($id)
        {
            $query = mysqli_query($this->con,"SELECT * from users where id = '$id'");
            $result = mysqli_fetch_array($query);
            return $result;
        }

        public function fetch_category()
        {
            $query = mysqli_query($this->con,"SELECT * from category");
            return $query;
        }

        public function fetch_products()
        {
            $query = mysqli_query($this->con,"SELECT * from products");
            return $query;
        }

        public function fetch_products_by_id($id)
        {
            $query = mysqli_query($this->con,"SELECT products.*,category.category as category_name,category.id as cid, subcategory.subcategory as subcategory_name, subcategory.id as subcid from products join category on products.category = category.id join subcategory on products.subcategory = subcategory.id where products.id = '$id'");
            $result = mysqli_fetch_array($query);
            return $query;
        }

        public function fetch_random_products()
        {
            $query = mysqli_query($this->con,"SELECT * from products order by rand() limit 4");
            return $query;
        }

        public function fetch_products_by_category_id($cid,$subcid)
        {
            $query = mysqli_query($this->con,"select * from products where subCategory='$subcid' and category='$cid'");
            // $result = mysqli_fetch_array($query);
            return $query;

        }

        public function update_user_details($id,$name,$contactno)
        {
            $query=mysqli_query($this->con,"update users set name ='$name',contactno ='$contactno' where id='$id'");
            
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

        public function update_password($id,$password,$new_password)
        {
            date_default_timezone_set('Asia/Kolkata');// change according timezone
            $currentTime = date( 'd-m-Y h:i:s A', time () );
            $query =mysqli_query($this->con,"SELECT password from users where password = '$password' and id = '$id'");

            $result = mysqli_fetch_array($query);
            if($result > 0)
            {
                $querys = mysqli_query($this->con,"UPDATE users set password = '$new_password', updationDate='$currentTime' where id='$id' ");
                
            }
            return $querys;

            
        }
    } 
?>
