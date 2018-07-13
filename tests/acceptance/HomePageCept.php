<?php

class HomePageCest {

    public function ensureThatHomePageWorks(AcceptanceTester $I) {
        $I->wantTo('perform actions and see result');
        $I->amOnPage('/');
        $I->see('Millenium Framework');
        $I->seeLink('About us');
        $I->click('About us');
        $I->see('Now you are on about page');
    }

}
