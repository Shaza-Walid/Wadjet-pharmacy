@extends('admin.layouts.admin')

@section('title', 'Categories Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Categories</h2>
        <button class="btn btn-primary" onclick="openModal('addCategoryModal')">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Category
        </button>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td><strong>#{{ $category->id }}</strong></td>
                    <td>
                        <div style="font-weight: 600; font-size: 15px;">{{ $category->name }}</div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-primary btn-sm" onclick="editCategory({{ $category->toJson() }})">Edit</button>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No categories found. Click "Add New Category" to create one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal" id="addCategoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New Category</h3>
            <button class="modal-close" onclick="closeModal('addCategoryModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Skin Care">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Save Category</button>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal" id="editCategoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Category</h3>
            <button class="modal-close" onclick="closeModal('editCategoryModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form id="editCategoryForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" id="edit_category_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Update Category</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function editCategory(category) {
        document.getElementById('edit_category_name').value = category.name;
        document.getElementById('editCategoryForm').action = '/admin/categories/' + category.id;
        openModal('editCategoryModal');
    }
</script>
@endsection
