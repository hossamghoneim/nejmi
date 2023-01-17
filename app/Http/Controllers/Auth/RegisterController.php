<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // Register View
    public function showRegistrationForm()
    {
        return view('index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'country_id' => 'required',
            'phone' => 'required'
        ]);
    }

    public function register_action(Request $request) {

        if($request->username) {
            $u = User::where('username', $request->username)->first();
            if($u)
                return response()->json('اسم المستخدم موجود مسبقاً',409);
        }

        if($request->phone) {
            $u = User::where('phone', $request->phone)->first();
            if($u)
                return response()->json('رقم الهاتف موجود مسبقاً',409);
        }

        $data = [
            "name" => $request->name,
            "username" => $request->username,
            "password" => $request->password,
            "phone" => $request->phone,
            "category_id" => $request->category_id,
            "price_ad" => $request->price_ad,
            "price_gift" => $request->price_gift,
            "followers" => $request->followers,
            "about" => $request->about,
            "video" => $request->video,
            "type" => $request->type,
        ];

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $filename = $video->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $video->move('video/', $newName);
            $data['video'] = $newName;
        }

        $check = $this->create($data);

        $credentials = [
            "phone" => $data['phone'],
            "password" => $data['password'],
        ];
        Auth::attempt($credentials);
        return response()->json(1);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type'] == 1) {
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'phone' => $data['phone'],
                'followers' => $data['followers'],
                'category_id' => $data['category_id'],
                'price_ad' => $data['price_ad'],
                'price_gift' => $data['price_gift'],
                'about' => $data['about'],
                'type' => $data['type'],
                'video' => $data['video'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            return User::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'type' => $data['type'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
