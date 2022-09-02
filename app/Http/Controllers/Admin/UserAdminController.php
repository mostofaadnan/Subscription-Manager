<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use DataTables;
use Hash;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {

        return view('Admin.pages.adminuser.adminlist');
    }

    public function adminList()
    {

        $Admin = Admin::orderBy('id', 'DESC')
            ->latest()
            ->get();
        return Datatables::of($Admin)
            ->addIndexColumn()

            ->addColumn('status', function (Admin $Admin) {
                return $Admin->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($Admin) {
                $button = '<div class="btn-group" role="group">';
                if ($Admin->status == 1) {
                    $button .= '<a class="btn btn-success btn-sm" id="active" data-id="' . $Admin->id . '">Active</a>';
                } else {
                    $button .= '<a class="btn btn-warning btn-sm" id="inactive" data-id="' . $Admin->id . '">Inactive</a>';
                }
                $button .= '<a class="btn btn-danger btn-sm" id="deletedata" data-id="' . $Admin->id . '">Delete</a>';
                return $button;
            })
            ->make(true);

    }

    public function AdminActive($id)
    {
        $Admin = Admin::find($id);
        $Admin->status = 1;
        $Admin->update();
        return response()->json([
            'status' => 200,
            'message' => 'Admin Activate Succesfuly']);
    }

    public function AdminInActive($id)
    {
        $Admin = Admin::find($id);
        $Admin->status = 0;
        $Admin->update();
        return response()->json([
            'status' => 200,
            'message' => 'Admin Diactivate Succesfuly']);
    }

    public function showAdminRegisterForm()
    {
        return view('Admin.pages.adminuser.newRegistration');
    }

    protected function createAdmin(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:admins',
            'password' => 'required | min:5 | max:12',
        ]);

        //save user into db
        $user = new Admin();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 0;
        $registerUser = $user->save();
        if ($registerUser) {
            return redirect()->route('auth.register')->with('success', 'You have been successfully registered! You will Login After Account Activation');
        } else {
            return back()->with('fail', 'Some thing went wrong!');
        }
    }

    public function resetPassword()
    {

        return view('auth.passwordReset');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePasswords = Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        if ($updatePasswords) {
            return redirect()->route('auth.resetpass')->with('success', 'Your Password Update Successfuly');
        } else {

            return redirect()->route('auth.resetpass')->with('fail', 'Your Password Update faild');

        }

    }
}
