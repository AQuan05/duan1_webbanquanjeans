<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">List Comment</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="customer_name">Name</th>
                                                <th class="sort" data-sort="order">Order_id</th>
                                                <th class="sort" data-sort="content">Content</th>
                                                <th class="sort" data-sort="date">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <?php foreach ($comments as $comment) { ?>
                                                <tr>
                                                    <td class="customer_name"><?= htmlspecialchars($comment['user_name']) ?></td>
                                                    <td class="order"><?= htmlspecialchars($comment['order_id']) ?></td>
                                                    <td class="content"><?= htmlspecialchars($comment['content']) ?></td>
                                                    <td class="date"><?= htmlspecialchars($comment['created_at']) ?></td>
                                                </tr>
                                            <?php } ?>
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