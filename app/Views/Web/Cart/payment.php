<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Checkout</h1>
            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                <?php echo session()->getFlashdata('message'); ?>
            <?php endif; ?>
        </div>
        <div class="service-inner">
            <div class="row">
                <div class="col-6">
                    <div class="card" style="min-height: 150px;">
                        <div class="card-body">
                            <h5>Shipping Address</h5>
                            <a href="#" onclick="showModal()" style="float: right;"><i class="flaticon-pencil sp-pen-ic"></i></a>
                            <p>Name: <?php echo newSession()->Patient_name; ?>

                            <br>Address: <?php echo divisionname($address->division) ?>,<?php echo districtname($address->zila) ?>,<?php echo upazilaname($address->upazila) ?></p>


                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="min-height: 150px;">
                        <div class="card-body">
                            <h5>Payment Method</h5>
                            <a href="#" style="float: right;"><i class="flaticon-pencil sp-pen-ic2"></i></a>
                            <p><i class="flaticon-credit-card"></i> Visa **** 0959</p>


                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url('Web/Cart/checkout')?>" method="post" >
                            <div class="row">

                                <div class="col-8 wish-list">
                                    <p class="font-15">Price:</p>
                                    <p class="font-15">Shipping:</p>
                                    <p class="font-15">Total price:</p>
                                </div>
                                <div class="col-4 pad-0 text-right ">
                                    <p class="font-15"><?php print priceSymbol(Cart()->total()); ?></p>
                                    <?php $shipp = (!empty(Cart()->contents())) ? 100 : 0; ?>
                                    <p class="font-15"><?php echo priceSymbol($shipp); ?></p>
                                    <p><b><?php echo priceSymbol(Cart()->total() + $shipp); ?></b></p>
                                    <input type="hidden" name="shippingAdd" value="<?php echo $address->global_address_id;?>" required>
                                    <input type="hidden" name="total" value="<?php echo Cart()->total();?>" required>
                                    <input type="hidden" name="shipping" value="<?php echo $shipp;?>" required>
                                    <input type="hidden" name="grandTotal" value="<?php echo Cart()->total() + $shipp;?>" required>
                                </div>
                                <div class="col-12 text-right ">
                                    <button type="submit" class="btn-check2">Checkout</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->

<div class="modal fade" id="address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Address Set</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="address-update" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="division" class="lab-t"> Division </label>
                        <select class="form-control in-c" name="division" onchange="viewdistrict(this.value)" required>
                            <option value="">Please Select</option>
                            <?php echo divisionView(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zila" class="lab-t"> Zila </label>
                        <select class="form-control in-c" name="zila" onchange="viewupazila(this.value)" id="district"
                                required>
                            <option value="">Please Select</option>
                            <?php echo districtselect(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="upazila" class="lab-t"> Upazila: </label>
                        <select class="form-control in-c" name="upazila" id="subdistrict" required>
                            <option value="">Please Select</option>
                            <?php echo upazilaselect(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>