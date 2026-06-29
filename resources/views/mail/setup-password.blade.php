{{--
Email: Setup Password untuk Akun Baru
Variables yang dibutuhkan BE:
- $email : string (Email penerima)
- $setupUrl : string (URL lengkap ke halaman setup password, termasuk token)
--}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Password — HMTIF-UNPAS</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    {{-- Wrapper --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f1f5f9; padding: 40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0"
                    style="max-width: 560px; width: 100%;">

                    {{-- Logo Header --}}
                    <tr>
                        <td align="center" style="padding-bottom: 32px;">
                            <img src="{{ config('app.logo_url') }}" alt="HMTIF-UNPAS" width="48" height="48"
                                style="border-radius: 12px;">
                        </td>
                    </tr>

                    {{-- Main Card --}}
                    <tr>
                        <td
                            style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow: hidden;">

                            {{-- Green Top Bar --}}
                            <div style="height: 4px; background: linear-gradient(90deg, #166534, #22c55e);"></div>

                            {{-- Content --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 40px 36px;">

                                        {{-- Greeting --}}
                                        <h1
                                            style="margin: 0 0 8px; font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3;">
                                            Selamat Datang! 🎉
                                        </h1>
                                        <p style="margin: 0 0 28px; font-size: 15px; color: #64748b; line-height: 1.6;">
                                            Akun dashboard HMTIF-UNPAS telah dibuat untuk Anda. Silakan klik tombol di
                                            bawah untuk mengatur password akun Anda.
                                        </p>

                                        {{-- Account Info Box --}}
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 28px;">
                                            <tr>
                                                <td style="padding: 20px 24px;">
                                                    <p
                                                        style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                                                        Email Akun</p>
                                                    <p
                                                        style="margin: 0; font-size: 15px; font-weight: 700; color: #1e293b;">
                                                        {{ $email }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- CTA Button --}}
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            style="margin-bottom: 28px;">
                                            <tr>
                                                <td align="center">
                                                    <a href="{{ $setupUrl }}"
                                                        style="display: inline-block; padding: 14px 36px; background-color: #166534; color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.3);">
                                                        🔐 Atur Password Sekarang
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Alternative URL --}}
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                            style="background-color: #fffbeb; border-radius: 12px; border: 1px solid #fef08a; margin-bottom: 24px;">
                                            <tr>
                                                <td style="padding: 16px 20px;">
                                                    <p
                                                        style="margin: 0 0 6px; font-size: 11px; font-weight: 800; color: #a16207; text-transform: uppercase; letter-spacing: 1.5px;">
                                                        ⚠️ Tombol tidak berfungsi?</p>
                                                    <p
                                                        style="margin: 0; font-size: 12px; color: #78716c; line-height: 1.6; word-break: break-all;">
                                                        Salin dan tempel link berikut di browser Anda:<br>
                                                        <span
                                                            style="color: #166534; font-weight: 600;">{{ $setupUrl }}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        {{-- Divider --}}
                                        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

                                        {{-- Footer Note --}}
                                        <p style="margin: 0; font-size: 13px; color: #94a3b8; line-height: 1.6;">
                                            Jika Anda merasa tidak mendaftar di HMTIF-UNPAS, abaikan email ini. Link ini
                                            hanya berlaku sementara dan satu kali pakai. Jika sudah kedaluwarsa, minta
                                            link baru melalui admin HMTIF atau alur reset password via email.
                                        </p>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td align="center" style="padding: 28px 16px 0;">
                            <p style="margin: 0 0 4px; font-size: 12px; font-weight: 600; color: #94a3b8;">
                                &copy; {{ date('Y') }} HMTIF-UNPAS.
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #cbd5e1;">
                                Email ini dikirim secara otomatis. Mohon jangan membalas email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
