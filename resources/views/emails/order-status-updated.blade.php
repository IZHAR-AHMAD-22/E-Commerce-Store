<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Update</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.08);">
        <div style="padding: 32px; background: #111; color: white; text-align: center;">
            <h1 style="margin: 0; font-size: 28px;">Order Update</h1>
            <p style="margin: 8px 0 0; color: #d1d5db;">Order #{{ $order->id }}</p>
        </div>
        <div style="padding: 32px; color: #111;">
            <p style="font-size: 16px; margin-bottom: 16px;">Hello {{ $order->customer_name }},</p>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 16px;">
                Your order is now <strong>{{ ucfirst($order->status) }}</strong>.
            </p>
            @if($order->admin_note)
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 18px; border-radius: 12px; margin-bottom: 16px;">
                <p style="margin: 0 0 8px; font-weight: 700; color: #111;">Message from the team:</p>
                <p style="margin: 0; color: #4b5563;">{{ $order->admin_note }}</p>
            </div>
            @endif
            <p style="font-size: 16px; margin-bottom: 24px;">
                You can view your order status in your account or reply to this email if you have any questions.
            </p>
            <a href="{{ url('/') }}" style="display: inline-block; padding: 14px 28px; background: #d97706; color: white; text-decoration: none; border-radius: 9999px; font-weight: 700;">
                Visit Thingy Store
            </a>
        </div>
    </div>
</body>
</html>
