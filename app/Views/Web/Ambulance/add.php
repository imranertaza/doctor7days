<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar; ?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title">Ambulance Add</h4>

                                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                        <?php echo session()->getFlashdata('message'); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="col-3 "></div>
                                <div class="col-6 ">
                                    <form action="<?php echo base_url('Web/Ambulance/create_action')?>" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="division" class="lab-t">Ambulance Number</label>
                                            <input class="form-control in-c" name="car_model_name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="Oxygen" class="lab-t"> Oxygen </label>
                                            <select class="form-control in-c" name="oxygen" required>
                                                <option value="">Please Select</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="ac" class="lab-t"> AC </label>
                                            <select class="form-control in-c" name="ac" required>
                                                <option value="">Please Select</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="image" class="lab-t"> Image </label>
                                            <input type="file" class="form-control in-c" name="image" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="lab-t"> Description </label>
                                            <textarea class="form-control" rows="6" name="description" required>

                    </textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-3 "></div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->