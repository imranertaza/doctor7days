<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3" id="reloadCart">
            <a href="<?php echo base_url('mobile_app/shop')?>" ><i class="flaticon-left-arrow back-icon"></i></a>

            <a href="<?php echo base_url('Mobile_app/Cart')?>" style="float: right;padding-right: 20px;" ><i class="flaticon-shopping-cart ic-shop"></i>(<?php echo Cart()->totalItems();?>)</a>
        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 text-center">
            <img src="<?php echo base_url('assets/upload/product/'.$product->prod_id.'/'.$product->picture) ?>">

        </div>
        <div class="col-12 p-3 text-center" style="text-transform: capitalize;">
            <p class="pro-pr"><?php echo priceSymbol($product->price)?></p>
            <p class="pro-n-d"><?php echo $product->name?></p>
            <p class="pro-ic">
                <i class="flaticon-star" ></i>
                <i class="flaticon-star" ></i>
                <i class="flaticon-star" ></i>
                <i class="flaticon-star" ></i>
                <i class="flaticon-star" ></i>
            </p>
        </div>

        <div class="col-12 p-3 row" style="padding-right: 0px !important;margin-top: -25px; ">

            <div class="col-6 " style="padding-right: 0px !important;">
                <select class="form-control in-c" name="" id="">
                    <option value="xs">XS</option>
                    <option value="xl">XL</option>
                </select>
            </div>
            <div class="col-6 " style="padding-right: 0px !important;">
                <select class="form-control in-c" name="" id="">
                    <option value="blue">💶 Blue</option>
                    <option value="red" data-icon="glyphicon-music">Red</option>
                </select>
            </div>

            <div class="col-12 pt-3" style="padding-right: 0px !important;">
                <button class="btn-check" onclick="addToCart('<?php echo $product->prod_id;?>')">Add to Cart</button>
            </div>

        </div>

    </div>
</section>