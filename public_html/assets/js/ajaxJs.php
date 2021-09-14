<script>
    function viewdistrict(id){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/search_district') ?>",
            dataType: "text",
            data: {divisionsId: id },

            beforeSend: function(){
                $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function(msg){
                $('#district').html(msg);
                $('#zila').html(msg);
            }

        });
    }

    function viewupazila(id){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ajax/search_upazila') ?>",
            dataType: "text",
            data: {districtId: id },

            beforeSend: function(){
                $('#upazila').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function(msg){
                $('#upazila').html(msg);
                $('#subdistrict').html(msg);
            }

        });
    }
</script>