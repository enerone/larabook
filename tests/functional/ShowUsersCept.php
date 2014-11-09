<?php 
$I = new FunctionalTester($scenario);
$I->am('a larabook member');
$I->wantTo('list all the users who are registered for larabook');

$I->haveAnAccount(['username'=>'Foo']);
$I->haveAnAccount(['username'=>'Bar']);


$I->amOnPage('/users');
$I->see('Foo');
$I->see('Bar');
