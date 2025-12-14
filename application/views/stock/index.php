<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>stock</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">stock</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif ($this->session->flashdata('error')) : ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if (in_array('createStock', $user_permission)) : ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add stock</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage stock</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>code art</th>
                  <th>libelle art</th>
                  <th>prix</th>
                  <th>largeur</th>
                  <th>hauteur</th>
                  <th>langeur</th>
                  <th>classeABC</th>
                  <?php if (in_array('updateStock', $user_permission) || in_array('deleteStock', $user_permission)) : ?>
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


  <!-- create brand modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Stock</h4>
      </div>
      

      <form role="form" action="<?php echo base_url('stock/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="codeart">Code Art</label>
            <input type="text" class="form-control" id="codeart" name="codeart" placeholder="Enter Code Art" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="libart">Lib Art</label>
            <input type="text" class="form-control" id="libart" name="libart" placeholder="Enter Lib Art" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" placeholder="Enter Prix" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="langeur">Langeur</label>
            <input type="text" class="form-control" id="langeur" name="langeur" placeholder="Enter langeur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="largeur">Largeur</label>
            <input type="text" class="form-control" id="largeur" name="largeur" placeholder="Enter Largeur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="hauteur">Hauteur</label>
            <input type="text" class="form-control" id="hauteur" name="hauteur" placeholder="Enter Hauteur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="classeABC">Classe ABC</label>
            <input type="text" class="form-control" id="classeABC" name="classeABC" placeholder="Enter Classe ABC" autocomplete="off">
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

  </div><!-- /.modal -->


<?php if (in_array('updateStock', $user_permission)) : ?>
  <!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Stock</h4>
      </div>

      <form role="form" action="<?php echo base_url('stock/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_codeart">Code Art</label>
            <input type="text" class="form-control" id="edit_codeart" name="edit_codeart" placeholder="Enter Code Art" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_libart">Lib Art</label>
            <input type="text" class="form-control" id="edit_libart" name="edit_libart" placeholder="Enter Lib Art" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_prix">Prix</label>
            <input type="text" class="form-control" id="edit_prix" name="edit_prix" placeholder="Enter Prix" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_langeur">Langeur</label>
            <input type="text" class="form-control" id="edit_langeur" name="edit_langeur" placeholder="Enter Langeur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_largeur">Largeur</label>
            <input type="text" class="form-control" id="edit_largeur" name="edit_largeur" placeholder="Enter Largeur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_hauteur">Hauteur</label>
            <input type="text" class="form-control" id="edit_hauteur" name="edit_hauteur" placeholder="Enter Hauteur" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_classeABC">Classe ABC</label>
            <input type="text" class="form-control" id="edit_classeABC" name="edit_classeABC" placeholder="Enter Classe ABC" autocomplete="off">
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

<?php if (in_array('deleteStock', $user_permission)) : ?>
  <!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove stock</h4>
      </div>

      <form role="form" action="<?php echo base_url('stock/remove') ?>" method="post" id="removeForm">
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

// Define removeFunc in the global scope
function removeFunc(id) {
    if (id) {
        $("#removeForm").unbind('submit').on('submit', function() {
            var form = $(this);

            // Remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { stock_id: id },
                dataType: 'json',
                success: function(response) {
                    manageTable.ajax.reload(null, false);

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');

                        // Hide the modal
                        $("#removeModal").modal('hide');

                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                    }
                }
            });

            return false;
        });
    }
}

// Define editFunc in the global scope
function editFunc(id) {
    $.ajax({
        url: '<?php echo base_url('stock/fetchStockDataById/'); ?>' + id,
        type: 'post',
        dataType: 'json',
        success: function(response) {
            $("#edit_codeart").val(response.codeart);
            $("#edit_libart").val(response.libart);
            $("#edit_prix").val(response.prix);
            $("#edit_longeur").val(response.langeur);
            $("#edit_largeur").val(response.largeur);
            $("#edit_hauteur").val(response.hauteur);
            $("#edit_classeABC").val(response.classeABC);

            // Submit the edit form 
            $("#updateForm").unbind('submit').bind('submit', function() {
                var form = $(this);

                // Remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action') + '/' + id,
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        manageTable.ajax.reload(null, false);

                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // Hide the modal
                            $("#editModal").modal('hide');

                            // Reset the form 
                            $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                        } else {
                            if (response.messages instanceof Object) {
                                $.each(response.messages, function(index, value) {
                                    var id = $("#" + index);

                                    id.closest('.form-group')
                                        .removeClass('has-error')
                                        .removeClass('has-success')
                                        .addClass(value.length > 0 ? 'has-error' : 'has-success');

                                    id.after(value);
                                });
                            } else {
                                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
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

$(document).ready(function() {
    $("#stockNav").addClass('active');

    // Initialize the datatable 
    manageTable = $('#manageTable').DataTable({
        'ajax': '<?php echo base_url('stock/fetchStockData'); ?>',
        'order': []
    });

    // Submit the create form 
    $("#createForm").unbind('submit').on('submit', function() {
        var form = $(this);

        // Remove the text-danger
        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                manageTable.ajax.reload(null, false);

                if (response.success === true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // Hide the modal
                    $("#addModal").modal('hide');

                    // Reset the form
                    $("#createForm")[0].reset();
                    $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

                } else {

                    if (response.messages instanceof Object) {
                        $.each(response.messages, function(index, value) {
                            var id = $("#" + index);

                            id.closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success');

                            id.after(value);

                        });
                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                    }
                }
            }
        });

        return false;
    });
});

</script>

