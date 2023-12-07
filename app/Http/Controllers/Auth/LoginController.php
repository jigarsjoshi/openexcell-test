<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')->user();
 
        $user = User::where('google_id', $socialUser->id)->first();

        if ($user) { 
            Auth::login($user);  

            if($user->user_type == 0) {
                return redirect()->route('client.dashboard');
            } else {
                return redirect()->route('designer.dashboard');
            }
        } else { 

            $existingUser = User::where('email', $socialUser->email)->first();

            if ($existingUser) { 
                 
                Auth::login($existingUser); 

                if($existingUser->user_type == 0) {
                    return redirect()->route('client.dashboard');
                } else {
                    return redirect()->route('designer.dashboard');
                }

            } else { 

                $newUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'google_id' => $socialUser->id,
                ]); 

                Auth::login($newUser); 
 
                return redirect()->route('complete-profile');  
            }
        }   
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();
 
        $user = User::where('fb_id', $socialUser->id)->first();

        if ($user) { 
            Auth::login($user);
            
            if($user->user_type == 0) {
                return redirect()->route('client.dashboard');
            } else {
                return redirect()->route('designer.dashboard');
            }

        } else { 

            $existingUser = User::where('email', $socialUser->email)->first();

            if ($existingUser) {    

                Auth::login($existingUser); 
            
            
                if($user->user_type == 0) {
                    return redirect()->route('client.dashboard');
                } else {
                    return redirect()->route('designer.dashboard');
                } 

            } else { 

                $newUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'fb_id' => $socialUser->id,
                ]);
 
                Auth::login($newUser);
  
                return redirect()->route('complete-profile'); 
            }
        } 
        // return redirect('/dashboard');
    }

    public function completeProfile()
    {
        // return view('complete-profile');
        $userId = Auth::id();
        $data['user'] = User::find($userId);

        return view('complete-profile', $data);

    }

    public function saveProfile(Request $request)
    {
        $user = User::find(Auth::id());

        if ($user) { 
            $request->validate([
                'dial_code' => 'required',
                'phone' => 'required|unique:users,phone,' . $user->id,
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_type' => 'required',
            ]);
 
            $user->update([
                'dial_code' => $request->input('dial_code'),
                'phone' => $request->input('phone'),
                'user_type' => $request->input('user_type'),
            ]);
 
            if ($request->hasFile('profile_pic')) {
                $profilePic = $request->file('profile_pic');
                $filename = time() . '.' . $profilePic->getClientOriginalExtension();
 
                $path = $profilePic->storeAs('profile_pics', $filename, 'public');
 
                $user->profile_pic = $path;
                $user->save();
            }
 
            if($user->user_type == 0) {
                return redirect()->route('client.dashboard');
            } else {
                return redirect()->route('designer.dashboard');
            }
        }

        redirect('login');
    }
}
