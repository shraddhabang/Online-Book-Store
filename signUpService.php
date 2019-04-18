<?php
    // Start the session
    session_start();
   	$email="";
	$password="";
    $name="";
    $city="";
    $phone="";
    $zip="";
    

    // Set session variables
     
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		# code...
		$email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['pass']);
        $name=htmlspecialchars($_POST['name']);
        $city=htmlspecialchars($_POST['city']);
        $zip=htmlspecialchars($_POST['zip']);
        $phone=htmlspecialchars($_POST['phone']);
        $errors = array(); //To store errors
        $response = array(); //Pass back the data to `form.php`
        
        require_once "functions/database_functions.php";
        $conn = db_connect();
        //$conn = mysqli_connect("localhost:8889", "root", "root", "www_project");
        // $conn = db_connect();
        if(!$conn){
            $errors['name'] = "Error in connecting DB";   
            $response['errors']  = $errors;
            echo json_encode($response);
            exit();  
        }   
        
        $query = "SELECT user_id_pk FROM user WHERE email = '$email'";
    
        $result = mysqli_query($conn, $query);
        $userData = mysqli_fetch_assoc($result);
        if($userData['user_id_pk']!=null){ 
            $errors['name'] = 'User is already registered';
            $response['success'] = false;
            $response['errors']  = $errors;
            echo json_encode($response);
            exit();
        }


        $hashPwd = hash('sha256', $password);
        $query = "INSERT INTO user (user_id_pk, name, password, email, phone, city, zip, role) 
                  VALUES (NULL, '$name', '$hashPwd', '$email', '$phone', '$city', '$zip', 'user');";
    
        // echo $query;
        $result = mysqli_query($conn, $query);
        $userData = mysqli_fetch_assoc($result);
        //echo "UserData: ".$userData;
        if($result == NULL ){ 
            $errors['name'] = 'Error in creating user';
            $response['success'] = false;
            $response['errors']  = $errors;
            echo json_encode($response);
            exit();
        }else{
            $_SESSION["email"] =$email;
            $query = "SELECT user_id_pk FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            $userData = mysqli_fetch_assoc($result);
            $_SESSION["id"]=$userData['user_id_pk'];
            $response['success'] = true;
            echo json_encode($response);   
        }			
	}
	
?>


