<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>emplacement</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">emplacement</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createEmp', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Emplacement</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage emp</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Code Emplacement</th>
                <th>Libelle Emp</th>
                <th>Width</th>
                <th>Height</th>
                <th>Depth</th>
                <th>Classe ABC</th>
                <th>Poid Max</th>
                <th>Occupied</th>
                <?php if(in_array('updateEmp', $user_permission) || in_array('deleteEmp', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('createEmp', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Emplacement</h4>
      </div>

      <form role="form" action="<?php echo base_url('emplacement/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="codeempa">Code Emplacement</label>
            <input type="text" class="form-control" id="codeempa" name="codeempa" placeholder="Enter code emplacement" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="libemp">Libelle Emp</label>
            <input type="text" class="form-control" id="libemp" name="libemp" placeholder="Enter Libelle Emp" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="width">Width</label>
            <input type="text" class="form-control" id="width" name="width" placeholder="Enter width" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="height">Height</label>
            <input type="text" class="form-control" id="height" name="height" placeholder="Enter height" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="depth">Depth</label>
            <input type="text" class="form-control" id="depth" name="depth" placeholder="Enter depth" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="classeABC">Classe ABC</label>
            <input type="text" class="form-control" id="classeABC" name="classeABC" placeholder="Enter classe ABC" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="poidmax">Poid Max</label>
            <input type="text" class="form-control" id="poidmax" name="poidmax" placeholder="Enter poid max" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="occupied">Occupied</label>
            <select class="form-control" id="occupied" name="occupied">
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateEmp', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Emplacement</h4>
      </div>

      <form role="form" action="<?php echo base_url('emplacement/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="edit_codeemp">Code Emplacement</label>
            <input type="text" class="form-control" id="edit_codeemp" name="edit_codeemp" placeholder="Enter code emplacement" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_libemp">Libelle Emp</label>
            <input type="text" class="form-control" id="edit_libemp" name="edit_libemp" placeholder="Enter Libelle Emp" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_width">Width</label>
            <input type="text" class="form-control" id="edit_width" name="edit_width" placeholder="Enter width" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_height">Height</label>
            <input type="text" class="form-control" id="edit_height" name="edit_height" placeholder="Enter height" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_depth">Depth</label>
            <input type="text" class="form-control" id="edit_depth" name="edit_depth" placeholder="Enter depth" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_classeABC">Classe ABC</label>
            <input type="text" class="form-control" id="edit_classeABC" name="edit_classeABC" placeholder="Enter classe ABC" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_poidmax">Poid Max</label>
            <input type="text" class="form-control" id="edit_poidmax" name="edit_poidmax" placeholder="Enter poid max" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_occupied">Occupied</label>
            <select class="form-control" id="edit_occupied" name="edit_occupied">
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteEmp', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove empalcement</h4>
      </div>

      <form role="form" action="<?php echo base_url('emplacement/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  $("#emplacementNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchStoreData',
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchStoreDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_codeemp").val(response.codeemp);
      $("#edit_libemp").val(response.libemp);
      $("#edit_width").val(response.width);
      $("#edit_height").val(response.height);
      $("#edit_depth").val(response.depth);
      $("#edit_classeABC").val(response.classeABC);
      $("#edit_poidmax").val(response.poidmax);
      $("#edit_occupied").val(response.occupied);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { codeemp:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}
</script>
