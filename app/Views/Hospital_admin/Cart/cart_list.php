<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cart list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cart list</li>
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
                                <h3 class="card-title">Cart list</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body " style="text-transform: capitalize;">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped" id="reloadtable">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (Cart()->contents() as $val) {
                                        $img = get_data_by_id('picture', 'products', 'prod_id', $val['id']);
                                        $pro = no_image_view('/assets/upload/product/'.$val['id']. '/' . $img,'/assets/upload/product/no_image.jpg',$img);
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $pro; ?>"
                                                     width="80">
                                            </td>
                                            <td>
                                                <?php echo $val['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo priceSymbol($val['price']); ?>
                                            </td>
                                            <td>
                                                <input type="number" style="width: 60px;"
                                                       onchange="updateQty(this.value,'<?php echo $val['rowid']; ?>')"
                                                       value="<?php echo $val['qty']; ?>">
                                            </td>
                                            <td>
                                                <?php echo priceSymbol($val['price'] * $val['qty']); ?>
                                            </td>
                                            <td>
                                                <a href="" onclick="removeCart('<?php echo $val['rowid']; ?>')"> <i
                                                            class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 row" id="cartDetail">
                                <div class="col-6"></div>
                                <div class="col-6 row" style="border: 1px solid #e5e5e5;padding: 10px;">
                                    <div class="col-8">
                                        <p class="font-15">Price:</p>
                                        <p class="font-15">Shipping:</p>
                                        <p class="font-15">Total price:</p>
                                    </div>
                                    <div class="col-4" >
                                        <p class="font-15"><?php print priceSymbol(Cart()->total()); ?></p>
                                        <?php $shipp = (!empty(Cart()->contents())) ? 100 : 0; ?>
                                        <p class="font-15"><?php echo priceSymbol($shipp); ?></p>
                                        <p><b><?php echo priceSymbol(Cart()->total() + $shipp); ?></b></p>

                                    </div>
                                    <a href="<?php echo base_url($controller.'/checkout')?>" style="width: 100%;" class="btn btn-primary">Checkout</a>
                                </div>
                            </div>
                        </div>
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

