<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-shop ti-icon"></i>
            </div>
            <div class="col-10 p-2" id="reloadCart">
                <span class="title-m">Your Shop</span>
                <a href="<?php echo base_url('Mobile_app/Cart') ?>" style="float: right"><i
                            class="flaticon-shopping-cart ic-shop"></i>(<?php echo Cart()->totalItems(); ?>)</a>
                <i class="flaticon-heart ic-shop ic-shop" style="padding-right: 20px;"></i>
            </div>
        </div>

    </div>
</section>

<section class="banner">
    <div class="row">
        <?php if (session()->getFlashdata('message') !== NULL) : ?>
            <div class="col-12 p-3 ">
                <?php echo session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 p-3" style="padding-left: 0px !important; padding-right: 0px !important;">
            <?php  $img = no_image_view('/assets/mobile/image/shop.png','/assets/mobile/image/no_image.jpg');?>
            <img src="<?php echo $img ?>" width="100%">
        </div>
        <form method="get">
        <div class="col-12 p-3 ">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <button type="submit" class="input-group-text sear-icon btn"><i class="flaticon-loupe"></i></button>
                </div>
                <input type="text" name="search" class="form-control sear-inp" value="<?php echo $key; ?>" placeholder="Search">
            </div>
        </div>
        </form>
        <div class="col-12 p-3 " style="padding-right: 0px !important;  ">

            <?php foreach ($product as $item) { ?>
                <div class="" style=" width: 50%;float: left">

                    <div class="col-12 pad-0">
                        <a href="<?php echo base_url('Mobile_app/Shop/product_detail/' . $item->prod_id) ?>">
                            <?php $proImg = no_image_view('/assets/upload/product/' .$item->prod_id.'/'.$item->picture,'/assets/upload/product/no_image.jpg',$item->picture);?>
                            <img src="<?php echo $proImg ?>"
                                 width="100%">
                        </a>
                    </div>
                    <div class="col-12 pad-0 p-3" style="line-height: 4px;">
                        <a href="<?php echo base_url('Mobile_app/Shop/product_detail/' . $item->prod_id) ?>">
                            <p class="p-n"><?php echo $item->name; ?></p>
                            <span class="p-p"><?php echo priceSymbol($item->price); ?></span>
                            <span class="p-s">Quentaty: (<?php echo $item->quantity; ?>)</span>
                        </a>
                    </div>
                    <div class="col-12 pad-0 p-3">
                        <button class="btn-cart" onclick="addToCart('<?php echo $item->prod_id ?>')">Add to Cart
                        </button>
                    </div>
                </div>

            <?php } ?>


        </div>
    </div>
</section>