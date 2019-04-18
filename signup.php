<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="bootstrap/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="bootstrap/loginvendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/loginutil.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/login.css">
<!--===============================================================================================-->

<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form name="signupForm" id="signupForm" class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
                    <div id="throw_error" class="alert alert-danger" style="visibility:hidden">
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="name">
						<span class="focus-input100" data-placeholder="Name"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="city">
						<span class="focus-input100" data-placeholder="city"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="zip">
						<span class="focus-input100" data-placeholder="Zip-Code"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="phone">
						<span class="focus-input100" data-placeholder="Phone"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Signup
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Have an account?
						</span>

						<a class="txt2" href="login.php">
							Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

    <script>
    $(document).ready(function(){
	    $("#signupForm").submit(function(event){
            $('#throw_error').empty(); //Clear the messages first
            
            console.log($('#signupForm').serialize());
            $.ajax({
            type: "POST",
            url: "signupService.php",
            data: $('#signupForm').serialize(),
            datatype: 'json',
            success   : function(response) {
                            var data = JSON.parse(response);
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('#throw_error').css("visibility","visible");
                                    $('#throw_error').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                    $('#pass').val = "";
                                }
                            }
                            else {
                                    window.open("index.php","_self");
                                } 
                            // console.log(response);
                            // alert(response);
                            },
            error : function(){
                alert("Error");
            }
        });
        event.preventDefault();
    });
    });
       
    </script>
</body>
</html>