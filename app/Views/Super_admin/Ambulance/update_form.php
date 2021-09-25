<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ambulance Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ambulance Update</li>
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
                        <h3 class="card-title">Update Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#registered">Registered</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#basic">Basic</a>
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
                                        <form id="update-reg" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone"> Phone: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="mobile" name="mobile" class="form-control"
                                                               value="<?php print $ambulance->mobile; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name"> Name: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="contactName" name="contactName"
                                                               value="<?php echo $ambulance->contact_name; ?>" required>
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password"> Password: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="password" name="password"
                                                               class="form-control" placeholder="Password" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ConfirmPassword">Confirm Password: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="con_password" name="con_password"
                                                               class="form-control" placeholder="Confirm Password"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="hidden" id="amb_id" name="amb_id"
                                                           value="<?php echo $ambulance->amb_id; ?>" required>
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success"
                                                            id="add-form-btn"
                                                            style="float: right;">Update
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>


                                    <div class="tab-pane container" id="basic">
                                        <form id="update-basic" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="is_default">Oxygen: </label>
                                                        <select id="oxygen" name="oxygen" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="yes" <?php if ($ambulance->oxygen == 'yes'){ echo 'selected';}?>>Yes</option>
                                                            <option value="no" <?php if ($ambulance->oxygen == 'no'){ echo 'selected';}?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="is_default">Ac: </label>
                                                        <select id="ac" name="ac" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="yes" <?php if ($ambulance->ac == 'yes'){ echo 'selected';}?>>Yes</option>
                                                            <option value="no" <?php if ($ambulance->ac == 'no'){ echo 'selected';}?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="is_default">Car Model Name: </label>
                                                        <input type="text" class="form-control" name="car_model_name" id="car_model_name" value="<?php echo $ambulance->car_model_name; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description"> Description: </label>
                                                        <textarea cols="40" rows="5" id="description" name="description"
                                                                  class="form-control" placeholder="Description" ><?php echo $ambulance->description; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <input type="hidden" id="amb_id" name="amb_id"
                                                           value="<?php echo $ambulance->amb_id; ?>" required>
                                                    <button type="submit" onclick="updateBasic()" class="btn btn-success"
                                                            id="up-basic-btn" style="margin-top: 30px;" >Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane container" id="address">
                                        <form id="update-address"  class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <?php
                                                    $division = get_data_by_id('division','global_address','global_address_id',$ambulance->global_address_id);
                                                    $zila = get_data_by_id('zila','global_address','global_address_id',$ambulance->global_address_id);
                                                    $upazila = get_data_by_id('upazila','global_address','global_address_id',$ambulance->global_address_id);
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="division"> Division:<?php echo $hospital->global_address_id; ?> </label>
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
                                                    <input type="hidden" id="amb_id" name="amb_id"
                                                           value="<?php echo $ambulance->amb_id; ?>" required>
                                                    <button type="submit" onclick="updateAddress()" class="btn btn-success"
                                                            id="up-address-btn" style="margin-top: 30px;" >Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="image">
                                        <!--    id="update-image"   action="<?php //echo base_url($controller . '/updateImage') ?>" method="Post"-->
                                        <form id="update-image"  method="Post" class="pl-3 pr-3" enctype="multipart/form-data">
                                            <div class="row pt-4">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Image: </label>
                                                        <input type="file" id="image" name="image" class="form-control" placeholder="image"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <?php $img = (!empty($ambulance->image))?$ambulance->image:'noimage.jpg';?>
                                                    <img src="<?php echo base_url()?>/assets/uplode/ambulance/<?php echo $img;?>" width="150">
                                                </div>

                                                <div class="col-md-12 ">
                                                    <input type="hidden" id="amb_id" name="amb_id"
                                                           value="<?php echo $ambulance->amb_id; ?>" required>
                                                    <button type="submit" onclick="updateimage()" class="btn btn-success"
                                                            id="up-image-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function updateReg() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');

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

                var form = $('#update-reg');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/updateReg') ?>',
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
        $('#update-reg').validate();
    }


    function updateBasic() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');

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
                var form = $('#update-basic');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/updateBasic') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function () {
                        $('#up-basic-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

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
                        $('#up-basic-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#update-basic').validate();
    }

    function updateAddress() {
        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');

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
                var form = $('#update-address');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/updateAddress') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function () {
                        $('#up-address-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

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
                        $('#up-address-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#update-address').validate();
    }


    function updateimage() {

        // reset the form
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');

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
                var form = $('#update-image');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/updateImage') ?>',
                    // type: 'post',
                    method:"POST",
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    // contentType: "application/json; charset=utf-8",
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#up-image-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

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
                        $('#up-image-btn').html('Add');
                    }
                });

                return false;
            }
        });
        $('#update-image').validate();
    }


</script>