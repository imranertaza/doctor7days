<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>No permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">No permission</a></li>
                        <li class="breadcrumb-item active">No permission</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                No permission
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- Add modal content -->
    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Add</h4>
                </div>
                <div class="modal-body">
                    <form id="add-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="prodId" name="prodId" class="form-control" placeholder="Prod id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="storeId"> Store id: <span class="text-danger">*</span> </label>
                                    <input type="number" id="storeId" name="storeId" class="form-control" placeholder="Store id" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" maxlength="55" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity"> Quantity: <span class="text-danger">*</span> </label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" maxlength="11" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit"> Unit: <span class="text-danger">*</span> </label>
                                    <input type="number" id="unit" name="unit" class="form-control" placeholder="Unit" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brandId"> Brand id: </label>
                                    <input type="number" id="brandId" name="brandId" class="form-control" placeholder="Brand id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="picture"> Picture: </label>
                                    <input type="text" id="picture" name="picture" class="form-control" placeholder="Picture" maxlength="155" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prodCatId"> Prod cat id: </label>
                                    <input type="number" id="prodCatId" name="prodCatId" class="form-control" placeholder="Prod cat id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productType"> Product type: <span class="text-danger">*</span> </label>
                                    <input type="text" id="productType" name="productType" class="form-control" placeholder="Product type" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description"> Description: </label>
                                    <textarea cols="40" rows="5" id="description" name="description" class="form-control" placeholder="Description" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status"> Status: <span class="text-danger">*</span> </label>
                                    <input type="text" id="status" name="status" class="form-control" placeholder="Status" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="createdDtm" name="createdDtm" class="form-control" placeholder="CreatedDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdBy"> CreatedBy: <span class="text-danger">*</span> </label>
                                    <input type="number" id="createdBy" name="createdBy" class="form-control" placeholder="CreatedBy" maxlength="11" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateDtm"> UpdateDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="updateDtm" name="updateDtm" class="form-control" placeholder="UpdateDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deleted"> Deleted: </label>
                                    <input type="number" id="deleted" name="deleted" class="form-control" placeholder="Deleted" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deletedRole"> DeletedRole: </label>
                                    <input type="number" id="deletedRole" name="deletedRole" class="form-control" placeholder="DeletedRole" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="add-form-btn">Add</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Add modal content -->
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form" class="pl-3 pr-3">
                        <div class="row">
                            <input type="hidden" id="prodId" name="prodId" class="form-control" placeholder="Prod id" maxlength="11" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="storeId"> Store id: <span class="text-danger">*</span> </label>
                                    <input type="number" id="storeId" name="storeId" class="form-control" placeholder="Store id" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"> Name: <span class="text-danger">*</span> </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" maxlength="55" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity"> Quantity: <span class="text-danger">*</span> </label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" maxlength="11" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit"> Unit: <span class="text-danger">*</span> </label>
                                    <input type="number" id="unit" name="unit" class="form-control" placeholder="Unit" maxlength="11" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brandId"> Brand id: </label>
                                    <input type="number" id="brandId" name="brandId" class="form-control" placeholder="Brand id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="picture"> Picture: </label>
                                    <input type="text" id="picture" name="picture" class="form-control" placeholder="Picture" maxlength="155" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="prodCatId"> Prod cat id: </label>
                                    <input type="number" id="prodCatId" name="prodCatId" class="form-control" placeholder="Prod cat id" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productType"> Product type: <span class="text-danger">*</span> </label>
                                    <input type="text" id="productType" name="productType" class="form-control" placeholder="Product type" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description"> Description: </label>
                                    <textarea cols="40" rows="5" id="description" name="description" class="form-control" placeholder="Description" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status"> Status: <span class="text-danger">*</span> </label>
                                    <input type="text" id="status" name="status" class="form-control" placeholder="Status" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdDtm"> CreatedDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="createdDtm" name="createdDtm" class="form-control" placeholder="CreatedDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="createdBy"> CreatedBy: <span class="text-danger">*</span> </label>
                                    <input type="number" id="createdBy" name="createdBy" class="form-control" placeholder="CreatedBy" maxlength="11" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updateDtm"> UpdateDtm: <span class="text-danger">*</span> </label>
                                    <input type="text" id="updateDtm" name="updateDtm" class="form-control" placeholder="UpdateDtm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="updatedBy"> UpdatedBy: </label>
                                    <input type="number" id="updatedBy" name="updatedBy" class="form-control" placeholder="UpdatedBy" maxlength="11" number="true" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deleted"> Deleted: </label>
                                    <input type="number" id="deleted" name="deleted" class="form-control" placeholder="Deleted" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="deletedRole"> DeletedRole: </label>
                                    <input type="number" id="deletedRole" name="deletedRole" class="form-control" placeholder="DeletedRole" maxlength="11" number="true" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="edit-form-btn">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /.content -->
</div>