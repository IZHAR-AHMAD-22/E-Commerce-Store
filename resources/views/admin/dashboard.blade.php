@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', '📊 Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">

    {{-- Total Products --}}
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card" style="border-left-color:#FF6B9D;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:13px;font-weight:700;
                        text-transform:uppercase;letter-spacing:1px;">
                        Total Products
                    </p>
                    <h2 class="font-fredoka mb-0" style="font-size:42px;color:#FF6B9D;">
                        {{ $total_products }}
                    </h2>
                    <p class="text-muted mt-1 mb-0" style="font-size:13px;">
                        Active products in store
                    </p>
                </div>
                <div style="background:#FFE8F3;width:56px;height:56px;
                    border-radius:16px;display:flex;align-items:center;
                    justify-content:center;font-size:28px;">
                    📦
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.products.index') }}"
                    style="color:#FF6B9D;font-size:13px;font-weight:700;
                    text-decoration:none;">
                    View All Products →
                </a>
            </div>
        </div>
    </div>

    {{-- Total Orders --}}
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card" style="border-left-color:#C77DFF;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:13px;font-weight:700;
                        text-transform:uppercase;letter-spacing:1px;">
                        Total Orders
                    </p>
                    <h2 class="font-fredoka mb-0" style="font-size:42px;color:#C77DFF;">
                        {{ $total_orders }}
                    </h2>
                    <p class="text-muted mt-1 mb-0" style="font-size:13px;">
                        All time orders
                    </p>
                </div>
                <div style="background:#F3E8FF;width:56px;height:56px;
                    border-radius:16px;display:flex;align-items:center;
                    justify-content:center;font-size:28px;">
                    🛒
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.orders.index') }}"
                    style="color:#C77DFF;font-size:13px;font-weight:700;
                    text-decoration:none;">
                    View All Orders →
                </a>
            </div>
        </div>
    </div>

    {{-- Total Revenue --}}
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card" style="border-left-color:#6BCB77;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:13px;font-weight:700;
                        text-transform:uppercase;letter-spacing:1px;">
                        Total Revenue
                    </p>
                    <h2 class="font-fredoka mb-0" style="font-size:42px;color:#6BCB77;">
                        Rs. {{ number_format($total_revenue) }}
                    </h2>
                    <p class="text-muted mt-1 mb-0" style="font-size:13px;">
                        From delivered orders
                    </p>
                </div>
                <div style="background:#E8F8EA;width:56px;height:56px;
                    border-radius:16px;display:flex;align-items:center;
                    justify-content:center;font-size:28px;">
                    💰
                </div>
            </div>
            <div class="mt-3">
                <span style="color:#6BCB77;font-size:13px;font-weight:700;">
                    ✅ Delivered Orders Only
                </span>
            </div>
        </div>
    </div>

    {{-- Total Users --}}
    <div class="col-12 col-sm-6 col-xl-6">
        <div class="stat-card" style="border-left-color:#FFD93D;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:13px;font-weight:700;
                        text-transform:uppercase;letter-spacing:1px;">
                        Total Customers
                    </p>
                    <h2 class="font-fredoka mb-0" style="font-size:42px;color:#F59E0B;">
                        {{ $total_users }}
                    </h2>
                    <p class="text-muted mt-1 mb-0" style="font-size:13px;">
                        Registered customers
                    </p>
                </div>
                <div style="background:#FFF8DC;width:56px;height:56px;
                    border-radius:16px;display:flex;align-items:center;
                    justify-content:center;font-size:28px;">
                    👥
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.users.index') }}"
                    style="color:#F59E0B;font-size:13px;font-weight:700;
                    text-decoration:none;">
                    View All Users →
                </a>
            </div>
        </div>
    </div>

    {{-- Unread Messages --}}
    <div class="col-12 col-sm-6 col-xl-6">
        <div class="stat-card" style="border-left-color:#EF4444;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1" style="font-size:13px;font-weight:700;
                        text-transform:uppercase;letter-spacing:1px;">
                        Unread Messages
                    </p>
                    <h2 class="font-fredoka mb-0" style="font-size:42px;color:#EF4444;">
                        {{ $unread_contacts }}
                    </h2>
                    <p class="text-muted mt-1 mb-0" style="font-size:13px;">
                        Pending contact messages
                    </p>
                </div>
                <div style="background:#FEE2E2;width:56px;height:56px;
                    border-radius:16px;display:flex;align-items:center;
                    justify-content:center;font-size:28px;">
                    📬
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.contacts.index') }}"
                    style="color:#EF4444;font-size:13px;font-weight:700;
                    text-decoration:none;">
                    View All Messages →
                </a>
            </div>
        </div>
    </div>

