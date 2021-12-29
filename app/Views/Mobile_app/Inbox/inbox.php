<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/home') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-envelope ti-icon"></i>
            </div>
            <div class="col-8 p-2">
                <span class="title-m">Inbox</span>
            </div>
        </div>
    </div>
</section>

<section class="banner2">
    <div class="row">
        <div class="col-12 p-3 in-fil mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($inbox as $val){ if ($val->for_patient == 'Specific'){
                    $cusId = newSession()->Patient_user_id;
                    $table = DB()->table('message');
                    $specific = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$val->message_id)->where('message_to.to_patient_id',$cusId)->get()->getRow();
                ?>
                    <tr>
                        <td><?php echo $specific->message_id;?></td>
                        <td><?php echo $specific->title;?></td>
                        <td>
                            <a href="<?php echo base_url('Mobile_app/Inbox/view/'.$specific->message_id)?>"><i class="flaticon-view"></i></a>
                        </td>
                    </tr>
                <?php } if ($val->for_patient == 'All'){ ?>
                    <tr>
                        <td><?php echo $val->message_id;?></td>
                        <td><?php echo $val->title;?></td>
                        <td>
                            <a href="<?php echo base_url('Mobile_app/Inbox/view/'.$val->message_id)?>"><i class="flaticon-view"></i></a>
                        </td>
                    </tr>
                <?php } }?>
                </tbody>
            </table>

        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 " >
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="addView">
                </div>
            </div>
            <div class="num"></div>
        </div>
    </div>
</section>