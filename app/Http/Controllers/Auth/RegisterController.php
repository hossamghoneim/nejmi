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

    use RegistersUsers;

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

        if(User::where('phone', $request->phone)->first())
            return 0;

        $data = [
            "name" => $request->name,
            "password" => $request->password,
            "phone" => $request->phone,
            "country_id" => $request->country_id,
            "category_id" => $request->category_id,
            "price_ad" => $request->price_ad,
            "price_gift" => $request->price_gift,
            "followers" => $request->followers,
            "about" => $request->about,
            "image" => $request->image,
            "type" => $request->type,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/users/', $newName);
            $data['image'] = $newName;
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
                'country_id' => $data['country_id'],
                'phone' => $data['phone'],
                'followers' => $data['followers'],
                'category_id' => $data['category_id'],
                'price_ad' => $data['price_ad'],
                'price_gift' => $data['price_gift'],
                'about' => $data['about'],
                'type' => $data['type'],
                'image' => $data['image'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            return User::create([
                'name' => $data['name'],
                'country_id' => $data['country_id'],
                'phone' => $data['phone'],
                'type' => $data['type'],
                'image' => $data['image'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
