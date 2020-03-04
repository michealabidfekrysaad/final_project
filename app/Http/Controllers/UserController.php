<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexAdmin()
    {
        $reports = Report::all();
        return view('layouts.AdminPanel.reportsAdmin.table', ['reports' => $reports]);
    }

    public function adminUsers()
    {
        $users = User::paginate(3);
        return view('layouts.AdminPanel.user.userstable', ['users' => $users]);
    }

    public function ban(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($user)) {

            $user->bans()->create([
                'expired_at' => '+1 month'
            ]);
        }
        return redirect('/admin/panel/userstable')->with('success', 'Ban Successfully..');
    }

    public function revoke($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->unban();
        }
        return redirect('/admin/panel/userstable')
            ->with('success', 'User Revoke Successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('layouts.AdminPanel.user.edit', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . auth()->user()->id,
        ]);
        $user = User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->save();
        return redirect('/admin/panel/userstable');
    }

    public function destroyUser($id)
    {
        User::find($id)->delete();
        return redirect('/admin/panel/userstable');
    }

    public function showuser($id)
    {
        $user = User::find($id);
        return view('layouts.AdminPanel.user.show', ['user' => $user]);
    }
}
