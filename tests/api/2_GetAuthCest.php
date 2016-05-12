<?php

class GetAuthCest extends ApiCest
{
    /**
     * CREATE NEW TOKEN
     */

    public function getTokenWithInvalidCredentials(ApiTester $I)
    {
        $I->wantTo('try to get token with invalid credentials');
        $I->sendPOST('authenticate', $this->invalidCredentials);
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'error' => 'string'
        ]);
    }

    public function getTokenWithValidCredentials(ApiTester $I)
    {
        $I->wantTo('get valid auth token');
        $I->sendPOST('authenticate', $this->validUserCredentials);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'token' => 'string'
        ]);
    }


    /**
     * GET AUTHENTICATED USER
     */

    public function getAuthenticateUserWithInvalidToken(ApiTester $I)
    {
        $this->getWithInvalidToken($I, 'try to authenticate user with invalid token', 'authenticate/user');
    }

    public function getAuthenticateUserWithAbsentToken(ApiTester $I)
    {
        $this->getWithAbsentToken($I, 'try to authenticate user with absent token', 'authenticate/user');
    }

    public function getAuthenticateUserWithExpiredToken(ApiTester $I)
    {
        $this->getWithExpiredToken($I, 'try to authenticate user with expired token', 'authenticate/user');
    }

    public function getAuthenticatedUser(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('get authenticated user');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('authenticate/user');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'user' => [
                'id' => 'integer',
                'name' => 'string',
                'email' => 'string',
                'created_at' => 'string',
                'updated_at' => 'string'
                ]
        ]);
    }

    /**
     * REFRESH TOKEN
     */

    public function getRefreshWithInvalidToken(ApiTester $I)
    {
        $this->getWithInvalidToken($I, 'try to refresh token with invalid token', 'refresh');
    }

    public function getRefreshWithAbsentToken(ApiTester $I)
    {
        $this->getWithAbsentToken($I, 'try to refresh token with absent token', 'authenticate/user');
    }

    public function getRefreshWithExpiredToken(ApiTester $I)
    {
        $this->getWithExpiredToken($I, 'try to refresh token with expired token', 'authenticate/user');
    }

    // TODO the answer doesn't correspond to the docs
    public function getRefreshToken(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('refresh valid token');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('refresh');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'token' => 'string'
        ]);
    }

    /**
     * INVALIDATE TOKEN
     */

    public function getInvalidateWithInvalidToken(ApiTester $I)
    {
        $this->getWithInvalidToken($I, 'try to invalidate token with invalid token', 'logout');
    }

    public function getInvalidateWithAbsentToken(ApiTester $I)
    {
        $this->getWithAbsentToken($I, 'try to invalidate token with absent token', 'authenticate/user');
    }

    public function getInvalidateWithExpiredToken(ApiTester $I)
    {
        $this->getWithExpiredToken($I, 'try to invalidate token with expired token', 'authenticate/user');
    }

    public function getInvalidateToken(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('invalidate valid token');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('logout');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContains('success');
    }
}
