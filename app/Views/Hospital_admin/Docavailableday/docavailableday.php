<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctor&#39;s Available Day</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Doctor&#39;s Available Day</li>
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
                                <h3 class="card-title">Doctor&#39;s Available Day</h3>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Doc avil id</th>
                                <th>Doc id</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday time</th>
                                <th>Sunday time</th>
                                <th>Monday time</th>
                                <th>Tuesday time</th>
                                <th>Wednesday time</th>
                                <th>Thursday time</th>
                                <th>Friday time</th>
                                <th>CreatedDtm</th>
                                <th>CreatedBy</th>
                                <th>UpdatedDtm</th>
                                <th>UpdatedBy</th>
                                <th>Deleted</th>
                                <th>DeletedRole</th>

                                <th></th>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Add</h4>
                </div>
                <div class="modal-body">
                    <form id="add-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="docAvilId" name="docAvilId" class="form-control" placeholder="Doc avil id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="docId"> Doc id: <span class="text-danger">*</span> </label>
                                    <input type="number" id="docId" name="docId" class="form-control" placeholder="Doc id" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="saturday"> Saturday: </label>
                                    <input type="text" id="saturday" name="saturday" class="form-control" placeholder="Saturday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sunday"> Sunday: </label>
                                    <input type="text" id="sunday" name="sunday" class="form-control" placeholder="Sunday" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="monday"> Monday: </label>
                                    <input type="text" id="monday" name="monday" class="form-control" placeholder="Monday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tuesday"> Tuesday: </label>
                                    <input type="text" id="tuesday" name="tuesday" class="form-control" placeholder="Tuesday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wednesday"> Wednesday: </label>
                                    <input type="text" id="wednesday" name="wednesday" class="form-control" placeholder="Wednesday" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thursday"> Thursday: </label>
                                    <input type="text" id="thursday" name="thursday" class="form-control" placeholder="Thursday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="friday"> Friday: </label>
                                    <input type="text" id="friday" name="friday" class="form-control" placeholder="Friday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="saturdayTime"> Saturday time: </label>
                                    <input type="text" id="saturdayTime" name="saturdayTime" class="form-control" placeholder="Saturday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sundayTime"> Sunday time: </label>
                                    <input type="text" id="sundayTime" name="sundayTime" class="form-control" placeholder="Sunday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mondayTime"> Monday time: </label>
                                    <input type="text" id="mondayTime" name="mondayTime" class="form-control" placeholder="Monday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tuesdayTime"> Tuesday time: </label>
                                    <input type="text" id="tuesdayTime" name="tuesdayTime" class="form-control" placeholder="Tuesday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wednesdayTime"> Wednesday time: </label>
                                    <input type="text" id="wednesdayTime" name="wednesdayTime" class="form-control" placeholder="Wednesday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thursdayTime"> Thursday time: </label>
                                    <input type="text" id="thursdayTime" name="thursdayTime" class="form-control" placeholder="Thursday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fridayTime"> Friday time: </label>
                                    <input type="text" id="fridayTime" name="fridayTime" class="form-control" placeholder="Friday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="createdDtm" name="createdDtm" class="form-control" placeholder="CreatedDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdBy"> CreatedBy: <span class="text-danger">*</span> </label>
                                    <input type="number" id="createdBy" name="createdBy" class="form-control" placeholder="CreatedBy" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedDtm"> UpdatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="updatedDtm" name="updatedDtm" class="form-control" placeholder="UpdatedDtm" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deleted"> Deleted: </label>
                                    <input type="number" id="deleted" name="deleted" class="form-control" placeholder="Deleted" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deletedRole"> DeletedRole: </label>
                                    <input type="number" id="deletedRole" name="deletedRole" class="form-control" placeholder="DeletedRole" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="docAvilId" name="docAvilId" class="form-control" placeholder="Doc avil id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="docId"> Doc id: <span class="text-danger">*</span> </label>
                                    <input type="number" id="docId" name="docId" class="form-control" placeholder="Doc id" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="saturday"> Saturday: </label>
                                    <input type="text" id="saturday" name="saturday" class="form-control" placeholder="Saturday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sunday"> Sunday: </label>
                                    <input type="text" id="sunday" name="sunday" class="form-control" placeholder="Sunday" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="monday"> Monday: </label>
                                    <input type="text" id="monday" name="monday" class="form-control" placeholder="Monday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tuesday"> Tuesday: </label>
                                    <input type="text" id="tuesday" name="tuesday" class="form-control" placeholder="Tuesday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wednesday"> Wednesday: </label>
                                    <input type="text" id="wednesday" name="wednesday" class="form-control" placeholder="Wednesday" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thursday"> Thursday: </label>
                                    <input type="text" id="thursday" name="thursday" class="form-control" placeholder="Thursday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="friday"> Friday: </label>
                                    <input type="text" id="friday" name="friday" class="form-control" placeholder="Friday" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="saturdayTime"> Saturday time: </label>
                                    <input type="text" id="saturdayTime" name="saturdayTime" class="form-control" placeholder="Saturday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sundayTime"> Sunday time: </label>
                                    <input type="text" id="sundayTime" name="sundayTime" class="form-control" placeholder="Sunday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mondayTime"> Monday time: </label>
                                    <input type="text" id="mondayTime" name="mondayTime" class="form-control" placeholder="Monday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tuesdayTime"> Tuesday time: </label>
                                    <input type="text" id="tuesdayTime" name="tuesdayTime" class="form-control" placeholder="Tuesday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wednesdayTime"> Wednesday time: </label>
                                    <input type="text" id="wednesdayTime" name="wednesdayTime" class="form-control" placeholder="Wednesday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thursdayTime"> Thursday time: </label>
                                    <input type="text" id="thursdayTime" name="thursdayTime" class="form-control" placeholder="Thursday time" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fridayTime"> Friday time: </label>
                                    <input type="text" id="fridayTime" name="fridayTime" class="form-control" placeholder="Friday time" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="createdDtm" name="createdDtm" class="form-control" placeholder="CreatedDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdBy"> CreatedBy: <span class="text-danger">*</span> </label>
                                    <input type="number" id="createdBy" name="createdBy" class="form-control" placeholder="CreatedBy" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedDtm"> UpdatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="updatedDtm" name="updatedDtm" class="form-control" placeholder="UpdatedDtm" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deleted"> Deleted: </label>
                                    <input type="number" id="deleted" name="deleted" class="form-control" placeholder="Deleted" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deletedRole"> DeletedRole: </label>
                                    <input type="number" id="deletedRole" name="deletedRole" class="form-control" placeholder="DeletedRole" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
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

    function edit(doc_avil_id) {
        $.ajax({
            url: '<?php echo base_url($controller.'/getOne') ?>',
            type: 'post',
            data: {
                doc_avil_id: doc_avil_id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #docAvilId").val(response.doc_avil_id);
                $("#edit-form #docId").val(response.doc_id);
                $("#edit-form #saturday").val(response.saturday);
                $("#edit-form #sunday").val(response.sunday);
                $("#edit-form #monday").val(response.monday);
                $("#edit-form #tuesday").val(response.tuesday);
                $("#edit-form #wednesday").val(response.wednesday);
                $("#edit-form #thursday").val(response.thursday);
                $("#edit-form #friday").val(response.friday);
                $("#edit-form #saturdayTime").val(response.saturday_time);
                $("#edit-form #sundayTime").val(response.sunday_time);
                $("#edit-form #mondayTime").val(response.monday_time);
                $("#edit-form #tuesdayTime").val(response.tuesday_time);
                $("#edit-form #wednesdayTime").val(response.wednesday_time);
                $("#edit-form #thursdayTime").val(response.thursday_time);
                $("#edit-form #fridayTime").val(response.friday_time);
                $("#edit-form #createdDtm").val(response.createdDtm);
                $("#edit-form #createdBy").val(response.createdBy);
                $("#edit-form #updatedDtm").val(response.updatedDtm);
                $("#edit-form #updatedBy").val(response.updatedBy);
                $("#edit-form #deleted").val(response.deleted);
                $("#edit-form #deletedRole").val(response.deletedRole);

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

    function remove(doc_avil_id) {
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
                        doc_avil_id: doc_avil_id
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