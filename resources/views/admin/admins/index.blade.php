@extends('layouts.admin')

@section('title', 'Admins')
@section('page-title', '👑 Admins')

@section('content')

<div class="row g-4">

    {{-- Admins Table --}}
    <div class="col-12 col-xl-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5>👑 All Admins</h5>
            </div>

            <div class="table-responsive">
                <table id="admins-table" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th>Badge</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Add New Admin Form --}}
    <div class="col-12 col-xl-4">
        <div class="content-card">
            <div class="content-card-header">
                <h5>➕ Add New Admin</h5>
            </div>

            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Full Name <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Enter full name..."
                           style="border-radius:12px;padding:12px 16px;">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">
                        Email Address <span class="text-danger">*</span>
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="admin@example.com"
                           style="border-radius:12px;padding:12px 16px;">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Password <span class="text-danger">*</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Min 8 characters..."
                           style="border-radius:12px;padding:12px 16px;">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Warning Box --}}
                <div class="p-3 rounded-3 mb-4"
                    style="background:#FEF3C7;border:1px solid #FCD34D;">
                    <p class="mb-0 fw-bold" style="color:#92400E;font-size:13px;">
                        ⚠️ Warning: This person will have FULL access to the admin panel.
                        Only add trusted people!
                    </p>
                </div>

                <button type="submit" class="btn-pink w-100 py-3">
                    👑 Create Admin
                </button>
            </form>
        </div>

        {{-- Info Card --}}
        <div class="content-card mt-4">
            <div class="content-card-header">
                <h5>ℹ️ Admin Info</h5>
            </div>
            <ul class="list-unstyled mb-0" style="font-size:13px;">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span>✅</span>
                    <span>Admins can manage all products, orders, users and contacts.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span>✅</span>
                    <span>Admins can add or view other admins.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span>⚠️</span>
                    <span>Admin accounts cannot be deleted from this panel for security.</span>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <span>🔒</span>
                    <span>Make sure to use a strong password for admin accounts.</span>
                </li>
            </ul>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#admins-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.admins.data") }}',
        columns: [
            { data: 'id', name: 'id', width: '50px' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
            processing: '<div class="text-center py-3">⏳ Loading...</div>',
            emptyTable: '<div class="text-center py-3">👑 No admins found!</div>',
        }
    });
});
</script>
@endsection

