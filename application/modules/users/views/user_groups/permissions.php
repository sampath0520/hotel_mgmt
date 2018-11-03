<div class="static-content-wrapper">
<div class="static-content">
   <div class="page-content">
      <ol class="breadcrumb">
         <li><a href="">Home</a></li>
         <li class="active"><a href="">groups & permissions</a></li>
         <li class="active"><a href="">permissions</a></li>
      </ol>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="alert alert-info clearfix">
                  <h3 class="mt0">Draggable Panels</h3>
                  <p>Wijets is a jQuery plugin that provides advanced panel options which can be configured all with a single line of code - <code>$.wijets.make();</code>. All other settings are configured directly with data-attributes!</p>
               </div>
            </div>
         </div>
         <div class="row" data-widget-group="group-demo">
            <div class="col-md-12">
               <div class="panel panel-success" data-widget='{"id" : "wiget4"}'>
                  <div class="panel-heading">
                     <div class="panel-ctrls button-icon" 
                        data-actions-container="" 
                        data-action-collapse='{"target": ".panel-body"}'
                        data-action-expand=''
                        data-action-colorpicker=''
                        data-action-refresh='{"type":"circular", "url":"ajax-text.html"}'
                        data-action-close=''
                        >
                     </div>
                     <h2><i class="fa fa-plus-circle"></i>Add Permissions</h2>
                  </div>
                  <div class="panel-editbox" data-widget-controls=""></div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-md-6">
                           <form class="form-inline" action="<?= base_url('users/User_groups/permissions') ?>" method="post" role="form">
                              <div class="form-group">
                                 <label> <font color="#8bc34a">Permission Name </font>&nbsp;</label>
                                 <input type="text" name="perm" class="form-control" placeholder="Permission Name">
                              </div>
                              <button type="submit" class="btn btn-default add"><i class="fa fa-plus"></i> Add</button>
                              <br>
                              <!-- <span id="err_msg" style="color: red;margin-left:22%"></span> -->
                           </form>
                        </div>
                     </div>
                     <div class="row" style="padding-top: 3%">
                        <div class="col-md-12">
                           <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Perm Id</th>
                                    <th>Permission Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($perm as $key => $value): ?>
                                 <tr>
                                    <td><?php echo $value->perm_id ?></td>
                                    <td><?php echo $value->perm_name ?></td>
                                    <td>
                                       <button class="btn btn-info update" edit="<?= $value->perm_id ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> Edit</button>
                                    </td>
                                    <td>
                                       <button class="btn btn-danger" id_del="<?= $value->perm_id ?>" id="delete"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                 </tr>
                              </tbody>
                              <?php endforeach ?>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- .container-fluid -->
   </div>
   <!-- #page-content -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update Permission</h4>
         </div>
         <div class="modal-body">
            <form class="form-inline" action="<?= base_url('users/User_groups/update_perm') ?>" method="post" role="form">
               <div class="form-group">
                  <label> <font color="#8bc34a">Permission Name </font>&nbsp;</label>
                  <input type="text" name="perm" id="perm" class="form-control" placeholder="Permission Name">
                  <input type="hidden" id="edit" name="edit">
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Save changes</button>
         </div>
         </form>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() 
   {
   	//This script will delete record
       $("body").on('click', '#delete', function(event) 
       {
       	event.preventDefault();
       	/* Act on the event */
           var del = $(this).attr('id_del');
   
           //ajax request
       	$.ajax({
   
       		url : '<?php bs('users/User_groups/delete_perm') ?>/'+del,
       		success: function(result) 
       		{
       			location.reload(); 
               }
       	});
       });
   
       $("body").on('click','.update',function(event) 
       {
           event.preventDefault();
           // body...
           var id = $(this).attr('edit');
   
   
           $.ajax({
   
               url : "<?php bs('users/User_groups/get_perm') ?>/"+id,
   
               success :function (success) 
               {
                   var obj = $.parseJSON(success);
                   $("#perm").val(obj.perm_name);
                   $("#edit").val(obj.perm_id);
               }
   
           })
       })
   });
</script>