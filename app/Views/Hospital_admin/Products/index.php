
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item dropdown" id="reloadCart">
                            <a class="nav-link"  href="<?php echo base_url('Hospital_admin/Cart') ?>">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="badge badge-danger navbar-badge"><?php echo Cart()->totalItems(); ?></span>
                            </a>

                        </li>
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Products</h3>
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body row">
                        <?php foreach ($products as $item){ ?>
                        <div class="col-md-3" >
                            <div class="box box-primary" style="border: 1px solid #e3e3e3; padding: 10px;">
                                <div class="box-body box-profile" style="text-transform: capitalize;">
                                    <?php $pro = no_image_view('/assets/upload/product/'.$item->prod_id . '/' . $item->picture,'/assets/upload/product/no_image.jpg',$item->picture);?>
                                    <center><img class="profile-user-img img-responsive " src="<?php echo $pro;?>" alt="User profile picture"></center>

                                    <h3 class="profile-username text-center"><?php echo $item->name; ?></h3>

                                    <p class="text-muted text-center"><?php echo priceSymbol($item->price); ?></p>
                                    <p class="text-muted text-center">Quantity available: (<?php echo $item->quantity; ?>)</p>

<!--                                    <ul class="list-group list-group-unbordered">-->
<!--                                        <li class="list-group-item">-->
<!--                                            <b>Followers</b> <a class="pull-right">1,322</a>-->
<!--                                        </li>-->
<!--                                        <li class="list-group-item">-->
<!--                                            <b>Following</b> <a class="pull-right">543</a>-->
<!--                                        </li>-->
<!--                                        <li class="list-group-item">-->
<!--                                            <b>Friends</b> <a class="pull-right">13,287</a>-->
<!--                                        </li>-->
<!--                                    </ul>-->

                                    <button  class="btn btn-primary btn-block" onclick="addToCart('<?php echo $item->prod_id ?>')" ><b>Add to Cart</b></button>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>



</div>
<!-- /.content-wrapper -->

