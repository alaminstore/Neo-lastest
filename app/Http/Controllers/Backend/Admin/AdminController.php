<?php

namespace App\Http\Controllers\Backend\Admin;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use function compact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use function redirect;
use function response;
use function unlink;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins  = User::with('role')
                        ->select('users.*')
                        ->orderBy('id','desc')
                        ->where('flag', 1)
                        ->where('role_id','!=', 8)
                        ->get();
        $roles   = Role::get();
        return view('backend.admins.admins', compact('admins', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required | string | max:255',
            'email'    => 'required | string | max:190 | unique:users',
            'phone'    => 'required | digits:11',
            'role'     => 'required',
            'password' =>'nullable | string | min:8 |confirmed',
        ]);
        $user_last = '';
        DB::beginTransaction();
        try {
            $user               = new User;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->role_id = $request->role;
            $user->phone_number = $request->phone;
            $user->password     = Hash::make($request->password);
            if($request->hasFile('photo'))
            {
                $path               = 'uploads/admins/';

                $image              = $request->photo;
                $imageName          = time().$image->getClientOriginalName();

                $image->move($path,$imageName);
                $user->photo  = $path.$imageName;
            }

            $user->save();

            $user_last = User::with('role')->where('id', $user->id)->first();
            DB::commit();
            $notification = array('message' => 'Information added successfully', 'alert-type'=> 'success');
            return response()->json([
                'user_last' => $user_last,
                'notification' => $notification
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return response()->json([
                'user_last' => $user_last,
                'notification' => $notification
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin  = User::find($id);
        return response()->json($admin);
    }



    public  function adminUpdate(Request $request)
    {
        $request->validate([
            'name'     => 'required | string | max:255',
            'email'    => 'required | string | max:190 | unique:users,email,'.$request->admin_id,
            'phone'    => 'required | digits:11',
            'role'     => 'required',
            'password' =>'nullable | string | min:8 |confirmed',
        ]);
        $user_update = '';
        DB::beginTransaction();
        try {
            $user               = User::find($request->admin_id);

            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->role_id      = $request->role;
            $user->phone_number = $request->phone;
            if($request->password) {
                $user->password     = Hash::make($request->password);
            }
            if($request->hasFile('photo'))
            {

                $path               = 'uploads/admins/';
                @unlink($user->photo);

                $image              = $request->photo;
                $imageName          = time().$image->getClientOriginalName();

                $image->move($path,$imageName);
                $user->photo  = $path.$imageName;
            }

            $user->save();
            $user_update = User::with('role')->where('id', $user->id)->first();
            DB::commit();
            $notification = array('message' => 'Information updated successfully', 'alert-type'=> 'success');
            return response()->json([
                'user_update' => $user_update,
                'notification' => $notification
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
            return response()->json([
                'user_update' => $user_update,
                'notification' => $notification
            ]);
        }
    }

    public  function delete() {

        $admin          = User::find(request()->id);
        $admin->status  = 0;
        $admin->flag    = 0;
        if($admin->save())
        {
            $user_delete = true;
            $notification = array('message' => 'Information deleted successfully', 'alert-type'=> 'success');
        }
        else
        {
            $user_delete = false;
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }
        return response()->json([ 'user_delete' => $user_delete ,'notification' =>$notification]);
    }

    public  function login()
    {
        if(Auth::check())
        {
            return redirect()->route('front');
        }
        return view('auth.login');
    }

    public  function logged(Request $request)
    {
        $request->validate([
           'email'      => 'required | email',
           'password'   => 'required'
        ]);

        $credintials = $request->except(['_token','remember']);
        $remember = $request->has('remember') ? true : false;

        if(Auth::attempt(array_merge($credintials, ['status' => 1,'role_id'=> [1]]),$remember))
        {
//            $user = Auth::user();
////            dd($user);
//            if($request->remember)
//            {
//                Auth::login($user, true);
//            }
            return redirect()->route('home');
        }
        return redirect()->route('admin.login')->with('message','Invalid credential');
    }

    public function profile()
    {
        return view('backend.admins.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
        ]);
        if($request->password){
            $request->validate([
                'password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('Old Password didn\'t match');
                        }
                    },
                ],
                'new_password' => ['required', 'min:8', 'max:50'],
            ]);
        }
        User::where('id', Auth::user()->id)->update(['name'=> $request->name, 'email'=> $request->email]);
        if($request->password)
        {
            User::where('id', Auth::user()->id)->update(['password'=> Hash::make($request->password)]);
        }
        if($request->hasFile('photo'))
        {
            @unlink(Auth::user()->photo);
            $path           = 'uploads/admins/';

            if (!is_dir($path))
            {
                mkdir($path, 0755, true);
            }

            $user      = User::find(Auth::user()->id);

            $image              = $request->photo;
            $imageName          = rand(100,1000).$image->getClientOriginalName();
            $image->move($path,$imageName);
            $user->photo           = $path.$imageName;
            $user->save();
        }
        $notification = array('message' => 'Profile updated successfully', 'alert-type'=> 'success');
        return redirect()->route('admin.profile')->with($notification);
    }

    public function statusChange($id, $status)
    {
        if($status == 1)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $admin            = User::where('id',$id)->first();
        $admin->status    = $status;
        if($admin->save())
        {
            $status_change = true;
            $notification = array('message' => 'Status Updated successfully', 'alert-type'=> 'success');
        }
        else
        {
            $status_change = false;
            $notification = array('message' => 'Someting went wrong!', 'alert-type'=> 'error');
        }

        return response()->json(['status'=>$status, 'status_change' => $status_change, 'notification'=>$notification]);
    }
}
