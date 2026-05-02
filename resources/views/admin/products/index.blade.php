@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', '📦 Products')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>📦 All Products</h5>
        <a href="{{ route('admin.products.create') }}" class="btn-pink">
            + Add New Product
        </a>
    </div>

    <div class="table-responsive">
        <table id="products-table" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>New Arrival</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.products.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'image', name: 'image', orderable: false, 
              searchable: false, width: '80px' },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'price', name: 'price' },
            { data: 'stock', name: 'stock' },
            { data: 'status', name: 'status' },
            { data: 'is_new_arrival', name: 'is_new_arrival' },
            { data: 'actions', name: 'actions', 
              orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">📦 No products found!</div>',
        }
    });
});
</script>
@endsection

