<?php
class AboutPageCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/about');
        $I->see('Now you are on about page', 'p');
    }
}