<?php

namespace App\Services;

use App\Interfaces\InvoiceServiceInterface;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class InvoiceService implements InvoiceServiceInterface
{
    /**
     * Download invoice as PDF file.
     */
    public function download(Order $order): Response
    {
        return $this->build($order)->download($this->filename($order));
    }

    /**
     * Stream invoice in browser (preview).
     */
    public function stream(Order $order): Response
    {
        return $this->build($order)->stream($this->filename($order));
    }

    /**
     * Build DomPDF instance with view data.
     */
    private function build(Order $order): \Barryvdh\DomPDF\PDF
    {
        $order->loadMissing(['items.product', 'user']);

        return Pdf::loadView('pdf.invoice', [
            'order'    => $order,
            'items'    => $order->items,
            'subtotal' => $order->items->sum('subtotal'),
            'discount' => 0,
            'shipping' => 0,
            'total'    => $order->total,
            'company'  => [
                'name'    => config('invoice.company_name',    'AVAMotors'),
                'email'   => config('invoice.company_email',   'alik.avamotors@gmail.com'),
                'phone'   => config('invoice.company_phone',   '+374 98 42 88 31'),
                'address' => config('invoice.company_address', 'Shahumyan Street 15, Hrazdan, Armenia'),
            ],
        ])
            ->setPaper('a4', 'portrait')
            ->setOption('defaultFont', 'DejaVu Sans')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);
    }

    /**
     * Generate PDF filename.
     */
    private function filename(Order $order): string
    {
        return 'Invoice_ORD-' . $order->id . '_' . now()->format('Ymd') . '.pdf';
    }
}
