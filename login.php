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
        background-image: url(bootstrap/images/background.jfif);
         /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
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
    </style>
</head>
<body>
<header class="s-header">

    <div class="header-logo">
        <a class="site-logo" href="./">
            <img src="./bootstrap/images/new_logo.jpg" alt="Homepage" style="width: 200px;height: 100px">
        </a>
    </div>
</header>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form id="loginForm" class="form-signin">
            <div id="throw_error" class="alert alert-danger" style="visibility:hidden"></div>
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
                <label for="inputEmail">Password</label>
              </div>
             
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>

              <div class="text-center">
						<span>
							Don’t have an account?
						</span>

						<a href="signup.php">
							Sign Up
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
	    $("#loginForm").submit(function(event){
            $('#throw_error').empty(); //Clear the messages first
            var postForm = { //Fetch form data
                'email'     : $('#email').val(), //Store name fields value
                'password'  : $('#pass').val()
            };
            console.log($('#loginForm').serialize());
            $.ajax({
            type: "POST",
            url: "loginService.php",
            data: $('#loginForm').serialize(),
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
                                    if(!data.admin){
                                        window.open("index.php","_self");
                                    }
                                    else{
                                        window.open("admin_book.php","_self");
                                    }
                                        
                                } 

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