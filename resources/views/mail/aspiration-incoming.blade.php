{{--
Email: Notifikasi Aspirasi Baru untuk Admin
Variables yang dibutuhkan BE:
- $name         : string (Nama pengirim)
- $nim          : string|null (NIM pengirim)
- $email        : string|null (Email pengirim)
- $subject      : string (Subjek/Tujuan aspirasi)
- $message      : string (Pesan aspirasi)
- $trackingCode : string (Kode tracking)
--}}

<x-layouts.mail
    title="Aspirasi Baru Masuk — HMTIF-UNPAS"
    footer-note="Email ini dikirim secara otomatis ke alamat admin yang terdaftar.">

    <h1 style="margin: 0 0 8px; font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3;">
        Aspirasi Baru Masuk! 📥
    </h1>
    <p style="margin: 0 0 28px; font-size: 15px; color: #64748b; line-height: 1.6;">
        Halo Admin HMTIF, ada aspirasi baru yang masuk melalui website HMTIF UNPAS. Berikut detail lengkapnya:
    </p>

    {{-- Aspiration Detail Box --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
        <tr>
            <td style="padding: 20px 24px;">
                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Kode Tracking</p>
                <p style="margin: 0 0 16px; font-size: 14px; font-weight: 600; color: #1e293b; font-family: 'Courier New', monospace; background: #e2e8f0; display: inline-block; padding: 4px 12px; border-radius: 6px;">
                    {{ $trackingCode }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Nama Pengirim</p>
                <p style="margin: 0 0 16px; font-size: 15px; font-weight: 700; color: #1e293b;">
                    {{ $name ?: 'Anonim' }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    NIM</p>
                <p style="margin: 0 0 16px; font-size: 15px; font-weight: 600; color: #334155;">
                    {{ $nim ?: '-' }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Email</p>
                <p style="margin: 0 0 16px; font-size: 15px; font-weight: 600; color: #334155;">
                    {{ $email ?: '-' }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Perihal</p>
                <p style="margin: 0 0 16px; font-size: 15px; font-weight: 700; color: #1e293b;">
                    {{ $subject }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Pesan</p>
                <p style="margin: 0; font-size: 14px; color: #334155; line-height: 1.7; white-space: pre-line;">
                    {{ $message }}</p>
            </td>
        </tr>
    </table>

    {{-- CTA Button --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 28px;">
        <tr>
            <td align="center">
                <a href="{{ url('/dashboard/aspirations') }}"
                    style="display: inline-block; padding: 14px 36px; background-color: #166534; color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.3);">
                    💼 Buka Dashboard Admin
                </a>
            </td>
        </tr>
    </table>

    <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

    <p style="margin: 0; font-size: 13px; color: #94a3b8; line-height: 1.6;">
        Silakan segera lakukan peninjauan dan berikan tanggapan terbaik Anda demi kemajuan HMTIF-UNPAS. 💚
    </p>

</x-layouts.mail>
