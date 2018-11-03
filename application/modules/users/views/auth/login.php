<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Login</title>
      <!-- Bootstrap -->
      <link href="<?php bs() ?>public/assets/css/bootstrap.css" rel="stylesheet">
      <link href="<?php bs() ?>public/assets/css/mystyle.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,400,900" rel="stylesheet">
      <?= link_tag("public/assets/css/animate.css") ?>
      <style>
         .nav > li > a:hover,
         .nav > li > a:focus {
         text-decoration: none;
         background-color: black;
         }
         .label
         {
         font-family: 'Raleway', sans-serif;
         color: white;
         font-size: 15px;
         }
      </style>
   </head>
   <body class="bg-img">
      <div class="container">
         <nav class="navbar">
            <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar" style="background-color: white;"></span>
                  <span class="icon-bar" style="background-color: white;"></span>
                  <span class="icon-bar" style="background-color: white;"></span>
                  </button>
                  <a class="navbar-brand" href="#">
                  <img src="<?php bs() ?>public/assets/img/login.png" width="100" alt="">
                  </a>
               </div>
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                     <?php 
                        if ($reg_status[0]->registration_status == 1): 
                        ?>
                     <li>
                        <a href="<?= base_url('users/Register') ?>">
                           <button id="login_register_btn" type="button" class="btn btn-link">
                              <h5><font color="white"><b>Register</b></font></h5>
                           </button>
                        </a>
                     </li>
                     <?php else: ?>
                     <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        User Registration is disable by Admin.
                     </div>
                     <?php endif; ?>       
                  </ul>
               </div>
               <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
         </nav>
         <div class="login-box">
            <div class="login-header">
               <h3 class="text-center" style="font-family: 'Raleway', Black; "><font color="white"><b>ADMIN DASHBOARD</b></font></h3>
            </div>
            <div class="row">
               <div class="col-sm-11 col-xs-11">
                  <form action="<?= base_url('users/auth/login') ?>" method="post" class="form-horizontal" id="login_form">
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label label">
                        E-mail Address
                        </label>
                        <div class="col-sm-9">
                           <input type="email" name="identity" id="identity" class="form-control" placeholder="Email" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label label">Password</label>
                        <div class="col-sm-9">
                           <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                           <input type="checkbox" name="remember" value="1" id="remember" />
                           <font color="white"> Remember me </font>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10 buttons">
                           <button type="submit" class="btn btn-xs btn-login"><i class="fa fa-sign-in"></i> Login</button>
                           &nbsp;&nbsp;<!-- <span><font color="white">Forget Password ?</font></span> -->
                           <?php if ($reg_status[0]->forgot_pass_status == 1): ?>
                           <a href="<?= base_url('users/Auth/forgot_password') ?>" title="">
                           <button id="login_lost_btn" type="button" class="btn btn-link">Forgot Password?</button>
                           </a>
                           <?php endif ?>
                        </div>
                     </div>
                  </form>
               </div>
               <?php if ($reg_status[0]->socail_login_status == 1): ?>
               <div class="row">
                  <div class="col-sm-11 col-xs-12 col-sm-offset-2" style="padding-left: 8%">
                     <a href="<?= $fbUrl ?>">
                     <img src="<?php bs('public/assets/img/facebook-icon.png') ?>" rel="tooltip" title="" class="social-img animated flip" alt="">
                     </a>  
                     <a href="<?= $oauthURL ?>">
                     <img src="<?php bs('public/assets/img/twitter-icon.png') ?>" rel="tooltip" title="" class="social-img animated flip" alt="">
                     </a>  
                     <a href="<?= $authUrl ?>">
                     <img src="<?php bs('public/assets/img/google-icon.png') ?>" rel="tooltip" title="" class="social-img animated flip" alt="">
                     </a>  
                     <a href="https://api.instagram.com/oauth/authorize/?client_id=cc0c6e3ffad5457eb811cf3bd99f0524&redirect_uri=http://localhost/login/users/Social_login/instagram_login&response_type=code&scope=public_content">
                     <img src="<?php bs('public/assets/img/instagram-icon.png') ?>" rel="tooltip" title="" class="social-img animated flip" alt="">
                     </a> 
                     <a href="<?php echo "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&state={$csrf_token}&scope={$scopes}"; ?>">
                     <img src="<?php bs('public/assets/img/linkedin-icon.png') ?>" rel="tooltip" title="" class="social-img animated flip" alt="">
                     </a>    
                  </div>
               </div>
               <?php endif ?>
            </div>
         </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="<?php bs() ?>public/assets/js/bootstrap.min.js"></script>
   </body>
</html>
<script src="<?= base_url('public/assets/js/bootstrap-notify.js') ?>"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script>
   $("#login_form").validate();
</script>
<script>
   $(document).ready(function(){
     $("[rel=tooltip]").tooltip({ placement: 'top'});
   });
</script>
<!-- Notification Script -->
<script>
   <?php
      $success = $this->session->flashdata('success');
      $error   = $this->session->flashdata('error');
      if (!empty($success))
       {
      ?>
    $.notify({
         
         icon: 'glyphicon glyphicon-info-sign',
         title: '<b>Notification</b><br>',
         message: '<?php echo $success ?>',
     },
     {
         
         
         type: "success success-noty col-md-3",
         allow_dismiss: true,
         placement: {
             from: "top",
             align: "center"
         },
         offset: 20,
         spacing: 10,
         z_index: 1431,
         delay: 5000,
         timer: 1000,
         animate: {
             enter: 'animated bounceInDown',
             exit: 'animated bounceOutUp'
         }
     });
   <?php
      } 
      if (!empty($error))
       {
      ?>
    $.notify({
             
             icon: 'glyphicon glyphicon-info-sign',
             title: '<b>Notification</b><br>',
             message: '<?php echo $error ?>',
         },{
             
             
             type: "danger noty-color col-md-3",
             allow_dismiss: true,
             placement: {
                 from: "top",
                 align: "right"
             },
             offset: 20,
             spacing: 10,
             z_index: 1431,
             delay: 5000,
             timer: 1000,
             animate: {
                 enter: 'animated fadeInDown',
                 exit: 'animated fadeOutUp'
             }
         });
    <?php            
      }
      ?>
   
</script>  
<script>
   <?php
      if (!empty($message))
        {
      ?>
    $.notify({
         
         icon: 'glyphicon glyphicon-info-sign',
         title: '<b>Notification</b><br>',
         message: '<?php echo $message;?>',
     },
     {
         
         type: "success success-noty col-md-3 col-md-offset-2",
         allow_dismiss: true,
         placement: {
             from: "top",
             align: "center"
         },
         offset: 20,
         spacing: 10,
         z_index: 1431,
         delay: 5000,
         timer: 1000,
         animate: {
             enter: 'animated bounceInDown',
             exit: 'animated bounceOutUp'
         }
     });
   <?php
      }
      ?> 
</script> 
<script>
   <?php  
      if (!empty($_GET['err_msg']))  
      {
      ?> 
      $.notify({
      title: '<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Error!</strong>',
      message: '<?php echo $_GET['err_msg'] ?>'
      },{
        type: 'danger alert-danger-alt col-md-3'
      });
     <?php 
      } 
       elseif (!empty($_GET['success_msg']))  
      {
       ?>
   
      $.notify({
      title: '<strong> <span class= "glyphicon glyphicon-ok"></span> Success!</strong>',
      message: '<?php echo $_GET['success_msg'] ?>'
      },{
        type: 'success alert-success-alt col-md-3'
      });
   
    <?php    
      }    
      ?>  
   
</script>