</div>

{{-- Recent Orders + Recent Contacts --}}
<div class="row g-4">

    {{-- Recent Orders --}}
    <div class="col-12 col-xl-7">
        <div class="content-card">
            <div class="content-card-header">
                <h5>🛒 Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn-purple">
                    View All
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    style="color:#C77DFF;font-weight:700;
                                    text-decoration:none;">
                                    #{{ $order->id }}
                                </a>
                            </td>
                            <td>
                                <div style="font-weight:700;color:#2D1B69;">
                                    {{ $order->customer_name }}
                                </div>
                                <div style="font-size:12px;color:#9CA3AF;">
                                    {{ $order->customer_email }}
                                </div>
                            </td>
                            <td>
                                <span style="font-weight:700;color:#6BCB77;">
                                    Rs. {{ number_format($order->final_amount) }}
                                </span>
                            </td>
                            <td>
                                @php
                                $colors = [
                                    'pending'    => ['bg'=>'#FEF3C7','text'=>'#92400E'],
                                    'confirmed'  => ['bg'=>'#DBEAFE','text'=>'#1E40AF'],
                                    'processing' => ['bg'=>'#FFEDD5','text'=>'#9A3412'],
                                    'shipped'    => ['bg'=>'#EDE9FE','text'=>'#5B21B6'],
                                    'delivered'  => ['bg'=>'#D1FAE5','text'=>'#065F46'],
                                    'cancelled'  => ['bg'=>'#FEE2E2','text'=>'#991B1B'],
                                ];
                                $c = $colors[$order->status] ?? 
                                    ['bg'=>'#F3F4F6','text'=>'#374151'];
                                @endphp
                                <span style="background:{{ $c['bg'] }};
                                    color:{{ $c['text'] }};
                                    padding:4px 12px;border-radius:20px;
                                    font-size:12px;font-weight:700;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td style="font-size:13px;color:#9CA3AF;">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div style="font-size:32px;">🛒</div>
                                <p class="text-muted mt-2">No orders yet!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Contacts --}}
    <div class="col-12 col-xl-5">
        <div class="content-card">
            <div class="content-card-header">
                <h5>📬 Recent Messages</h5>
                <a href="{{ route('admin.contacts.index') }}" class="btn-pink">
                    View All
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_contacts as $contact)
                        <tr>
                            <td>
                                <div style="font-weight:700;color:#2D1B69;
                                    font-size:13px;">
                                    {{ $contact->name }}
                                </div>
                                <div style="font-size:11px;color:#9CA3AF;">
                                    {{ $contact->created_at->format('d M') }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                    style="color:#374151;text-decoration:none;
                                    font-size:13px;">
                                    {{ Str::limit($contact->subject, 25) }}
                                </a>
                            </td>
                            <td>
                                @if($contact->is_read)
                                <span style="background:#D1FAE5;color:#065F46;
                                    padding:3px 10px;border-radius:20px;
                                    font-size:11px;font-weight:700;">
                                    Read ✅
                                </span>
                                @else
                                <span style="background:#FEE2E2;color:#991B1B;
                                    padding:3px 10px;border-radius:20px;
                                    font-size:11px;font-weight:700;">
                                    Unread 🔴
                                </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                <div style="font-size:32px;">📭</div>
                                <p class="text-muted mt-2">No messages yet!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

