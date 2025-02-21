<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">List Order</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="order_id">Order ID</th>
                                                <th class="sort" data-sort="username">Name User</th>
                                                <th class="sort" data-sort="total_price">Total Price</th>
                                                <th class="sort" data-sort="user_address">Address</th>
                                                <th class="sort" data-sort="phone">Phone</th>
                                                <th class="sort" data-sort="created_at">Date of Purchase</th>
                                                <th class="sort" data-sort="status_name">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list form-check-all">
                                            <?php foreach ($orders as $order) { ?>
                                                <tr>
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary"></a></td>
                                                    <td class="order_id"><?= $order['order_id']; ?></td>
                                                    <td class="customer_name"><?= $order['user_name']; ?></td>
                                                    <td class="total_price"><?= number_format($order['total_price']) ?></td>
                                                    <td class="user_address"><?= $order['user_address']; ?></td>
                                                    <td class="phone"><?= $order['Phone']; ?></td>
                                                    <td class="created_at"><?= $order['created_at']; ?></td>
                                                    <td class="badge <?= getStatusBadge($order['status_id']) ?>"><?= $order['status_name']; ?></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal" ><a href="?act=detailOrder&order_id=<?= $order['order_id'] ?>" style="color: white">View</a></button>
                                                            </div>
                                                        </div>
                                                    </td>
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
    <?php
// Hàm trả về màu sắc theo trạng thái đơn hàng
function getStatusBadge($status_id)
{
    switch ($status_id) {
        case 0:
            return "bg-danger"; // Đã hủy
        case 1:
            return "bg-secondary"; // Chưa xác nhận
        case 2:
            return "bg-primary"; // Đã xác nhận
        case 3:
            return "bg-warning"; // Đang giao hàng
        case 4:
            return "bg-success"; // Hoàn thành
        default:
            return "bg-dark";
    }
}
?>