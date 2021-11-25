<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                                <h3 class="card-title">Settings</h3>
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
                                        <a class="nav-link" data-toggle="tab" href="#basic">Basic</a>
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
                                            <div class="row col-md-6">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> Name: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                               value="<?php echo $hospital->name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> Email : <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="email" name="email"
                                                               value="<?php echo $hospital->email; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> Phone : <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="mobile"
                                                               name="mobile"
                                                               value="<?php echo $hospital->mobile; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-6">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> Description: <span
                                                                    class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control" id="description"
                                                                  name="description"
                                                                  style="height: 100px;"><?php echo $hospital->description; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> Comment : <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea class="form-control" id="comment" name="comment" style="height: 100px;"><?php echo $hospital->comment; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-12">
                                                <div class="col-md-12">
                                                    <input type="hidden" id="h_id" name="h_id"
                                                           value="<?php echo $hospital->h_id; ?>" required>
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success"
                                                            id="add-form-btn"
                                                            style="float: right;">Update
                                                    </button>
                                                </div>
                                            </div>
                                            </div>
                                        </form>

                                    </div>


                                    <div class="tab-pane container" id="basic">
                                        <form id="update-basic" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="division" class="lab-t"> Division </label>
                                                        <select class="form-control in-c" name="division"
                                                                onchange="viewdistrict(this.value)" required>
                                                            <option value="">Please Select</option>
                                                            <?php echo divisionView($globaladdr->division); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="zila" class="lab-t"> Zila </label>
                                                        <select class="form-control in-c" name="zila"
                                                                onchange="viewupazila(this.value)" id="district"
                                                                required>
                                                            <option value="">Please Select</option>
                                                            <?php echo districtselect($globaladdr->zila,$globaladdr->division); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="upazila" class="lab-t"> Upazila: </label>
                                                        <select class="form-control in-c" name="upazila"
                                                                id="subdistrict" onchange="checkCity(this.value)"
                                                                required>
                                                            <option value="">Please Select</option>
                                                            <?php echo upazilaselect($globaladdr->upazila,$globaladdr->zila); ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-12 text-right">
                                                    <input type="hidden" id="h_id" name="h_id"
                                                           value="<?php echo $hospital->h_id; ?>" required>
                                                    <button type="submit" onclick="updateBasic()"
                                                            class="btn btn-success"
                                                            id="up-basic-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="image">

                                        <form id="update-image" method="Post" class="pl-3 pr-3" enctype="multipart/form-data">
<!--                                        <form action="--><?php //echo base_url($controller . '/updateImage') ?><!--" method="Post" class="pl-3 pr-3" enctype="multipart/form-data">-->
                                            <div class="row pt-4 mt-4 img_div">

                                                <div class="col-md-6" >
                                                    <div class="form-group">
                                                        <label for="logo"> Logo: </label>
                                                        <input type="file" id="logo" name="logo" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode">
                                                    <?php $logo = (!empty($hospital->logo)) ? $hospital->logo : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id; ?>/<?php echo $logo ?>"
                                                         style="max-width: 200px;">
                                                </div>
                                            </div>
                                            <div class="row pt-4 mt-4 img_div">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Image: </label>
                                                        <input type="file" id="image" name="image" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode2" style="padding-top: 20px;">
                                                    <?php $image = (!empty($hospital->image)) ? $hospital->image : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id; ?>/<?php echo $image ?>"
                                                         style="max-width: 200px;">
                                                </div>
                                            </div>
                                            <div class="row pt-4 mt-4 img_div">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Banner one: </label>
                                                        <input type="file" id="banner_1" name="banner_1" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode3" style="padding-top: 20px;">
                                                    <?php $banner = (!empty($hospital->banner_1)) ? $hospital->banner_1 : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id; ?>/<?php echo $banner ?>"
                                                         style="max-width: 200px;">
                                                </div>
                                            </div>

                                            <div class="row pt-4 mt-4 img_div">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Banner two: </label>
                                                        <input type="file" id="banner_2" name="banner_2" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode4" style="padding-top: 20px;">
                                                    <?php $banner1 = (!empty($hospital->banner_2)) ? $hospital->banner_2 : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id; ?>/<?php echo $banner1 ?>"
                                                         style="max-width: 200px;">
                                                </div>
                                            </div>

                                            <div class="row pt-4 mt-4 img_div">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Banner three: </label>
                                                        <input type="file" id="banner_3" name="banner_3" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode5" style="padding-top: 20px;">
                                                    <?php $banner3 = (!empty($hospital->banner_3)) ? $hospital->banner_3 : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id; ?>/<?php echo $banner3 ?>"
                                                         style="max-width: 200px;">
                                                </div>
                                            </div>

                                            <div class="row pt-4">

                                                <div class="col-md-12 text-right">
                                                    <input type="hidden" id="h_id" name="h_id"
                                                           value="<?php echo $hospital->h_id; ?>" required>
                                                    <button type="submit" class="btn btn-success" id="up-image-btn" onclick="updateimage()" style="margin-top: 30px;">Update
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
    <!-- Add modal content -->

</div>
<!-- /.content-wrapper -->

<script>

    function updateReg(){
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

                var form = $('#updaue-reg');
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
                        $('#add-form-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#updaue-reg').validate();
    }
    function updateBasic(){
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
                    url: '<?php echo base_url($controller . '/updateAddress') ?>',
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
                        $('#up-basic-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#update-basic').validate();
    }


    function updateimage(){
        $('#update-image').on('submit', function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/updateImage') ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
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
                        }).then(function() {
                            document.getElementById("update-image").reset();
                            $('#imgRelode').load(document.URL + ' #imgRelode');
                            $('#imgRelode2').load(document.URL + ' #imgRelode2');
                            $('#imgRelode3').load(document.URL + ' #imgRelode3');
                            $('#imgRelode4').load(document.URL + ' #imgRelode4');
                            $('#imgRelode5').load(document.URL + ' #imgRelode5');
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
                    $('#up-image-btn').html('Update');
                }
            });

        });
    }


</script>