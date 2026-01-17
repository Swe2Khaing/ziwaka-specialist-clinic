<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: dashboard.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <style>
      .wrap-input100 {
  width: 100%;
  position: relative;
  border-bottom: 2px solid #adadad;
  margin-bottom: 20px;
}

.input100 {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: #555555;
  line-height: 1.2;
  display: block;
  width: 100%;
  height: 45px;
  background: transparent;
  padding:0px;
  border: none;
  outline:none;
}

/*---------------------------------------------*/ 
.focus-input100 {
  margin-left:0px;
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
}

.focus-input100::before {
  content: "";
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
 

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;

  background: #6a7dfe;
  background: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  background: -o-linear-gradient(left, #21d4fd, #b721ff);
  background: -moz-linear-gradient(left, #21d4fd, #b721ff);
  background: linear-gradient(left, #21d4fd, #b721ff);
}

.focus-input100::after {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: red;
  line-height: 1.2;

  content: attr(data-placeholder);
  display: block;
  width: 100%;
  position: absolute;
  top: 16px;
  left: 0px;
  padding-left: 0px;
  
  
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input100:focus + .focus-input100::after {
  top: -8px;
}

.input100:focus + .focus-input100::before {
  width: 100%;
}

.has-val.input100 + .focus-input100::after {
  top: -8px;
}

.has-val.input100 + .focus-input100::before {
  width: 100%;
}

/*---------------------------------------------*/

/*---------------------------------------------*/
.btn-show-pass {
  font-size: 15px;
  color: #999999;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  height: 100%;
  top: 0;
  right: 0;
  padding-right: 5px;
  cursor: pointer;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.btn-show-pass:hover {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}

.btn-show-pass.active {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}
      *{
        margin:0px;
        padding: 0px;
      }
      body{
        background-color:#ffffe6;
      }
      .login{
       
        width:300px;
        height:220px;
        margin:5% auto;
        background-color:#ffffe6;
        margin-top:50px;
        margin-bottom:50px;
        padding:20px;
        
      }
      .container{
        background-color:#a3c646;
        width: 50%;
        margin:20px auto;
        height:80vh;
        border-radius:10px;
        opacity: 0.9;
      }
      h1{
        color:black;
        font-size:70px;
        font-weight:900;
      
      }
      .title{
        padding:20px;
        text-align:center;
        width:100%;
        margin:20px auto;
      }
      button{
        color:black;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        
        width: 100%;
        border:0px;
        background-color:  #b7e0ec;
        padding: 3px;
        font-size:20px;
        border-radius:6px 6px;
        
        margin-top:8px;
      
      }
      button:hover{
        background: linear-gradient(#31B7C2,#02b23d);
        color:black;
      }
      .logo{
        padding:10px;
        display: flex;
        justify-content:center;
        margin:0px 40%;
        width:200px;
        height:200px;
        border-radius: 50%;
       
          
        
      }
      input{
        padding:0px;
       
        margin-bottom:-8px; 
      }
      body{
        background-image:url("./img/back11.jpg");
        background-size:cover;
      }
      
     
/********************************** Start @media *************************************************/ 
@media screen and (max-width:1800px){

.container{

  width: 60%;
  margin:20px auto;
  height:90vh;
  border-radius:30px;

  background: linear-gradient(#31B7C2,#02b23d);
}
body{
  background-color:#ffffe6;
  }
}
@media screen and (max-width:1500px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:14px 43%;
  width:160px;
  height:160px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:58px;
  font-weight:1000;
  margin-top:35px;

}
.login{
  
  width:350px;
  height:200px;
  margin:5% auto;
 
  margin-top:20px;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}
}

@media screen and (max-width:1200px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:10px 40%;
  width:150px;
  height:150px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:50px;
  font-weight:1000;
  margin-top:40px;

}
.login{
  
  width:320px;
  height:180px;
  margin:5% auto;
 
  margin-top:20px;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}

}

@media screen and (max-width:992px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:10px 40%;
  width:150px;
  height:150px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:50px;
  font-weight:1000;
  margin-top:40px;

}
.login{
  
  width:320px;
  height:180px;
  margin:5% auto;
 
  margin-top:20px;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}
}

@media screen and (max-width:768px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:10px 38%;
  width:140px;
  height:140px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:40px;
  font-weight:1000;
  margin-top:50px;

}
.login{
  
  width:280px;
  height:180px;
  margin:5% auto;
 
  margin-top:20px;
  margin-left:24%;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}
}

@media screen and (max-width:660px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:10px 37%;
  width:130px;
  height:130px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:40px;
  font-weight:1000;
  margin-top:50px;

}
.login{
  
  width:240px;
  height:180px;
  margin:5% auto;
 
  margin-top:20px;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}

}

@media screen and (max-width:500px){
  .container{
  background-color:#a3c646;
  width: 90%;
  margin:50px auto;
  height:80vh;
  border-radius: 10px;
}
.logo{
  padding:0px;
  display: flex;
  justify-content:center;
  margin:10px 34%;
  width:130px;
  height:130px;
  border-radius: 50%;
  
  
}
h1{
  color:black;
  font-size:40px;
  font-weight:1000;
  margin-top:50px;

}
.login{
  
  width:240px;
  height:180px;
  margin:5% auto;
 
  margin-top:20px;
  padding:10px;

}
button{
  color:black;
  width: 100%;
  border:0px;
  background-color:  #b7e0ec;
  padding: 3px;
  font-size:20px;
  border-radius:6px 6px;
}
.aa{
  font-size:13px;
}
}



/********************************** End @media *************************************************/
.focus-input100 {
  margin-left:0px;
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
  padding:0px;
}

.focus-input100::before {
  content: "";
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
 

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;

  background: #6a7dfe;
  background: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  background: -o-linear-gradient(left, #21d4fd, #b721ff);
  background: -moz-linear-gradient(left, #21d4fd, #b721ff);
  background: linear-gradient(left, #21d4fd, #b721ff);
}

.focus-input100::after {
  font-family: Poppins-Regular;
  font-size: 15px;
  color: red;
  line-height: 1.2;

  content: attr(data-placeholder);
  display: block;
  width: 100%;
  position: absolute;
  top: 16px;
  left: 0px;
  padding-left: 0px;
  
  
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

      
    </style>
  </head>
  <body>
    <div class="container">

  <div class="title">
    <img class="logo" id="logo" src="img/ziwaka33-removebg.png" alt="">
    <h1 >Ziwaka Specialist Clinic</h1>
    </div>

    <div class="login">
      
    <form class="aa" action="" method="post" autocomplete="off">
    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
        <input class="input100" type="text" id="username" name="username" required value="">
        <span class="focus-input100" data-placeholder="Username"></span>
    </div> 

    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
		</div>
    
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    </div>
    </div>
  </body>
  <script>
     /* [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
    });

  </script>
</html>
