
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ad Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ad Management</li>
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
                                <h3 class="card-title">Ad Management</h3>
                            </div>
                            <div class="col-md-4">
                                <?php if ($create == 1) { ?>
                                    <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Add</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped" style="text-transform: capitalize;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Company</th>
                                <th>Package</th>
                                <th>Org Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- Add modal content -->
    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Status update</h4>
                </div>
                <div class="modal-body">
                    <form id="add-form" class="pl-3 pr-3">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="start">
                                    <label for="contactName"> Start Date: <span class="text-danger">*</span> </label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"  required>
                                </div>

                                <div class="form-group" id="end">
                                    <label for="contactName"> End Date: <span class="text-danger">*</span> </label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"  required>
                                    <input type="hidden" id="id" name="id" class="form-control"  required>
                                    <input type="hidden" id="status" name="status" class="form-control"  required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="add-form-btn">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.content -->

    <div id="new-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Add</h4>
                </div>
                <div class="modal-body">
                    <form id="add-new-form" class="pl-3 pr-3" enctype="multipart/form-data" >

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Companey: <span class="text-danger">*</span> </label>
                                    <select id="ad_com_id" name="ad_com_id" class="form-control" placeholder="Package"  required>
                                        <option value="">Please select</option>
                                        <?php foreach ($companey as $view) { ?>
                                            <option value="<?php echo $view->ad_com_id;?>"><?php echo $view->com_name;?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Package: <span class="text-danger">*</span> </label>
                                    <select id="ad_package_id" name="ad_package_id" class="form-control" placeholder="Package"  required>
                                        <option value="">Please select</option>
                                        <?php foreach ($adPack as $item) { ?>
                                            <option value="<?php echo $item->ad_package_id?>"><?php echo $item->name?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="org_type"> Org Type: <span class="text-danger">*</span> </label>
                                    <select id="org_type" name="org_type" class="form-control" required>
                                        <option value="">Please select</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="national">National</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="banner"> Banner: <span class="text-danger">*</span> </label>
                                    <input type="file" id="banner" name="banner" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="newadd-form-btn">Add</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<!-- /.content-wrapper -->
<script>
    $(function () {
        $('#data_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url($controller.'/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    });
    function add() {
        // reset the form
        // $("#add-new-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#new-add-modal').modal('show');
        // submit the add from
        $('#add-new-form').on('submit', function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/add') ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#newadd-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    if (response.success === true) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            $('#new-add-modal').modal('hide');
                        })

                    } else {

                        if (response.messages instanceof Object) {
                            $.each(response.messages, function(index, value) {
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
                    $('#newadd-form-btn').html('Add');
                }
            });

        });

    }

    function addStatusChange(status,id) {
        $.ajax({
            url: '<?php echo base_url($controller.'/getOne') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form
                $("#add-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');

                $('#add-modal').modal('show');

                if (status == 'active'){
                    $("#add-form #start").css('display','block');
                    $("#add-form #end").css('display','block');
                }else{
                    $("#add-form #start").css('display','none');
                    $("#add-form #end").css('display','none');
                }


                $("#add-form #start_date").val(response.start_date);
                $("#add-form #end_date").val(response.end_date);
                $("#add-form #id").val(id);
                $("#add-form #status").val(status);

                // submit the edit from
                $.validator.setDefaults({
                    highlight: function(element) {
                        $(element).addClass('is-invalid').removeClass('is-valid');
                    },
                    unhighlight: function(element) {
                        $(element).removeClass('is-invalid').addClass('is-valid');
                    },
                    errorElement: 'div ',
                    errorClass: 'invalid-feedback',
                    errorPlacement: function(error, element) {
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

                    submitHandler: function(form) {
                        var form = $('#add-form');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url($controller.'/statusChange') ?>' ,
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                            },
                            success: function(response) {

                                if (response.success === true) {

                                    Swal.fire({
                                        position: 'bottom-end',
                                        icon: 'success',
                                        title: response.messages,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        $('#add-modal').modal('hide');
                                    })

                                } else {

                                    if (response.messages instanceof Object) {
                                        $.each(response.messages, function(index, value) {
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
                                $('#add-form-btn').html('Update');
                            }
                        });

                        return false;
                    }
                });
                $('#add-form').validate();

            }
        });
    }

    function remove(ad_com_id) {
        Swal.fire({
            title: 'Are you sure of the deleting process?',
            text: "You cannot back after confirmation",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url($controller.'/remove') ?>',
                    type: 'post',
                    data: {
                        ad_com_id: ad_com_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            })
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
                });
            }
        })
    }

    function __addStatusChange(status,id){
        $('#add-modal').modal('show');
        alert(id);

        //$.ajax({
        //    url: '<?php //echo base_url($controller.'/statusChange') ?>//',
        //    type: 'post',
        //    data: {status:status,id:id}, // /converting the form data into array and sending it to server
        //    dataType: 'json',
        //    beforeSend: function() {
        //        $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
        //    },
        //    success: function(response) {
        //
        //        if (response.success === true) {
        //            Swal.fire({
        //                position: 'bottom-end',
        //                icon: 'success',
        //                title: response.messages,
        //                showConfirmButton: false,
        //                timer: 1500
        //            })
        //        } else {
        //            if (response.messages instanceof Object) {
        //                $.each(response.messages, function(index, value) {
        //                    var id = $("#" + index);
        //
        //                    id.closest('.form-control')
        //                        .removeClass('is-invalid')
        //                        .removeClass('is-valid')
        //                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
        //
        //                    id.after(value);
        //
        //                });
        //            } else {
        //                Swal.fire({
        //                    position: 'bottom-end',
        //                    icon: 'error',
        //                    title: response.messages,
        //                    showConfirmButton: false,
        //                    timer: 1500
        //                })
        //            }
        //        }
        //    }
        //});
    }
</script>