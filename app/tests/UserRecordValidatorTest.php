<?php

class UserRecordValidatorTest extends TestCase
{
    public function setUp()
    {
        $this->validParams   = [
            'name' => 'Foo',
            'email' => 'foo@example.com',
            'password' => 'validlength',
            'password_confirmation' => 'validlength'
        ];
        $this->validParamsNoPassword = [
            'name' => 'Foo',
            'email' => 'foo@example.com'
        ];
        $this->invalidParams = [
            'name' => 'Foo',
            'email' => 'foo@example.com',
            'password' => 'short'
        ];
    }

    public function testWillValidateUserWithoutPassword()
    {
        $params = array_merge(['id' => 1], $this->validParamsNoPassword);
        $this->validator = new UserRecordValidator($params);

        $this->assertTrue($this->validator->isValid());
    }

    public function testWillValidateUserWithValidPassword()
    {
        $params = array_merge(['id' => 1], $this->validParams);
        $this->validator = new UserRecordValidator($params);

        $this->assertTrue($this->validator->isValid());
    }

    public function testWontValidateRegistrantWithoutPassword()
    {
        $this->validator = new UserRecordValidator($this->validParamsNoPassword);

        $this->assertFalse($this->validator->isValid());
    }

    public function testWontValidateInvalidUser()
    {
        $this->validator = new UserRecordValidator($this->invalidParams);

        $this->assertFalse($this->validator->isValid());
        $this->assertCount(2, $this->validator->getErrors());
    }
}
