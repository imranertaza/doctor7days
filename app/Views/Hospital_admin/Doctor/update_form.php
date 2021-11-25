<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctor Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Doctor Update</li>
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
                                        <a class="nav-link" data-toggle="tab" href="#avilDay">Doctor's Available Day</a>
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
                                                               value="<?php echo $doctor->name; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email"> Email: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                               value="<?php echo $doctor->email; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone"> Phone: <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="mobile" name="mobile"
                                                               class="form-control"
                                                               value="<?php echo $doctor->mobile; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status"> Specialist: <span
                                                                    class="text-danger">*</span>
                                                        </label>
                                                        <select id="specialistId" name="specialistId"
                                                                class="form-control" placeholder="Specialist" required>
                                                            <option value="">Please select</option>
                                                            <?php echo getListInOption($doctor->specialist_id, 'specialist_id', 'specialist_type_name', 'specialist') ?>
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
                                                    <input type="hidden" id="doc_id" name="doc_id"
                                                           value="<?php echo $doctor->doc_id; ?>" required>
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
                                                        <label for="comment"> NID: </label>
                                                        <input type="text" id="nid" name="nid"
                                                               class="form-control" placeholder="NID number"
                                                               value="<?php echo $doctor->nid; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description"> Description: </label>
                                                        <textarea cols="40" rows="5" id="description" name="description"
                                                                  class="form-control"
                                                                  placeholder="Description"><?php echo $doctor->description; ?></textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-6 text-center">
                                                    <input type="hidden" id="doc_id" name="doc_id"
                                                           value="<?php echo $doctor->doc_id; ?>" required>
                                                    <button type="submit" onclick="updateBasic()"
                                                            class="btn btn-success"
                                                            id="up-basic-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="image">
                                        <!--    id="update-image"   action="<?php //echo base_url($controller . '/updateImage') ?>" method="Post"-->
                                        <form id="update-image" method="Post" class="pl-3 pr-3" enctype="multipart/form-data">
                                            <div class="row pt-4">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo"> Profile Image: </label>
                                                        <input type="file" id="pic" name="pic" class="form-control"
                                                               placeholder="Logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="imgRelode">
                                                    <?php $img = (!empty($doctor->pic)) ? $doctor->pic : 'noimage.jpg'; ?>
                                                    <img src="<?php echo base_url() ?>/assets/upload/doctor/<?php echo $doctor->doc_id;?>/<?php echo $img ?>"
                                                         style="max-width: 200px;">
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <input type="hidden" id="doc_id" name="doc_id"
                                                           value="<?php echo $doctor->doc_id; ?>" required>
                                                    <button type="submit" onclick="updateimage()"
                                                            class="btn btn-success"
                                                            id="up-image-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane container" id="avilDay">


                                        <form id="update-avilDay" class="pl-3 pr-3">
                                            <div class="row pt-4">



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="saturdayTime"> Saturday time: </label>
                                                        <select id="saturdayTime" name="saturday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->saturday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->saturday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->saturday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="sundayTime"> Sunday time: </label>

                                                        <select id="sundayTime" name="sunday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->sunday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->sunday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->sunday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="mondayTime"> Monday time: </label>
                                                        <select id="mondayTime" name="monday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->monday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->monday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->monday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="tuesdayTime"> Tuesday time: </label>
                                                        <select id="tuesdayTime" name="tuesday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->tuesday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->tuesday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->tuesday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="wednesdayTime"> Wednesday time: </label>
                                                        <select id="wednesdayTime" name="wednesday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->wednesday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->wednesday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->wednesday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="thursdayTime"> Thursday time: </label>
                                                        <select id="thursdayTime" name="thursday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->thursday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->thursday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->thursday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="fridayTime"> Friday time: </label>

                                                        <select id="fridayTime" name="friday" class="form-control">
                                                            <option value="">Please select</option>
                                                            <option value="morning" <?php if($day->friday == 'morning'){echo 'selected';}?> >Morning</option>
                                                            <option value="evening" <?php if($day->friday == 'evening'){echo 'selected';}?> >Evening</option>
                                                            <option value="both" <?php if($day->friday == 'both'){echo 'selected';}?>>Both</option>
                                                        </select>
                                                    </div>

                                                    <h5>Booking date</h5>
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Start Date: </label>
                                                            <input type="date" class="form-control" name="appointment_start_date" value="<?php echo $day->appointment_start_date; ?>">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> End Date: </label>
                                                            <input type="date" class="form-control" name="appointment_end_date" value="<?php echo $day->appointment_end_date; ?>">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-6">


                                                    <h5>Doctor available time </h5>
                                                    <div class="row" style="border: 1px solid #eaeaeb; padding: 20px;">
                                                        <div class="form-group col-12 text-center">
                                                        <h5>Morning</h5>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <h6>Start time</h6>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Hour: </label>
                                                            <input type="text" class="form-control" name="morning_start_hour">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Minute: </label>
                                                            <input type="text" class="form-control" name="morning_start_minute">
                                                        </div>

                                                        <div class="form-group col-12">
                                                            <h6>End time</h6>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Hour: </label>
                                                            <input type="text" class="form-control" name="morning_end_hour">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Minute: </label>
                                                            <input type="text" class="form-control" name="morning_end_minute">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="fridayTime"> Total patient:  </label>
                                                            <input type="text" class="form-control" name="qty_in_morning" value="<?php echo $day->qty_in_morning; ?>">
                                                        </div>

                                                    </div>

                                                    <div class="row mt-3" style="border: 1px solid #eaeaeb; padding: 20px;">
                                                        <div class="form-group col-12 text-center">
                                                            <h5>Evening</h5>
                                                        </div>
                                                        <div class="form-group col-12 ">
                                                            <h6>Start time</h6>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <?php
                                                            $evStTi =  $day->evening_start_time;
                                                            $evStTi =  '3:00';
                                                            $sub =   '';
                                                            $string = str_ireplace($sub, ": ", $evStTi);
                                                            //echo $string;

                                                            $search  = array('A', 'B','C');
                                                            $replace = array('B');
                                                            $subject = 'D';
