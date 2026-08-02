@extends('admin.layouts.admin')

@section('title', 'Products Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Products</h2>
        <button class="btn btn-primary" onclick="openModal('addProductModal')">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add New Product
        </button>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 6px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #64748b;">No Img</div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                    </td>
                    <td>
                        <span class="badge badge-active">{{ $product->category->name ?? 'Uncategorized' }}</span>
                    </td>
                    <td>
                        {{ number_format($product->price, 2) }} EGP
                    </td>
                    <td>
                        @if($product->quantity <= 10)
                            <span class="badge badge-cancelled">{{ $product->quantity }} Low</span>
                        @else
                            <span class="badge badge-delivered">{{ $product->quantity }}</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-primary btn-sm" onclick="editProduct({{ $product->toJson() }})">Edit</button>
                            <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No products found. Click "Add New Product" to create one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal" id="addProductModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New Product</h3>
            <button class="modal-close" onclick="closeModal('addProductModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Price (EGP)</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description (Optional)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Save Product</button>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal" id="editProductModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Product</h3>
            <button class="modal-close" onclick="closeModal('editProductModal')"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
        </div>
        <form id="editProductForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" id="edit_category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Price (EGP)</label>
                <input type="number" step="0.01" name="price" id="edit_price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="quantity" id="edit_quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description (Optional)</label>
                <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Update Product</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function editProduct(product) {
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_category_id').value = product.category_id;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_quantity').value = product.quantity;
        document.getElementById('edit_description').value = product.description || '';
        
        document.getElementById('editProductForm').action = '/admin/products/' + product.product_id;
        
        openModal('editProductModal');
    }
</script>
@endsection
