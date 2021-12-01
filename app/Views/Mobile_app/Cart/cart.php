<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Shop') ?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row">
        <div class="col-12 ">
            <p class="sop-ct">Shopping Cart</p>
        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 row" id="reloadCart" style="text-transform: capitalize;">
            <?php foreach (Cart()->contents() as $val){ $img = get_data_by_id('picture','products','prod_id',$val['id']); $qty = get_data_by_id('quantity','products','prod_id',$val['id']); ?>
            <div class="col-12 mt-4 row">
                <div class="col-5 pad-0" >
                    <img src="<?php echo base_url('assets/upload/product/'.$val['id'].'/'.$img) ?>"  width="100%">
                </div>
                <div class="col-6 pad-0 pro-data" >
                    <p class="pro-n"><?php echo $val['name'];?></p>
                    <p class="pro-sub">NO12345</p>
                    <p class="pro-sub">Size: S</p>
                    <p class="pro-pri"><?php echo priceSymbol($val['price']);?></p>
                </div>
                <div class="col-1 pad-0">
                    <a href="" onclick="removeCart('<?php echo $val['rowid'];?>')" > <i class="flaticon-delete"></i></a>
                </div>
                <div class="col-12 pt-2 row">
                    <div class="col-6 ">
                        <input type="number" class="form-control in-c" onchange="updateQty(this.value,'<?php echo $val['rowid'];?>')" value="<?php echo $val['qty'];?>" >

                    </div>
                    <div class="col-1 pad-0 wish-list" style="margin-top: 15px;">
                        <i class="flaticon-heart wish-icon"></i>
                    </div>
                    <div class="col-5 pad-0 wish-list" style="margin-top: 11px;">
                        <span class="wish-tit">Move to Wishlist</span>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
<!--        <form action="--><?php //echo base_url('')?><!--" method="post" style="width: 100%;">-->
        <div class="col-12 p-3 row" style="padding-right: 0px !important;">

            <div class="col-12 row" style="padding-right: 0px !important;" id="cartDetail">
                <div class="col-8 wish-list">
                    <p class="font-15">Price:</p>
                    <p class="font-15">Shipping:</p>
                    <p class="font-15">Total price:</p>
                </div>
                <div class="col-4 pad-0 text-right ">
                    <p class="font-15"><?php print priceSymbol(Cart()->total());?></p>
                    <?php $shipp = (!empty(Cart()->contents()))?100:0; ?>
                    <p class="font-15"><?php echo priceSymbol($shipp);?></p>
                    <p><b><?php echo priceSymbol(Cart()->total()+$shipp); ?></b></p>
                </div>
            </div>
            <div class="col-12" style="padding-right: 0px !important;">
                <?php if (!empty(Cart()->contents())){ ?>
                <a href="<?php echo base_url('Mobile_app/Cart/payment')?>" type="submit" class="btn-check">Checkout</a>
                <?php }else{ ?>
                    <button type="submit" class="btn-check">Checkout</button>
                <?php }?>
            </div>

        </div>
<!--        </form>-->
    </div>
</section>