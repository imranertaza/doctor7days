

<?php foreach ($hospitaladd as $key => $val){  $ac = ($key == 0)?'active':'';  ?>
    <div class="carousel-item <?php echo $ac ?>" add-id="<?php echo $val->ad_id ?>" >
        <img src="<?php echo base_url() ?>/assets/upload/adbanner/<?php echo $val->h_id ?>/<?php echo $val->banner ?>" class="d-block w-100" alt="...">
    </div>
<?php }  ?>

