<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agent Invitation</title>
</head>
<body style="font-family: 'General Sans', sans-serif; background-color: #f9f9f8; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; border: 1px border #e8e8e7; overflow: hidden; padding: 40px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome" style="height: 40px;">
        </div>
        <h1 style="color: #1e1d1d; font-size: 24px; font-medium; margin-bottom: 20px;">You're Invited!</h1>
        <p style="color: #464646; font-size: 16px; line-height: 1.5; margin-bottom: 20px;">
            Hello {{ $agentName }},
        </p>
        <p style="color: #464646; font-size: 16px; line-height: 1.5; margin-bottom: 30px;">
            You have been invited to join <strong>{{ auth()->user()->name }}</strong> as a Business Agent on HopInHome. Start managing listings and boosting your property business today!
        </p>
        <div style="text-align: center; margin-bottom: 40px;">
            <a href="{{ $invitationUrl }}" style="background-color: #1447d4; color: #ffffff; padding: 16px 32px; border-radius: 50px; text-decoration: none; font-weight: 500; font-size: 16px;">
                Accept Invitation
            </a>
        </div>
        <p style="color: #949494; font-size: 14px; text-align: center;">
            If you didn't expect this invitation, you can safely ignore this email.
        </p>
        <hr style="border: 0; border-top: 1px solid #e8e8e7; margin: 30px 0;">
        <p style="color: #949494; font-size: 12px; text-align: center;">
            &copy; {{ date('Y') }} HopInHome. All rights reserved.
        </p>
    </div>
</body>
</html>
