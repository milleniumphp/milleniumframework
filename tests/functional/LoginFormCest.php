<?php
class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage('pages/login');
    }
    
    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h2');
    }
    
    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('bad');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', [
            'login' => 'wrong',
            'password' => 'wrong',
        ]);
        $I->see('bad');
        $I->expectTo('see validations errors');
    }
    
    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', [
            'login' => 'admin',
            'password' => 'admin',
        ]);
        
        $I->dontSeeElement('form#login-form');
        $I->see('Logout');
        
    }
}