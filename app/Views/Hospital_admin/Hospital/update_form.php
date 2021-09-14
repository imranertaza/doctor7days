<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hospital Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Hospital Update</li>
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
                                        <a class="nav-link" data-toggle="tab" href="#image">Images</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
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
                                                        <input type="text" id="name" name="name" class="form-control"
                                                               value="<?php echo $hospital->name; ?>" required>
                                                        <input type="hidden" id="h_id" name="h_id"
                                                               value="<?php echo $hospital->h_id; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email"> Email: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                               value="<?php echo $hospital->email; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone"> Phone: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="phone" name="phone" class="form-control"
                                                               value="<?php echo $hospital->mobile; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status"> Status: <span class="text-danger">*</span>
                                                        </label>
                                                        <select id="status" name="status" class="form-control" required>
                                                            <?php echo globalStatus($hospital->status)?>
                                                        </select>
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
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success"
                                                            id="add-form-btn"
                                                            style="float: right;">Update
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>


                                    <div class="tab-pane container" id="basic">
                                        <form id="updaue-basic" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description"> Description: </label>
                                                        <textarea cols="40" rows="5" id="description" name="description"
                                                                  class="form-control" placeholder="Description"
                                                                  required><?php echo $hospital->description; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="comment"> Comment: </label>
                                                        <textarea cols="40" rows="5" id="comment" name="comment"
                                                                  class="form-control"
                                                                  placeholder="Comment"><?php echo $hospital->comment; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="is_default">Is Default: </label>
                                                        <select id="is_default" name="is_default" class="form-control" required>
                                                            <?php echo globalStatus($hospital->is_default)?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">

                                                    <button type="submit" onclick="updateBasic()" class="btn btn-success"
                                                            id="up-basic-btn" style="margin-top: 30px;" >Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="image">
                                        <form id="updaue-image" class="pl-3 pr-3">
                                            <div class="row pt-4">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Logo: </label>
                                                        <input type="file" id="logo" name="logo" class="form-control" placeholder="Logo" maxlength="155" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="image"> Image: </label>
                                                        <input type="file" id="image" name="image" class="form-control" placeholder="Image" maxlength="155" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="banner"> Banner: </label>
                                                        <input type="file" id="banner" name="banner" class="form-control" placeholder="Banner" maxlength="155" >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">

                                                    <button type="submit" onclick="updateimage()" class="btn btn-success"
                                                            id="up-image-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane container" id="address">
                                        <form id="updaue-address" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="division"> Division: </label>
                                                        <select class="form-control" name="division" onchange="viewdistrict(this.value)" required >
                                                            <option value="">Please Select</option>
                                                            <?php echo divisionView() ; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="zila"> Zila: </label>
                                                        <select class="form-control" name="zila" onchange="viewupazila(this.value)" id="district" required>
                                                            <option value="">Please Select</option>
                                                            <?php echo districtselect($zila) ; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="upazila"> Upazila: </label>
                                                        <select class="form-control" name="upazila" id="subdistrict" onchange="checkCity(this.value)"  required>
                                                            <option value="">Please Select</option>
                                                            <?php echo upazilaselect($upazila) ; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <button type="submit" onclick="updateimage()" class="btn btn-success"
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
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function updateReg() {
        // reset the form
        //$("#updaue-reg")[0].reset();
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
                                //$('#add-modal').modal('hide');
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
</script>