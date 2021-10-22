<?php

namespace App\Http\Controllers\Backend\User;

use App\Helpers\File;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*

        //## Static way Create Role---
        // Role::create(['name' => 'Supper Admin']);
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'User']);
        // Role::create(['name' => 'Member']);
        // return true;

        //## Dynamic way create role, Crate a dynamic funcion in User Model.
        // $role = User::createRole('Supper Admin');

        //## Permission create---
        // Permission::create(['name'=> 'dashboard.view', 'guard_name'=> 'sanctum', 'group_name'=> 'Dashboard']);
        // Permission::create(['name'=> 'dashboard.statictice', 'guard_name'=> 'sanctum', 'group_name'=> 'Dashboard']);
        // Permission::create(['name'=> 'user.create', 'guard_name'=> 'sanctum', 'group_name'=> 'User Permission']);
        // Permission::create(['name'=> 'user.list', 'guard_name'=> 'sanctum', 'group_name'=> 'User Permission']);
        // Permission::create(['name'=> 'user.edit', 'guard_name'=> 'sanctum', 'group_name'=> 'User Permission']);
        // Permission::create(['name'=> 'user.delete', 'guard_name'=> 'sanctum', 'group_name'=> 'User Permission']);
        // Permission::create(['name'=> 'user.view', 'guard_name'=> 'sanctum', 'group_name'=> 'User Permission']);
        // return true;

        // specific role by givePermission
        $role = User::createRole('Supper Admin');

        //## Give Role Permissions---
        // $role->givePermissionTo('user.create');
        // $role->givePermissionTo('user.list');
        // $role->givePermissionTo('user.edit');
        // $role->givePermissionTo('user.delete');
        // $role->givePermissionTo('user.view');
        // return $role;

        //## Find the loggedUser.
        $user = request()->user();

        //## Assign Role
        // Initialy dosen't woark role, then just defile guard name in model.
        $user->assignRole('Supper Admin');

        */

        // Check if loggedUse has "User.create" Permission or Not.
        if(!request()->user()->hasPermissionTo('user.create')){
            return abort(401);
        }

        $designations = Designation::get(['id', 'name']);
        return view('backend.user.create', compact('designations'));



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
            'name' => ['required', 'string', 'max:100', 'min:2'],
            'userName' => ['required', 'unique:users,userName', 'string', 'max:100', 'min:2'],
            'email' => ['required', 'email', 'max:100', 'min:5', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone', 'max:15', 'min:11'],
            'status' => ['required', 'string'],
            'password' => ['required', 'max:255', 'min:8'],
            'con_password' => ['required', 'max:255', 'min:8'],
            'parmanet_address' => ['nullable','max:255'],
            'present_address' => ['nullable', 'max:255'],
            'designation_id' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,png'],
        ]);

        // $file = $request->image;
        // $imageName = 'user-' . rand(1, 99999) . Str::random(5) . time();
        // $extension = $file->getClientOriginalExtension();
        // $imageName .= "." . $extension;
        // $targetLocation = 'images/users';
        // $file->move($targetLocation, $imageName);

        if($request->password === $request->con_password){
            $user = new User();
            $user->name = $request->name;
            $user->userName = $request->userName ;
            $user->email = $request->email ;
            $user->phone = $request->phone ;
            $user->status = $request->status ;
            $user->password = bcrypt($request->password) ;
            $user->parmanet_address = $request->parmanet_address ;
            $user->present_address = $request->present_address ;
            $user->designation_id = $request->designation_id ;
            $user->created_by = request()->user()->id ;

            if($request->image){
                $user->image = File::upload($request->image, 'images/users');
            }

            $user->save();
            session()->flash('success', 'Data Save successful!');
        }else{
            return back()->withErrors([
                'con_password' => 'Password Miss Match',
            ]);
        }
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Check if loggedUse has "User.edit" Permission or Not.
        if(!request()->user()->hasPermissionTo('user.edit')){
            return abort(401);
        }

        $designations = Designation::get(['id', 'name']);
        return view('backend.user.edit', compact(['user', 'designations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Check if loggedUse has "User.u" Permission or Not.
        if(!request()->user()->hasPermissionTo('user.edit')){
            return abort(401);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:2'],
            'userName' => ["unique:users,userName," . "$user->id"],
            'email' => ["unique:users,email," . "$user->id"],
            'phone' => ["unique:users,phone," . "$user->id"],
            'status' => ['required', 'string'],
            'password' => ['required', 'max:255', 'min:8'],
            'con_password' => ['required', 'max:255', 'min:8'],
            'parmanet_address' => ['nullable','max:255'],
            'present_address' => ['nullable', 'max:255'],
            'designation_id' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,png'],
        ]);

        if($request->password === $request->con_password){
            $user->name = $request->name;
            $user->userName = $request->userName ;
            $user->email = $request->email ;
            $user->phone = $request->phone ;
            $user->status = $request->status ;
            $user->password = bcrypt($request->password) ;
            $user->parmanet_address = $request->parmanet_address ;
            $user->present_address = $request->present_address ;
            $user->designation_id = $request->designation_id ;
            $user->updated_by = request()->user()->id ;

            if($request->image){
                File::deleteFile($user->image);
                $user->image = File::upload($request->image, 'images/users');
            }

            $update = $user->save();
            if($update){
                session()->flash('success', 'User Information Update successful!');
            }
        }else{
            return back()->withErrors([
                'con_password' => 'Password Miss Match',
            ]);
        }
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Check if loggedUse has "User.delete" Permission or Not.
        if(!request()->user()->hasPermissionTo('user.delete')){
            return abort(401);
        }
        if($user->image){
            File::deleteFile($user->image);
            $user->deleted_at = request()->user()->id;
        }
        $delete = $user->delete();
        if($delete){
            session()->flash('success', 'User Deleted successful!');
        }
        return redirect()->route('admin.user.index');
    }
}
