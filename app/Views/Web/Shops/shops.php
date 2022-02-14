<!-- banner image -->
<section>
    <div class="banner-img">
        <?php $banner = no_image_view('/assets/web/image/Web-5.jpg','/assets/web/image/no_image.jpg')?>
        <img class="img-fluid" src="<?php echo $banner; ?>" alt="" />
    </div>
</section>
<!-- banner image end -->


<!-- shop section start -->
<div class="shop_wrapper area-hight">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mt-5">Our Products</h2>
            </div>
        </div>
    </div>
    <!-- products -->
    <div class="products_wrapper mt-4">
        <div class="container">
            <div class="row">
                <?php foreach ($product as $item){?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="products-card mb-3">
                        <a href="<?php echo base_url('Web/Shops/details/'.$item->prod_id)?>">
                            <div class="card text-center" style="width: 100%">
                                <?php $pro = no_image_view('/assets/upload/product/'.$item->prod_id.'/'. $item->picture,'/assets/upload/product/no_image.jpg',$item->picture)?>
                                <img src="<?php echo $pro; ?>"class="img-fluid mt-3" alt="Product image"  />
                                <div class="card-body">
                                    <h5 class="card-title m-0"><?php echo $item->name?></h5>
                                    <p><span>TK. <?php echo $item->price;?> </span>In-stock: (<?php echo $item->quantity;?>)</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:void(0)" class="cart-btn" onclick="addToCart('<?php echo $item->prod_id ?>')">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- products end -->
</div>
<!-- shop section end -->








