@extends('layouts.admin')

@section('title', 'Customer Profile')
@section('page-title', '👤 Customer Profile')

@section('content')

<div class="row g-4">

    {{-- Customer Info Card --}}
    <div class="col-12 col-xl-4">
        <div class="content-card text-center">
            <div class="content-card-header">
                <h5>👤 Customer Info</h5>
                <a href="{{ route('admin.users.index') }}" class="btn-purple">
                    ← Back
                </a>
            </div>

            {{-- Avatar --}}
            <div class="mb-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                         alt="{{ $user->name }}"
                         style="width:100px;height:100px;border-radius:50%;
                         object-fit:cover;border:4px solid #FF6B9D;">
                @else
                    <div style="width:100px;height:100px;border-radius:50%;
                        background:linear-gradient(135deg,#FF6B9D,#C77DFF);
                        display:flex;align-items:center;justify-content:center;
                        font-size:40px;margin:0 auto;border:4px solid #FF6B9D;">
                        👤
                    </div>
                @endif
            </div>

            <h4 class="font-fredoka" style="color:#2D1B69;">
                {{ $user->name }}
            </h4>
            <p class="text-muted mb-4">{{ $user->email }}</p>

            {{-- Stats --}}
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#FFE8F3;">
                        <div class="font-fredoka" style="font-size:28px;color:#FF6B9D;">
                            {{ $user->orders->count() }}
                        </div>
                        <div style="font-size:12px;font-weight:700;color:#FF6B9D;">
                            Total Orders
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#E8F8EA;">
                        <div class="font-fredoka" style="font-size:20px;color:#6BCB77;">
                            Rs. {{ number_format($user->orders->sum('final_amount')) }}
                        </div>
                        <div style="font-size:12px;font-weight:700;color:#6BCB77;">
                            Total Spent
                        </div>
                    </div>
                </div>
            </div>

            {{-- Details --}}
            <ul class="list-unstyled text-start" style="font-size:14px;">
                <li class="mb-3 p-3 rounded-3" style="background:#F8F9FF;">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Phone</span>
                    <span class="fw-bold">
                        {{ $user->phone ?? 'Not provided' }}
                    </span>
                </li>
                <li class="mb-3 p-3 rounded-3" style="background:#F8F9FF;">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Address</span>
                    <span class="fw-bold">
                        {{ $user->address ?? 'Not provided' }}
                    </span>
                </li>
                <li class="p-3 rounded-3" style="background:#F8F9FF;">
                    <span class="text-muted d-block" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">Member Since</span>
                    <span class="fw-bold">
                        {{ $user->created_at->format('d M Y') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Order History --}}
    <div class="col-12 col-xl-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5>🛒 Order History</h5>
                <span style="background:#EDE9FE;color:#5B21B6;
                    padding:4px 16px;border-radius:20px;
                    font-weight:700;font-size:13px;">
                    {{ $user->orders->count() }} Orders
                </span>
            </div>

            @forelse($user->orders as $order)
            <div class="p-4 mb-3 rounded-3" style="background:#F8F9FF;
                border-left:4px solid #C77DFF;">

                {{-- Order Header --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                            style="font-family:'Fredoka One',cursive;font-size:18px;
                            color:#2D1B69;text-decoration:none;">
                            Order #{{ $order->id }}
                        </a>
                        <div style="font-size:12px;color:#9CA3AF;margin-top:2px;">
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </div>
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
                    <span style="background:{{ $c['bg'] }};color:{{ $c['text'] }};
                        padding:5px 14px;border-radius:20px;
                        font-weight:700;font-size:12px;">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- Order Items --}}
                @foreach($order->orderItems as $item)
                <div class="d-flex align-items-center gap-3 mb-2">
                    @if($item->product_image)
                        <img src="{{ asset('storage/' . $item->product_image) }}"
                             style="width:45px;height:45px;object-fit:cover;
                             border-radius:8px;">
                    @else
                        <div style="width:45px;height:45px;background:#EDE9FE;
                            border-radius:8px;display:flex;align-items:center;
                            justify-content:center;font-size:18px;">🛍️</div>
                    @endif
                    <div style="flex:1;">
                        <div style="font-weight:700;font-size:13px;color:#374151;">
                            {{ $item->product_name }}
                        </div>
                        <div style="font-size:12px;color:#9CA3AF;">
                            x{{ $item->quantity }} × Rs. {{ number_format($item->unit_price) }}
                        </div>
                    </div>
                    <div style="font-weight:700;color:#6BCB77;font-size:13px;">
                        Rs. {{ number_format($item->subtotal) }}
                    </div>
                </div>
                @endforeach

                {{-- Order Total --}}
                <div class="d-flex justify-content-between align-items-center
                    pt-3 mt-2" style="border-top:1px dashed #e0e0e0;">
                    <span style="font-size:13px;color:#6B7280;">
                        💳 {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}
                    </span>
                    <span style="font-weight:800;color:#FF6B9D;font-size:16px;">
                        Rs. {{ number_format($order->final_amount) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <div style="font-size:48px;">🛒</div>
                <p class="text-muted mt-3">No orders yet from this customer.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection

