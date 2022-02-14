

<?php
foreach ($hospitaladd as $key => $val){  $ac = ($key == 0)?'active':'';  ?>
    <div class="carousel-item <?php echo $ac ?>" add-id="<?php echo $val->ad_id ?>" >
        <?php $banner = no_image_view('/assets/upload/adbanner/'.$val->h_id.'/'.$val->banner,'/assets/upload/adbanner/no_image.jpg',$val->banner); ?>
        <img src="<?php echo $banner; ?>" class="d-block w-100" alt="...">
    </div>
<?php }  ?>

