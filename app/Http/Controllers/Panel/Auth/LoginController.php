<?php

namespace App\Http\Controllers\Panel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller implements HasMiddleware
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
    protected $redirectTo = 'panel';



    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function showLoginForm()
    {
        return view('panel.auth.login');
    }

    public function login(Request $request)
    {
        // $validator = $this->validateLogin($request);

        // if ($validator->fails()) {

        //     return response()->json([
        //         'status' => false,
        //         'code' => 422,
        //         'message' => $validator->errors()->first()
        //     ] , 422);
        // }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    protected function validateLogin(Request $request)
    {
        $niceNames = [
            $this->username() => __('panel.email'),
            'password' => __('panel.password'),
        ];
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|exists:admins,email',
            'password' => 'required|min:6'
        ]);
        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if (!$this->authenticated($request, $this->guard()->user())) {
            return response()->json([
                'status'    => 200,
                'redirectUrl' => url($this->redirectTo)
            ], 200);
        } else {
            return response()->json([
                'message' => trans('auth.failed')
            ], 422);
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'message' => trans('auth.failed')
        ], 422);
    }


    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }

}
