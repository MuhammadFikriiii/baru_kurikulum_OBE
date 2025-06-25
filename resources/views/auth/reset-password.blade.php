<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            padding: 20px 0;
            line-height: 1.6;
            color: #334155;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            padding: 40px 32px 32px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .icon {
            width: 56px;
            height: 56px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 24px;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 15px;
            color: #64748b;
        }

        .content {
            padding: 32px;
        }

        .message {
            font-size: 16px;
            margin-bottom: 32px;
            text-align: center;
        }

        .button-wrapper {
            text-align: center;
            margin-bottom: 32px;
        }

        .reset-button {
            display: inline-block;
            padding: 12px 24px;
            background: #3b82f6;
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s ease;
            min-width: 160px;
        }

        .reset-button:hover {
            background: #2563eb;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 32px 0;
        }

        .notice {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .notice-text {
            font-size: 14px;
            color: #92400e;
            text-align: center;
        }

        .footer {
            background: #f8fafc;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer-text {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        .link {
            color: #3b82f6;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a;
            }

            .container {
                background: #1e293b;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            }

            .header {
                border-bottom-color: #334155;
            }

            .title {
                color: #f8fafc;
            }

            .subtitle,
            .message,
            .footer-text {
                color: #cbd5e1;
            }

            .divider {
                background: #334155;
            }

            .footer {
                background: #0f172a;
                border-top-color: #334155;
            }
        }

        /* Mobile responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px 0;
            }

            .container {
                margin: 0 16px;
                border-radius: 8px;
            }

            .header {
                padding: 32px 24px 24px;
            }

            .content {
                padding: 24px;
            }

            .footer {
                padding: 20px 24px;
            }

            .title {
                font-size: 22px;
            }

            .message {
                font-size: 15px;
            }

            .reset-button {
                width: 100%;
                padding: 14px 24px;
            }
        }

        /* High contrast mode */
        @media (prefers-contrast: high) {
            .reset-button {
                border: 2px solid #1e40af;
            }

            .notice {
                border-width: 2px;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .reset-button {
                transition: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="icon">🔐</div>
            <h1 class="title">Reset Password</h1>
            <p class="subtitle">Permintaan reset kata sandi Anda</p>
        </div>

        <div class="content">
            <p class="message">
                Klik tombol di bawah ini untuk membuat password baru.
                Link ini akan kedaluwarsa dalam 1 jam.
            </p>

            <div class="button-wrapper">
                <a href="{{ route('validasi-forgot-password', ['token' => $token]) }}" class="reset-button">
                    Reset Password
                </a>
            </div>

            <div class="divider"></div>

            <div class="notice">
                <p class="notice-text">
                    Jika Anda tidak meminta reset password, abaikan email ini.
                </p>
            </div>
        </div>

        <div class="footer">
            <p class="footer-text">
                Email dari <strong>OBE Poliban</strong><br>
            </p>
        </div>
    </div>
</body>

</html>
