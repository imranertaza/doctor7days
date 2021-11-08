<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Patients update</li>
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
                                <h3 class="card-title">Patients update</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#registered">Registered</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#image">Images</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active container" id="registered">
                                        <form id="updaue-reg" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name"> Name: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                               value="<?php echo $patient->name; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email"> Email: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                               value="<?php echo $patient->email; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone"> Phone: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="phone" name="phone" class="form-control"
                                                               value="<?php echo $patient->phone; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nid"> NID: </label>
                                                        <input type="text" id="nid" name="nid" class="form-control"
                                                               value="<?php echo $patient->nid; ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="age"> Age: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="age" name="age" class="form-control"
                                                               value="<?php echo $patient->age; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password"> Password: </label>
                                                        <input type="password" id="password" name="password" class="form-control"
                                                               value="" >
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <input type="hidden" id="pat_id" name="pat_id"
                                                           value="<?php echo $patient->pat_id; ?>" required>
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success"
                                                            id="add-form-btn"
                                                            style="float: right;">Update
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>


                                    <div class="tab-pane container" id="image">
                                        <form id="update-image" method="Post" class="pl-3 pr-3" enctype="multipart/form-data">
                                            <div class="row pt-4">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="photo"> Photo: </label>
                                                        <input type="file" id="photo" name="photo" class="form-control" placeholder="photo"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="imgRelode">
                                                    <?php $img = (!empty($patient->photo)) ? $patient->photo : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/uplode/patient/<?php echo $img ?>" style="max-width: 200px;">
                                                </div>


                                                <div class="col-md-12 text-center">
                                                    <input type="hidden" id="pat_id" name="pat_id"
                                                           value="<?php echo $patient->pat_id; ?>" required>
                                                    <button type="submit" onclick="updateimage()" class="btn btn-success"
                                                            id="up-image-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane container" id="address">
                                        <form id="update-address" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <?php
                                                    $division = get_data_by_id('division','global_address','global_address_id',$patient->global_address_id);
                                                    $zila = get_data_by_id('zila','global_address','global_address_id',$patient->global_address_id);
                                                    $upazila = get_data_by_id('upazila','global_address','global_address_id',$patient->global_address_id);
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="division"> Division: </label>
                                                        <select class="form-control" name="division" onchange="viewdistrict(this.value)" required >
                                                            <option value="">Please Select</option>
                                                            <?php echo divisionView($division) ; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="zila"> Zila: </label>
                                                        <select class="form-control" name="zila" onchange="viewupazila(this.value)" id="district" required>
                                                            <option value="">Please Select</option>
                                                            <?php echo districtselect($zila,$division) ; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="upazila"> Upazila: </label>
                                                        <select class="form-control" name="upazila" id="subdistrict"  required>
                                                            <option value="">Please Select</option>
                                                            <?php echo upazilaselect($upazila,$zila) ; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">

                                                    <input type="hidden" id="pat_id" name="pat_id"
                                                           value="<?php echo $patient->pat_id; ?>" required>
                                                    <button type="submit" onclick="updateaddress()" class="btn btn-success"
                                                            id="up-address-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<!-- /.content-wrapper -->

<script>

    function updateReg() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
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
                var form = $("#updaue-reg");
                var formData = new FormData(form[0]);
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller.'/updateReg') ?>',
                    type: 'post',
                    data: formData, // /converting the form data into array and sending it to server
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
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
        $('#updaue-reg').validate();
    }
    function updateimage() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
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
                var form = $("#update-image");
                var formData = new FormData(form[0]);
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller.'/updateImage') ?>',
                    type: 'post',
                    data: formData, // /converting the form data into array and sending it to server
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#up-image-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                document.getElementById("update-image").reset();
                                $('#imgRelode').load(document.URL + ' #imgRelode');
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
                        $('#up-image-btn').html('Update');
                    }
                });
                return false;
            }
        });
        $('#update-image').validate();
    }
    function updateaddress() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
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
                var form = $("#update-address");
                var formData = new FormData(form[0]);
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller.'/updateAddress') ?>',
                    type: 'post',
                    data: formData, // /converting the form data into array and sending it to server
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#up-address-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
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
                        $('#up-address-btn').html('Update');
                    }
                });
                return false;
            }
        });
        $('#update-address').validate();
    }

</script>