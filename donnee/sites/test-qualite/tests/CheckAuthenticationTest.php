<?php

namespace App\Tests;

use App\Service\CheckAuthentication;
use PHPUnit\Framework\TestCase;

class CheckAuthenticationTest extends TestCase
{

    public function test_check_username_validity_is_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(true, $checkAuthentication->checkUsernameValidity('admin'));
    }

    public function test_check_username_validity_not_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $notStringValues = [5, [], false];
        foreach ($notStringValues as $notStringValue) {
            $this->assertEquals(false, $checkAuthentication->checkUsernameValidity($notStringValue));
        }
    }

    public function test_check_username_validity_string_with_lenght_inferior_minimum()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(false, $checkAuthentication->checkUsernameValidity('a'));
    }

    public function test_check_username_validity_string_with_lenght_superior_maximum()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(false, $checkAuthentication->checkUsernameValidity('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'));
    }


    public function test_check_password_validity_is_incorrect_string()
    {
        $checkAuthentication = new CheckAuthentication();

        $notCorrectPasswords = ['azerty', [], 555, 'Azerty123.', '**###'];
        foreach ($notCorrectPasswords as $notCorrectPassword) {
            $this->assertEquals(false, $checkAuthentication->checkPasswordValidity($notCorrectPassword));
        }
    }

    public function test_check_password_validity_is_correct_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $notCorrectPasswords = ['Azerty123#', '1223Pc^%', 'Azerty123.@', '*Poayh856$'];
        foreach ($notCorrectPasswords as $notCorrectPassword) {
            $this->assertEquals(true, $checkAuthentication->checkPasswordValidity($notCorrectPassword));
        }
    }
}