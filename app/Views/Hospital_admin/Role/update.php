<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role Update</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Role Update</h3>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="edit-form" class="pl-3 pr-3">
                            <div class="row">
                                <input type="hidden" id="roleId" name="roleId" class="form-control"
                                       placeholder="Role id" maxlength="11" value="<?php echo $role->role_id; ?>"
                                       required>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role"> Role: <span class="text-danger">*</span> </label>
                                        <input type="text" id="role" name="role" class="form-control" placeholder="Role"
                                               maxlength="30" value="<?php echo $role->role; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permission"> Permission: <span class="text-danger">*</span> </label>
                                        <ol>
                                            <?php foreach (json_decode($role->permission) as $key => $value) { ?>
                                                <li><?php echo $key; ?>
                                                    <?php foreach ($value as $k => $v) {
                                                        $isChecked = ($v == 1) ? 'checked="checked"' : ''; ?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" <?php echo $isChecked; ?>
                                                                       name="permission[<?php print $key; ?>][<?php print $k; ?>]"
                                                                       value="1"> <?php echo $k ?></label>
                                                        </div>

                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" id="edit-form-btn" onclick="edit()">
                                        Update
                                    </button>
                                    <a href="<?php echo base_url('Hospital_admin/Role')?>" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

    function add() {
        // reset the form
        $("#add-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal').modal('show');
        // submit the add from
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            errorElement: 'div ',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if ($(element).is('.select')) {
                    element.next().after(error);
                } else if (element.hasClass('select2')) {
                    //error.insertAfter(element);
                    error.insertAfter(element.next());
                } else if (element.hasClass('selectpicker')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {

                var form = $('#add-form');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/add') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function () {
                        $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

                        if (response.success === true) {

                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                                $('#add-modal').modal('hide');
                            })

                        } else {

                            if (response.messages instanceof Object) {
                                $.each(response.messages, function (index, value) {
                                    var id = $("#" + index);

                                    id.closest('.form-control')
                                        .removeClass('is-invalid')
                                        .removeClass('is-valid')
                                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                                    id.after(value);

                                });
                            } else {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'error',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            }
                        }
                        $('#add-form-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#add-form').validate();
    }

    function edit() {

        // reset the form
        // $("#edit-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');

        // submit the edit from
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            errorElement: 'div ',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if ($(element).is('.select')) {
                    element.next().after(error);
                } else if (element.hasClass('select2')) {
                    //error.insertAfter(element);
                    error.insertAfter(element.next());
                } else if (element.hasClass('selectpicker')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {
                var form = $('#edit-form');
                $(".text-danger").remove();
                $.ajax({
                    url: '<?php echo base_url($controller . '/edit') ?>',
                    type: 'post',
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        $('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

                        if (response.success === true) {

                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                                $('#edit-modal').modal('hide');
                            })

                        } else {

                            if (response.messages instanceof Object) {
                                $.each(response.messages, function (index, value) {
                                    var id = $("#" + index);

                                    id.closest('.form-control')
                                        .removeClass('is-invalid')
                                        .removeClass('is-valid')
                                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                                    id.after(value);

                                });
                            } else {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'error',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            }
                        }
                        $('#edit-form-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#edit-form').validate();


    }

</script>