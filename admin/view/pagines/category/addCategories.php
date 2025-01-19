<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Add Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listProducts">List of Category</a></li>
                                <li class="breadcrumb-item active">Add Category</li>
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

                                <form action="?act=addCategory" method="post" enctype="multipart/form-data">

                                    <div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="cleave-date" class="form-label">Name</label>
                                                    <input type="text" class="form-control" placeholder="Please enter name" name="name_cate" value="">
                                                </div>

                                            </div><!-- end col -->
                                            <div class="col-xl-6">
                                            <div class="mb-3">
                                                <label for="Status" class="form-label">Status</label> <br>
                                                <select name="status" id="Status" class="form-select">
                                                    <option value="" selected disabled>Chọn trạng thái</option> <!-- Lựa chọn mặc định -->
                                                   <option value="Active">Active</option>
                                                   <option value="Inactive" >Inactive</option>
                                                </select>
                                            </div>

                                        </div><!-- end col -->
                                        </div><!-- end row -->

                                    </div>
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="submit" name="addCate" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Category</button>
                                        </div>
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
    <!-- End Page-content -->

</div>