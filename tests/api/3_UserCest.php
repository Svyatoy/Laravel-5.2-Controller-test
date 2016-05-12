<?php


class UserCest extends ApiCest
{
    private function getValidUserTokenForCreatedUser(ApiTester $I)
    {
        $I->sendPOST('authenticate', ['email' => 'abe@simpson.org', 'password' => 'secret']);
        // set valid user token
        $validToken = json_decode($I->grabResponse());
        $this->validUserTokenForCreatedUser = $validToken->token;
    }

    /**
     * GET ALL USERS
     */

    public function getAllUsersWithoutProvidedToken(ApiTester $I)
    {
        $this->getWithoutProvidedToken($I, 'try to get all users without provided token', 'users');
    }

    public function getAllUsersWithInvalidToken(ApiTester $I)
    {
        $this->getWithInvalidToken($I, 'try to get all users with invalid token', 'users');
    }

    public function getAllUsersWithExpiredToken(ApiTester $I)
    {
        $this->getWithExpiredToken($I, 'try to get all users with expired token', 'users');
    }

    public function getAllUsersForNonAdmin(ApiTester $I)
    {
        $validToken = $this->getValidToken($I, 'user');
        $this->getForNonAdmin($I, 'try to get all users for nonadmin users', 'users', $validToken);
    }

    public function getAllUsersForAdmin(ApiTester $I)
    {
        $validToken = $this->getValidToken($I, 'admin');

        $I->wantTo('get all users for admin');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('users');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$..id');
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..created_at');
        $I->seeResponseJsonMatchesJsonPath('$..updated_at');
    }

    /**
     * GET SPECIFIC USER
     */

    public function getSpecificUserWithoutProvidedToken(ApiTester $I)
    {
        $this->getWithoutProvidedToken($I, 'try to get specific user without provided token', 'users/104');
    }

    public function getSpecificUserWithInvalidToken(ApiTester $I)
    {
        $this->getWithInvalidToken($I, 'try to get specific user with invalid token', 'users/104');
    }

    public function getSpecificUserWithExpiredToken(ApiTester $I)
    {
        $this->getWithExpiredToken($I, 'try to get specific user with expired token', 'users/104');
    }

