<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-text text-center">
            <h1>Jobs</h1>
            <p>get best jobs</p>
        </div>
        <div class="service-inner">
            <div class="row">
                <div class="col-md-12 p-2">

                    <table class="table">
                        <tbody>
                            <?php foreach ($jobs as $item){?>
                                <tr>
                                    <td>
                                        <span><?php echo get_data_by_id('name','hospital','h_id',$item->h_id)?></span>
                                        <h5><?php echo $item->title?></h5>
                                        <span><?php echo date('M-d-Y H:i:s', strtotime($item->createdDtm));?></span>
                                    </td>
                                    <td><p></p><a href="<?php echo base_url('Web/Jobs/job_apply/'.$item->job_id)  ?>" class="mt-2"><i class="flaticon-right-arrow"></i></a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>


                </div>


            </div>
        </div>
    </div>
</section>
<!-- services area  end-->