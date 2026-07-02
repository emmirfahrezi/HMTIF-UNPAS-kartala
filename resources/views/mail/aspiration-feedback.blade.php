{{--
Email: Notifikasi Status Aspirasi
Variables yang dibutuhkan BE:
- $name         : string (Nama pengirim aspirasi)
- $subject      : string (Subjek aspirasi)
- $trackingCode : string (Kode tracking)
- $status       : string (pending|reviewed|resolved|rejected)
- $message      : string|null (Pesan balasan opsional dari admin)
--}}

@php
    $recipientName = trim((string) ($name ?? ''));
    if ($recipientName === '' || in_array($recipientName, ['Pengirim', 'Pelapor'], true)) {
        $recipientName = 'Sobat HMTIF';
    }

    $statusMap = [
        'pending'  => ['label' => 'Menunggu', 'color' => '#f59e0b', 'bg' => '#fef3c7'],
        'reviewed' => ['label' => 'Ditinjau', 'color' => '#3b82f6', 'bg' => '#dbeafe'],
        'resolved' => ['label' => 'Selesai',  'color' => '#10b981', 'bg' => '#d1fae5'],
        'rejected' => ['label' => 'Ditolak',  'color' => '#ef4444', 'bg' => '#fee2e2'],
    ];
    $current = $statusMap[$status] ?? $statusMap['pending'];
@endphp

<x-layouts.mail title="Update Aspirasi — HMTIF-UNPAS">

    <h1 style="margin: 0 0 8px; font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.3;">
        Halo, {{ $recipientName }}! 👋
    </h1>
    <p style="margin: 0 0 28px; font-size: 15px; color: #64748b; line-height: 1.6;">
        Ada update terbaru untuk aspirasi yang kamu kirimkan. Berikut detail statusnya:
    </p>

    {{-- Aspiration Detail Box --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
        <tr>
            <td style="padding: 20px 24px;">
                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Subjek</p>
                <p style="margin: 0 0 16px; font-size: 15px; font-weight: 700; color: #1e293b;">
                    {{ $subject }}</p>

                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                    Status</p>
                <span style="display: inline-block; padding: 5px 14px; border-radius: 999px; font-size: 13px; font-weight: 700; color: {{ $current['color'] }}; background-color: {{ $current['bg'] }};">
                    {{ $current['label'] }}
                </span>

                @if (!empty($trackingCode))
                    <p style="margin: 16px 0 4px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px;">
                        Kode Tracking</p>
                    <p style="margin: 0; font-size: 14px; font-weight: 600; color: #475569; font-family: 'Courier New', monospace; background: #e2e8f0; display: inline-block; padding: 4px 12px; border-radius: 6px;">
                        {{ $trackingCode }}</p>
                @endif
            </td>
        </tr>
    </table>

    {{-- Admin Response --}}
    @if (!empty($message))
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
            style="background-color: #f0fdf4; border-radius: 12px; border: 1px solid #bbf7d0; margin-bottom: 24px;">
            <tr>
                <td style="padding: 20px 24px;">
                    <p style="margin: 0 0 8px; font-size: 11px; font-weight: 800; color: #16a34a; text-transform: uppercase; letter-spacing: 1.5px;">
                        💬 Pesan dari Admin</p>
                    <p style="margin: 0; font-size: 14px; color: #1e293b; line-height: 1.7;">
                        {{ $message }}</p>
                </td>
            </tr>
        </table>
    @endif

    <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

    <p style="margin: 0; font-size: 13px; color: #94a3b8; line-height: 1.6;">
        Terima kasih telah menyampaikan aspirasimu. Suaramu penting untuk kemajuan HMTIF-UNPAS. 💚
    </p>

</x-layouts.mail>
