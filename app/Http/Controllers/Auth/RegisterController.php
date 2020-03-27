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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'phone_number' => ['required', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:9', 'unique:users'],
            'apartment_number' => ['string', 'required', 'max:10'],
            'street' => ['string', 'required', 'max:255'],
            'ward' => ['string', 'required', 'max:255'],
            'district' => ['string', 'required', 'max:255'],
            'city' => ['string', 'required', 'max:255'],
        ]);
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
