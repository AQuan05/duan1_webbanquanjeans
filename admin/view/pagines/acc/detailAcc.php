<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Detail Account</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?act=listUsers">List of Account</a></li>
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
                            <form action="" method="POST">
                                <?php if ($oneUser) { ?>
                                    <div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" name="username" class="form-control"
                                                        value="<?= htmlspecialchars($oneUser['username']) ?>"
                                                        placeholder="Please enter username" id="username" readonly>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="<?= htmlspecialchars($oneUser['email']) ?>"
                                                        placeholder="Please enter email" id="email" readonly>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div>

                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        value="<?= htmlspecialchars($oneUser['password']) ?>"
                                                        placeholder="Please enter password" id="password" readonly>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?= htmlspecialchars($oneUser['user_phone'] ?? '') ?>"
                                                        placeholder="Please enter phone number" id="phone" readonly>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="<?= htmlspecialchars($oneUser['user_address'] ?? '') ?>"
                                                        placeholder="Please enter address" id="address" readonly>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div>

                                    <div class="mt-4">
                                        <div>
                                            <div class="col-sm-auto">
                                                <div>
                                                    <button class="btn btn-warning list-btn">
                                                        <a href="?act=listUsers">List Account</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                <?php } ?>
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