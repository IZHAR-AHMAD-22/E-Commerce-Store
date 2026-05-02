@extends('layouts.admin')

@section('title', 'Contacts')
@section('page-title', '📬 Contact Messages')

@section('content')

<div class="content-card">
    <div class="content-card-header">
        <h5>📬 All Messages</h5>
    </div>

    <div class="table-responsive">
        <table id="contacts-table" class="table table-hover w-100">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
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
    $('#contacts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.contacts.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'subject', name: 'subject' },
            { data: 'is_read', name: 'is_read' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">📭 No messages found!</div>',
        }
    });
});
</script>
@endsection

