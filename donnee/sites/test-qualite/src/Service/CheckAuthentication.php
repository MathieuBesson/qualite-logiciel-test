<?php 

namespace App\Service;

class CheckAuthentication
{
    public function checkPasswordValidity(): string
    {
        return 1;
    }

    public function checkUsernameValidity($username): string
    {
        return is_string($username) && strlen($username) >= 3 && strlen($username) <= 150;
    }
}