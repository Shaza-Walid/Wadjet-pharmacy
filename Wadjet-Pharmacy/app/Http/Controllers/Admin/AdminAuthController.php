<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\StoreAdminRequest;
use App\Services\Auth\AdminAuthService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct(
        protected readonly AdminAuthService $adminAuthService
    ) {}

    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function store(StoreAdminRequest $request)
    {
        $this->adminAuthService->createAdmin($request->validated());

        return redirect()->back()->with('success', 'Admin created successfully');
    }

    public function destroy(string $id)
    {
        try {
            $this->adminAuthService->deleteAdmin($id);
            return redirect()->back()->with('success', 'Admin deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', $e->validator->errors()->first());
        }
    }
}