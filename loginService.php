<?php
    // Start the session
    session_start();
   	$email="";
	$password="";
    $flag="";
    

    // Set session variables
     
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		# code...
		$email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['pass']);
        $errors = array(); //To store errors
        $response = array(); //Pass back the data to `form.php`

        $conn = mysqli_connect("localhost:8889", "root", "root", "www_project");
        // $conn = db_connect();
        if(!$conn){
            $errors['name'] = "Error in connecting DB";   
            $response['errors']  = $errors;
            echo json_encode($response);
            exit();  
        }            
        
        $query = "SELECT user_id_pk,password FROM user WHERE email = '$email'";
    
        $result = mysqli_query($conn, $query);
        $userData = mysqli_fetch_assoc($result);
        if($userData['user_id_pk']==null){ 
            $errors['name'] = 'User is not registered';
            $response['success'] = false;
            $response['errors']  = $errors;
            echo json_encode($response);
            exit();
        }else{
            // Hash a new password for storing in the database.
            // The function automatically generates a cryptographically safe salt.
            //$hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
            $hashToStoreInDb = hash('sha256', $password);
            //echo password_verify($password, $userData['password']);
             if($hashToStoreInDb != $userData['password']){
                $errors['name'] = 'Password is incorrect';
                $response['success'] = false;
                $response['errors']  = $errors;
                echo json_encode($response);
                exit();
            }
            $_SESSION["email"] =$email;
            $_SESSION["id"]=$userData['user_id_pk'];
            $response['success'] = true;
            echo json_encode($response);
            
        }			
	}
	
?>


