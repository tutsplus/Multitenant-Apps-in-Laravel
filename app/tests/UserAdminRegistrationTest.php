<?php

class UserAdminRegistrationTest extends TestCase
{
    public function setUp()
    {
        $this->params = [
            'name' => 'Foo',
            'email' => 'foo@example.com'
        ];
        $this->newUser = Mockery::mock('User[save]');
        $this->existingUser = Mockery::mock('User[save]');
        $this->existingUser->id = 1;
        $this->existingUser->exists = true;
        $this->existingUser->fill($this->params);

    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCanCreateANewUser()
    {
        $this->newUser->shouldReceive('save')->andReturn($this->newUser);

        $params = array_merge($this->params, [
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]);

        $creator = new UserAdminRegistration($params, $this->newUser);
        $this->assertTrue($creator->save());
    }

    public function testCanUpdateAnExistingUser()
    {
        $this->existingUser->shouldReceive('save')->andReturn($this->existingUser);

        $creator = new UserAdminRegistration(['name' => 'Bar'], $this->existingUser);

        $this->assertTrue($creator->save());
        $this->assertEquals('Bar', $creator->getUser()->name);
    }
}
