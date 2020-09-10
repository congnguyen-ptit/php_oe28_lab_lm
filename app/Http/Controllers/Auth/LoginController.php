<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Http\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        if ($user->role_id == UserRole::Administrator) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->stateless()->user();
        $authUser = $this->findOrCreateUser($user, $service);
        if ($authUser) {
            Auth::login($authUser, true);
            return redirect()->route('home');
        }
    }

    public function findOrCreateUser($user, $service)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'code' => Str::random(5),
            'name' => $user->name,
            'user_slug' => Str::slug($user->name),
            'email' => $user->email,
            'username' => $user->email,
            'provider' => $service,
            'provider_id' => $user->id,
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'is_vip' => 0,
        ]);
    }
}
