<?php

namespace App\Services\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{
    public function login(array $data)
    {
        $login = $data['username'] ?? $data['email'];

        $admin = Admin::where(function ($query) use ($login) {
            $query->where('name', $login)->orWhere('email', $login);
        })->first();

        if (! $admin || ! Hash::check($data['password'], $admin->password)) {
            return false;
        }

        return $admin;
    }

    public function createAdmin(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function deleteAdmin(string $id)
    {
        if ($id == 1) {
            throw ValidationException::withMessages(['error' => 'Cannot delete main admin']);
        }

        $admin = Admin::find($id);

        if (!$admin) {
            throw ValidationException::withMessages(['error' => 'Admin not found']);
        }

        $admin->delete();
    }
}
