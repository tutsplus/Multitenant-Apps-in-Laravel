<?php

class CanITest extends TestCase
{
    public function setUp()
    {
        $this->auth = new CanI\CanI((object)['id' => 1]);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testWillFailWithoutAnyRule()
    {
        $this->assertFalse($this->auth->can('read', 'Post'));
    }

    public function testWillFailWithoutMatchingRule()
    {
        $this->auth->allow('read', 'stdClass');

        $this->assertFalse($this->auth->can('read', 'Post'));
    }

    public function testWillFailWithoutMatchingEntity()
    {
        $this->auth->allow('read', 'stdClass');

        $this->assertFalse($this->auth->can('read', Mockery::mock('Post')));
    }

    public function testWillFailWithoutSuccessfulCondition()
    {
        $this->auth->allow('read', 'Post', function($post) {
            return false;
        });

        $this->assertFalse($this->auth->can('read', 'Post'));
    }

    public function testWillAllowWithMatchingRule()
    {
        $this->auth->allow('read', 'Post');

        $this->assertTrue($this->auth->can('read', 'Post'));
    }

    public function testWillAllowWithMatchingRuleWithInstance()
    {
        $mockPost = Mockery::mock('Post');
        $this->auth->allow('read', get_class($mockPost));


        $this->assertTrue($this->auth->can('read', $mockPost));
    }

    public function testWillAllowWithPositiveCondition()
    {
        $mockPost = Mockery::mock('Post');
        $this->auth->allow('read', get_class($mockPost), function($post) {
            return $this->getUser()->id === 1;
        });


        $this->assertTrue($this->auth->can('read', $mockPost));
    }
}
