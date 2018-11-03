<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- <link rel="stylesheet" type="text/css" href="<?php bs() ?>assets/css/tyle.css"> -->
      <style>
         .form-gap 
         {
         padding-top: 150px;
         }
         .btn-custom
         {
         background: linear-gradient(to bottom right, #1EBBD4, #34D2C4);
         color: white;
         border-radius: 0px;
         }
         .btn-custom:hover{
         color: white;
         }
         .form-control {
         display: block;
         width: 100%;
         height: 50px;
         padding: 6px 12px;
         font-size: 17px;
         line-height: 1.42857143;
         color: #555;
         background-color: #fff;
         background-image: none;
         border: 1px solid #ccc;
         border-radius: 0px;
         -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
         box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
         -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
         -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
         transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
         background:rgba(255,255,255,0.5);
         }
         .input-group-addon{
         border-radius: 0px;
         background-color: white;
         }
         .error
         {
         color: red;
         }
      </style>
   </head>
   <body style="background-image: url(<?php bs() ?>public/assets/img/two_factor_auth.jpg);background-size: 100%">
      <div class="container-fluid">
         <nav class="navbar navbar-inverse" style="">
            <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#"><img src="<?php bs() ?>public/assets/img/login.png" alt="" width="100"></a>
               </div>
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                     <li><a href="<?php bs() ?>users/Auth/Logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                  </ul>
               </div>
               <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
         </nav>
         <!-- Collect the nav links, forms, and other content for toggling -->
      </div>
      <!-- /.container-fluid -->
      <div class="form-gap"></div>
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <?php if (!empty($this->session->flashdata('error'))): ?>
               <div class="alert alert-danger" style="background-color:#ab2e2b;color :white;border:0px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="glyphicon glyphicon-bell"></i> <?php echo $this->session->flashdata('error'); ?>
               </div>
               <?php endif ?>  
               <?php if (!empty($this->session->flashdata('success'))): ?>
               <div class="alert alert-danger" style="background-color:#23bb07;color :white;border:0px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-bell" aria-hidden="true"></i> <?php echo $this->session->flashdata('success'); ?>
               </div>
               <?php endif ?> 
               <div class="panel panel-default" style="background:rgba(255,255,255,0.5);">
                  <div class="panel-body">
                     <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Two Factor Authentication</h2>
                        <p>Please Enter Verification Code.</p>
                        <div class="panel-body">
                           <form id="verify_form" action="<?php bs() ?>users/Auth/authentication" role="form" autocomplete="off" class="form" method="post">
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk color-blue"></i></span>
                                    <input name="code" placeholder="Plese Enter 6 digits Code" class="form-control" type="number" required>
                                 </div>
                              </div>
                              <?php echo form_error('code','<div class="error">', '</div>'); ?><br>
                              <div class="form-group">
                                 <input name="recover-submit" class="btn btn-lg btn-custom btn-block" value="Submit" type="submit">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js'></script>
      <script>
         // code verification form validation
         $("#verify_form").validate();
      </script>
   </body>
</html>