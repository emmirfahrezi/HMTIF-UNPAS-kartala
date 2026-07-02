{{--
Email: Reset Password
Variables yang dibutuhkan BE:
- $email    : string (Email penerima)
- $resetUrl : string (URL lengkap ke halaman reset password, termasuk token)
--}}

<x-layouts.mail title="Reset Password — HMTIF-UNPAS">

    <h1 style="margin: 0 0 8px; font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3;">
        Permintaan Reset Password
    </h1>
    <p style="margin: 0 0 28px; font-size: 15px; color: #64748b; line-height: 1.6;">
        Kami menerima permintaan untuk mereset password akun dashboard HMTIF-UNPAS Anda. Klik tombol di bawah untuk membuat password baru.
    </p>

    {{-- Account Info Box --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 28px;">
        <tr>
            <td style="padding: 20px 24px;">
                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Email Akun</p>
                <p style="margin: 0; font-size: 15px; font-weight: 700; color: #1e293b;">
                    {{ $email }}
                </p>
            </td>
        </tr>
    </table>

    {{-- CTA Button --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 16px;">
        <tr>
            <td align="center">
                <a href="{{ $resetUrl }}"
                    style="display: inline-block; padding: 14px 36px; background-color: #166534; color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.3);">
                    🔑 Reset Password Sekarang
                </a>
            </td>
        </tr>
    </table>

    <p style="margin: 0 0 24px; font-size: 12px; color: #94a3b8; text-align: center; line-height: 1.6;">
        Link ini hanya berlaku selama <strong style="color: #64748b;">60 menit</strong> dan satu kali pakai.
    </p>

    {{-- Alternative URL --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #fffbeb; border-radius: 12px; border: 1px solid #fef08a; margin-bottom: 24px;">
        <tr>
            <td style="padding: 16px 20px;">
                <p style="margin: 0 0 6px; font-size: 11px; font-weight: 800; color: #a16207; text-transform: uppercase; letter-spacing: 1.5px;">
                    ⚠️ Tombol tidak berfungsi?</p>
                <p style="margin: 0; font-size: 12px; color: #78716c; line-height: 1.6; word-break: break-all;">
                    Salin dan tempel link berikut di browser Anda:<br>
                    <span style="color: #166534; font-weight: 600;">{{ $resetUrl }}</span>
                </p>
            </td>
        </tr>
    </table>

    <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

    <p style="margin: 0; font-size: 13px; color: #94a3b8; line-height: 1.6;">
        Jika Anda tidak merasa meminta reset password, abaikan email ini — password Anda tidak akan berubah. Jika Anda curiga ada aktivitas mencurigakan, segera hubungi admin HMTIF-UNPAS.
    </p>

</x-layouts.mail>
