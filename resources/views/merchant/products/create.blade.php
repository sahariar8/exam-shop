@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">🆕 Add Product</h2>
    <div class="card mx-auto shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <form action="{{ route('merchant.product.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="store_id" class="form-label">Select Store</label>
                    <select id="store_id" name="store_id" class="form-control" required>
                        <option value="">-- Select Store --</option>
                        @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select id="category_id" name="category_id" class="form-control" required disabled>
                        <option value="">-- Select Store First --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (৳)</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter product price" required min="0" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter product description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Add Product</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('store_id').addEventListener('change', function() {
        let storeId = this.value;
        let categorySelect = document.getElementById('category_id');
        
        // Reset category dropdown
        categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
        categorySelect.disabled = true;

        if (storeId) {
            fetch(`/merchant/categories-by-store/${storeId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(category => {
                        let option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                    categorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching categories:', error));
        }
    });
</script>
@endsection
