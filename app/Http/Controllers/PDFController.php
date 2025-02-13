<?php

namespace App\Http\Controllers;


use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use PDF; // If you're using a PDF library like dompdf or snappy


class PDFController extends Controller
{
   
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to Laravel PDF generation'];
        
        // You can use view files or directly pass HTML content here
        $pdf = PDF::loadView('pdfs.pdf_template', $data);
        
        // Stream the PDF file to the browser
        return $pdf->stream('document.pdf');
        
        // Alternatively, you can save it to a file
        // $pdf->save(storage_path('app/public/document.pdf'));
        
        // Or download it directly
        // return $pdf->download('document.pdf');
    }

    // Invoices
    public function streamInvoice($shareCode)
    {
        // 
    }

    public function downloadInvoice($invoiceNumber)
    {
        $invoice = Invoice::where('invoice_number', $invoiceNumber)->first();
        if (!$invoice) {
            abort(404);
        }

        $data = ['invoice' => $invoice];

        $pdf = PDF::loadView('content.pages.pdfs.invoices.invoice', $data);

        return $pdf->download($invoiceNumber . '.pdf');
    }
}
