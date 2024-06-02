<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Report extends BaseController
{
    public function generatePDF()
    {
        // Load TCPDF library
        require_once APPPATH . 'Libraries/TCPDF-main/tcpdf.php';
        $model = new TransaksiModel();

        // Fetch transaction data (adjust this based on your actual implementation)
        $getData = $model->getAllDataWithRelation();

        // Create a PDF instance
        $pdf = new \TCPDF();

        // Set document information
        $pdf->SetCreator('Admin');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Transaction Report');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 14);

        // Add content to the PDF
        $pdf->Cell(0, 10, 'RISING SHOP', 0, 1, 'C');
       

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'TRANSACTION REPORT', 0, 1, 'C');
     
        
        $date = date('Y-m-d');
        $pdf->SetFont('helvetica', 12);
        $pdf->Cell(0, 10, 'Date: ' . $date, 0, 1);
      

        // Add table to PDF
        $pdf->writeHTML('<table border="1">' . $this->getTableData($getData) . '</table>', true, false, false, false, '');

        // Output the PDF to the browser
        $pdf->Output('transaction_report.pdf', 'D');
        exit;
    }


    private function getTableData($data)
    {
        $html = '<table border="1" cellspacing="0" style="width: 100%; text-align: center;">';

        // Header row with blue background color
        $html .= '<tr>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">ID PAYMENT</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">DATE</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">SERVER</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">USERNAME</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">GAME</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">TOP UP</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">METODE</th>';
        $html .= '<th style="background-color: #003366; color: #ffffff;">TOTAL</th>';
        $html .= '</tr>';

        foreach ($data as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->id_transaksi . '</td>';
            $html .= '<td>' . $row->tanggal . '</td>';
            $html .= '<td>' . $row->server_game . '</td>';
            $html .= '<td>' . $row->customer . '</td>';
            $html .= '<td>' . $row->name_game . '</td>';
            $html .= '<td>' . $row->top_up . '</td>';
            $html .= '<td>' . $row->metode . '</td>';
            $html .= '<td>Rp. ' . $row->jumlah . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }
}
