<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Http\Controllers\UserController;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Mockery;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\RedirectResponse;

class UserControllerTest extends TestCase
{
    protected $userController;

    public function setUp(): void
    {
        $this->userController = new UserController();
        parent::setUp();
    }

    public function tearDown():void
    {
        unset($this->userController);
        parent::tearDown();
    }

    public function test_add_book()
    {
        $view = $this->userController->addBook();
        $this->assertEquals('user.pages.addbook', $view->getName());
    }

    public function test_myaccount()
    {
        $result = $this->userController->myAccount('2');
        $this->assertEquals('user.pages.myaccount', $result->getName());
        $this->assertArrayHasKey('user', $result->getData());
    }

    public function test_update()
    {
        $data = [
            'code' => 'asdavx',
            'name' => 'test',
            'user_slug' => 'test',
            'email' => 'test@gmail.com',
            'phone_number' => '032165498',
            'username' => 'asdxcv',
            'role_id' => '1',
        ];
        $request = new Request();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));
        $result = $this->userController->update($request, '2');
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertArrayHasKey('success', $result->getSession()->all());
    }
}
