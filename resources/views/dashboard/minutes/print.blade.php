<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara - {{ $minute->nomor }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap');

        :root {
            --kop-green: #086b3e;
        }

        @page {
            size: A4;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #525659;
            margin: 0;
            padding: 20px 0;
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            font-size: 12pt;
            line-height: 1.5;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* ============================================
           PRINT: Repeating Header & Footer via Table
           ============================================ */
        .print-table {
            width: 100%;
            border-collapse: collapse;
        }

        .print-table thead {
            display: table-header-group;
        }

        .print-table tfoot {
            display: table-footer-group;
        }

        .print-table tbody {
            display: table-row-group;
        }

        .print-table thead td,
        .print-table tfoot td,
        .print-table tbody td {
            padding: 0;
        }

        /* ============================================
           A4 Page Container (screen preview only)
           ============================================ */
        .a4-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 20px auto;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        /* Watermark background */
        /* Watermark Image */
        .watermark-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120mm;
            height: auto;
            opacity: 0.08;
            z-index: 0;
            pointer-events: none;
        }

        .page-inner {
            position: relative;
            z-index: 1;
        }

        /* ============================================
           KOP SURAT (HEADER)
           ============================================ */
        .kop-surat {
            width: 100%;
            text-align: center;
            padding-bottom: 0px;
        }

        .kop-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2mm;
            margin-left: 10mm;
            margin-right: 10mm;
            margin-top: 5mm
        }

        .kop-logo {
            width: 29mm;
            height: auto;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
            padding: 0 5mm;
        }

        .kop-text h1 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            line-height: 1.5;
        }

        .kop-text h2 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
            line-height: 1.5;
        }

        .kop-text p {
            font-size: 9.5pt;
            margin: 2px 0 0 0;
            line-height: 1.5;
        }

        .kop-divider {
            margin: 2mm 23mm 5mm 23mm;
            border: none;
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 6px;
        }

        /* ============================================
           FOOTER
           ============================================ */
        .box-closer {
            border-top: 1px solid #000;
            margin: 0 23mm;
            display: block;
            height: 0;
        }

        .footer-space {
            height: 28mm;
        }

        .print-footer {
            width: 100%;
            height: 22mm;
            background: linear-gradient(to bottom, transparent 0%, #a4e1ca 8%, #258d34 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 4mm;
        }

        @media print {
            .print-only {
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                width: 100% !important;
                z-index: 9999 !important;
                display: flex !important;
            }

            .screen-only {
                display: none !important;
            }
        }

        @media screen {
            .print-only {
                display: none !important;
            }

            .screen-only {
                position: absolute;
                bottom: 0;
                left: 0;
            }
        }

        .footer-line {
            position: absolute;
            bottom: 10mm;
            left: 23mm;
            right: 23mm;
            width: auto;
            border: none;
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 6px;
            background-color: transparent;
        }

        .footer-contacts {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            color: white;
            font-size: 8pt;
            z-index: 2;
            font-family: 'Instrument Sans', sans-serif;
        }

        .footer-contacts div {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .footer-contacts svg {
            width: 12px;
            height: 12px;
        }

        /* ============================================
           CONTENT
           ============================================ */
        .main-content {
            padding: 0 23mm;
        }

        .doc-title {
            text-align: center;
            margin-top: 5mm;
            margin-bottom: 6mm;
        }

        .doc-title h3 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0 0 2px 0;
            text-transform: uppercase;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 6mm;
            font-size: 12pt;
            line-height: 1.5;
        }

        .meta-table td {
            vertical-align: top;
            padding: 1px 0;
        }

        .meta-label {
            width: 28mm;
        }

        .meta-colon {
            width: 5mm;
            text-align: center;
        }

        /* Section boxes */
        .section-box {
            margin-bottom: 6mm;
            page-break-inside: auto;
        }

        .section-header {
            background-color: var(--kop-green);
            color: white;
            font-weight: bold;
            padding: 5px 18px;
            display: inline-block;
            font-size: 11pt;
            border: 1px solid #000;
            border-bottom: none;
            margin-bottom: -1px;
            position: relative;
            z-index: 2;
        }

        .section-content {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 12px 18px;
            font-size: 12pt;
            line-height: 1.5;
        }

        .section-content p {
            margin-top: 0;
            margin-bottom: 8px;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .section-content ul {
            margin-top: 0;
            padding-left: 20px;
        }

        .section-content li {
            margin-bottom: 4px;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        /* Attendance */
        .attendance-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5mm;
            text-transform: uppercase;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6mm;
            font-size: 11pt;
            text-align: center;
        }

        .attendance-table th,
        .attendance-table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .attendance-table th {
            background-color: var(--kop-green);
            color: white;
            font-weight: bold;
        }

        /* Signature */
        .signature-area {
            display: flex;
            justify-content: center;
            margin-top: 10mm;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
            width: 60mm;
            font-size: 12pt;
            line-height: 1.5;
        }

        .signature-space {
            height: 25mm;
        }

        /* Documentation images */
        .doc-images {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .doc-images img {
            max-width: 48%;
            height: auto;
        }

        .page-break {
            page-break-before: always;
        }

        /* ============================================
           PRINT OVERRIDES
           ============================================ */
        @media print {

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body,
            html {
                background: transparent !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .a4-page {
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
                height: 100% !important;
                min-height: auto !important;
            }

            .watermark-img {
                position: fixed !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                z-index: 0 !important;
                display: block !important;
            }
        }
    </style>
</head>

<body>

    {{-- ===== PRINT ONLY FOOTER (Fixed to viewport bottom in Chrome Print) ===== --}}
    <div class="print-footer print-only">
        <div class="footer-line"></div>
        <div class="footer-contacts">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                hmtif2526@gmail.com
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>
                www.unpas.ac.id
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
                @hmtifunpas
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.54-4.24-7.136-7.136l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                +62 857-1395-4883
            </div>
        </div>
    </div>

    <div class="a4-page">
        <img src="{{ config('app.logo_url') }}" class="watermark-img" alt="Watermark">

        <div class="page-inner" style="position: relative; display: block;">
            {{-- ===== TABLE 1: BERITA ACARA ===== --}}
            <div style="display: block; clear: both; width: 100%;">
                <table class="print-table">
                    {{-- ===== THEAD: KOP SURAT (repeats on every printed page) ===== --}}
                    <thead>
                        <tr>
                            <td>
                                <div class="kop-surat" style="padding-top: 5mm;">
                                    <div class="kop-row">
                                        <img src="{{ config('app.logo_unpas_url') }}" alt="Logo UNPAS" class="kop-logo"
                                            onerror="this.src='https://via.placeholder.com/100x100?text=UNPAS'">
                                        <div class="kop-text">
                                            <h1>HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h1>
                                            <h2>FAKULTAS TEKNIK</h2>
                                            <h2>UNIVERSITAS PASUNDAN</h2>
                                            <h2>BANDUNG</h2>
                                            <p>Jl. Dr. Setiabudi No. 193 Gedung Jalak Harupat Lt. 7 Bandung 40153</p>
                                        </div>
                                        <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="kop-logo">
                                    </div>
                                </div>
                                <div class="kop-divider" style="margin-top: 2mm; margin-bottom: 2mm;"></div>
                                <div class="box-top-border"
                                    style="margin: 0 23mm; border-bottom: 1px solid #000; height: 1px;"></div>
                            </td>
                        </tr>
                    </thead>

                    {{-- ===== TFOOT: FOOTER SPACE (reserves space on every printed page) ===== --}}
                    <tfoot>
                        <tr>
                            <td>
                                <div class="footer-space"></div>
                            </td>
                        </tr>
                    </tfoot>

                    {{-- ===== TBODY: MAIN CONTENT ===== --}}
                    <tbody>
                        <tr>
                            <td>
                                <div class="main-content">
                                    {{-- CONCEALER DIV: Hides the fake top border on Page 1! --}}
                                    <div
                                        style="position: relative; top: -3px; left: 0; width: 100%; height: 4px; background: white; z-index: 10;">
                                    </div>

                                    {{-- Judul Dokumen --}}
                                    <div class="doc-title" style="margin-top: 0;">
                                        <h3>BERITA ACARA RAPAT</h3>
                                        <h3>BIDANG KOMUNIKASI DAN INFORMASI(KOMINFO)</h3>
                                    </div>

                                    {{-- Meta Info --}}
                                    <table class="meta-table">
                                        <tr>
                                            <td class="meta-label">Nomor</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->nomor }}</td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Perihal</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->perihal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Pertemuan ke</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->pertemuan_ke ?? 1 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Hari, Tanggal</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ \Carbon\Carbon::parse($minute->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Waktu</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->waktu_mulai }} – {{ $minute->waktu_selesai ?? 'Selesai' }}
                                                WIB</td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Tempat</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->tempat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="meta-label">Dipimpin oleh</td>
                                            <td class="meta-colon">:</td>
                                            <td>{{ $minute->dipimpin_oleh }}</td>
                                        </tr>
                                    </table>

                                    {{-- Agenda --}}
                                    <div class="section-box">
                                        <div class="section-header">Agenda</div>
                                        <div class="section-content">
                                            {!! $minute->agenda !!}
                                        </div>
                                    </div>

                                    {{-- Isi Rapat --}}
                                    <div class="section-box">
                                        <div class="section-header">Isi Rapat</div>
                                        <div class="section-content">
                                            {!! $minute->isi_rapat !!}
                                        </div>
                                    </div>

                                    {{-- Dokumentasi --}}
                                    @if($minute->dokumentasi && count($minute->dokumentasi) > 0)
                                        <div class="section-box">
                                            <div class="section-header">Dokumentasi</div>
                                            <div class="section-content">
                                                <div class="doc-images">
                                                    @foreach($minute->dokumentasi as $doc)
                                                        <img src="{{ asset('storage/' . $doc) }}" alt="Dokumentasi">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- ===== TABLE 2: DAFTAR HADIR ===== --}}
            <div style="display: block; clear: both; width: 100%; page-break-before: always;">
                <table class="print-table">
                    <thead>
                        <tr>
                            <td>
                                <div class="kop-surat" style="padding-top: 5mm;">
                                    <div class="kop-row">
                                        <img src="{{ config('app.logo_unpas_url') }}" alt="Logo UNPAS" class="kop-logo"
                                            onerror="this.src='https://via.placeholder.com/100x100?text=UNPAS'">
                                        <div class="kop-text">
                                            <h1>HIMPUNAN MAHASISWA TEKNIK INFORMATIKA</h1>
                                            <h2>FAKULTAS TEKNIK</h2>
                                            <h2>UNIVERSITAS PASUNDAN</h2>
                                            <h2>BANDUNG</h2>
                                            <p>Jl. Dr. Setiabudi No. 193 Gedung Jalak Harupat Lt. 7 Bandung 40153</p>
                                        </div>
                                        <img src="{{ config('app.logo_url') }}" alt="Logo HMTIF" class="kop-logo">
                                    </div>
                                </div>
                                <div class="kop-divider"></div>
                            </td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>
                                <div class="footer-space"></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>
                                <div class="main-content" style="padding-top: 5mm;">

                                    <div class="attendance-title" style="margin-top: 10mm;">DAFTAR HADIR</div>

                                    <table class="attendance-table">
                                        <thead>
                                            <tr>
                                                <th style="width:10%;">No</th>
                                                <th style="width:45%;">Nama</th>
                                                <th style="width:25%;">NPM</th>
                                                <th style="width:20%;">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($minute->attendees as $index => $attendee)
                                                <tr>
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td style="text-align:left;">{{ $attendee->name }}</td>
                                                    <td>{{ $attendee->nim ?? '-' }}</td>
                                                    <td>{{ $attendee->keterangan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- Tanda Tangan --}}
                                    <div class="signature-area">
                                        <div class="signature-box">
                                            <p>Bandung,
                                                {{ \Carbon\Carbon::parse($minute->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                            </p>
                                            <p style="font-weight:bold; margin-top:15px;">Mengetahui</p>
                                            <p style="font-weight:bold; margin-bottom:5px;">Koordinator Bidang</p>
                                            <div class="signature-space"></div>
                                            <p style="text-decoration:underline; margin-bottom:0;">
                                                {{ $minute->dipimpin_oleh }}
                                            </p>
                                            <p style="margin-top:2px;">
                                                NPM.{{ $minute->attendees->where('name', $minute->dipimpin_oleh)->first()->nim ?? '-' }}
                                            </p>
                                        </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== SCREEN ONLY FOOTER (Sticks to bottom of white paper in Screen Preview) ===== --}}
        <div class="print-footer screen-only">
            <div class="footer-line"></div>
            <div class="footer-contacts">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    hmtif2526@gmail.com
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    www.unpas.ac.id
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                    @hmtifunpas
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.54-4.24-7.136-7.136l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    +62 857-1395-4883
                </div>
            </div>
        </div>

    </div>

    <script>
        window.onload = function () {
            // window.print();
        }
    </script>

</body>

</html>