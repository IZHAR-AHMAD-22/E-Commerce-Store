@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', '🛒 Orders')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>🛒 All Orders</h5>
    </div>

    <div class="table-responsive">
        <table id="orders-table" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
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
    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.orders.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'customer_phone', name: 'customer_phone' },
            { data: 'city', name: 'city' },
            { data: 'final_amount', name: 'final_amount' },
            { data: 'payment_method', name: 'payment_method' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">🛒 No orders found!</div>',
        }
    });
});
</script>
@endsection

