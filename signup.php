<html lang="en">
<head>
	<title>Online Book Store</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <style>
        :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
        }

        body {
        background: green;
        background: linear-gradient(to right,#e9ecef, #dee2e6);
        }

        .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
        }

        .card-signin .card-body {
        padding: 2rem;
        }

        .form-signin {
        width: 100%;
        }

        .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
        }

        .form-label-group {
        position: relative;
        margin-bottom: 1rem;
        }

        .form-label-group input {
        height: auto;
        border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
        color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-moz-placeholder {
        color: transparent;
        }

        .form-label-group input::placeholder {
        color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
        }

        .btn-google {
        color: white;
        background-color: #ea4335;
        }

        .btn-facebook {
        color: white;
        background-color: #3b5998;
        }
        .form-error{
            color:red;
            text-align: center;
        }

        #pswd_info {
            position: absolute;
            bottom: -100px;
            bottom: -115px\9;
            right: 9px;
            width: 350px;
            padding: 15px;
            background: #fefefe;
            font-size: .875em;
            border-radius: 5px;
            box-shadow: 0 1px 3px #ccc;
            border: 1px solid #ddd;
        }

        #pswd_info h4 {
            margin:0 0 10px 0;
            padding:0;
            font-weight:normal;
        }

        #pswd_info::before {
            content: "\25B2";
            position:absolute;
            top:-12px;
            left:45%;
            font-size:14px;
            line-height:14px;
            color:#ddd;
            text-shadow:none;
            display:block;
        }

        .invalid {
            padding-left:22px;
            line-height:24px;
            color:#ec3f41;
        }
        .valid {
            padding-left:22px;
            line-height:24px;
            color:#3a7d34;
        }
        #pswd_info {
            display:none;
        }
    </style>
</head>
<body>
<?php
    require_once "navbar.html";
?>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign Up</h5>
            <form id="signupForm" class="form-signin">
            <div id="throw_error" class="alert alert-danger" style="visibility:hidden"></div>
              <div class="form-label-group">
                <input type="text" id="inputName" class="form-control" name="name" placeholder="Name" maxlength="20" required autofocus>
                <label for="inputName">Name</label>
              </div>
              <div class="form-label-group">
                <input type="text" id="inputCity" class="form-control" name="city" placeholder="City" maxlength="20" required>
                <label for="inputCity">City</label>
              </div>
              <div class="form-label-group">
                <input type="text" id="inputZip" class="form-control" name="zip" placeholder="Zip-Code" maxlength="5" required>
                <label for="inputZip">Zip-Code</label>
              </div>
              <div class="form-label-group">
                <input type="text" id="inputPhone" class="form-control" name="phone" placeholder="Phone" maxlength="10" required>
                <label for="inputPhone">Phone</label>
              </div>
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" maxlength="30" required>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
                <label for="inputPassword">Password</label>
                <p id="passwordError" class="form-error"></p>
              </div>
             
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign Up</button>
              <div class="text-center">
						<span>
							Already have an account?
						</span>

						<a href="login.php">
							Login
						</a>
			  </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script>
    $(document).ready(function(){
        $('#inputPassword').keyup(function() {
            var pswd = $(this).val();
            if ( pswd.length < 8 ||  !pswd.match(/[A-z]/) || !pswd.match(/[A-Z]/) || !pswd.match(/\d/)) {
                $('#passwordError').html("Password must contain at least <strong>one letter</strong>, at least <strong>one capital letter</strong>, at least <strong>one number</strong>, and should be at least <strong>8 characters");
            }else{
                $('#passwordError').empty();
            }
        });
	    $("#signupForm").submit(function(event){    
            $('#throw_error').empty(); //Clear the messages first
            $('#passwordError').empty();
            var $error = false;
            var $pswd = $('#inputPassword').val();
            if ( $pswd.length < 8 ||  !$pswd.match(/[A-z]/) || !$pswd.match(/[A-Z]/) || !$pswd.match(/\d/)){
                $error=true;
                $('#passwordError').html("Password must contain at least <strong>one letter</strong>, at least <strong>one capital letter</strong>, at least <strong>one number</strong>, and should be at least <strong>8 characters");
            } 
            console.log($error);
            if(!$error){
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
            }
                              
            event.preventDefault();
        });
    });   
    </script>
</body>
</html>