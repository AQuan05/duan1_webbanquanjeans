<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Edit Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listProducts">List of Categories</a></li>
                                <li class="breadcrumb-item active">Edit Category</li>
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
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3">
                                                <input type="hidden" name="category_id" value="<?= $oneCategory['category_id'] ?>">
                                                <label for="cleave-date" class="form-label">Name</label>
                                                <input type="text" class="form-control" placeholder="Please enter name" id="cleave-date" name="name_cate" value="<?= $oneCategory['category_name'] ?>">
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="submit" name="updateCate" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Update Category</button>
                                        </div>

                                    </div><!-- end col -->
                                </div><!-- end row -->
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>