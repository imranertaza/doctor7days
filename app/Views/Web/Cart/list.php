<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Cart list</h1>
        </div>
        <div class="service-inner">
            <div class="row">
                <div class="col-12 p-3 row" id="reloadtable" style="text-transform: capitalize;">
                    <?php foreach (Cart()->contents() as $val) {
                        $img = get_data_by_id('picture', 'products', 'prod_id', $val['id']);
                        $qty = get_data_by_id('quantity', 'products', 'prod_id', $val['id']); ?>
                        <div class="col-12 mt-2 row" style="border: 1px solid #f3efef; padding: 20px;">
                            <div class="col-4 pad-0 d-flex justify-content-center align-items-center ">
                                <?php $pro = no_image_view('/assets/upload/product/'.$val['id'].'/'. $img,'/assets/upload/product/no_image.jpg',$img)?>
                                <img src="<?php echo $pro; ?>" width="150">
                            </div>
                            <div class="col-6 pad-0 pro-data " style="line-height: 10px;">
                                <p><b><?php echo $val['name']; ?></b></p>
                                <p class="pro-sub">NO12345</p>
                                <p class="pro-sub">Size: S</p>
                                <p><b><?php echo priceSymbol($val['price']); ?></b></p>
                            </div>
                            <div class="col-2 pad-0">
                                <a href="" onclick="removeCart('<?php echo $val['rowid']; ?>')"> <i
                                            class="flaticon-delete"></i></a>
                            </div>
                            <div class="col-12 pt-2 row">
                                <div class="col-4 ">
                                    <input type="number" class="form-control in-c"
                                           onchange="updateQty(this.value,'<?php echo $val['rowid']; ?>')"
                                           value="<?php echo $val['qty']; ?>">

                                </div>
                                <div class="col-8 pad-0 wish-list" style="margin-top: 11px;">
                                    <i class="flaticon-heart wish-icon"></i> <span
                                            class="wish-tit">Move to Wishlist</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-12 mt-2 row"
                         style="padding-right: 0px !important; border: 1px solid #f3efef; padding: 20px;"
                         id="cartDetail">
                        <div class="col-8 wish-list text-right ">
                            <p class="font-15">Price:</p>
                            <p class="font-15">Shipping:</p>
                            <p class="font-15">Total price:</p>
                        </div>
                        <div class="col-4 pad-0 text-center ">
                            <p class="font-15"><?php print priceSymbol(Cart()->total()); ?></p>
                            <?php $shipp = (!empty(Cart()->contents())) ? 100 : 0; ?>
                            <p class="font-15"><?php echo priceSymbol($shipp); ?></p>
                            <p><b><?php echo priceSymbol(Cart()->total() + $shipp); ?></b></p>
                        </div>

                        <div class="col-12 text-right">
                            <?php if (!empty(Cart()->contents())) { ?>
                                <a href="<?php echo base_url('Web/Cart/payment') ?>" type="submit"
                                   class=" btn-check">Checkout</a>
                            <?php } else { ?>
                                <button type="submit" class=" btn-check">Checkout</button>
                            <?php } ?>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>
<!-- services area  end-->