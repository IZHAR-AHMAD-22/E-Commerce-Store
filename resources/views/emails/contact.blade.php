<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFBF0;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #FF6B9D, #C77DFF);
            padding: 32px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .header p {
            color: rgba(255,255,255,0.85);
            margin: 8px 0 0;
            font-size: 14px;
        }
        .body {
            padding: 32px;
        }
        .field {
            margin-bottom: 20px;
            border-left: 4px solid #FF6B9D;
            padding-left: 16px;
        }
        .field label {
            display: block;
            font-size: 12px;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .field p {
            margin: 0;
            font-size: 15px;
            color: #1F2937;
            line-height: 1.6;
        }
        .message-box {
            background: #FFFBF0;
            border-radius: 12px;
            padding: 20px;
            margin-top: 8px;
            border: 1px solid #FFD93D;
        }
        .message-box p {
            margin: 0;
            font-size: 15px;
            color: #1F2937;
            line-height: 1.7;
        }
        .footer {
            background: #F9FAFB;
            padding: 20px 32px;
            text-align: center;
            border-top: 1px solid #F3F4F6;
        }
        .footer p {
            margin: 0;
            font-size: 13px;
            color: #9CA3AF;
        }
        .badge {
            display: inline-block;
            background: #FFD93D;
            color: #92400E;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>🛍️ Thingy Store</h1>
            <p>New Contact Message Received</p>
        </div>

        <div class="body">
            <span class="badge">📬 New Message</span>

            <div class="field">
                <label>Customer Name</label>
                <p>{{ $contact->name }}</p>
            </div>

            <div class="field">
                <label>Email Address</label>
                <p>
                    <a href="mailto:{{ $contact->email }}" 
                        style="color:#FF6B9D;text-decoration:none;">
                        {{ $contact->email }}
                    </a>
                </p>
            </div>

            <div class="field">
                <label>Subject</label>
                <p>{{ $contact->subject }}</p>
            </div>

            <div class="field">
                <label>Message</label>
                <div class="message-box">
                    <p>{{ $contact->message }}</p>
                </div>
            </div>

            <div class="field">
                <label>Date Received</label>
                <p>{{ $contact->created_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <div class="footer">
            <p>This email was sent from Thingy Store contact form.</p>
            <p style="margin-top:6px;">
                © {{ date('Y') }} Thingy Store. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>