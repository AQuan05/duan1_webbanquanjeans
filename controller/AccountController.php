<?php
require_once 'model/Account.php';

class AccountController
{
    public $account;

    public function __construct()
    {
        $this->account = new Account(); // Model
    }
    public function addAccController()
    {
        require_once 'view/pagines/acc/register.php';

        // Xóa thông báo lỗi sau khi load lại trang
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }

        if (isset($_POST['addAcc']) && $_POST['addAcc']) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Khởi tạo mảng lỗi
            $errors = [];

            // 1. Kiểm tra lỗi trống
            if (empty($username)) {
                $errors['username'] = 'Username cannot be blank';
            }
            if (empty($email)) {
                $errors['email'] = 'Email cannot be blank';
            }
            if (empty($password)) {
                $errors['password'] = 'Password cannot be blank';
            }

            // Nếu không có lỗi trống thì kiểm tra định dạng
            if (empty($errors)) {
                // 2. Kiểm tra định dạng
                $usernameValidation = Validator::validateUsername($username);
                if ($usernameValidation !== true) {
                    $errors['username'] = $usernameValidation;
                }

                $emailValidation = Validator::validateEmail($email);
                if ($emailValidation !== true) {
                    $errors['email'] = $emailValidation;
                }

                $passwordValidation = Validator::validatePassword($password);
                if ($passwordValidation !== true) {
                    $errors['password'] = $passwordValidation;
                }
            }

            // 3. Kiểm tra trùng lặp trong database (nếu không có lỗi định dạng)
            if (empty($errors)) {
                $existingUser = $this->account->checkUsername($username);
                if ($existingUser) {
                    $errors['username'] = 'Username already exists.';
                }

                $existingEmail = $this->account->checkEmail($email);
                if ($existingEmail) {
                    $errors['email'] = 'Email already exists.';
                }
            }

            // Nếu có lỗi, lưu lỗi vào session và quay lại trang đăng ký
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors; // Lưu lỗi vào session
                header('Location: ' . $_SERVER['REQUEST_URI']); // Quay lại trang đăng ký
                exit();
            } else {
                // 4. Nếu không có lỗi, thêm tài khoản
                $this->account->addAccountModel($username, $email, $password);
                header('location:?act=login');
                exit();
            }
        }
    }
    public function loginController()
    {
        require_once 'view/pagines/acc/login.php';
        if (isset($_POST['login']) && $_POST['login']) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Email and Password cannot be empty.";
                header('Location: ?act=login');
                exit();
            }

            // Gọi model để kiểm tra đăng nhập
            $user = $this->account->loginModel($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;

                // Kiểm tra nếu user đã có giỏ hàng chưa
                $cart = $this->account->getCartByUserId($user['user_id']);
                if (!$cart) {
                    $this->account->createCart($user['user_id']);
                }

                // Chuyển hướng theo vai trò của người dùng
                if ($user['role_id'] == 1) {
                    header('Location: admin/?act=index'); // Chuyển đến trang admin
                } else {
                    header('Location: ?act=/'); // Chuyển đến trang client
                }
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password.";
                header('Location: ?act=login');
                exit();
            }
        }
    }
    public function forgotPasswordController()
    {
        require_once 'view/pagines/acc/ForgotPassword.php'; // Tạo file forgot_password.php cho form

        if (isset($_POST['forgotPass']) && $_POST['forgotPass']) {
            $email = $_POST['email'];

            // Kiểm tra nếu email trống
            if (empty($email)) {
                $_SESSION['error'] = "Email cannot be empty.";
                header('Location: ?act=forgotPassword');
                exit();
            }

            // Kiểm tra định dạng email hợp lệ (nếu muốn)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format.";
                header('Location: ?act=forgotPassword');
                exit();
            }

            // Kiểm tra nếu email có trong cơ sở dữ liệu không
            $emailExists = $this->account->checkEmail($email);
            if (!$emailExists) {
                $_SESSION['error'] = "Email not found.";
                header('Location: ?act=forgotPassword');
                exit();
            }

            // Nếu email tồn tại, chuyển hướng người dùng đến trang reset mật khẩu
            $_SESSION['email'] = $email;
            header('Location: ?act=resetPassword');
            exit();
        }
    }
    public function resetPasswordController()
    {
        require_once 'view/pagines/acc/ResetPassword.php'; // Gọi file view để hiển thị form reset mật khẩu

        // Kiểm tra xem email đã được lưu trong session chưa
        if (!isset($_SESSION['email'])) {
            // Nếu không có email trong session, chuyển hướng về trang forgotPassword
            header('Location: ?act=forgotPassword');
            exit();
        }

        // Nếu người dùng đã submit form reset mật khẩu
        if (isset($_POST['resetPass']) && $_POST['resetPass']) {
            $email = $_SESSION['email']; // Lấy email từ session
            $newPassword = $_POST['newPassword']; // Mật khẩu mới
            $confirmPassword = $_POST['confirmPassword']; // Xác nhận mật khẩu

            // Kiểm tra nếu mật khẩu mới và mật khẩu xác nhận trống
            if (empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error'] = "Both password fields are required.";
                header('Location: ?act=resetPassword');
                exit();
            }

            // Kiểm tra mật khẩu mới có khớp với mật khẩu xác nhận không
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match.";
                header('Location: ?act=resetPassword');
                exit();
            }

            // Kiểm tra độ dài mật khẩu (tùy thuộc vào yêu cầu hệ thống)
            if (strlen($newPassword) < 6) {
                $_SESSION['error'] = "Password must be at least 6 characters long.";
                header('Location: ?act=resetPassword');
                exit();
            }

            // Cập nhật mật khẩu trong cơ sở dữ liệu
            $updateSuccess = $this->account->updatePasswordModel($email, $newPassword);

            if ($updateSuccess) {
                // Nếu cập nhật thành công, thông báo và chuyển hướng người dùng
                unset($_SESSION['email']); // Xóa email khỏi session
                $_SESSION['success'] = "Password reset successfully. You can now log in with your new password.";
                header('Location: ?act=login');
                exit();
            } else {
                // Nếu không thành công, hiển thị thông báo lỗi
                $_SESSION['error'] = "Failed to reset password. Please try again.";
                header('Location: ?act=resetPassword');
                exit();
            }
        }
    }
    public function edit($user_id) {
        $user = $this->account->getUser($user_id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'] ?? null;
            $user_address = trim($_POST['user_address']);
            $user_phone = trim($_POST['user_phone']);
            
            $errors = [];
            if (empty($username)) $errors['username'] = "Username không được để trống.";
            if (empty($email)) $errors['email'] = "Email không được để trống.";
            if (empty($user_address)) $errors['user_address'] = "Địa chỉ không được để trống.";
            if (empty($user_phone)) $errors['user_phone'] = "Số điện thoại không được để trống.";
    
            if (empty($errors)) {
                $this->account->updateUser($user_id, $username, $email, $password, null, $user_address, $user_phone);
                header('Location: ?act=/');
                exit();
            }
        }
    
        require_once 'view/pagines/acc/editProfile.php'; // Hiển thị giao diện sau khi xử lý form
    }
}
