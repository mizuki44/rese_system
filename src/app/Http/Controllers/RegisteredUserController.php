<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (request()->is('admin/*')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', Rules\Password::defaults()],
                'role' => ['required', 'string'],
            ]);

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            event(new Registered($admin));

            Auth::login($admin);

            return 'success!';

        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', Rules\Password::defaults()],

            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }
    }
}

// namespace App\Http\Controllers;
// namespace Laravel\Fortify\Http\Controllers;

// use Illuminate\Auth\Events\Registered;
// use Illuminate\Contracts\Auth\StatefulGuard;
// use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;
// use Illuminate\Support\Str;
// use Laravel\Fortify\Contracts\CreatesNewUsers;
// use Laravel\Fortify\Contracts\RegisterResponse;
// use Laravel\Fortify\Contracts\RegisterViewResponse;
// use Laravel\Fortify\Fortify;

// class RegisteredUserController extends Controller
// {
//     /**
//      * The guard implementation.
//      *
//      * @var \Illuminate\Contracts\Auth\StatefulGuard
//      */
//     protected $guard;

//     /**
//      * Create a new controller instance.
//      *
//      * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
//      * @return void
//      */
//     public function __construct(StatefulGuard $guard)
//     {
//         $this->guard = $guard;
//     }

//     /**
//      * Show the registration view.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Laravel\Fortify\Contracts\RegisterViewResponse
//      */
//     public function create(Request $request): RegisterViewResponse
//     {
//         return app(RegisterViewResponse::class);
//     }

//     /**
//      * Create a new registered user.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
//      * @return \Laravel\Fortify\Contracts\RegisterResponse
//      */
//     public function store(
//         Request $request,
//         CreatesNewUsers $creator
//     ): RegisterResponse {
//         if (config('fortify.lowercase_usernames')) {
//             $request->merge([
//                 Fortify::username() => Str::lower($request->{Fortify::username()}),
//             ]);
//         }

//         event(new Registered($user = $creator->create($request->all())));

//         $this->guard->login($user);

//         return app(RegisterResponse::class);
//     }
// }
