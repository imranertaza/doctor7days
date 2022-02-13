<div class="container">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="products-image ">
                <?php $pro = no_image_view('/assets/upload/product/'.$product->prod_id.'/'. $product->picture,'/assets/upload/product/no_image.jpg',$product->picture)?>
                <img src="<?php echo $pro; ?>" alt="Products image" class="img-fluid" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="products-details">
                <h2 class="text-capitalize mt-4 pt-md-0"><?php echo $product->name?></h2>
                <p><?php echo $product->description;?></p>
                <!-- products price and review area -->
                <div class="col-12" style="text-transform: capitalize">
                    <p class="pro-pr"><span>Price:</span> TK.<?php echo $product->price;?></p>
                    <p class="pro-n-d">in-stock (<?php echo $product->quantity;?>)</p>
                    <p class="pro-ic">
                        <a href=""><i class="flaticon-star"></i></a>
                        <a href=""><i class="flaticon-star"></i></a>
                        <a href=""><i class="flaticon-star"></i></a>
                        <a href=""><i class="flaticon-star"></i></a>
                        <a href=""><i class="flaticon-star"></i></a>
                    </p>
                </div>
                <!-- products price and review are end -->
                <div class="row">
                    <div class="col-6" style="padding-right: 0px !important">
                        <select class="form-control" name="" id="">
                            <option value="xs">XS</option>
                            <option value="xl">XL</option>
                        </select>
                    </div>
                    <div class="col-6" style="padding-right: 0px !important">
                        <select class="form-control" name="" id="">
                            <option value="blue">Blue</option>
                            <option value="red" data-icon="glyphicon-music">Red</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <a href="" class="cart-btn">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>