@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', '✏️ Edit Product')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>✏️ Edit: {{ $product->name }}</h5>
        <a href="{{ route('admin.products.index') }}" class="btn-purple">
            ← Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Left Column --}}
            <div class="col-12 col-lg-8">

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Product Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name"
                           value="{{ old('name', $product->name) }}"
                           class="form-control @error('name') is-invalid @enderror"
                           style="border-radius:12px;padding:12px 16px;">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Short Description <span class="text-danger">*</span>
                    </label>
                    <textarea name="short_description" rows="2"
                        class="form-control @error('short_description') is-invalid @enderror"
                        style="border-radius:12px;padding:12px 16px;">{{ old('short_description', $product->short_description) }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Full Description <span class="text-danger">*</span>
                    </label>
                    <textarea name="description" rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        style="border-radius:12px;padding:12px 16px;">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-bold">Price (Rs.)</label>
                        <input type="number" name="price"
                               value="{{ old('price', $product->price) }}"
                               class="form-control @error('price') is-invalid @enderror"
                               min="0" step="0.01"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Sale Price (Rs.)</label>
                        <input type="number" name="sale_price"
                               value="{{ old('sale_price', $product->sale_price) }}"
                               class="form-control @error('sale_price') is-invalid @enderror"
                               min="0" step="0.01"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-bold">Stock</label>
                        <input type="number" name="stock"
                               value="{{ old('stock', $product->stock) }}"
                               class="form-control @error('stock') is-invalid @enderror"
                               min="0"
                               style="border-radius:12px;padding:12px 16px;">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category"
                            class="form-select @error('category') is-invalid @enderror"
                            style="border-radius:12px;padding:12px 16px;">
                            <option value="">Select Category...</option>
                            @foreach(['gadgets'=>'📱 Gadgets',
                                      'stationery'=>'✏️ Stationery',
                                      'home-decor'=>'🏠 Home Decor',
                                      'fashion'=>'👗 Fashion',
                                      'toys'=>'🧸 Toys',
                                      'beauty'=>'💄 Beauty',
                                      'other'=>'📦 Other'] as $val => $label)
                            <option value="{{ $val }}"
                                {{ old('category', $product->category) == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="col-12 col-lg-4">

                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status"
                        class="form-select"
                        style="border-radius:12px;padding:12px 16px;">
                        <option value="active"
                            {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                            ✅ Active
                        </option>
                        <option value="inactive"
                            {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                            ❌ Inactive
                        </option>
                    </select>

                    <div class="mt-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_featured"
                                   value="1"
                                   id="is_featured"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
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
                                   {{ old('is_new_arrival', $product->is_new_arrival) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold"
                                   for="is_new_arrival">
                                🆕 New Arrival
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Current Image --}}
                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">Current Image</label>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded-3 mb-3"
                             style="max-height:180px;object-fit:cover;width:100%;">
                    @else
                        <div class="text-center py-3 text-muted">
                            <div style="font-size:40px;">📷</div>
                            <p class="mb-0 small">No image uploaded</p>
                        </div>
                    @endif
                    <label class="form-label fw-bold mt-2">
                        Upload New Image
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="form-control"
                           style="border-radius:12px;"
                           onchange="previewImage(this)">
                    <div id="image-preview" class="mt-2 d-none">
                        <img id="preview-img" src=""
                             class="img-fluid rounded-3"
                             style="max-height:150px;object-fit:cover;width:100%;">
                    </div>
                </div>

                {{-- Current Gallery --}}
                <div class="mb-4 p-4 rounded-3" style="background:#F8F9FF;">
                    <label class="form-label fw-bold">Current Gallery</label>
                    @php
                        $gallery = json_decode($product->gallery, true) ?? [];
                    @endphp
                    @if(count($gallery) > 0)
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach($gallery as $img)
                            <img src="{{ asset('storage/' . $img) }}"
                                 class="rounded-2"
                                 style="width:60px;height:60px;object-fit:cover;">
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small mb-2">No gallery images</p>
                    @endif
                    <label class="form-label fw-bold">Add More Images</label>
                    <input type="file" name="gallery[]"
                           accept="image/*" multiple
                           class="form-control"
                           style="border-radius:12px;">
                </div>

            </div>
        </div>

        <div class="d-flex gap-3 mt-2">
            <button type="submit" class="btn-pink px-5 py-3">
                💾 Update Product
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

