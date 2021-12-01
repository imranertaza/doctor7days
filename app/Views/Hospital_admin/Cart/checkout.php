<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Checkout</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
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
                                <h3 class="card-title">Checkout</h3>
                            </div>
                            <div class="col-12 p-3 ">
                                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                    <?php echo session()->getFlashdata('message'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body " style="text-transform: capitalize;">
                        <form action="<?php echo base_url($controller.'/checkoutAction')?>" method="post" >
                            <div class="row">
                                <div class="col-12 row">
                                    <div class="col-4">
                                        <div style="border: 1px solid #e5e5e5;padding: 10px;">
                                            <a href="javascript:void(0);" onclick="upAddress()" style="float: right;"><i class="fas fa-pencil-alt"></i></a>
                                            <h5> Address</h5>
                                            <h6><?php print newSession()->hospitalName; ?></h6>
                                            <p><?php echo divisionname($address->division) ?>
                                                ,<?php echo districtname($address->zila) ?>
                                                ,<?php echo upazilaname($address->upazila) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div style="border: 1px solid #e5e5e5;padding: 10px;">
                                            <a href="" style="float: right;"><i class="fas fa-pencil-alt"></i></a>
                                            <h5>Payment Method</h5>
                                            <p>payment method</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 row" id="cartDetail">
                                    <div class="col-6 mt-4"></div>
                                    <div class="col-6 mt-4 row" style="border: 1px solid #e5e5e5;padding: 10px;">
                                        <div class="col-8">
                                            <p class="font-15">Price:</p>
                                            <p class="font-15">Shipping:</p>
                                            <p class="font-15">Total price:</p>
                                        </div>
                                        <div class="col-4">
                                            <p class="font-15"><?php print priceSymbol(Cart()->total()); ?></p>
                                            <?php $shipp = (!empty(Cart()->contents())) ? 100 : 0; ?>
                                            <p class="font-15"><?php echo priceSymbol($shipp); ?></p>
                                            <p><b><?php echo priceSymbol(Cart()->total() + $shipp); ?></b></p>
                                            <input type="hidden" name="shippingAdd"
                                                   value="<?php echo $address->global_address_id; ?>" required>
                                            <input type="hidden" name="total" value="<?php echo Cart()->total(); ?>"
                                                   required>
                                            <input type="hidden" name="shipping" value="<?php echo $shipp; ?>" required>
                                            <input type="hidden" name="grandTotal"
                                                   value="<?php echo Cart()->total() + $shipp; ?>" required>
                                        </div>
                                        <button style="width: 100%;" class="btn btn-primary">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div id="address-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Address</h4>
                </div>
                <div class="modal-body">
                    <form id="addre-form" class="pl-3 pr-3">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="division"> Division: </label>
                                    <select class="form-control" name="division" onchange="viewdistrict(this.value)" required >
                                        <option value="">Please Select</option>
                                        <?php echo divisionView() ; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="zila"> Zila: </label>
                                    <select class="form-control" name="zila" onchange="viewupazila(this.value)" id="district" required>
                                        <option value="">Please Select</option>
                                        <?php echo districtselect($zila) ; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upazila"> Upazila: </label>
                                    <select class="form-control" name="upazila" id="subdistrict" onchange="checkCity(this.value)"  required>
                                        <option value="">Please Select</option>
                                        <?php echo upazilaselect($upazila) ; ?>
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
    </div>
</div>
<!-- /.content-wrapper -->

<script>
    function upAddress() {
        // reset the form
        $("#addre-form")[0].reset();
        $('#address-modal').modal('show');

        $('#addre-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "<?= base_url('ajax/addressUpdateHospital') ?>",
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    if (data.success == true) {
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        $("#address-modal").modal('hide');
                        location.reload();

                    }else {
                        Toast.fire({
                            icon: 'error',
                            title: data.msg
                        })
                        $("#address-modal").modal('hide');
                        // location.reload();
                    }
                }
            });
        });
    }
</script>

