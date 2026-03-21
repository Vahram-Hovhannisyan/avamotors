<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Http\Response;

interface InvoiceServiceInterface
{
    /**
     * Download invoice as PDF file.
     */
    public function download(Order $order): Response;

    /**
     * Stream invoice in browser (preview).
     */
    public function stream(Order $order): Response;
}
