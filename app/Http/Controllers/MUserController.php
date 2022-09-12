<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class MUserController extends Controller
{
    public function home()
    {
        return view('mypage.user.home');
    }

    public function reserve()
    {
        $user = Auth::user();
        $reserved_experiences = $user->reserved_experiences;
        return view('mypage.user.reserve', compact('user', 'reserved_experiences'));
    }

    public function users()
    {
        $users = User::all();
        return view('mypage.user.users', compact('users'));
    }

    public function users_edit(Request $request)
    {
        // $users = User::find($id)->first();
        $user = User::where('id', $request->id)->first();
        $roles = Role::all();
        $user_roles = array();
        if($request->id<>""){
            $user_roles_object = $user->getRoleNames();
            foreach($user_roles_object as $role_name){
                $user_roles[] = $role_name;
            }
        }

        return view('mypage.user.users_edit', compact('user', 'roles', 'user_roles'));
    }

    public function users_edit_post(Request $request)
    {
        $mode = $request->mode;
        
        if($mode=="ins"){
            $name = $request->name;
            $email = $request->email;
            $pass = $request->pass;
            $role = $request->role;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => null,
                'password' => Hash::make($pass),
            ]);

            $roles = Role::all();
            foreach($roles as $r){
                if(in_array($r->name,(array)$role)){
                    //echo $r->name."のroleを付与します<br>";
                    $user->assignRole($r->name);
                }
            }
        }

        if($mode=="upd"){
            $id = $request->id;
            $name = $request->name;
            $email = $request->email;
            $pass = $request->pass;
            $role = $request->role;

            $user = User::where('id', $id)->update([
                'name' => $name,
                'email' => $email,
            ]);
            
            if($pass<>""){
                $user = User::where('id', $id)->update([
                    'password' => Hash::make($pass),
                ]);
            }

            $user = User::where('id', $id)->first();
            $roles = Role::all();
            foreach($roles as $r){
                if(in_array($r->name,(array)$role)){
                    //echo $r->name."のroleを付与します<br>";
                    $user->assignRole($r->name);
                }else{
                    //echo $r->name."のroleを削除します<br>";
                    $user->removeRole($r->name);
                }
            }
        }

        if($mode=="del"){
            $id = $request->id;
            User::where('id', $id)->delete();
        }
        
        return $this->users();
    }
}
