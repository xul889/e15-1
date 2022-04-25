<?php

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
        //$I->amOnPage('/test/refresh-database');
    }

    // tests
    public function pageLoads(AcceptanceTester $I)
    {
        # Action...
        $I->amOnPage('/login');
        
        # Assertion...
        $I->see('Login');
        $I->seeElement('#email');
    }

    /**
     *
     */
    public function userCanLogIn(AcceptanceTester $I)
    {
        # Act
        $I->amOnPage('/login');

        # Interact with form elements
        $I->fillField('[test=email-input]', 'jill@harvard.edu');
        $I->fillField('[test=password-input]', 'asdfasdf');
        $I->click('[test=login-button]');

        # Assert expected results
        $I->see('Jill Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }
}