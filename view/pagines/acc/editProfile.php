<?php require_once 'view/layout/header.php'; ?>

<section class="container mt-5">
    <section class="card shadow-lg p-4">
        <h2 class="text-center text-primary">Cập nhật thông tin người dùng</h2>
        
        <form action="?act=editprofile&user_id=<?= htmlspecialchars($user['user_id'] ?? '') ?>" method="POST">
            <section class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id'] ?? '') ?>">
                            <td><label class="fw-bold">Tên đăng nhập:</label></td>
                            <td><input type="text" name="username" class="form-control" 
                                       value="<?= htmlspecialchars($user['username'] ?? '') ?>" required></td>
                        </tr>

                        <tr>
                            <td><label class="fw-bold">Email:</label></td>
                            <td><input type="email" name="email" class="form-control" 
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>" required></td>
                        </tr>

                        <tr>
                            <td><label class="fw-bold">Mật khẩu (bỏ trống nếu không đổi):</label></td>
                            <td><input type="password" name="password" class="form-control" value="<?= $user['password'] ?? '' ?>"></td>
                        </tr>

                        <tr>
                            <td><label class="fw-bold">Địa chỉ:</label></td>
                            <td><input type="text" name="user_address" class="form-control" 
                                       value="<?= htmlspecialchars($user['user_address'] ?? '') ?>"></td>
                        </tr>

                        <tr>
                            <td><label class="fw-bold">Số điện thoại:</label></td>
                            <td><input type="text" name="user_phone" class="form-control" 
                                       value="<?= htmlspecialchars($user['user_phone'] ?? '') ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary px-5" name="update">Cập nhật</button>
            </div>
        </form>
    </section>
</section>

<?php require_once 'view/layout/footer.php'; ?>
