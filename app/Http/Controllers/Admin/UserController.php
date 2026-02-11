<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'sometimes|boolean',
        ]);

        $wasAdmin = $user->is_admin;

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'is_admin' => $request->has('is_admin'),
        ]);

        // اگه کاربر خودش رو ادمین کرد یا از ادمین درش آورد، کش رو پاک می‌کنیم
        if (Auth::id() === $user->id) {
            // نقش جدید رو فوراً اعمال می‌کنه
            Auth::setUser($user->fresh());
        }

        $status = $user->is_admin ? 'ادمین' : 'کاربر عادی';
        return redirect()->route('admin.users.index')
                         ->with('success', "کاربر {$user->name} با موفقیت ویرایش شد و حالا {$status} است");
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'نمی‌تونی خودت رو حذف کنی، احمق!');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "کاربر {$name} با موفقیت حذف شد");
    }
}