//                                                            echo str_replace($search, $replace, $subject);
                                                            ?>
                                                            <label for="fridayTime"> Hour: </label>
                                                            <input type="text" class="form-control" name="evening_start_hour">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Minute: </label>
                                                            <input type="text" class="form-control" name="evening_start_minute">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <h6>End time</h6>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Hour: </label>
                                                            <input type="text" class="form-control" name="evening_end_hour">
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="fridayTime"> Minute: </label>
                                                            <input type="text" class="form-control" name="evening_end_minute">
                                                        </div>

                                                        <div class="form-group col-12">
                                                            <label for="fridayTime"> Total patient:  </label>
                                                            <input type="text" class="form-control" name="qty_in_evening" value="<?php echo $day->qty_in_evening; ?>">
                                                        </div>

                                                    </div>

                                                    <div class="row mt-3" style="border: 1px solid #eaeaeb; padding: 20px;">
                                                        <div class="form-group col-12 text-center">
                                                            <h6>Holidays</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <?php  $holidays =  json_decode($day->holidays);
                                                            if (!empty($holidays)){ foreach ($holidays as $row){
                                                            ?>
                                                            <div id="inputFormRow">
                                                                <div class="input-group mb-3">
                                                                    <input type="date" name="holidays[]" class="form-control"  autocomplete="off" value="<?php echo $row; ?>">
                                                                    <div class="input-group-append">
                                                                        <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } } ?>

                                                            <div id="newRow"></div>
                                                            <button id="addRow" type="button" class="form-control" class="btn btn-default" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-12 text-right">
                                                    <input type="hidden" id="doc_avil_id" name="doc_avil_id"
                                                           value="<?php echo $day->doc_avil_id; ?>" required>
                                                    <button type="submit" onclick="updateavilavil()"
                                                            class="btn btn-success"
                                                            id="up-avilDay-btn" style="margin-top: 30px;">Update
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

    function updateaddress() {
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
                            });

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
                        $('#up-address-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#update-address').validate();
    }

    function updateavilavil() {
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
                var form = $('#update-avilDay');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/updateApoDay') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function () {
                        $('#up-avilDay-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {

                        if (response.success === true) {

                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            });

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
                        $('#up-avilDay-btn').html('Update');
                    }
                });

                return false;
            }
        });
        $('#update-avilDay').validate();
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

    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="date" name="holidays[]" class="form-control"  autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });


</script>