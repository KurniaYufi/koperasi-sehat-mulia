<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitansi & Nota - {{ $invoice->invoice_number }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            margin: 1.5cm;
            color: #000;
            line-height: 1.15;
        }

        .header {
            width: 100%;
            margin-bottom: 50px;
            border-collapse: collapse;
        }
        .logo-container {
            width: 60px;
            vertical-align: top;
        }
        .logo {
            width: 60px;
            height: auto;
        }
        .company-detail {
            text-align: left;
            vertical-align: top;
            padding-left: 20px;
        }
        .company-detail h2 {
            font-size: 18pt;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .company-detail p {
            margin: 5px 0 0 0;
            font-size: 9pt;
            line-height: 1.4;
        }

        .nota-info { margin: 20px 0; font-weight: bold; font-size: 11pt; }

        .content-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .content-table td { padding: 8px 5px; vertical-align: top; }

        .amount-box {
            border: 1px solid #000;
            padding: 8px 12px;
            font-size: 14pt;
            display: inline-block;
            min-width: 220px;
        }

        .footer-section {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        .sig-container {
            text-align: center;
            width: 250px;
            vertical-align: top;
        }
        .sig-space { height: 80px; }

        .page-break { page-break-after: always; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .flex-amount { display: table; width: 100%; }
        .currency { display: table-cell; text-align: left; }
        .value { display: table-cell; text-align: right; }

        .nota-grid { width: 100%; border-collapse: collapse; }
        .nota-grid th { border: 1px solid #000; padding: 8px; font-size: 9pt; text-transform: uppercase; }
        .nota-grid td { border-left: 1px solid #000; border-right: 1px solid #000; padding: 6px 8px; font-size: 10pt; height: 25px; }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td class="logo-container">
                <img src="{{ public_path('/images/logo.png') }}" class="logo">
            </td>
            <td class="company-detail">
                <h2>KOPERASI SEHAT MULIA</h2>
                <p>Jl. Percetakan Negara No. 17 Kelurahan Johar Baru<br>Kecamatan Johar Baru Jakarta Pusat 10560</p>
            </td>
        </tr>
    </table>

    <div class="nota-info">No. Kwitansi : {{ $invoice->invoice_number }}</div>

    <table class="content-table">
        <tr>
            <td width="140"><i>Sudah terima dari</i></td>
            <td width="10">:</td>
            <td><strong>{{ strtoupper($invoice->received_from) }}</strong></td>
        </tr>
        <tr>
            <td><i>Besar pembayaran</i></td>
            <td>:</td>
            <td><i>{{ $invoice->amount_in_words }} rupiah</i></td>
        </tr>
        <tr>
            <td><i>Untuk Pembayaran</i></td>
            <td>:</td>
            <td>{{ $invoice->description }}</td>
        </tr>
    </table>

    <table class="footer-section">
        <tr>
            <td style="vertical-align: bottom; padding-bottom: 5px;">
                <div class="amount-box">
                    <div class="flex-amount">
                        <span class="currency">Rp.</span>
                        <span class="value">{{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </td>
            <td class="sig-container">
                <div>Jakarta, {{ $invoice->invoice_date->translatedFormat('d F Y') }}</div>
                <div class="sig-space"></div>
                <strong>{{ $invoice->issuer_name ?? 'Muhammad Fikri' }}</strong>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <table class="header">
        <tr>
            <td class="logo-container">
                <img src="{{ public_path('/images/logo.png') }}" class="logo">
            </td>
            <td class="company-detail">
                <h2>KOPERASI SEHAT MULIA</h2>
                <p>Jl. Percetakan Negara No. 17 Kelurahan Johar Baru<br>Kecamatan Johar Baru Jakarta Pusat 10560</p>
            </td>
        </tr>
    </table>

    <div class="nota-info">Nota No : {{ $invoice->invoice_number }}</div>

    <table class="nota-grid">
        <thead>
            <tr>
                <th width="15%">BANYAKNYA</th>
                <th>NAMA BARANG</th>
                <th width="20%">HARGA</th>
                <th width="20%">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td class="text-center">{{ $item->quantity }}</td>
                <td>{{ $item->item_name }}</td>
                <td class="text-right">{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td class="text-right">
                    <div class="flex-amount">
                        <span class="currency">Rp.</span>
                        <span class="value">{{ number_format($item->total_price, 0, ',', '.') }}</span>
                    </div>
                </td>
            </tr>
            @endforeach
            @for($i = count($invoice->items); $i < 10; $i++)
            <tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
            @endfor
            <tr style="border: 1px solid #000; font-weight: bold;">
                <td colspan="2" class="text-center" style="height: 30px;">JUMLAH</td>
                <td></td>
                <td class="text-right">
                    <div class="flex-amount">
                        <span class="currency">Rp.</span>
                        <span class="value">{{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="footer-section" style="margin-top: 40px;">
        <tr>
            <td class="sig-container" style="text-align: center;">
                <p style="margin-bottom: 0;">Tanda Terima</p>
                <div class="sig-space"></div>
                <strong>( {{ $invoice->received_from_name ?? '-' }} )</strong>
            </td>
            <td></td>
            <td class="sig-container" style="text-align: center;">
                <p style="margin-bottom: 0;">Hormat Kami,</p>
                <div class="sig-space"></div>
                <strong>( {{ $invoice->issuer_name ?? 'Muhammad Fikri' }} )</strong>
            </td>
        </tr>
    </table>

</body>
</html>
