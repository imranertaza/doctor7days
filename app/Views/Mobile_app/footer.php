<section class="footer ">
    <div class="row fixed-bottom  foot pt-3">
        <div class="col-4">
            <a class="nav-link" href="#"><i class="flaticon-menu iconfoot"></i></a>
        </div>
        <div class="col-4 text-center">
            <div class="f-home  mb-1">
                <a class="" href="<?php echo base_url('Mobile_app/home') ?>"><i class="flaticon-home iconhome"></i></a>
            </div>
        </div>
        <div class="col-4 text-right dropdown">
            <a class="nav-link " data-toggle="dropdown" href="#"><i class="flaticon-user iconfoot"></i></a>
            <?php if (newSession()->isAmbulanceLogin == true){?>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Ambulance_dashboard/');?>">Dashboard</a>
                <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Ambulance_dashboard/profile');?>">Profile</a>
                <a class="dropdown-item " href="<?php echo base_url('Mobile_app/Ambulance/logout');?>">Logout</a>
            </div>
            <?php }?>

            <?php if (newSession()->isPatientLogin == true){?>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Patient/dashboard/');?>">Dashboard</a>
                    <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Patient/profile');?>">Profile</a>
                    <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Patient/order');?>">Order</a>
                    <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Inbox');?>">Inbox
                        <?php $count = count_patient_notification(newSession()->Patient_user_id); if ($count != 0){?>
                        <span class="badge red"><?php echo $count; ?></span>
                        <?php } ?>
                    </a>
                    <a class="dropdown-item " href="<?php echo base_url('Mobile_app/Patient/logout');?>">Logout</a>
                </div>
            <?php }else{?>
            <div class="dropdown-menu">
                <a class="dropdown-item " href="<?php echo base_url('Mobile_app/Patient/login');?>">Login</a>
            </div>
            <?php }?>

        </div>
    </div>
</section>
</div>


<!--all custome js-->
<?php  require_once(APPPATH.'../public_html/assets/js/ajaxJs.php'); ?>

</body>
</html>

<script>

    $(function () {
        hospitalAdView();
        nationalAdView();
        setInterval(hospitalAdView, 25000);
        setInterval(nationalAdView, 25000);

        function hospitalAdView() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax/hospitalAd') ?>",
                dataType: "text",
                success: function (data) {
                    $('#addView').html(data);
                    $("#carouselExampleSlidesOnly").carousel();

                    var addId = $('#carouselExampleSlidesOnly div.active').attr('add-id');
                    if(data == true) {
                        addViewCount(addId);
                    }
                }
            });
        }

        function nationalAdView() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax/nationalAd') ?>",
                dataType: "text",
                success: function (data) {
                    $('#addViewNational').html(data);
                    $("#carouselExampleSlidesOnly").carousel();

                    var addId = $('#carouselExampleSlidesOnly div.active').attr('add-id');

                    if(data == true) {
                        addViewCount(addId);
                    }
                }
            });
        }

        $('#carouselExampleSlidesOnly').carousel({
            interval: 5000
        });

        $('#carouselExampleSlidesOnly').on('slid.bs.carousel', function () {
            var addId = $('#carouselExampleSlidesOnly div.active').attr('add-id');
            addViewCount(addId);
            // $('.num').html(addId);
        });

        function addViewCount(addId) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('ajax/adViewCount') ?>",
                data: {adId: addId},
                dataType: "text",
                success: function (data) {
                    // $('.num').html(data);
                }
            });
        }
    });

    window.onload = function(){
        $("#loderImg").hide();
        $("#loderdiv").attr('class', 'newClass');
    };
</script>