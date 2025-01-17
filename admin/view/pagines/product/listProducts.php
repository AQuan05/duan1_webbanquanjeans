<?php require_once '../admin/controller/productController.php' ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">List Product</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i><a href="?act=addProducts" style="color: #fff">Add Product</a> </button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="customer_name">ID</th>
                                                <th class="sort" data-sort="email">Name Product</th>
                                                <th class="sort" data-sort="email">Image</th>
                                                <th class="sort" data-sort="email">Category name</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php foreach ($listProducts as $listProduct) {
                                                extract($listProduct); ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td class="id"><a href="javascript:void(0);" class="fw-medium link-primary"><?= $listProduct['product_id'] ?></a></td>
                                                    <td class="product_name"><?= $listProduct['product_name'] ?></td>
                                                    <td><img width="100" src="../admin/view/assets/images/products/<?= $listProduct['image'] ?>" alt="123"></td>
                                                    <td class="category_name"><?= $listProduct['category_name'] ?></td>
                                                    <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">Active</span></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal"><a href="?act=editProduct&id=<?= $listProduct['product_id'] ?>">Edit</a></button>
                                                            </div>
                                                            <div class="remove">
                                                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><a href="?act=deleteProduct&id=<?= $listProduct['product_id'] ?>">Remove</a></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>