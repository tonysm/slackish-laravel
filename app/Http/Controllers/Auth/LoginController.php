<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'index']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @param string $provider
     *
     * @return mixed
     */
    public function create($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($provider)
    {
        /** @var \Laravel\Socialite\AbstractUser $providerUser */
        $providerUser = Socialite::driver($provider)->user();

        $user = $this->findOrCreate($providerUser);

        auth()->login($user);

        return redirect()->home();
    }

    /**
     * @param \Laravel\Socialite\AbstractUser $providerUser
     *
     * @return mixed
     */
    private function findOrCreate(AbstractUser $providerUser)
    {
        if ($user = User::where('google_id', $providerUser->id)->first()) {
            return $user;
        }

        return User::create([
            'google_id' => $providerUser->id,
            'google_token' => encrypt($providerUser->token),
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'avatar_path' => $providerUser->getAvatar(),
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('welcome');
    }
}
