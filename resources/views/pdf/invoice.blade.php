<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            background: #fff;
            padding: 30px 40px;
        }

        /* ── Header ── */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 24px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 16px;
        }
        .header-logo  { display: table-cell; width: 50%; vertical-align: middle; }
        .header-right { display: table-cell; width: 50%; vertical-align: middle; text-align: right; }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #111;
        }
        .logo-text span { color: #6366f1; }

        .invoice-title {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .company-info {
            margin-top: 4px;
            font-size: 11px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* ── Meta row ── */
        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 24px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
        }
        .meta-col { display: table-cell; width: 33.33%; vertical-align: top; }

        .meta-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .meta-value      { font-size: 12px; color: #111; font-weight: 600; }
        .meta-value-sub  { font-size: 11px; color: #6b7280; margin-top: 2px; }

        /* ── Items table ── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
        }
        table.items thead tr {
            background: #f9fafb;
        }
        table.items thead th {
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e5e7eb;
        }
        table.items thead th.right { text-align: right; }

        table.items tbody tr { border-bottom: 1px solid #f3f4f6; }
        table.items tbody tr:last-child { border-bottom: none; }

        table.items tbody td {
            padding: 10px;
            font-size: 12px;
            color: #374151;
            vertical-align: middle;
        }
        table.items tbody td.right { text-align: right; }
        table.items tbody td.muted { color: #9ca3af; font-size: 11px; }

        /* ── Totals ── */
        .totals-wrap {
            display: table;
            width: 100%;
            margin-top: 16px;
        }
        .totals-spacer { display: table-cell; width: 55%; }
        .totals-box    { display: table-cell; width: 45%; vertical-align: top; }

        table.totals {
            width: 100%;
            border-collapse: collapse;
        }
        table.totals td {
            padding: 5px 10px;
            font-size: 12px;
            color: #374151;
        }
        table.totals td.label { color: #6b7280; }
        table.totals td.value { text-align: right; font-weight: 600; }

        .totals-grand {
            border-top: 2px solid #111;
            margin-top: 4px;
        }
        .totals-grand td {
            padding: 8px 10px !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #111 !important;
        }

        /* ── Status badge ── */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-confirmed { background: #dbeafe; color: #1e40af; }
        .badge-shipped   { background: #ede9fe; color: #5b21b6; }
        .badge-delivered { background: #d1fae5; color: #065f46; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }

        /* ── Footer ── */
        .footer {
            margin-top: 32px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>

{{-- ── Header ── --}}
<div class="header">
    <div class="header-logo">
        <div class="logo-text">{{ strtoupper($company['name']) }}</div>
    </div>
    <div class="header-right">
        <div class="invoice-title">Հաշիվ-ապրանքագիր</div>
        <div class="company-info">
            {{ $company['email'] }} &nbsp;|&nbsp; {{ $company['phone'] }}<br>
            {{ $company['address'] }}
        </div>
    </div>
</div>

{{-- ── Meta ── --}}
<div class="meta-row">
    {{-- Order --}}
    <div class="meta-col">
        <div class="meta-label">Հաշիվ-ապրանքագիր</div>
        <div class="meta-value">ORD-{{ $order->id }}</div>
        <div class="meta-value-sub">Ամսաթիվ&nbsp;: {{ now()->locale('ru')->isoFormat('D MMMM YYYY г.') }}</div>
    </div>

    {{-- Customer --}}
    <div class="meta-col">
        <div class="meta-label">Հաճախորդ</div>
        <div class="meta-value">{{ $order->name }}</div>
        <div class="meta-value-sub">
            {{ $order->address }}<br>
            {{ $order->phone }}<br>
            {{ $order->email }}
        </div>
    </div>

    {{-- Status --}}
    <div class="meta-col">
        <div class="meta-label">Կարգավիճակ</div>
        <div class="meta-value" style="margin-top:4px;">
                <span class="badge badge-{{ $order->status }}">
                    {{ $order->statusLabel() }}
                </span>
        </div>
        <div class="meta-value-sub" style="margin-top:6px;">Վճարում<br>Սպասվում</div>
    </div>
</div>

{{-- ── Items ── --}}
<div class="section-title">Ապրանքներ</div>

<table class="items">
    <thead>
    <tr>
        <th style="width:40px;">№</th>
        <th>Ապրանք</th>
        <th>SKU</th>
        <th class="right">Քան.</th>
        <th class="right">Գին</th>
        <th class="right">Ընդամենը</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $index => $item)
        <tr>
            <td class="muted">{{ $index + 1 }}</td>
            <td>{{ $item->product_name }}</td>
            <td class="muted">{{ $item->product_sku }}</td>
            <td class="right">{{ $item->quantity }}</td>
            <td class="right">{{ number_format($item->price, 0, '.', ' ') }} AMD</td>
            <td class="right" style="font-weight:600;">{{ number_format($item->subtotal, 0, '.', ' ') }} AMD</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{-- ── Totals ── --}}
<div class="totals-wrap">
    <div class="totals-spacer"></div>
    <div class="totals-box">
        <table class="totals">
            <tr>
                <td class="label">Ընդհամենը</td>
                <td class="value">{{ number_format($subtotal, 0, '.', ' ') }} AMD</td>
            </tr>
            <tr>
                <td class="label">Առաքում</td>
                <td class="value">{{ $shipping > 0 ? number_format($shipping, 0, '.', ' ').' AMD' : '0 AMD' }}</td>
            </tr>
            <tr>
                <td class="label">Զեղչ (կիրառված)</td>
                <td class="value">{{ $discount > 0 ? number_format($discount, 0, '.', ' ').' AMD' : '0 AMD' }}</td>
            </tr>
            <tr class="totals-grand">
                <td class="label">ԸՆԴԱՄԵՆԸ</td>
                <td class="value">{{ number_format($total, 0, '.', ' ') }} AMD</td>
            </tr>
        </table>
    </div>
</div>

{{-- ── Footer ── --}}
<div class="footer">
    Ստեղծված է {{ $company['name'] }}-ի կողմից &nbsp;·&nbsp;
    {{ now()->format('d.m.Y, H:i:s') }} &nbsp;·&nbsp;
    Այս փաստաթուղթը ծառայում է որպես պաշտոնական հաշիվ-ապրանքագիր :
</div>

</body>
</html>
