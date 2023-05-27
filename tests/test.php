<?php

use PHPUnit\Framework\TestCase;
use App\User;

require 'User.php';

class Test extends TestCase
{
    private $user;

    public function test()
    {
        $this->assertEquals(1, 1);
    }

    protected function setUp(): void
    {
        $this->user = new User();
    }

    //function qui test l'insertion d'un user
    public function test_insert_user()
    {
        $this->assertEquals(1, $this->user->insert_user("test", "test@test.com", "test", 0, 0));
    }
}

?>