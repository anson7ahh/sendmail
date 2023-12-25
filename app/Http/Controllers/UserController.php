<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\events\SendMailEvent;
use Illuminate\Support\Facades\Event;


class UserController extends Controller


{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {

        $getuser = $this->user::all();

        return view('home', compact('getuser'));
    }
    public function store(Request $request)
    {


        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',

        ], [
            'name.required' => 'ho ten can nhap',
            'email.required' => 'email bat buoc phai nhap',
            'password.required' => 'password bat buoc phai nhap'



        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors())->withInput();
        }
        $this->user->name = $request->input('name');
        $this->user->password = Hash::make($request->password);
        $this->user->email = $request->input('email');
        $this->user->save();
        $job = (new SendMailEvent($this->user));
        dd(Event::dispatch($job));
        Event::dispatch($job);




        return redirect('/register')->with("success", 'thanh cong');
    }

    public function update(Request $request, $id)
    {

        $user = $this->user::find($id);
        if (!empty($user)) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required',

            ], [
                'name.required' => 'ho ten can nhap',
                'email.required' => 'email bat buoc phai nhap',
                'password.required' => 'password bat buoc phai nhap'



            ]);
            $this->user->update($request->all());
            return redirect('/register');
        } else {
            return redirect('/register')->with("success", 'id ko ton tai');
        }
    }
    public function show()
    {
        return view('edit');
    }
    public function delete($user_id)
    {
        if (!empty($user_id)) {
            $this->user->deleteuser($user_id);
            return redirect('/register')->with('thanh cong');
        }
        return redirect('/register')->with("success", 'id ko ton tai');
    }
}
