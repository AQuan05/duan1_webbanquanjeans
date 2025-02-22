<?php
require_once 'model/Account.php';

class AccountController
{
    public $account;

    public function __construct()
    {
        $this->account = new Account();
    }
    public function listUserController() {
        $users = $this->account->listUserModel();
        require_once '../admin/view/pagines/acc/listAcc.php';
    }
    public function detailUserController($user_id) {
        $oneUser = $this->account->detailUserModel($user_id);
        require_once '../admin/view/pagines/acc/detailAcc.php';
    }
}