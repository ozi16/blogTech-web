<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Helpers\CMail;
use App\Enums\UserStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Forgot Password'
        ];
        return view('back.pages.auth.forgot', $data);
    }

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Enter your email or username',
                'login_id.email' => 'invalid email address',
                'login_id.exists' => 'Email or username does not exist',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Enter your username or email',
                'login_id.exists' => 'No account found this username'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password,
        );

        if (Auth::attempt($creds)) {
            // check if account is inactive mode
            if (auth()->user() == UserStatus::Inactive) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'your  account is currently inactive. please , contact support for futher assistanse.');
            }

            // check i account if is pending mode
            if (auth()->user()->status == UserStatus::Pending) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'your account is currently pending. please , contact support for futher assistanse.');
            }

            // redirect use to dashboard
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withInput()->with('fail', 'incorrect password');
        }
    } //end Method

    public function sendPasswordResetLink(Request $request)
    {
        // Validate the form
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'The :attribute is required',
            'email.email' => 'Invalid email address',
            'email.exist' => 'We can not find a user with this email address'
        ]);

        // GET User Details
        $user = User::where('email', $request->email)->first();

        // Generate TOKEN
        $token = base64_encode(Str::random(64));

        // Check if there is an existing token
        $oldToken = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if ($oldToken) {
            // update existing token
            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            // Add New reset Token
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        // create clickable action link
        $actionLink = route('admin.reset_password_form', ['token' => $token]);

        $data = array(
            'actionLink' => $actionLink,
            'user' => $user
        );

        $mail_body = view('email-template.forgot-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->name,
            'subject' => 'Reset Password',
            'body' => $mail_body
        );

        if (CMail::send($mailConfig)) {
            return redirect()->route('admin.forgot')->with('success', 'Password reset link has been sent to your email');
        } else {
            return redirect()->route('admin.forgot')->with('fail', 'Failed to send password reset');
        }
    }
}
