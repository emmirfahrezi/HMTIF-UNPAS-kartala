@props([
    'title' => 'HMTIF-UNPAS',
    'footerNote' => 'Email ini dikirim secara otomatis. Mohon jangan membalas email ini.',
])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f1f5f9; padding: 40px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0"
                    style="max-width: 560px; width: 100%;">

                    {{-- Logo --}}
                    <tr>
                        <td align="center" style="padding-bottom: 32px;">
                            <img src="{{ config('app.logo_url') }}" alt="HMTIF-UNPAS" width="48" height="48"
                                style="border-radius: 12px;">
                        </td>
                    </tr>

                    {{-- Main Card --}}
                    <tr>
                        <td style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow: hidden;">
                            <div style="height: 4px; background: linear-gradient(90deg, #166534, #22c55e);"></div>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 40px 36px;">
                                        {{ $slot }}
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
                                {{ $footerNote }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
