<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>
<style>
    * {
        color: red;
    }
</style>

<body>
    <!-- Example alert div -->

    <!-- Your form can go here -->
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
                                        <label>Username</label>
                                        <input type="text" name="username" value="" placeholder="Enter Your Username" class="cr-form-control">
                                        <?php if (isset($_SESSION['errors']['username'])): ?>
                                            <div class="error-message"><?php echo $_SESSION['errors']['username']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" name="email" value="" placeholder="Enter Your Email" class="cr-form-control">
                                        <?php if (isset($_SESSION['errors']['email'])): ?>
                                            <div class="error-message"><?php echo $_SESSION['errors']['email']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="" placeholder="Enter Your Password" class="cr-form-control">
                                        <?php if (isset($_SESSION['errors']['password'])): ?>
                                            <div class="error-message"><?php echo $_SESSION['errors']['password']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="cr-register-buttons">
                                    <button type="submit" name="addAcc" value="addAcc" class="cr-button">Signup</button>
                                    <a href="?act=login" class="link">
                                        Have an account?
                                    </a>
                                </div>
                            </div>
                        </form>
                        <?php
                        // Xóa lỗi sau khi hiển thị
                        if (isset($_SESSION['errors'])) {
                            unset($_SESSION['errors']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>