<?php
class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/index');        
        $I->see('Millenium Framework');
        
        $I->seeLink('About us');
        $I->click('About us');
        $I->wait(2); // wait for page to be opened
        
        $I->see('Now you are in this file:');
    }
}