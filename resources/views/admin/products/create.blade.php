@extends('layouts.admin')

@section('title', 'Add Product')
@section('page-title', '➕ Add New Product')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>➕ Add New Product</h5>
        <a href="{{ route('admin.products.index') }}" 
            class="btn-purple">
            ← Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- Left Column --}}
            <div class="col-12 col-lg-8">

                {{-- Product Name --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Product Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Enter product name..."
                           style="border-radius:12px;padding:12px 16px;">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Short Description <span class="text-danger">*</span>
                    </label>
                    <textarea name="short_description" rows="2"
                        class="form-control @error('short_description') is-invalid @enderror"
                        placeholder="Brief description..."
                        style="border-radius:12px;padding:12px 16px;">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Full Description --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Full Description <span class="text-danger">*</span>
                    </label>
                    <textarea name="description" rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Full product description..."
                        style="border-radius:12px;padding:12px 16px;">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price Row --}}
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-bold">
                            Price (Rs.) <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               name="price" 
                               value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="0"
                               min="0" step="0.01"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">
                            Sale Price (Rs.)
                            <span class="text-muted fw-normal">(optional)</span>
                        </label>
                        <input type="number" 
                               name="sale_price" 
                               value="{{ old('sale_price') }}"
                               class="form-control @error('sale_price') is-invalid @enderror"
                               placeholder="0"
                               min="0" step="0.01"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Stock + Category Row --}}
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-bold">
                            Stock <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               name="stock" 
                               value="{{ old('stock', 0) }}"
                               class="form-control @error('stock') is-invalid @enderror"
                               min="0"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">
                            Category <span class="text-danger">*</span>
                        </label>
                        <select name="category"
                            class="form-select @error('category') is-invalid @enderror"
                            style="border-radius:12px;padding:12px 16px;">
                            <option value="">Select Category...</option>
                            <option value="gadgets" 
                                {{ old('category') == 'gadgets' ? 'selected' : '' }}>
                                📱 Gadgets
                            </option>
                            <option value="stationery"
                                {{ old('category') == 'stationery' ? 'selected' : '' }}>
                                ✏️ Stationery
                            </option>
                            <option value="home-decor"
                                {{ old('category') == 'home-decor' ? 'selected' : '' }}>
                                🏠 Home Decor
                            </option>
                            <option value="fashion"
                                {{ old('category') == 'fashion' ? 'selected' : '' }}>
                                👗 Fashion
                            </option>
                            <option value="toys"
                                {{ old('category') == 'toys' ? 'selected' : '' }}>
                                🧸 Toys
                            </option>
                            <option value="beauty"
                                {{ old('category') == 'beauty' ? 'selected' : '' }}>
                                💄 Beauty
                            </option>
                            <option value="other"
                                {{ old('category') == 'other' ? 'selected' : '' }}>
                                📦 Other
                            </option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="col-12 col-lg-4">

                {{-- Status --}}
                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status"
                        class="form-select @error('status') is-invalid @enderror"
                        style="border-radius:12px;padding:12px 16px;">
                        <option value="active" 
                            {{ old('status') == 'active' ? 'selected' : '' }}>
                            ✅ Active
                        </option>
                        <option value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            ❌ Inactive
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- Toggles --}}
                    <div class="mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_featured" 
                                   value="1"
                                   id="is_featured"
                                   {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" 
                                   for="is_featured">
                                ⭐ Featured Product
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_new_arrival" 
                                   value="1"
                                   id="is_new_arrival"
                                   {{ old('is_new_arrival') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" 
                                   for="is_new_arrival">
                                🆕 New Arrival
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">
                        Main Image
                    </label>
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="form-control @error('image') is-invalid @enderror"
                           style="border-radius:12px;"
                           onchange="previewImage(this)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-3 d-none">
                        <img id="preview-img" src="" alt="Preview"
                             class="img-fluid rounded-3"
                             style="max-height:200px;object-fit:cover;width:100%;">
                    </div>
                </div>

                {{-- Gallery Images --}}
                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">
                        Gallery Images
                        <span class="text-muted fw-normal">(multiple)</span>
                    </label>
                    <input type="file" 
                           name="gallery[]" 
                           accept="image/*"
                           multiple
                           class="form-control @error('gallery.*') is-invalid @enderror"
                           style="border-radius:12px;">
                    @error('gallery.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Submit --}}
        <div class="d-flex gap-3 mt-2">
            <button type="submit" class="btn-pink px-5 py-3">
                💾 Save Product
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="btn btn-light px-5 py-3 rounded-3 fw-bold">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection

@section('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection

