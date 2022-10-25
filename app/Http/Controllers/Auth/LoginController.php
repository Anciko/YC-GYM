<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'phone';
    }

    protected function authenticated(Request $request, $user)
    {
        $role_name=$user->getRoleNames()->toArray();

        if( $user->hasAnyRole(['System_Admin'])){
            Auth::login($user);
            return redirect('admin');
        }
        if( $user->hasAnyRole(['Trainer'])){
            Auth::login($user);
            return redirect('/');
        }
        if( $user->hasAnyRole(['Free'])){
            Auth::login($user);
            return redirect('free');
        }
        if( $user->hasAnyRole(['Platinum'])){
            Auth::login($user);
            return redirect('platinum');
        }
        if( $user->hasAnyRole(['Gold'])){
            Auth::login($user);
            return redirect('gold');
        }
        if( $user->hasAnyRole(['Diamond'])){
            Auth::login($user);
            return redirect('diamond');
        }
        if( $user->hasAnyRole(['Ruby'])){
            Auth::login($user);
            return redirect('ruby');
        }
        if( $user->hasAnyRole(['Ruby Premium'])){
            Auth::login($user);
            return redirect('ruby_premium');
        }
        else{
            return redirect('/');
        }
    }
}
