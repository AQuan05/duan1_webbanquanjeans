<?php
class Validator
{
    // Kiểm tra username (từ 6 đến 10 ký tự)
    public static function validateUsername($username)
    {
        if (empty($username)) {
            return "Please enter username.";
        }
        return preg_match('/^[a-zA-Z0-9]{6,10}$/', $username) ? true : "Username is not in correct format.";
    }

    // Kiểm tra password (từ 10 đến 15 ký tự và không chứa ký tự đặc biệt)
    public static function validatePassword($password)
    {
        if (empty($password)) {
            return "Please enter password.";
        }
        return preg_match('/^[a-zA-Z0-9]{10,15}$/', $password) ? true : "Password is not in correct format.";
    }

    // Kiểm tra email (chỉ tính phần trước dấu '@')
    public static function validateEmail($email)
    {
        if (empty($email)) {
            return "Please enter email.";
        }

        // Kiểm tra xem email có dấu '@' không
        if (strpos($email, '@') === false) {
            return "Invalid email format.";
        }

        // Tách phần trước dấu '@' và kiểm tra độ dài
        list($usernamePart, $domainPart) = explode('@', $email);

        if (strlen($usernamePart) < 5 || strlen($usernamePart) > 10) {
            return "Email username must be between 5 and 10 characters.";
        }

        // Kiểm tra định dạng email hợp lệ
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        return true;
    }

    // Kiểm tra trùng lặp username
    public static function checkUsernameExists($username, $accountModel)
    {
        return $accountModel->checkUsernameExists($username) ? "Username already exists." : true;
    }

    // Kiểm tra trùng lặp email
    public static function checkEmailExists($email, $accountModel)
    {
        return $accountModel->checkEmailExists($email) ? "Email already exists." : true;
    }
}
