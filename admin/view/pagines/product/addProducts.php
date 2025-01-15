<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Add Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listProducts">List of Products</a></li>
                                <li class="breadcrumb-item active">Add Products</li>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="cleave-date" class="form-label">Name Product</label>
                                                <input type="text" name="product_name" class="form-control" placeholder="Please enter name" id="cleave-date">
                                            </div>

                                        </div><!-- end col -->

                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="cleave-date-format" class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control" placeholder="Please select a photo" id="cleave-date-format">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>

                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category</label> <br>
                                                <select name="category_id" id="category_id" class="form-select">
                                                    <option value="" selected disabled>Chọn danh mục</option> <!-- Lựa chọn mặc định -->
                                                    <?php foreach ($Categories as $Category) { ?>
                                                        <option value="<?= $Category['category_id'] ?>"><?= $Category['category_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div><!-- end col -->

                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="cleave-time-format" class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" placeholder="Please description" id="cleave-time-format">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>

                                <div class="mt-4">
                                    <div>
                                        <div class="col-sm-auto">
                                            <div>
                                                <button type="submit" name="addPro" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Product</button>
                                                <button class="btn btn-warning list-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i><a href="?act=listProducts">List Product</a></button>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                            </form><!-- end form -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>