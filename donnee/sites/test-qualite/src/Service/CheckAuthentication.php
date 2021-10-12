<?php 

namespace App\Service;

class CheckAuthentication
{
    public function checkPasswordValidity($password): string
    {
        return is_string($password) && preg_match("/^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{6,}$/", $password) === 1;
    }

    public function checkUsernameValidity($username): string
    {
        return is_string($username) && strlen($username) >= 3 && strlen($username) <= 150;
    }
}