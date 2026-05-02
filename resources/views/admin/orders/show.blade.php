@extends('layouts.admin')

@section('title', 'Order #' . $order->id)
@section('page-title', '🛒 Order Details')

@section('content')

<div class="row g-4">

    {{-- Order Info --}}
    <div class="col-12 col-xl-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5>📋 Order #{{ $order->id }}</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn-purple">
                    ← Back to Orders
                </a>
            </div>

            {{-- Order Items Table --}}
            <div class="table-responsive mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                         width="55" height="55"
                                         style="object-fit:cover;border-radius:10px;">
                                @else
                                    <div style="width:55px;height:55px;background:#F3E8FF;
                                        border-radius:10px;display:flex;align-items:center;
                                        justify-content:center;font-size:22px;">🛍️</div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:700;color:#2D1B69;">
                                    {{ $item->product_name }}
                                </div>
                            </td>
                            <td>Rs. {{ number_format($item->unit_price) }}</td>
                            <td>
                                <span style="background:#EDE9FE;color:#5B21B6;
                                    padding:3px 12px;border-radius:20px;
                                    font-weight:700;font-size:13px;">
                                    x{{ $item->quantity }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight:700;color:#6BCB77;">
                                    Rs. {{ number_format($item->subtotal) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total Amount:</td>
                            <td style="font-weight:800;color:#FF6B9D;font-size:18px;">
                                Rs. {{ number_format($order->final_amount) }}
                            </td>
                        </tr>
                        @if($order->discount_amount > 0)
                        <tr>
                            <td colspan="4" class="text-end fw-bold text-success">Discount:</td>
                            <td style="font-weight:700;color:#6BCB77;">
                                - Rs. {{ number_format($order->discount_amount) }}
                            </td>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>

            {{-- Order Note --}}
            @if($order->order_note)
            <div class="p-3 rounded-3 mb-0" style="background:#FFFBF0;border:1px solid #FFD93D;">
                <p class="fw-bold mb-1">📝 Order Note:</p>
                <p class="mb-0 text-muted">{{ $order->order_note }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Right Column --}}
    <div class="col-12 col-xl-4">

        {{-- Update Status --}}
        <div class="content-card mb-4">
            <div class="content-card-header">
                <h5>⚡ Update Status</h5>
            </div>

            @php
            $colors = [
                'pending'    => ['bg'=>'#FEF3C7','text'=>'#92400E'],
                'confirmed'  => ['bg'=>'#DBEAFE','text'=>'#1E40AF'],
                'processing' => ['bg'=>'#FFEDD5','text'=>'#9A3412'],
                'shipped'    => ['bg'=>'#EDE9FE','text'=>'#5B21B6'],
                'delivered'  => ['bg'=>'#D1FAE5','text'=>'#065F46'],
                'cancelled'  => ['bg'=>'#FEE2E2','text'=>'#991B1B'],
            ];
            $c = $colors[$order->status] ?? ['bg'=>'#F3F4F6','text'=>'#374151'];
            @endphp

            <div class="text-center mb-4">
                <span style="background:{{ $c['bg'] }};color:{{ $c['text'] }};
                    padding:8px 24px;border-radius:30px;
                    font-weight:800;font-size:16px;">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Change Status</label>
                    <select name="status" class="form-select"
                        style="border-radius:12px;padding:12px 16px;">
                        <option value="pending"
                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                            ⏳ Pending
                        </option>
                        <option value="confirmed"
                            {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                            ✅ Confirmed
                        </option>
                        <option value="processing"
                            {{ $order->status == 'processing' ? 'selected' : '' }}>
                            ⚙️ Processing
                        </option>
                        <option value="shipped"
                            {{ $order->status == 'shipped' ? 'selected' : '' }}>
                            🚚 Shipped
                        </option>
                        <option value="delivered"
                            {{ $order->status == 'delivered' ? 'selected' : '' }}>
                            📦 Delivered
                        </option>
                        <option value="cancelled"
                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                            ❌ Cancelled
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn-pink w-100 py-3">
                    💾 Update Status
                </button>
            </form>
        </div>

        {{-- Customer Info --}}
        <div class="content-card">
            <div class="content-card-header">
                <h5>👤 Customer Info</h5>
            </div>
            <ul class="list-unstyled mb-0" style="font-size:14px;">
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Name</span>
                    <span class="fw-bold">{{ $order->customer_name }}</span>
                </li>
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Email</span>
                    <span class="fw-bold">{{ $order->customer_email }}</span>
                </li>
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Phone</span>
                    <span class="fw-bold">{{ $order->customer_phone }}</span>
                </li>
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">City</span>
                    <span class="fw-bold">{{ $order->city }}</span>
                </li>
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Address</span>
                    <span class="fw-bold">{{ $order->shipping_address }}</span>
                </li>
                <li class="mb-3">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Payment</span>
                    <span class="fw-bold">
                        {{ $order->payment_method == 'cod' ? '💵 Cash on Delivery' : '🏦 Bank Transfer' }}
                    </span>
                </li>
                <li>
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Order Date</span>
                    <span class="fw-bold">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </span>
                </li>
            </ul>
        </div>

    </div>
</div>

@endsection

