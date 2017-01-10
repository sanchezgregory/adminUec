<?php


class AccessHandlerTest extends TestCase
{
    public function testCheck()
    {
        $this->assertTrue(
            Access::check('admin', 'editor'),
            'Admin deberia ver modulos de editor'
        );

        $this->assertTrue(
            Access::check('editor', 'user'),
            'Editor deberia ver modulos de user'
        );

        $this->assertFalse(
            Access::check('user', 'admin'),
            'user NO deberia ver modulos de admin'
        );

        $this->assertFalse(
            Access::check('user', 'editor'),
            'User NO deberia ver modulos de editor'
        );
    }
}