<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/appionment') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-checkup ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m"><?php echo $hospital->name;?></span>
            </div>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <?php
        $banImg = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->image,'/assets/upload/hospital/no_image.jpg',$hospital->image);
        ?>
        <img src="<?php echo $banImg;?>" width="100%">
    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 row">
            <div class="col-6">
                <?php
                $img = no_image_view('/assets/upload/doctor/'.$specialties->doc_id.'/'.$specialties->pic,'/assets/upload/doctor/no_image.jpg',$specialties->pic);
                //$img = (!empty($specialties->pic)) ? $specialties->pic : 'noimage.jpg';
                ?>
                <img src="<?php echo $img;?>" width="100%">
            </div>
            <div class="col-6">

                <p class="tit"><?php echo $specialties->name; ?></p>
                <p class="sub-tit"><?php echo $specialties->degree; ?></p>
                <p class="sub-tit"><?php echo get_data_by_id('specialist_type_name', 'specialist', 'specialist_id ', $specialties->specialist_id); ?></p>
            </div>
        </div>
        <div class="col-12 p-3 ">
            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                <?php echo session()->getFlashdata('message'); ?>
            <?php endif; ?>
        </div>
        <div class="col-12 p-3 dr-row in-fil">
            <form action="<?php echo base_url('Mobile_app/Appionment/appinoment_action');?>" method="POST">
                <?php
                    $name = (!empty(newSession()->isPatientLogin)) ? newSession()->Patient_name : '';
                    $phone = (!empty(newSession()->isPatientLogin)) ? newSession()->Patient_phone : '';
                ?>
                <div class="form-group">
                    <label for="name" class="lab-t">Name</label>
                    <input type="text" name="name" class="form-control in-c" placeholder="Enter Name" id="name" value="<?php echo $name;?>" >

                </div>
                <div class="form-group">
                    <label for="mobile" class="lab-t">Mobile</label>
                    <input type="text" name="phone" class="form-control in-c" placeholder="Enter Mobile" id="mobile"
                           value="<?php echo $phone; ?>" required>
                </div>
                <h6>Appionment filter</h6>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="date" class="lab-t">Year</label>
                        <input type="hidden" name="docId" id="docId" value="<?php echo $avilDay->doc_avil_id;?>">
                        <input type="hidden" name="doc_id" class="form-control " id="doc_id"
                               value="<?php echo $avilDay->doc_id; ?>" required>
                        <select class="form-control in-c " name="year" id="year">
                            <?php for ($i = date('Y'); $i < 2040; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="date" class="lab-t">Month</label>
                        <select class="form-control in-c " name="month" id="month" onchange="getDate(this.value)">
                            <?php
                                $i = 1;
                                $month = strtotime(date('Y-m-d'));
                                while ($i <= 12) {
                                $monthNum = date('m', $month);
                                $month_name = date('F', $month);
                                $month = strtotime('+1 month', $month);
                                $i++;
                            ?>
                            <option value="<?php echo $monthNum ?>"><?php echo $month_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" >
                    <label for="time" class="lab-t">Date</label>
                    <select class="form-control in-c" name="date" id="dataData"  onchange="getTime(this.value)"  required>
                        <option value="">Date select</option>
                        <?php
                            $availablDayArray = array('Sat' => $avilDay->saturday, 'Sun' => $avilDay->sunday, 'Mon' => $avilDay->monday, 'Tue' => $avilDay->tuesday, 'Wed' => $avilDay->wednesday, 'Thu' => $avilDay->thursday, 'Fri' => $avilDay->friday);
                            $today = date('Y-m-d');
                            $last = date("Y-m-t", strtotime($today));
                            $date1 = new DateTime($today);
                            $date2 = new DateTime($last);
                            $totalDay = $date2->diff($date1)->format('%a');
                            for ($i = 0; $i < $totalDay; $i++) {
                            $date = date('Y-m-d', strtotime($today . ' +' . $i . ' day'));
                            $tim = strtotime($date);
                            $day = date('D', $tim);
                            $dayFull = date('l', $tim);
                            $sel = ($date == $today) ? 'selected' : '';
                            if ($availablDayArray[$day] != NULL && $today <= $date ) {
                        ?>
                        <option value="<?php echo $date; ?>"  ><?php echo $date; ?>(<?php echo $day; ?>)</option>
                        <?php } } ?>
                    </select>
                </div>

                <h6>Appionment time</h6>
                <div class="row" id="appTimeData">

                </div>

                <div class="form-group">
                    <button class="sub-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function getTime(day){
        var docId = $('#docId').val();
        $.ajax({
            url: '<?php echo base_url('Mobile_app/Appionment/appi_time') ?>',
            dataType: "text",
            type: "Post",
            data: {day:day,docAvID:docId },
            success: function (data) {
                // alert(data);
                $('#appTimeData').html(data);
            }
        });
    }

    function getDate(month){
        var year = $('#year').val();
        var docId = $('#docId').val();
        $.ajax({
            url: '<?php echo base_url('Mobile_app/Appionment/appi_date') ?>',
            dataType: "text",
            type: "Post",
            data: {month:month,year:year,docAvID:docId},
            success: function (data) {
                // alert(data);
                $('#dataData').html(data);
                $('#appTimeData').html('');
            }
        });
    }
</script>