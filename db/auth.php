<?php

class Auth
{

    public static function authVendor()
    {
        if (!isset($_SESSION["id"])) {
            header('location: ../../index');
        } else {
            if ($_SESSION["type"] != '2') {
                header('location: ../../index');
            }
        }
    }

    public static function authUser()
    {
        if (!isset($_SESSION["id"])) {
            header('location: ../../index');
        } else {
            if ($_SESSION["type"] != '0') {
                header('location: ../../index');
            }
        }
    }
}
