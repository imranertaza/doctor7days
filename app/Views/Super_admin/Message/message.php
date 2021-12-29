<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Message</li>
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
                                <h3 class="card-title">Message</h3>

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
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>

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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"> Title: <span class="text-danger">*</span> </label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"> Hospital: </label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_hospital" id="inlineRadio1" value="All" >
                                                <label class="form-check-label chec" for="inlineRadio1">All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_hospital" id="inlineRadio2" value="Specific" >
                                                <label class="form-check-label chec" for="inlineRadio2">Specific</label>
                                            </div>
                                        </div>

                                        <div class="form-group" id="hospitalview" style="display: none;">
                                            <label for="title"> Please select: </label>

                                            <ul class="list-unstyled">
                                                <?php foreach ($hospital as $key => $hos){ if ($hos->hospital_cat_id == 1){ ?>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="hospital[]" type="checkbox"  id="hospital_<?php echo $key+1?>" value="<?php echo $hos->h_id?>">
                                                            <label class="form-check-label" for="hospital_<?php echo $key+1?>"><?php echo $hos->name?></label>
                                                        </div>
                                                    </li>
                                                <?php } }?>
                                            </ul>

                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"> Diagnostics: </label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_diagnostic" id="inlineRadio3" value="All">
                                                <label class="form-check-label chec" for="inlineRadio3">All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_diagnostic" id="inlineRadio4" value="Specific">
                                                <label class="form-check-label chec" for="inlineRadio4">Specific</label>
                                            </div>
                                        </div>

                                        <div class="form-group" id="diagnosticview" style="display: none;">
                                            <label for="title"> Please select: </label>

                                            <ul class="list-unstyled">
                                                <?php foreach ($hospital as $key => $hos){ if ($hos->hospital_cat_id == 2){ ?>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="diagnostic[]" type="checkbox"  id="diagnostic_<?php echo $key+1?>" value="<?php echo $hos->h_id?>">
                                                            <label class="form-check-label" for="diagnostic_<?php echo $key+1?>"><?php echo $hos->name?></label>
                                                        </div>
                                                    </li>
                                                <?php } }?>
                                            </ul>

                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"> Patient: </label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_patient" id="inlineRadio5" value="All">
                                                <label class="form-check-label chec" for="inlineRadio5">All</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input chec" type="radio" name="for_patient" id="inlineRadio6" value="Specific">
                                                <label class="form-check-label chec" for="inlineRadio6">Specific</label>
                                            </div>
                                        </div>

                                        <div class="form-group" id="patientview" style="display: none;">
                                            <label for="title"> Please select: </label>

                                            <ul class="list-unstyled">
                                                <?php foreach ($patientModel as $key => $pat){ ?>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="patient[]" type="checkbox"  id="patient_<?php echo $key+1?>" value="<?php echo $pat->pat_id?>">
                                                            <label class="form-check-label" for="patient_<?php echo $key+1?>"><?php echo $pat->name?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                        </div>

                                    </div>



                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description"> Description: <span class="text-danger">*</span> </label>
                                    <input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
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
                    <form id="edit-form" method="post" enctype="multipart/form-data" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="brandId" name="brandId" class="form-control"  required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="logo"> Logo: </label>
                                    <input type="file" id="logo" name="logo" class="form-control" >
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

    function edit(brand_id) {
        $.ajax({
            url: '<?php echo base_url($controller.'/getOne') ?>',
            type: 'post',
            data: {
                brand_id: brand_id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #brandId").val(response.brand_id);
                $("#edit-form #name").val(response.name);


            }
        });

        $('#edit-form').on('submit',function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/edit') ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
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
                        }).then(function() {
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

        });
    }

    function remove(message_id) {
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
                        message_id: message_id
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



    $('#inlineRadio1').click(function () {
        $('#hospitalview').css('display','none');
    });
    $('#inlineRadio2').click(function () {
        $('#hospitalview').css('display','block');
    });

    $('#inlineRadio3').click(function () {
        $('#diagnosticview').css('display','none');
    });
    $('#inlineRadio4').click(function () {
        $('#diagnosticview').css('display','block');
    });

    $('#inlineRadio5').click(function () {
        $('#patientview').css('display','none');
    });
    $('#inlineRadio6').click(function () {
        $('#patientview').css('display','block');
    });

</script>