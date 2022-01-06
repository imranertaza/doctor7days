<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Cart') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 ">
            <p class="job-tit">Shipping & Payment</p>
        </div>
        <div class="col-12 p-3 ">
            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                <?php echo session()->getFlashdata('message'); ?>
            <?php endif; ?>
        </div>
        <div class="col-12 p-3 ">
            <div class="sp-border " style="text-transform: capitalize;">

                <p class="sp-he">Shipping Address</p>
                <p><?php echo newSession()->Patient_name; ?></p>

                <p class="sp-add"><?php echo divisionname($address->division) ?>
                    ,<?php echo districtname($address->zila) ?>,<?php echo upazilaname($address->upazila) ?></p>

                <a href="#" onclick="showModal()"><i class="flaticon-pencil sp-pen-ic"></i></a>
            </div>
        </div>
        <div class="col-12 p-3 ">
            <div class="sp-border ">
                <p class="sp-he">Payment Method</p>
                <div style="width: 12%; float: left; "><i class="flaticon-credit-card" style="font-size: 25px;"></i>
                </div>
                <div style="width: 88%; float: left;padding-top: 4px; "><label class="sp-cr-t">Visa **** 0959</label>
                </div>
                <br>
                <i class="flaticon-pencil sp-pen-ic2"></i>
            </div>
        </div>
        <form action="<?php echo base_url('Mobile_app/Cart/checkout')?>" method="post" style="width: 100%;">
            <div class="col-12 p-3 row" style="padding-right: 0px !important;">
                <div class="col-12 row" style="padding-right: 0px !important;">
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
                </div>
                <div class="col-12" style="padding-right: 0px !important;">
                    <button type="submit" class="btn-check">Checkout</button>
                </div>

            </div>
        </form>
    </div>
</section>

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
                        <select class="form-control in-c" name="upazila" id="subdistrict"
                                onchange="checkCity(this.value)" required>
                            <option value="">Please Select</option>
                            <?php echo upazilaselect($address->upazila); ?>
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