    public function getNonexistentUser(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('try to get nonexistent user');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('users/0');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'User not found']);
    }

    public function getSpecificUserForNonOwner(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('try to get specific user for owner');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('users/104');
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Forbidden to see this user']);
    }

    public function getSpecificUserForOwner(ApiTester $I)
    {
        $validToken = $this->getValidToken($I);

        $I->wantTo('try to get specific user for nonowner users');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('users/103');
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Forbidden to see this user']);
    }

    public function getSpecificUserForAdmin(ApiTester $I)
    {
        $validToken = $this->getValidToken($I, 'admin');

        $I->wantTo('try to get specific user for admin users');
        $I->amBearerAuthenticated($validToken);
        $I->sendGET('users/104');
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Forbidden to see this user']);
    }

    /**
     * CREATE USER
     */

    public function createUserWithoutParams(ApiTester $I)
    {
        $I->wantTo('try to create user without parameters');
        $I->sendPOST('users');
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
    }

    public function createUserWithIncorrectParams(ApiTester $I)
    {
        $I->wantTo('try to create user with incrorrect parameters');
        $I->sendPOST('users', ['name' => 'ab', 'email' => 'mail', 'password' => '12345']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..password');
    }

    public function createUser(ApiTester $I)
    {
        $I->wantTo('create user');
        $I->sendPOST('users', ['name' => 'abe', 'email' => 'abe@simpson.org', 'password' => 'secret']);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$..id');
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..created_at');
        $I->seeResponseJsonMatchesJsonPath('$..updated_at');
        $userId = json_decode($I->grabResponse());
        $this->createdUserId = $userId->id;
    }

    /**
     * UPDATE USER
     */
    public function updateUserWithoutProvidedToken(ApiTester $I)
    {
        $I->wantTo('try to update user without provided token');
        $I->amBearerAuthenticated('');
        $I->sendPUT("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_not_provided']);
    }

    public function updateUserWithInvalidToken(ApiTester $I)
    {
        $I->wantTo('try to update user with invalid token');
        $I->amBearerAuthenticated($this->invalidToken);
        $I->sendPUT("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_invalid']);
    }

    public function updateUserWithAbsentToken(ApiTester $I)
    {
        $I->wantTo('try to update user with absent token');
        $I->amBearerAuthenticated('');
        $I->sendPUT("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_not_provided']);
    }

    public function updateNonexistentUser(ApiTester $I)
    {
        $I->wantTo('try to update nonexistent user with validation parameters');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendPUT(
            'users/0',
            [
                'name' => 'Bob',
                'email' => 'secondnamebob@simpson.org',
                'password' => 'secret'
            ]
        );
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'user not found']);
    }

    public function updateUserForNonOwner(ApiTester $I)
    {
        $I->wantTo('try to update user for nonowner users');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendPUT(
            "users/{$this->createdUserId}",
            [
                'name' => 'Bob',
                'email' => 'secondnamebob@simpson.org',
                'password' => 'secret'
            ]
        );
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Forbidden to update this user']);
    }

    public function updateUserWithoutParameters(ApiTester $I)
    {
        $I->wantTo('try to update user without parameters users');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendPUT("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(422);
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..password');
    }

    public function updateUserWithIncorrectParams(ApiTester $I)
    {
        $I->wantTo('try to create user with incrorrect parameters');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendPUT(
            "users/{$this->createdUserId}",
            [
                'name' => '##',
                'email' => 'secondnamebob',
                'password' => '1234'
            ]
        );
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..password');
    }

    public function updateUserForOwner(ApiTester $I)
    {
        $this->getValidUserTokenForCreatedUser($I);
        $I->wantTo('try to update user for owner');
        $I->amBearerAuthenticated($this->validUserTokenForCreatedUser);
        $I->sendPUT(
            "users/{$this->createdUserId}",
            [
                'name' => 'Bob',
                'email' => 'secondnamebob@simpson.org',
                'password' => 'secret'
            ]
        );
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Forbidden to update this user']);
    }

    public function updateUserForAdmin(ApiTester $I)
    {
        $I->wantTo('update user for admin');
        $I->amBearerAuthenticated($this->validAdminToken);
        $I->sendPUT(
            "users/{$this->createdUserId}",
            [
                'name' => 'Bob',
                'email' => 'secondnamebob@simpson.org',
                'password' => 'secret'
            ]
        );
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        $I->seeResponseJsonMatchesJsonPath('$..id');
        $I->seeResponseJsonMatchesJsonPath('$..name');
        $I->seeResponseJsonMatchesJsonPath('$..email');
        $I->seeResponseJsonMatchesJsonPath('$..created_at');
        $I->seeResponseJsonMatchesJsonPath('$..updated_at');
    }

    /**
     * DELETE USER
     */
     // TODO docs doesn't have error describe
    public function deleteUserWithoutProvidedToken(ApiTester $I)
    {
        $I->wantTo('try to delete user without provided token');
        $I->amBearerAuthenticated('');
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_not_provided']);
    }

    public function deleteUserWithInvalidToken(ApiTester $I)
    {
        $I->wantTo('try to delete user with invalid token');
        $I->amBearerAuthenticated($this->invalidToken);
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_invalid']);
    }

    public function deleteUserWithAbsentToken(ApiTester $I)
    {
        $I->wantTo('try to delete user with absent token');
        $I->amBearerAuthenticated('');
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'token_not_provided']);
    }

    public function deleteNonexistentUser(ApiTester $I)
    {
        $I->wantTo('try to delete nonexistent user');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendGET('users/0');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'User not found']);
    }

    public function deleteUserForNonOwner(ApiTester $I)
    {
        $I->wantTo('try to delete user for nonowner');
        $I->amBearerAuthenticated($this->validUserToken);
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Access denied', 'code' => '403']);
    }

    public function deleteUserForOwner(ApiTester $I)
    {
        $this->getValidUserTokenForCreatedUser($I);
        $I->wantTo('try to delete user for owner');
        $I->amBearerAuthenticated($this->validUserTokenForCreatedUser);
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Access denied', 'code' => '403']);
    }

    public function deleteUserForAdmin(ApiTester $I)
    {
        $I->wantTo('delete user for admin');
        $I->amBearerAuthenticated($this->validAdminToken);
        $I->sendDELETE("users/{$this->createdUserId}");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['error' => 'Access denied', 'code' => '403']);
    }
}
