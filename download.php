<?php
// Panggil library TCPDF
require_once('tcpdf/tcpdf.php');

// Fungsi untuk menghasilkan sertifikat
function generateCertificate($participant_name, $event_name, $event_date, $certificate_text) {
    // Membuat objek TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Atur informasi dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Certificate');
    $pdf->SetSubject('Certificate for ' . $participant_name);
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // Atur margin
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Atur font
    $pdf->SetFont('helvetica', '', 12);

    // Tambahkan halaman baru
    $pdf->AddPage();

    // Tambahkan konten sertifikat
    $html = '<h1>' . $event_name . '</h1>
             <p>This is to certify that <strong>' . $participant_name . '</strong> participated in the event on ' . $event_date . ' and successfully completed it.</p>
             <p>' . $certificate_text . '</p>';

    // Tambahkan HTML ke dokumen PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Akhiri pembuatan PDF dan kirim ke browser
    $pdf->Output('certificate.pdf', 'D');
}

// Panggil fungsi generateCertificate dengan data yang sesuai
// Misalnya, jika Anda memiliki data sertifikat yang ingin dihasilkan
$participant_name = "John Doe";
$event_name = "Web Development Workshop";
$event_date = "2024-04-15";
$certificate_text = "This certificate is awarded in recognition of your participation and successful completion of the Web Development Workshop.";

generateCertificate($participant_name, $event_name, $event_date, $certificate_text);
?>
