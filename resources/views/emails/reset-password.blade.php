<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - HelpDeskly</title>
</head>

<body style="margin: 0; padding: 20px; background-color: #f3f4f6; font-family: Arial, sans-serif;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto;">
        <!-- Logo Header -->
        <tr>
            <td align="center" style="padding: 0 0 32px 0;">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color: #2563eb; padding: 12px; border-radius: 12px;">
                                        <span style="color: white; font-size: 20px;">💬</span>
                                    </td>
                                    <td style="padding-left: 12px;">
                                        <span
                                            style="font-size: 24px; font-weight: bold; color: #1f2937;">HelpDeskly</span>
                                    </td>
                                </tr>
                            </table>
                            <p style="color: #6b7280; font-size: 14px; margin: 8px 0 0 0;">The Modern Support Ticket
                                Platform</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Email Content Card -->
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0"
                    style="background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="padding: 32px;">
                            <!-- Title -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 8px;">
                                        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin: 0;">
                                            Password Reset Request</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 24px;">
                                        <p style="color: #6b7280; margin: 0;">Hello {{ $user->first_name }},</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 24px;">
                                        <p style="color: #374151; margin: 0; line-height: 1.5;">
                                            You are receiving this email because we received a password reset request
                                            for your account.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Verification Code Display -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 24px; background-color: #f0f9ff; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 20px; text-align: center;">
                                        <p
                                            style="color: #0369a1; font-size: 14px; margin: 0 0 8px 0; font-weight: bold;">
                                            Your Verification Code:</p>
                                        <div
                                            style="background: white; padding: 16px; border-radius: 8px; border: 2px dashed #0369a1; display: inline-block;">
                                            <span
                                                style="font-size: 28px; font-weight: bold; color: #0369a1; letter-spacing: 4px;">{{ $verification_code }}</span>
                                        </div>
                                        <p style="color: #0369a1; font-size: 12px; margin: 8px 0 0 0;">
                                            Expires: {{ $verification_code_expire_at->format('M j, Y g:i A') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Reset Link -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/reset-password') }}?email={{ Illuminate\Support\Facades\Crypt::encrypt($user->email) }}"
                                            style="background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
                                            🔄 Go to Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Info Box -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="background-color: #dbeafe; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 16px;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="padding-bottom: 12px;">
                                                    <p
                                                        style="font-size: 14px; color: #1e40af; font-weight: bold; margin: 0;">
                                                        Important Information:</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="20" style="vertical-align: top;">⏰</td>
                                                            <td
                                                                style="font-size: 12px; color: #1e40af; line-height: 1.4;">
                                                                This verification code will expire in <strong>30
                                                                    minutes</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="8"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20" style="vertical-align: top;">🔒</td>
                                                            <td
                                                                style="font-size: 12px; color: #1e40af; line-height: 1.4;">
                                                                Enter this code on the password reset page along with
                                                                your new password
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 24px 0;">
                <p style="color: #6b7280; font-size: 12px; margin: 0;">
                    &copy; {{ date('Y') }} HelpDeskly. All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>