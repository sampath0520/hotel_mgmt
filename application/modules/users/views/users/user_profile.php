<div class="static-content-wrapper">
<div class="static-content">
   <div class="page-content">
      <ol class="breadcrumb">
         <li><a href="index.html">Home</a></li>
         <li class="active"><a href="#">Profile</a></li>
      </ol>
      <div class="container-fluid">
         <div data-widget-group="group1">
            <div class="row">
               <div class="col-sm-3">
                  <div class="panel panel-profile">
                     <div class="panel-body">
                        <img src="<?php bs() ?>uploads/<?php echo $user_profile->user_img ?>" class="img-circle" width="200" alt="">
                        <?php 
                           $user = $this->ion_auth->user()->row();
                         ?>
                        <div class="name"><?php echo $user->username; ?></div>
                        <div class="info"><?php echo $user->email ?></div>
                        <ul class="list-inline text-center">
                           <li><a href="#" class="profile-facebook-icon"><i class="ti ti-facebook"></i></a></li>
                           <li><a href="#" class="profile-twitter-icon"><i class="ti ti-twitter"></i></a></li>
                           <li><a href="#" class="profile-dribbble-icon"><i class="ti ti-dribbble"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- panel -->
                  <div class="list-group list-group-alternate mb-n nav nav-tabs">
                     <a href="#tab-about" 	role="tab" data-toggle="tab" class="list-group-item active">
                     <i class="ti ti-user"></i> About <span class="badge badge-primary">80%</span></a>
                     <a href="#change_pic" role="tab" data-toggle="tab" class="list-group-item">
                     <i class="ti ti-exchange-vertical"></i> Change Profile Avatar</a>
                     <a href="#chang_pass" role="tab" data-toggle="tab" class="list-group-item">
                     <i class="ti ti-unlock"></i> Change Password</a>
                     <a href="#tab-edit" role="tab" data-toggle="tab" class="list-group-item">
                     <i class="ti ti-pencil"></i> Edit</a>
                  </div>
               </div>
               <!-- col-sm-3 -->
               <div class="col-sm-9">
                  <div class="tab-content">
                     <div class="tab-pane" id="chang_pass">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h2>Change Password</h2>
                           </div>
                           <div class="panel-body">
                              <div class="table-responsive">
                                 <div class="row">
                                    <div class="col-md-5">
                                       <?php echo form_open("users/auth/change_password",array("id"=>"change_pass"));?>
                                       <div class="form-group">
                                          <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                                          <?php echo form_input($old_password);?>
                                       </div>
                                       <div class="form-group">
                                          <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                                          <?php echo form_input($new_password);?>
                                       </div>
                                       <div class="form-group">
                                          <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                                          <?php echo form_input($new_password_confirm);?>
                                       </div>
                                       <?php echo form_input($user_id);?>
                                       <?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-toolbar"');?>
                                       <?php echo form_close();?>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.table-responsive -->
                           </div>
                           <!-- /.panel-body -->
                        </div>
                     </div>
                     <!-- #tab-projects -->
                     <div class="tab-pane active" id="tab-about">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h2>About</h2>
                           </div>
                           <div class="panel-body">
                              <div class="about-area">
                                 <h4>Personal Information</h4>
                                 <div class="table-responsive">
                                    <table class="table about-table">
                                       <tbody>
                                          <tr>
                                             <th>Full Name</th>
                                             <td><?php echo $user_profile->first_name." ".$user_profile->last_name ?></td>
                                          </tr>
                                          <tr>
                                             <th>Country</th>
                                             <td>
                                                <?php 
                                                   //ipinfo grabs the ip of the person requesting
                                                   
                                                    $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
                                                   
                                                    $country_code = $getloc->country; //to get city
                                                   
                                                    echo $country_name = get_country_name($country_code);
                                                   ?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th>Last Login</th>
                                             <td>
                                                <?php 
                                                   $datestring = '%D-%d-%y at <i class="fa fa-clock-o"></i> %h:%i %a';
                                                   $time = $user_profile->last_login;
                                                   echo mdate($datestring, $time);
                                                   ?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <th>Email</th>
                                             <td><?php echo $user_profile->email ?></td>
                                          </tr>
                                          <tr>
                                             <th>Mobile</th>
                                             <td><?php echo $user_profile->phone ?></td>
                                          </tr>
                                          <tr>
                                             <th>Created Date</th>
                                             <td><?php echo $user_profile->date ?></td>
                                          </tr>
                                          <tr>
                                             <th>Mobile No</th>
                                             <td><?php echo $user_profile->phone ?></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="change_pic">
                        <div class="panel">
                           <div class="panel-heading">
                              <h2>Change Profile Picture</h2>
                           </div>
                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-12">
                                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php bs() ?>users/update_avatar" role="form">
                                       <div class="form-group">
                                          <div class="col-lg-6">
                                             <?php 
                                                if (empty($user->user_img)) 
                                                {
                                                	
                                                ?>
                                             <img src="<?php bs() ?>public/assets/img/default_user.png" class="img-responsive img-circle" width="200" alt="">
                                             <?php	
                                                } 
                                                else {
                                                ?>
                                             <img src="<?php bs() ?>uploads/<?php echo $user->user_img ?>" class="img-responsive img-circle" width="200" alt="">
                                             <?php		
                                                }
                                                
                                                
                                                ?>    
                                             <br><br>
                                             <input type="file" name="chang_image">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                             <button type="submit" class="btn btn-success">Change</button>
                                             <button type="button" class="btn btn-default">Cancel</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="tab-edit">
                        <div class="panel">
                           <div class="panel-heading">
                              <h2>Edit</h2>
                           </div>
                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-12">
                                    <form method="post" action="<?php bs() ?>users/edit_profile">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">First Name</label>
                                          <input type="text" class="form-control" name="first_name" value="<?php echo $user_profile->first_name ?>">
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputPassword1">Last Name</label>
                                          <input type="text" class="form-control" name="last_name" value="<?php echo $user_profile->last_name ?>">
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputPassword1">Email</label>
                                          <input type="email" class="form-control" name="email" value="<?php echo $user_profile->email ?>">
                                       </div>
                                       <div class="form-group">
                                          <label for="exampleInputPassword1">Mobiel No</label>
                                          <input type="text" class="form-control" name="mobile_no" value="<?php echo $user_profile->phone ?>">
                                       </div>
                                       <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- .tab-content -->
               </div>
               <!-- col-sm-8 -->
            </div>
         </div>
      </div>
      <!-- .container-fluid -->
   </div>
   <!-- #page-content -->
</div>