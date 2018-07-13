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
    
    public function loginWithEmptyData(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Login is required');
        $I->see('Password is required');
    }

    public function loginWithWrongData(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', [
            'login' => 'wrong',
            'password' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect data entered');
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