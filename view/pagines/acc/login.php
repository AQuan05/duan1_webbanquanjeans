<?php require_once 'view/layout/header.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            color: red;
        }

        .cr-register-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .left-links,
        .right-links {
            display: inline-block;
        }

        .sign-up-link {
            margin-top: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }

        .cr-register-buttons .link {
            display: inline-block;
            margin-bottom: 10px;
        }

        .cr-register-buttons .sign-up {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <section class="section-register padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cr-register" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="form-logo">
                            <img src="view/assets/img/logo/logo.png" alt="logo">
                        </div>
                        <form class="cr-content-form" method="POST">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="" placeholder="Enter Your Email" class="cr-form-control">
                                        <?php if (isset($_SESSION['error'])): ?>
                                            <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                                            <?php unset($_SESSION['error']); ?> <!-- Xóa lỗi sau khi hiển thị -->
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="" placeholder="Enter Your Password" class="cr-form-control">
                                        <?php if (isset($_SESSION['error'])): ?>
                                            <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Hiển thị thông báo lỗi nếu có -->
                                <?php if (isset($_SESSION['error'])): ?>
                                    <div class="error-message"><?php echo $_SESSION['error']; ?></div>
                                    <?php unset($_SESSION['error']); ?> <!-- Xóa lỗi sau khi hiển thị -->
                                <?php endif; ?>
                                <div class="cr-register-buttons">
                                    <button type="submit" name="login" value="login" class="cr-button">Login</button>
                                    <a href="?act=forgotPassword" class="link">Forgot Password?</a>
                                    <a href="?act=register" class="link sign-up">Don't have an account? Sign up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
<?php require_once 'view/layout/footer.php' ?>