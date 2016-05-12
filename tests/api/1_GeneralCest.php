<?php


class GeneralAuthCest
{
    public function getCorrectPageNotFoundPage(ApiTester $I)
    {
        $I->wantTo('get page not found in correct format');
        $I->sendPOST('authenticate/2');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'error' => 'string'
        ]);
    }

    public function getCorrectMethodNotAllowedPage(ApiTester $I)
    {
        $I->wantTo('get page method not allowed in correct format');
        $I->sendGET('authenticate');
        $I->seeResponseCodeIs(405);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'error' => 'string'
        ]);
    }
}
