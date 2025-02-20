<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class AdminController extends Controller
{
    public function adminDashboard(Request $request)
    {
        $data = [
            'pageTitle' => 'Admin'
        ];
        return view('back.pages.dashboard', $data);
    }

    public function logoutHandler(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (isset($request->source)) {
            return redirect()->back();
        }
        return redirect()->route('admin.login')->with('fail', 'you are now logged out');
    }

    public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'profile'
        ];
        return view('back.pages.profile', $data);
    } // end of profileView method

    public function generalSettings(Request $request)
    {
        $data = [
            'pageTitle' => 'General Settings'
        ];
        return view('back.pages.general_settings', $data);
    } // End method

    // public function updateLogo(Request $request){
    //     $settings = GeneralSetting::take(1)->first();

    //     if(!is_null($settings)){
    //         $path = 'images/site/';
    //         $old_logo = $settings->site_logo;
    //         $file = $request->file('site_logo');
    //         $filename = 'logo_'.uniqid(). '.png';

    //         if($request->hasFile('site_logo')){
    //             $upload = $file->move(public_path($path),$filename);

    //             if($upload){
    //                 if($old_logo != null && File::exists(public_path($path.$old_logo)) ){

    //                 }
    //             }
    //         }
    //     }
    // }

    public function categoriesPage(Request $request)
    {
        $data = [
            'pageTitle' => 'Manage categories'
        ];
        return view('back.pages.categories_page', $data);
    }
}
