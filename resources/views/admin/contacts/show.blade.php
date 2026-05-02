@extends('layouts.admin')

@section('title', 'Contact Message')
@section('page-title', '📬 Message Detail')

@section('content')

<div class="row g-4 justify-content-center">
    <div class="col-12 col-xl-8">
        <div class="content-card">
            <div class="content-card-header">
                <h5>📬 Message Detail</h5>
                <a href="{{ route('admin.contacts.index') }}" class="btn-purple">
                    ← Back to Messages
                </a>
            </div>

            {{-- Status Badge --}}
            <div class="mb-4">
                @if($contact->is_read)
                    <span style="background:#D1FAE5;color:#065F46;
                        padding:6px 18px;border-radius:20px;
                        font-weight:700;font-size:13px;">
                        ✅ Read
                    </span>
                @else
                    <span style="background:#FEE2E2;color:#991B1B;
                        padding:6px 18px;border-radius:20px;
                        font-weight:700;font-size:13px;">
                        🔴 Unread
                    </span>
                @endif
            </div>

            {{-- Sender Info --}}
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-4">
                    <div class="p-3 rounded-3" style="background:#F8F9FF;">
                        <span class="text-muted d-block mb-1" style="font-size:11px;
                            text-transform:uppercase;letter-spacing:1px;">
                            From
                        </span>
                        <span class="fw-bold" style="color:#2D1B69;">
                            👤 {{ $contact->name }}
                        </span>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="p-3 rounded-3" style="background:#F8F9FF;">
                        <span class="text-muted d-block mb-1" style="font-size:11px;
                            text-transform:uppercase;letter-spacing:1px;">
                            Email
                        </span>
                        <a href="mailto:{{ $contact->email }}"
                            class="fw-bold" style="color:#FF6B9D;text-decoration:none;">
                            📧 {{ $contact->email }}
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="p-3 rounded-3" style="background:#F8F9FF;">
                        <span class="text-muted d-block mb-1" style="font-size:11px;
                            text-transform:uppercase;letter-spacing:1px;">
                            Date
                        </span>
                        <span class="fw-bold" style="color:#2D1B69;">
                            📅 {{ $contact->created_at->format('d M Y, h:i A') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Subject --}}
            <div class="mb-4">
                <div class="p-4 rounded-3" style="background:#FFE8F3;
                    border-left:4px solid #FF6B9D;">
                    <span class="text-muted d-block mb-1" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">
                        Subject
                    </span>
                    <h5 class="mb-0 fw-bold" style="color:#2D1B69;">
                        {{ $contact->subject }}
                    </h5>
                </div>
            </div>

            {{-- Message --}}
            <div class="mb-4">
                <div class="p-4 rounded-3" style="background:#FFFBF0;
                    border:1px solid #FFD93D;">
                    <span class="text-muted d-block mb-3" style="font-size:11px;
                        text-transform:uppercase;letter-spacing:1px;">
                        Message
                    </span>
                    <p style="font-size:15px;line-height:1.8;color:#374151;margin:0;">
                        {{ $contact->message }}
                    </p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex gap-3 flex-wrap">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                    class="btn-pink px-4 py-3">
                    📧 Reply via Email
                </a>

                @if(!$contact->is_read)
                <form action="{{ route('admin.contacts.read', $contact->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-purple px-4 py-3"
                        style="border:none;cursor:pointer;">
                        ✅ Mark as Read
                    </button>
                </form>
                @endif

                <a href="{{ route('admin.contacts.index') }}"
                    class="btn btn-light px-4 py-3 rounded-3 fw-bold">
                    ← Back to List
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

