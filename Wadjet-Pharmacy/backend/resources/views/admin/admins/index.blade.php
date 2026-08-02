@extends('admin.layouts.admin')

@section('title', 'Admins Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">System Administrators</h2>
        <button class="btn btn-primary" onclick="openModal('addAdminModal')">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Admin
        </button>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                <tr>
                    <td><strong>#{{ $admin->id }}</strong></td>
                    <td>
                        <div style="font-weight: 600; font-size: 15px;">{{ $admin->name }}</div>
                    </td>
                    <td>
                        {{ $admin->email }}
                    </td>
                    <td>
                        {{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td>
                        @if(Auth::guard('admin')->user()->id !== $admin->id)
                        <div style="display: flex; gap: 8px;">
                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin account?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        @else
                        <span class="badge badge-active">You</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No admins found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Admin Modal -->
<div class="modal" id="addAdminModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New Admin</h3>
            <button class="modal-close" onclick="closeModal('addAdminModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form action="{{ route('admin.admins.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required placeholder="Admin Name">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required placeholder="admin@example.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required minlength="8" placeholder="Must be at least 8 characters">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Create Admin</button>
        </form>
    </div>
</div>

@endsection
