<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                                <h3 class="card-title">Invoice</h3>
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
                                <th>Invoice id</th>
                                <th>Patient id</th>
                                <th>Pymnt method id</th>
                                <th>Amount</th>
                                <th>Entire sale discount</th>
                                <th>Vat</th>
                                <th>Delivery charge</th>
                                <th>Final amount</th>
                                <th>Profit</th>
                                <th>Cash paid</th>
                                <th>Due</th>
                                <th>Global address id</th>
                                <th>Creation timestamp</th>
                                <th>Payment timestamp</th>
                                <th>Payment method</th>
                                <th>Payment details</th>
                                <th>Status</th>
                                <th>Timestamp</th>
                                <th>Year</th>
                                <th>CreatedDtm</th>
                                <th>CreatedBy</th>
                                <th>UpdatedBy</th>
                                <th>UpdatedDtm</th>
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
                            <input type="hidden" id="invoiceId" name="invoiceId" class="form-control" placeholder="Invoice id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="patientId"> Patient id: </label>
                                    <input type="number" id="patientId" name="patientId" class="form-control" placeholder="Patient id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pymntMethodId"> Pymnt method id: </label>
                                    <input type="number" id="pymntMethodId" name="pymntMethodId" class="form-control" placeholder="Pymnt method id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount"> Amount: <span class="text-danger">*</span> </label>
                                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="entireSaleDiscount"> Entire sale discount: </label>
                                    <input type="number" id="entireSaleDiscount" name="entireSaleDiscount" class="form-control" placeholder="Entire sale discount" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vat"> Vat: </label>
                                    <input type="number" id="vat" name="vat" class="form-control" placeholder="Vat" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deliveryCharge"> Delivery charge: </label>
                                    <input type="number" id="deliveryCharge" name="deliveryCharge" class="form-control" placeholder="Delivery charge" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="finalAmount"> Final amount: <span class="text-danger">*</span> </label>
                                    <input type="text" id="finalAmount" name="finalAmount" class="form-control" placeholder="Final amount" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profit"> Profit: <span class="text-danger">*</span> </label>
                                    <input type="text" id="profit" name="profit" class="form-control" placeholder="Profit" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cashPaid"> Cash paid: </label>
                                    <input type="text" id="cashPaid" name="cashPaid" class="form-control" placeholder="Cash paid" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="due"> Due: </label>
                                    <input type="text" id="due" name="due" class="form-control" placeholder="Due" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="globalAddressId"> Global address id: </label>
                                    <input type="number" id="globalAddressId" name="globalAddressId" class="form-control" placeholder="Global address id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="creationTimestamp"> Creation timestamp: </label>
                                    <input type="number" id="creationTimestamp" name="creationTimestamp" class="form-control" placeholder="Creation timestamp" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentTimestamp"> Payment timestamp: </label>
                                    <textarea cols="40" rows="5" id="paymentTimestamp" name="paymentTimestamp" class="form-control" placeholder="Payment timestamp" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentMethod"> Payment method: </label>
                                    <textarea cols="40" rows="5" id="paymentMethod" name="paymentMethod" class="form-control" placeholder="Payment method" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentDetails"> Payment details: </label>
                                    <textarea cols="40" rows="5" id="paymentDetails" name="paymentDetails" class="form-control" placeholder="Payment details" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status"> Status: <span class="text-danger">*</span> </label>
                                    <input type="text" id="status" name="status" class="form-control" placeholder="Status" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="timestamp"> Timestamp: <span class="text-danger">*</span> </label>
                                    <input type="text" id="timestamp" name="timestamp" class="form-control" placeholder="Timestamp" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year"> Year: </label>
                                    <textarea cols="40" rows="5" id="year" name="year" class="form-control" placeholder="Year" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="date" id="createdDtm" name="createdDtm" class="form-control" dateISO="true" required>
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
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedDtm"> UpdatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="date" id="updatedDtm" name="updatedDtm" class="form-control" dateISO="true" required>
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
                            <input type="hidden" id="invoiceId" name="invoiceId" class="form-control" placeholder="Invoice id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="patientId"> Patient id: </label>
                                    <input type="number" id="patientId" name="patientId" class="form-control" placeholder="Patient id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pymntMethodId"> Pymnt method id: </label>
                                    <input type="number" id="pymntMethodId" name="pymntMethodId" class="form-control" placeholder="Pymnt method id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount"> Amount: <span class="text-danger">*</span> </label>
                                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="entireSaleDiscount"> Entire sale discount: </label>
                                    <input type="number" id="entireSaleDiscount" name="entireSaleDiscount" class="form-control" placeholder="Entire sale discount" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vat"> Vat: </label>
                                    <input type="number" id="vat" name="vat" class="form-control" placeholder="Vat" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deliveryCharge"> Delivery charge: </label>
                                    <input type="number" id="deliveryCharge" name="deliveryCharge" class="form-control" placeholder="Delivery charge" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="finalAmount"> Final amount: <span class="text-danger">*</span> </label>
                                    <input type="text" id="finalAmount" name="finalAmount" class="form-control" placeholder="Final amount" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profit"> Profit: <span class="text-danger">*</span> </label>
                                    <input type="text" id="profit" name="profit" class="form-control" placeholder="Profit" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cashPaid"> Cash paid: </label>
                                    <input type="text" id="cashPaid" name="cashPaid" class="form-control" placeholder="Cash paid" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="due"> Due: </label>
                                    <input type="text" id="due" name="due" class="form-control" placeholder="Due" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="globalAddressId"> Global address id: </label>
                                    <input type="number" id="globalAddressId" name="globalAddressId" class="form-control" placeholder="Global address id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="creationTimestamp"> Creation timestamp: </label>
                                    <input type="number" id="creationTimestamp" name="creationTimestamp" class="form-control" placeholder="Creation timestamp" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentTimestamp"> Payment timestamp: </label>
                                    <textarea cols="40" rows="5" id="paymentTimestamp" name="paymentTimestamp" class="form-control" placeholder="Payment timestamp" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentMethod"> Payment method: </label>
                                    <textarea cols="40" rows="5" id="paymentMethod" name="paymentMethod" class="form-control" placeholder="Payment method" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paymentDetails"> Payment details: </label>
                                    <textarea cols="40" rows="5" id="paymentDetails" name="paymentDetails" class="form-control" placeholder="Payment details" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status"> Status: <span class="text-danger">*</span> </label>
                                    <input type="text" id="status" name="status" class="form-control" placeholder="Status" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="timestamp"> Timestamp: <span class="text-danger">*</span> </label>
                                    <input type="text" id="timestamp" name="timestamp" class="form-control" placeholder="Timestamp" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year"> Year: </label>
                                    <textarea cols="40" rows="5" id="year" name="year" class="form-control" placeholder="Year" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="date" id="createdDtm" name="createdDtm" class="form-control" dateISO="true" required>
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
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedDtm"> UpdatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="date" id="updatedDtm" name="updatedDtm" class="form-control" dateISO="true" required>
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

    function edit(invoice_id) {
        $.ajax({
            url: '<?php echo base_url($controller.'/getOne') ?>',
            type: 'post',
            data: {
                invoice_id: invoice_id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #invoiceId").val(response.invoice_id);
                $("#edit-form #patientId").val(response.patient_id);
                $("#edit-form #pymntMethodId").val(response.pymnt_method_id);
                $("#edit-form #amount").val(response.amount);
                $("#edit-form #entireSaleDiscount").val(response.entire_sale_discount);
                $("#edit-form #vat").val(response.vat);
                $("#edit-form #deliveryCharge").val(response.delivery_charge);
                $("#edit-form #finalAmount").val(response.final_amount);
                $("#edit-form #profit").val(response.profit);
                $("#edit-form #cashPaid").val(response.cash_paid);
                $("#edit-form #due").val(response.due);
                $("#edit-form #globalAddressId").val(response.global_address_id);
                $("#edit-form #creationTimestamp").val(response.creation_timestamp);
                $("#edit-form #paymentTimestamp").val(response.payment_timestamp);
                $("#edit-form #paymentMethod").val(response.payment_method);
                $("#edit-form #paymentDetails").val(response.payment_details);
                $("#edit-form #status").val(response.status);
                $("#edit-form #timestamp").val(response.timestamp);
                $("#edit-form #year").val(response.year);
                $("#edit-form #createdDtm").val(response.createdDtm);
                $("#edit-form #createdBy").val(response.createdBy);
                $("#edit-form #updatedBy").val(response.updatedBy);
                $("#edit-form #updatedDtm").val(response.updatedDtm);
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

    function remove(invoice_id) {
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
                        invoice_id: invoice_id
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