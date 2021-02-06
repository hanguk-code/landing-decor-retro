<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Illuminate\Support\Facades\Mail;

use App\Models\User\User;
use App\Helpers\HashGen;
use App\Mail\RegisterEmail;

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
    protected $redirectTo = '/';

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
            //'hash' => ['required', 'string', 'max:255', 'unique:user'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8'],
            //'type' => new EnumRule(UserStatus::class),
            //'status' => new EnumRule(UserType::class),
        ]);
    }

//    /**
//     * Create a new user instance after a valid registration.
//     *
//     * @param  array  $data
//     * @return \App\User
//     */
//    protected function create(array $data)
//    {
//        $hashGen = new HashGen();
//        $currentId = \DB::table('user')->max('id');
//        return User::create([
//            'id' => $currentId + 1,
//            'hash' => $hashGen->make(),
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'type' =>  UserType::registered(),
//            'status' => UserStatus::active(),
//        ]);
//    }

    public function register(Request $request)
    {
       $this->validate($request, [
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8'],
       ]);

        $hashGen = new HashGen();
        $email = $request->email;
        $name = $request->name;
        $password = $request->password;

        $user            = new User();
        $user->hash      = $hashGen->make();
        $user->name      = $name;
        $user->email     = $email;
        $user->password  = Hash::make($password);
        $user->status    = 'active';

        //send email with password after registration
        if($user->save()) {
            //$user->profile()->create(['name' =>$name]);
            // $objRegUser = new \stdClass();
            // $objRegUser->password = $pass;
            // $objRegUser->name = $name;

            // Mail::to($email)->send(new RegisterEmail($objRegUser));
        }

        return $this->registered($request, $user, $email, $password);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user, $email, $password)
    {
        return response()->json([
            'token'    => $user->createToken($request->input('driver'))->accessToken,
            'user'     => $request->user(),
            'form'    => ['email' => $email, 'password' => $password]
        ]);
    }

  
    public function register2(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }
}
