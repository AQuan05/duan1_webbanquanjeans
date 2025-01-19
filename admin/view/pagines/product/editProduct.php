<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Update Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listProducts">List of Products</a></li>
                                <li class="breadcrumb-item active">Update Products</li>
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
                                                <label for="product_name" class="form-label">Name Product</label>
                                                <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($oneProduct['product_name']) ?>" placeholder="Please enter name" id="product_name">
                                                <input type="hidden" name="product_id" value="<?= $oneProduct['product_id'] ?>">
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control" value="<?= htmlspecialchars($oneProduct['image']) ?>" placeholder="Please select a photo" id="image">
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
                                                    <option value="" selected disabled>Chọn danh mục</option>
                                                    <?php foreach ($Categories as $Category) { ?>
                                                        <option value="<?= $Category['category_id'] ?>"
                                                            <?= ($Category['category_id'] == $oneProduct['category_id']) ? 'selected' : '' ?>>
                                                            <?= $Category['category_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($oneProduct['description']) ?>" placeholder="Please description" id="description">
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>

                                <div id="variant-container" class="mt-4">
                                    <?php if (isset($variants) && count($variants) > 0) { ?>
                                        <?php foreach ($variants as $variant) { ?>
                                            <div class="variant-group">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label for="color_id" class="form-label">Color</label> <br>
                                                            <select name="color_id" id="color_id" class="form-select">
                                                                <option value="" disabled>Chọn color</option>
                                                                <?php foreach ($color as $colors) { ?>
                                                                    <option value="<?= $colors['color_id'] ?>"
                                                                        <?= ($variant['color_id'] == $colors['color_id']) ? 'selected' : '' ?>>
                                                                        <?= $colors['color_name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div><!-- end col -->

                                                    <div class="col-xl-6">
                                                        <div class="mb-3">
                                                            <label for="size_id" class="form-label">Size</label> <br>
                                                            <select name="size_id" id="size_id" class="form-select">
                                                                <option value="" disabled>Chọn size</option>
                                                                <?php foreach ($size as $sizes) { ?>
                                                                    <option value="<?= $sizes['size_id'] ?>"
                                                                        <?= ($variant['size_id'] == $sizes['size_id']) ? 'selected' : '' ?>>
                                                                        <?= $sizes['size_name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div><!-- end col -->

                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Price</label>
                                                        <input type="number" name="price" class="form-control"
                                                            value="<?= $variant['price'] ?>" placeholder="Please enter price" id="price">
                                                    </div>
                                                </div><!-- end row -->
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="variant-group">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label for="color_id" class="form-label">Color</label> <br>
                                                        <select name="color_id" id="color_id" class="form-select">
                                                            <option value="" disabled selected>Chọn color</option>
                                                            <?php foreach ($color as $colors) { ?>
                                                                <option value="<?= $colors['color_id'] ?>"><?= $colors['color_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="col-xl-6">
                                                    <div class="mb-3">
                                                        <label for="size_id" class="form-label">Size</label> <br>
                                                        <select name="size_id" id="size_id" class="form-select">
                                                            <option value="" disabled selected>Chọn size</option>
                                                            <?php foreach ($size as $sizes) { ?>
                                                                <option value="<?= $sizes['size_id'] ?>"><?= $sizes['size_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" name="price" class="form-control" placeholder="Please enter price" id="price">
                                                </div>
                                            </div><!-- end row -->
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="mt-4">
                                    <div>
                                        <div class="col-sm-auto">
                                            <div>
                                                <button type="submit" name="updatePro" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Update Product</button>
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
