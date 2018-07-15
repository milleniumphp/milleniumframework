<?php
class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage('/pages/login');
    }
    
    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h2');
    }
    
    public function loginWithEmptyData(\FunctionalTester $I)
   {
        $I->submitForm('form#login-form', [
            'login' => ' ',
            'password' => ' ',
        ]);
        $I->seeCurrentUrlEquals('/pages/login');
        var_dump(app\models\LoginForm::$errors);
    }
    
    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('form#login-form', [
            'login' => 'admin',
            'password' => 'admin',
        ]);
        
        $I->dontSeeElement('form#login-form');
        
        $I->seeCurrentUrlEquals('/');
        
        $I->see('Logout');
        
    }
}