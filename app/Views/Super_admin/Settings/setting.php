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
                            <div class="col-md-12 mt-2">
                                <h3 class="card-title">Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name"> Name: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                               value="<?php echo $user->name; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email"> Email: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                               value="<?php echo $user->email; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone"> Phone: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="phone" name="phone" class="form-control"
                                                               value="<?php echo $user->mobile; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password"> Password: </label>
                                                        <input type="text" id="password" name="password" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $user->admin_id; ?>" required>
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success" id="add-form-btn" style="float: right;">Update </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane container" id="basic">
                                        <form id="update-basic" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="comName"> Company Name: </label>
                                                        <input type="text" class="form-control" id="comName" name="comName" value="<?php echo $user->comName; ?>" required>
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address"> Address: </label>
                                                        <textarea cols="40" rows="5" id="address" name="address" class="form-control" placeholder="Comment"><?php echo $user->address; ?></textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-6 text-center">
                                                    <input type="hidden" id="admin_id" name="admin_id"
                                                           value="<?php echo $user->admin_id; ?>" required>
                                                    <button type="submit" onclick="updateBasic()" class="btn btn-success" id="up-basic-btn" style="margin-top: 30px;" >Update </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="image">
                                        <form id="update-image" method="Post" class="pl-3 pr-3" enctype="multipart/form-data">
                                            <div class="row pt-4 mt-4 img_style" >
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pic"> Logo: </label>
                                                        <input type="file" id="pic" name="pic" class="form-control" required  >
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="imgRelode">
                                                    <?php $img = no_image_view('/assets/upload/superAdmin/'.$user->admin_id.'/'.$user->pic,'/assets/upload/superAdmin/no_image.jpg',$user->pic); ?>
                                                    <img src="<?php echo $img;?>" style="max-width: 200px;">
                                                </div>


                                                <div class="col-md-12 text-center">
                                                    <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $user->admin_id; ?>" required>
                                                    <button type="submit" onclick="updateimage()" class="btn btn-success" id="up-image-btn" style="margin-top: 30px;">Update </button>
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
        $('#updaue-reg').validate();
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
                        $('#up-basic-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#update-basic').validate();
    }

    function updateimage() {
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