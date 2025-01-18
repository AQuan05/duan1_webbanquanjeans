<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Add Variants</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listVariants">List of Variants</a></li>
                                <li class="breadcrumb-item active">Update Variants/li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <form action=" " method="post" enctype="multipart/form-data">
                                <div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <input type="hidden" name="variant_id" value="<?= $OneVariant['variant_id'] ?>">
                                                <label for="product_id" class="form-label">Product</label> <br>
                                                <select name="product_id" id="product_id" class="form-select">
                                                    <option value="" disabled>Choose a product</option>
                                                    <?php foreach ($products as $product) { ?>
                                                        <option value="<?= $product['product_id'] ?>" 
                                                            <?= $OneVariant['product_id'] == $product['product_id'] ? 'selected' : '' ?>>
                                                            <?= $product['product_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div><!-- end col -->
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="cleave-date" class="form-label">Color</label>
                                                <input type="text" name="color" class="form-control" placeholder="Enter color" id="cleave-date" value="<?= $OneVariant['color'] ?>">
                                            </div>

                                        </div><!-- end col -->

                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="cleave-date-format" class="form-label">Size</label>
                                                <input type="text" name="size" class="form-control" placeholder="Enter size" id="cleave-date-format" value="<?= $OneVariant['size'] ?>">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                                <button type="submit" name="updateVariant" class="btn btn-primary">Update Variants</button>
                            </form><!-- end form -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>