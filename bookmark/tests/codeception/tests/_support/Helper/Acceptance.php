<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    public function _beforeSuite($settings = [])
    {
        // $I = $this;
        // $I->comment('hai');

        // var_dump('here');
    }
}