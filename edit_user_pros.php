<?php 
require_once('req/database.php');
$id = $_GET['id'];
		if(isset($_POST['submit'])){
            
                $fname = $_POST['fname'];
                $mname = $_POST['mname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $uname = $_POST['uname'];
                $password = $_POST['password'];
                $utype = $_POST['type'];
                if($utype == "Administrator"){
                    $type = 1;
                }elseif($utype == "Staff"){
                    $type = 2;
                }
                
                $prof_pic = $conn->real_escape_string('images/'.$_FILES['img']['name']);
                    if(preg_match("!image!", $_FILES['img']['type'])){
                        if(move_uploaded_file($_FILES['img']['tmp_name'], $prof_pic)){
                        $query = "UPDATE `users` SET `firstname` = '$fname', `middlename` = '$mname', `lastname` = '$lname', `email` = '$email', `username` = '$uname', `password` = '$password', `avatar` = '$prof_pic', `type` = '$type' WHERE `id` = '$id'";
                       // print_r($_POST);
                     //  exit();
                        $result = $conn->query($query);
                        if($result) {
                            $_SESSION['message'] = "Record Registered Successfully!";
                            header('Location: users.php');
                            exit();
                        }else{
                            $_SESSION['message'] = "Unable to Register Record!";
                            header('Location: users.php');
                            exit();
                        }
				}
			
		}
    }
?>