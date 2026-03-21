<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceServiceInterface;
use App\Models\Order;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function __construct(
        private readonly InvoiceServiceInterface $invoiceService
    ) {}

    /**
     * Download invoice as PDF.
     * GET /orders/{order}/invoice/download
     */
    public function download(Order $order): Response
    {
        return $this->invoiceService->download($order);
    }

    /**
     * Preview invoice in browser.
     * GET /orders/{order}/invoice/preview
     */
    public function preview(Order $order): Response
    {
        return $this->invoiceService->stream($order);
    }
}
