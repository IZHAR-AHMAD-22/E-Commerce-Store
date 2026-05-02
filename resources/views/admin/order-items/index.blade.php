@extends('layouts.admin')

@section('title', 'Order Items')
@section('page-title', '📦 Order Items')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>📦 All Order Items</h5>
    </div>

    <div class="table-responsive">
        <table id="order-items-table" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Order #</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#order-items-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.order-items.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'product_name', name: 'product_name' },
            { data: 'order_id', name: 'order_id' },
            { data: 'unit_price', name: 'unit_price' },
            { data: 'quantity', name: 'quantity' },
            { data: 'subtotal', name: 'subtotal' },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">📦 No order items found!</div>',
        }
    });
});
</script>
@endsection

