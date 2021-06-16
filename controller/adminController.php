<?php
require_once ROOT_URL . '/model/adminModel.php';

class adminController
{
    function viewsp()
    {

        $admin = new adminModel();
        return $admin->viewsp();
    }

    function approvalsp()
    {
        $admin = new adminModel();
        $admin->sp_id = $_POST['sp_id'];
    }
}
