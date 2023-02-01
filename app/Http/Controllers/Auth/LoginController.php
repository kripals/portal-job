<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Models\Advertisement\Advertisement;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
//        Auth::guard('web');
        $ads = Advertisement::whereIsDeleted('no')->whereType('login')->get();
        if (Auth::guard('web')->check()) {
            if (auth()->user()->hasRole(['ROLE_COMPANY'])) {
                return redirect()->route('company.dashboard');
            }
            if (auth()->user()->hasRole(['ROLE_CANDIDATE'])) {
                return redirect()->route('candidate.dashboard');
            }
        }
        return view('auth.login',compact('ads'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
//        dd($request->all());
        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->updateLastLogin();
            if (auth()->user()->hasRole(['ROLE_COMPANY'])) {
                if(auth()->user()->company->is_verified == 'yes' && auth()->user()->company->status == 'active') {
                    return redirect()->route('company.dashboard');
                }else{
                    Auth::logout();
                    Toastr::error('Company is not verified. Please wait for the verification process to be administered.', 'Warning !!!', ["positionClass" => "toast-bottom-right"]);
                    return redirect('/login');
                }
            }
            if (auth()->user()->hasRole(['ROLE_CANDIDATE'])) {
                return redirect()->route('candidate.dashboard');
            }
//            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('login');
    }


    public function updateLastLogin()
    {
        $user = Auth::user();
        $user->last_logged_in = Carbon::now();
        $user->no_of_logins = $user->no_of_logins + 1;
        $user->save();
    }
}
