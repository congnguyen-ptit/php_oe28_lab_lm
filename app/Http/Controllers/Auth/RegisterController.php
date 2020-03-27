<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Models\User;
use App\Http\Models\Location;
use App\Enums\UserRole;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'code' => Str::random(config('const.code')),
            'name' => $data['name'],
            'user_slug' => Str::slug($data['name']),
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => UserRole::User,
        ]);
        $location = Location::create([
            'apartment_number' => $data['apartment_number'],
            'street' => $data['street'],
            'ward' => $data['ward'],
            'district' => $data['district'],
            'city' => $data['city'],
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
