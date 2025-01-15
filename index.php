<?php
require_once 'commons/function.php';
include 'view/layout/header.php';
if (isset($_GET['act']) && $_GET['act'] != '') {
    $act = $_GET['act'];
    switch ($act) {
        
    }
}else{
    include 'view/pagines/home.php';
}
include 'view/layout/footer.php';
