<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
// db facade
use Illuminate\Support\Facades\DB;

use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class AdminController extends Controller
{
    private function generateUserId(){
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        $userId = substr(str_shuffle($letters), 0, 2) . substr(str_shuffle($numbers), 0, 4);
        return $userId;
    }
    private function generateUsername(){
        $letters='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $username = substr(str_shuffle($letters), 0, 6);
        return $username;
    }

    public function home(Request $request): View
    {
        return view('admin.home');
    }

    public function add_user(Request $request): View
    {
        return view('admin.addUser');
    }

    public function addUser(Request $request)
    {
         $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'role' => 'required',
            ]);
            $userId = $this->generateUserId();
            $isDummy = $request->role === 'dummy_user' ? 1 : 0;
            $username = $this->generateUsername();

            
            //create user
            try {
                DB::table('users')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'plain_password' => $request->password,
                    'user_id' => $userId,
                    'is_dummy' => $isDummy,
                    'username' => $username,
                ]);
                return redirect()->back()->with('success', 'User added successfully!');
            } catch (\Exception $e) {
                dd('Insert Error: ' . $e->getMessage());
            }
       
     
    }

    public function add_admin(Request $request): View
    {
        $roles= DB::table('roles')->get();
        return view('admin.addAdmin', ['roles' => $roles]);
    }

    public function addAdmin(Request $request){
        $request->validate([
             'username' => 'required|string|unique:admins,username|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ]);
       //fetch role name from roles table using of role_id
         $role = DB::table('roles')->where('id', $request->role)->first();
            $roleName = $role->name;
       try {
        DB::table('admins')->insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'plain_password' => $request->password,
        ]);
        $msg=$roleName." added successfully!";
        return redirect()->back()->with('success', $msg);
       } catch (\Throwable $th) {
              dd('Insert Error: ' . $th->getMessage());
       }

    }

    public function allAdmin(Request $request): View
    {
        $admins = DB::table('admins')
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->select('admins.*', 'roles.name as role_name', 'roles.description as role_description') // Single select call
        ->get();

    return view('admin.allAdmin', ['admins' => $admins]);
    }

    public function allUser(Request $request): View
    {
        $users = DB::table('users')->get();
        return view('admin.allUser', ['users' => $users]);
    }
}
