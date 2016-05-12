<?php

class ApiCest
{

    protected $invalidToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyMiwiaXNzIjoiaHR0cDpcL1wvc2VyZ2V5LXJlc3RhcGkubGFiXC9hcGlcL3YxLjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ2MTc4MzA2MiwiZXhwIjoxNDYxNzg2NjYyLCJuYmYiOjE0NjE3ODMwNjIsImp0aSI6ImZhNDU5YjA5YTNlMjAxOWM0ZTEwYjRjZDdiM2QwN2U5In0.9G4t_946Tfq217iMq_b6BqM_3B5Awtp1tpQbONnx9';
    protected $expiredAdminToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyMiwiaXNzIjoiaHR0cDpcL1wvc2VyZ2V5LXJlc3RhcGkubGFiXC9hcGlcL3YxLjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ2MTc4MzA2MiwiZXhwIjoxNDYxNzg2NjYyLCJuYmYiOjE0NjE3ODMwNjIsImp0aSI6ImZhNDU5YjA5YTNlMjAxOWM0ZTEwYjRjZDdiM2QwN2U5In0.9G4t_946Tfq217iMq_b6BqM_3B5Awtp1tpQbONnx9RM';
    protected $expiredUserToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwMywiaXNzIjoiaHR0cDpcL1wvc2VyZ2V5LXJlc3RhcGkubGFiXC9hcGlcL3YxLjFcL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ2MjQ0ODg5MSwiZXhwIjoxNDYyNDUyNDkxLCJuYmYiOjE0NjI0NDg4OTEsImp0aSI6Ijk0MDVhMmQ0YjI2MGEzNmY5ZDRjZjljMzllNjVlODhkIn0.P9bo6m9hyhH6CAsZrtqGg6EWJlPVM3xeQuwnCvJfElA';

    protected $invalidCredentials = [
        'email' => 'updat.test@2gmail.com',
        'password' => 'secret'
    ];

    protected $validAdminCredentials = [
        'email' => 'update.test@2gmail.com',
        'password' => 'secret'
    ];

    protected $validUserCredentials = [
        'email' => 'Gibson.Angelita@example.org',
        'password' => 'secret'
    ];

    // protected function getWithInvalidCredentials(ApiTester $I, $wantTo, $path)
    // {
    //     $I->wantTo($wantTo);
    //     $I->sendPOST($path, $this->invalidCredentials);
    //     $I->seeResponseCodeIs(401);
    //     $I->seeResponseIsJson();
    //     $I->seeResponseMatchesJsonType([
    //         'error' => 'string'
    //     ]);
    // }
    //
    // protected function getWithValidCredentials(ApiTester $I, $wantTo, $path)
    // {
    //     $I->wantTo($wantTo);
    //     $I->sendPOST($path, $this->validCredentials);
    //     $I->seeResponseCodeIs(200);
    //     $I->seeResponseIsJson();
    //     $I->seeResponseMatchesJsonType([
    //         'token' => 'string'
    //     ]);
    // }

    protected function getValidToken(ApiTester $I, $role = 'user')
    {
        $validCredentials = ($role == 'admin') ? $this->validAdminCredentials : $this->validUserCredentials;
        $I->sendPOST('authenticate', $validCredentials);
        $validToken = json_decode($I->grabResponse());
        return $validToken->token;
    }

    protected function getWithInvalidToken(ApiTester $I, $wantTo, $path)
    {
        $I->wantTo($wantTo);
        $I->amBearerAuthenticated($this->invalidToken);
        $I->sendGET($path);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'error' => 'token_invalid'
        ]);
    }

    protected function getWithAbsentToken(ApiTester $I, $wantTo, $path)
    {
        $I->wantTo($wantTo);
        $I->amBearerAuthenticated('');
        $I->sendGET($path);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'error' => 'token_absent'
        ]);
    }

    protected function getWithExpiredToken(ApiTester $I, $wantTo, $path, $role = 'user')
    {
        $expiredToken = ($role == 'admin') ? $this->expiredAdminToken : $this->expiredAdminToken;
        $I->wantTo($wantTo);
        $I->amBearerAuthenticated($expiredToken);
        $I->sendGET($path);
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'error' => 'token_expired'
        ]);
    }

    protected function getWithoutProvidedToken(ApiTester $I, $wantTo, $path)
    {
        $I->wantTo($wantTo);
        // $I->amBearerAuthenticated('');
        $I->sendGET($path);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_not_provided']);
    }

    // TODO response must be in json format
    protected function getForNonAdmin(ApiTester $I, $wantTo, $path, $validToken)
    {
        $I->wantTo($wantTo);
        $I->amBearerAuthenticated($validToken);
        $I->sendGET($path);
        $I->seeResponseCodeIs(403);
        // $I->seeResponseIsJson();
        // $I->seeResponseContainsJson(['error' => 'Access denied', 'code' => '403']);
        $I->seeResponseContains('Admin only');
    }
}
