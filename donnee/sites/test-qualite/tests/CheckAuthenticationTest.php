<?php

namespace App\Tests;

use App\Service\CheckAuthentication;
use PHPUnit\Framework\TestCase;

class CheckAuthenticationTest extends TestCase
{

    /**
     * Vérification qu'un nom valable soit bien validé 
     */
    public function test_check_username_validity_is_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(true, $checkAuthentication->checkUsernameValidity('admin'));
    }

    /**
     * Vérification que le le nom soit bien une chaine de caractère 
     */
    public function test_check_username_validity_not_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $notStringValues = [5, [], false];
        foreach ($notStringValues as $notStringValue) {
            $this->assertEquals(false, $checkAuthentication->checkUsernameValidity($notStringValue));
        }
    }

    /**
     * Vérification que le la longueur du nom soit supérieur à la taille minimal
     */
    public function test_check_username_validity_string_with_lenght_superior_minimum()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(false, $checkAuthentication->checkUsernameValidity('a'));
    }

    /**
     * Vérification que le la longueur du nom soit inférieur à la taille maximal
     */
    public function test_check_username_validity_string_with_lenght_inferior_maximum()
    {
        $checkAuthentication = new CheckAuthentication();
        $this->assertEquals(false, $checkAuthentication->checkUsernameValidity('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'));
    }

    /**
     * Vérification que le mot de passe est bien une chaine 
     */
    public function test_check_password_validity_is_incorrect_string()
    {
        $checkAuthentication = new CheckAuthentication();

        $notCorrectPasswords = ['azerty', [], 555, 'Azerty123.', '**###'];
        foreach ($notCorrectPasswords as $notCorrectPassword) {
            $this->assertEquals(false, $checkAuthentication->checkPasswordValidity($notCorrectPassword));
        }
    }

    /**
     * Vérification que le mot de passe est valide (nombre caractères, majuscules, caractères spéciales, chiffres... )
     */
    public function test_check_password_validity_is_correct_string()
    {
        $checkAuthentication = new CheckAuthentication();
        $notCorrectPasswords = ['Azerty123#', '1223Pc^%', 'Azerty123.@', '*Poayh856$'];
        foreach ($notCorrectPasswords as $notCorrectPassword) {
            $this->assertEquals(true, $checkAuthentication->checkPasswordValidity($notCorrectPassword));
        }
    }
}