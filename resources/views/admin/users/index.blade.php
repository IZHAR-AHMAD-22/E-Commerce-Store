@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', '👥 Users')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>👥 All Customers</h5>
    </div>

    <div class="table-responsive">
        <table id="users-table" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
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
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.users.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'orders_count', name: 'orders_count' },
            { data: 'orders_sum_final_amount', name: 'orders_sum_final_amount' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">👥 No customers found!</div>',
        }
    });
});
</script>
@endsection

