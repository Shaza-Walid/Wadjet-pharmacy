@extends('admin.layouts.admin')

@section('title', 'Suppliers Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Suppliers</h2>
        <button class="btn btn-primary" onclick="openModal('addSupplierModal')">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Supplier
        </button>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Contact Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td><strong>#{{ $supplier->id }}</strong></td>
                    <td>
                        <div style="font-weight: 600; font-size: 15px;">{{ $supplier->name }}</div>
                    </td>
                    <td>
                        <div style="color: var(--text-light); font-size: 13px;">
                            {{ $supplier->contact_info ?? 'No contact info provided' }}
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-primary btn-sm" onclick="editSupplier({{ $supplier->toJson() }})">Edit</button>
                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No suppliers found. Click "Add New Supplier" to create one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal" id="addSupplierModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New Supplier</h3>
            <button class="modal-close" onclick="closeModal('addSupplierModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Pfizer">
            </div>
            <div class="form-group">
                <label>Contact Info (Optional)</label>
                <textarea name="contact_info" class="form-control" rows="3" placeholder="Phone number, email, or address..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Save Supplier</button>
        </form>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal" id="editSupplierModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Supplier</h3>
            <button class="modal-close" onclick="closeModal('editSupplierModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form id="editSupplierForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" id="edit_supplier_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contact Info (Optional)</label>
                <textarea name="contact_info" id="edit_supplier_contact" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Update Supplier</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function editSupplier(supplier) {
        document.getElementById('edit_supplier_name').value = supplier.name;
        document.getElementById('edit_supplier_contact').value = supplier.contact_info || '';
        document.getElementById('editSupplierForm').action = '/admin/suppliers/' + supplier.id;
        openModal('editSupplierModal');
    }
</script>
@endsection
