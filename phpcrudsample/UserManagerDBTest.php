<?php
require_once '/public/includes/autoload.php';
use classes\business\UserManager;
use classes\data\UserManagerDB;
use classes\entity\User;
use classes\util\DBUtil;

/**
 * UserManagerDB test case.
 */
class UserManagerDBTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var UserManagerDB
     */
    private $userManagerDB;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated UserManagerDBTest::setUp()
        
        $this->userManagerDB = new UserManagerDB();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated UserManagerDBTest::tearDown()
        $this->userManagerDB = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests UserManagerDB::fillUser()
     */
    public function testFillUser()
    {
        // TODO Auto-generated UserManagerDBTest::testFillUser()
        $this->markTestIncomplete("fillUser test not implemented");
        
        UserManagerDB::fillUser(/* parameters */);
    }

    /**
     * Tests UserManagerDB::loginPasswordCheck()
     */
    public function testLoginPasswordCheck()
    {
        // TODO Auto-generated UserManagerDBTest::testGetUserByEmailPassword()
        // $this->markTestIncomplete("getUserByEmailPassword test not implemented");
        
        $user = UserManagerDB::loginPasswordCheck('temporesta@gmail.com', 'Password123');

        $this->assertTrue($user);
    }

    /**
     * Tests UserManagerDB::getUserByEmail()
     */
    public function testGetUserByEmailValid()
    {
        // TODO Auto-generated UserManagerDBTest::testGetUserByEmail()
        //$this->markTestIncomplete("getUserByEmail test not implemented");
        
       $user = UserManagerDB::getUserByEmail('mdnurerfan105@gmail.com');

       $this->assertEquals('Muhammad Nur Erfan Bin', $user->firstName);
    }
    
    public function testGetUserByEmailInvalid()
    {
        // TODO Auto-generated UserManagerDBTest::testGetUserByEmail()
        //$this->markTestIncomplete("getUserByEmail test not implemented");
        
       $user = UserManagerDB::getUserByEmail('wrongemail@gmail.com');

       $this->assertEquals(NULL, $user);
    }

    /**
     * Tests UserManagerDB::getUserById()
     */
    public function testGetUserByIdValid()
    {
        // TODO Auto-generated UserManagerDBTest::testGetUserById()
        // $this->markTestIncomplete("getUserById test not implemented");
        
        $user = UserManagerDB::getUserById('2');

        $this->assertEquals('Muhammad Nur Erfan Bin', $user->firstName);
    }

    public function testGetUserByIdInvalid()
    {
        // TODO Auto-generated UserManagerDBTest::testGetUserById()
        // $this->markTestIncomplete("getUserById test not implemented");
        
        $user = UserManagerDB::getUserById('30');

        $this->assertEquals(NULL, $user);
    }

    /**
     * Tests UserManagerDB::saveUser()
     */
    public function testSaveUser()
    {
        // TODO Auto-generated UserManagerDBTest::testSaveUser()
        $this->markTestIncomplete("saveUser test not implemented");
        
        UserManagerDB::saveUser(/* parameters */);
    }

    /**
     * Tests UserManagerDB::updatePassword()
     */
    public function testUpdatePassword()
    {
        // TODO Auto-generated UserManagerDBTest::testUpdatePassword()
        $this->markTestIncomplete("updatePassword test not implemented");
        
        UserManagerDB::updatePassword(/* parameters */);
    }

    /**
     * Tests UserManagerDB::deleteAccount()
     */
    public function testDeleteAccount()
    {
        // TODO Auto-generated UserManagerDBTest::testDeleteAccount()
        $this->markTestIncomplete("deleteAccount test not implemented");
        
        UserManagerDB::deleteAccount(/* parameters */);
    }

    /**
     * Tests UserManagerDB::getAllUsers()
     */
    public function testGetAllUsers()
    {
        // TODO Auto-generated UserManagerDBTest::testGetAllUsers()
        // $this->markTestIncomplete("getAllUsers test not implemented");
        
        $users = UserManagerDB::getAllUsers();
        $this->assertEquals(5, sizeof($users)-1);
    }

    /**
     * Tests UserManagerDB::searchUserFirstName()
     */
    // public function testSearchUserFirstNameValid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserFirstName()
    //     // $this->markTestIncomplete("searchUserFirstName test not implemented");
        
    //     $users = UserManagerDB::searchUserFirstName('c');

    //     $this->assertEquals(2, count($users));
    //     $this->assertEquals('Cristiano', $users[1]->firstName);
    // }

    // public function testSearchUserFirstNameInvalid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserFirstName()
    //     // $this->markTestIncomplete("searchUserFirstName test not implemented");
        
    //     $user = UserManagerDB::searchUserFirstName('p');

    //     $this->assertEquals(1, count($user));
    // }

    // /**
    //  * Tests UserManagerDB::searchUserLastName()
    //  */
    // public function testSearchUserLastNameValid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserLastName()
    //     // $this->markTestIncomplete("searchUserLastName test not implemented");
        
    //     $users = UserManagerDB::searchUserLastName('m');

    //     $this->assertEquals(3, count($users));
    //     $this->assertEquals('Najib', $users[1]->firstName);
    //     $this->assertEquals('Lionel', $users[2]->firstName);
    // }

    // public function testSearchUserLastNameInvalid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserLastName()
    //     // $this->markTestIncomplete("searchUserLastName test not implemented");
        
    //     $users = UserManagerDB::searchUserLastName('f');

    //     $this->assertEquals(1, count($users));
    // }

    // /**
    //  * Tests UserManagerDB::searchUserEmail()
    //  */
    // public function testSearchUserEmailValid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserEmail()
    //     // $this->markTestIncomplete("searchUserEmail test not implemented");
        
    //     $users = UserManagerDB::searchUserEmail('p');

    //     $this-> assertEquals(2, count($users));
    //     $this-> assertEquals('da', $users[1]->firstName);
    // }

    // public function testSearchUserEmailInvalid()
    // {
    //     // TODO Auto-generated UserManagerDBTest::testSearchUserEmail()
    //     // $this->markTestIncomplete("searchUserEmail test not implemented");
        
    //     $users = UserManagerDB::searchUserEmail('q');

    //     $this-> assertEquals(1, count($users));
    // }
}
