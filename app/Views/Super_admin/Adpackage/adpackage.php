
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ad Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ad Package</li>
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
                                <h3 class="card-title">Ad Package</h3>
                            </div>
                            <div class="col-md-4">
                                <?php if ($create == 1) { ?><button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Add</button><?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="text-transform: capitalize;">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Org Type</th>
                                <th>Total Views</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>Price Recurring</th>

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
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Add</h4>
                </div>
                <div class="modal-body">
                    <form id="add-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="adId" name="adId" class="form-control" placeholder="Ad id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="org_type"> Org Type: <span class="text-danger">*</span> </label>
                                    <select type="text" id="org_type" name="org_type" class="form-control" required>
                                        <option value="">Pleace select</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="national">National</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_views"> Total Views: <span class="text-danger">*</span> </label>
                                    <input type="text" id="total_views" name="total_views" class="form-control" placeholder="Total Views" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="height"> Width: <span class="text-danger">*</span> </label>
                                    <input type="text" id="size_width" name="size_width" class="form-control" placeholder="Width" maxlength="155" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="height"> Height: <span class="text-danger">*</span> </label>
                                    <input type="text" id="size_hight" name="size_hight" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="weight"> Weight: <span class="text-danger">*</span> </label>
                                    <input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price"> Price: <span class="text-danger">*</span> </label>
                                    <input type="number" id="price" name="price" class="form-control" placeholder="Price" maxlength="11" number="true" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="paidStatus"> Price Recurring: <span class="text-danger">*</span> </label>
                                    <select id="price_recurring" name="price_recurring" class="form-control" required>
                                        <option value="">Please select</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="add-form-btn">Add</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Add modal content -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="ad_package_id" name="ad_package_id" class="form-control" placeholder="Ad id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="org_type"> Org Type: <span class="text-danger">*</span> </label>
                                    <select type="text" id="org_type" name="org_type" class="form-control" required>
                                        <option value="">Pleace select</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="national">National</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="total_views"> Total Views: <span class="text-danger">*</span> </label>
                                    <input type="text" id="total_views" name="total_views" class="form-control" placeholder="Total Views" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="height"> Width: <span class="text-danger">*</span> </label>
                                    <input type="text" id="size_width" name="size_width" class="form-control" placeholder="Width" maxlength="155" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="height"> Height: <span class="text-danger">*</span> </label>
                                    <input type="text" id="size_hight" name="size_hight" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="weight"> Weight: <span class="text-danger">*</span> </label>
                                    <input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="price"> Price: <span class="text-danger">*</span> </label>
                                    <input type="number" id="price" name="price" class="form-control" placeholder="Price" maxlength="11" number="true" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="paidStatus"> Price Recurring: <span class="text-danger">*</span> </label>
                                    <select id="price_recurring" name="price_recurring" class="form-control" required>
                                        <option value="">Please select</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="edit-form-btn">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /.content -->
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
        $("#add-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal').modal('show');
        // submit the add from
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
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller.'/add') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
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
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
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
                        $('#add-form-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#add-form').validate();
    }

    function edit(ad_package_id) {
        $.ajax({
            url: '<?php echo base_url($controller.'/getOne') ?>',
            type: 'post',
            data: {
                ad_package_id: ad_package_id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #ad_id").val(response.ad_id);
                $("#edit-form #org_type").val(response.org_type);
                $("#edit-form #total_views").val(response.total_views);
                $("#edit-form #size_width").val(response.size_width);
                $("#edit-form #size_hight").val(response.size_hight);
                $("#edit-form #name").val(response.name);
                $("#edit-form #weight").val(response.weight);
                $("#edit-form #price").val(response.price);
                $("#edit-form #price_recurring").val(response.price_recurring);

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
                        var form = $('#edit-form');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url($controller.'/edit') ?>' ,
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                                        $('#edit-modal').modal('hide');
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
                                $('#edit-form-btn').html('Update');
                            }
                        });

                        return false;
                    }
                });
                $('#edit-form').validate();

            }
        });
    }

    function remove(ad_package_id) {
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
                        ad_package_id: ad_package_id
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
</script>