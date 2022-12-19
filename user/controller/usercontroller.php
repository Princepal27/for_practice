<?php
    include('../model/usermodel.php');
    $obj = new userportal;

    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
        $emailverification  = $obj->email_verification($email);
        // var_dump($emailverification);
        // die;
        if($emailverification > 0)
        {
            echo "<span style='color:red'> Email already exists .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } 
        else
        {
	        echo "<span style='color:green'> Email available for Registration .</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }

    if(isset($_POST['submit']))
    {
        $name=$_POST['fullname'];
        $email=$_POST['emailid'];
        $contactno=$_POST['contactno'];
        $password=md5($_POST['password']);

        $user = $obj->user_register($name,$email,$contactno,$password);
        if($user != "0")
        {
            // header('location:../login.php');
            echo "<script>
                    window.location = '../login.php';
                    alert('You are successfully register');
                    </script>";
        }
        else
        {
            echo "<script>
            window.location = '../login.php';
            alert('You are something went wrong');
            </script>";
        }
    }

    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $login = $obj->user_login($email,$password);

        if($login > 0)
        {
            session_start();
            $extra="../my-cart.php";
            $_SESSION['login']=$_POST['email'];
            $_SESSION['id']=$login['id'];
            $_SESSION['username']=$login['name'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=1;
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }
        else
        {
            $extra="../login.php";
            $email=$_POST['email'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=0;
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']="Invalid email id or Password";
            exit();
        }
    }

    if(isset($_POST['update']))
	{
		$name = $_POST['name'];
		$contactno = $_POST['contactno'];
        $id = $_POST['id'];
		
        $user_details = $obj->update_user_details($id,$name,$contactno);

        if($user_details != 0)
		{
            echo "<script>
            window.location = '../my-account.php';
            alert('Your info has been updated');
            </script>";
		}
	}

    if(isset($_POST['update_password']))
    {
        $password = md5($_POST['cpass']);
        $new_password = md5($_POST['newpass']);
        $id = $_POST['id'];
        $getpassword = $obj->update_password($id,$password,$new_password);

        if($getpassword != 0)
        {
            echo "<script>
            window.location = '../my-account.php';
            alert('Password Changed Successfully !!');
            </script>";

        }
        else
        {
            echo "<script>
            window.location = '../my-account.php';
            alert('Current Password not match !!');
            </script>";
        }

        
    }
    


?>