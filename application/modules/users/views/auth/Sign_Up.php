?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>

  <?= link_tag("public/assets/css/bootstrap.min.css") ?>
  <?= link_tag("public/assets/css/sign_up.css") ?>
  <?= link_tag("public/assets/css/animate.css") ?>

  <style type="text/css" media="screen">
    .custm_btn
    {
      padding: 3px 3px;
      font-size: 11px;
      color: black;
    }
    .noty-color
    {
      background-color:red;
      border: 0px;
      color: white;

    }
    .success-noty
    {
      background-color: #2d862d;
      color: white;
    }
    .error
    {
      color: red;
    }
  </style>

</head>
<body>

<link href='http://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>

<div class="container">
  <div class="row login_box">
      <div class="col-lg-12 col-md-12 col-sm-12" align="center">
            <!-- <div><h3>Sign Up</h3></div> -->
            <!-- <div class="outter">
               <img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="image-circle"/>
            </div>  -->  
            <h1>Sign Up</h1>
      </div>
        <?php echo validation_errors(); ?>
        <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 login_control">
                
          <?= form_open('users/Register/sign_up',array('id'=>'myform')); ?> 

          <div class="control">
            <div for="first_name" class="label">First Name</div>
            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Code" required/>
          </div>

          <div class="control">
            <div for="last_name" class="label">Last Name</div>
            <input type="text" id="last_name" name="last_name" class="form-control" value="<?= set_value('last_name'); ?>" placeholder="Master" required/>
          </div>

          <div  class="control">
            <div for="username" class="label">User Name</div>
            <input type="text" id="username" name="username" value="<?= set_value('username'); ?>" class="form-control"  placeholder="Code Master" required/>
            <div id="username_message" style="color: red;font-weight: bold;"> </div>
          </div>

          <div class="control">
            <div for="email" class="label">Email Address</div>
            <input type="email" id="email" name="email" class="form-control" value="<?= set_value('email'); ?>" placeholder="Example@gmail.com" required/>
            <div id="user_mail" style="color: red;font-weight: bold;"></div>
          </div>
                
          <div class="control">
            <div for="password" class="label">Password</div>
            <input type="password" id="password" name="password" minlength="8" class="form-control" placeholder="***********" required/>
          </div>

          <div class="control">
              <div for="confirm_password" class="label">Confirm Password</div>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="***********" required/>
          </div>

          <div class="control">
              <div for="confirm_password" class="label col-xs-offset-3 col-md-offset-3">
                <div class="g-recaptcha" data-sitekey="6LfaLzIUAAAAAHpYFZW__WFypmev0w8rgz7AtPBN"
                  data-callback="YourOnSubmitFn"></div>
              </div>
              <!-- <div for="confirm_password" class="label col-xs-offset-3 col-md-offset-3"><?php echo $image  ?></div> -->
              <!-- <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Submit the word you see in image" required/> -->
          </div>

          <div align="center">
            
            <button class="btn btn-orange">Sign Up</button> 
          </div>
        </div>
        <?= form_close(); ?>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
  <!-- Include all compiled plugins (below), or include individual files as needed -->    
  <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>

  <script src="<?= base_url('public/assets/js/bootstrap-notify.js') ?>"></script>

  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

  <script src='https://www.google.com/recaptcha/api.js'></script>

  <script>
    $("#myform").validate({
      rules: {
        password: "required",
        confirm_password: {
          equalTo: "#password"
        },
        captcha: {
          "required": true
        }
      },
      messages:
      {
        captcha: {
            "required": "Please enter the verifcation code.",
          }
      }
  });
  </script>

  <script>
    $(document).ready(function() {

       //This script is to check email validity
       $("#email").change(function() 
       {

          var email    = $("#email").val();

          $.ajax({
            url: '<?= base_url("users/Register/check_email") ?>',
            method: 'POST',
            dataType: 'TEXT',
            data: {myemail: email},
            success: function(result) 
            {
              var msg = result.split("::");

              if (msg[0] == "ok")
              {
                $("#user_mail").fadeIn();
                $("#user_mail").text("This Email Is Already Registered Please Try With Another.");
              }  
              else
              {
                $("#user_mail").fadeIn();
                $("#user_mail").html("<span class='glyphicon glyphicon-ok text-success'>Success</span>");
                $("#user_mail").delay(3000).fadeOut();
              }
            },
            error:function(result) 
            {
              // body...
              console.log(result);
            }
          })
       });

       //This script is to check Username validity
      $("#username").change(function() 
       {

          var username = $("#username").val();

          $.ajax({
            url: '<?= base_url("users/Register/check_username") ?>',
            method: 'POST',
            dataType: 'HTML',
            data: {u_name: username},
            success: function(result) 
            {
              var msg = result.split("::");

              if (msg[0] == "ok")
              {
                $("#username_message").fadeIn();
                $("#username_message").html('This User name Is Already Registered Please Try With Another.');
              }
              else
              {
                $("#username_message").fadeIn();
                $("#username_message").html("<span class='glyphicon glyphicon-ok text-success'>Success</span>");
                $("#username_message").delay(3000).fadeOut();
              }
            },
            error:function(result) 
            {
              // body...
              console.log(result);
            }
          })
       });
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
          
          
          type: "success success-noty col-sm-3",
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
              type: "danger noty-color col-sm-3",
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
  <!-- Notification Script -->
  <script>
  <?php
      if (!empty($message))
       {
  ?>
     $.notify({
              
              icon: 'glyphicon glyphicon-info-sign',
              title: '<b>Notification</b><br>',
              message: '<?php echo $message ?>',
          },{
              
              
              type: "danger noty-color col-sm-3",
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

  </body>
</html>