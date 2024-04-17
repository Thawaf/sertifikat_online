<?php
require_once('tcpdf/tcpdf.php');

// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sertifikat_online';

$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data sertifikat dari tabel "certificates"
$sql = "SELECT * FROM certificates";
$result = $conn->query($sql);

// Inisialisasi TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set dokumen meta
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Sertifikat');
$pdf->SetSubject('Sertifikat Online');
$pdf->SetKeywords('Sertifikat, Online');

// Set header dan footer
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set ukuran font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFontSize(10);

// Tambahkan halaman
$pdf->AddPage();

// Loop melalui hasil dan tambahkan informasi sertifikat ke PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Sertifikat', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Nama Peserta: ' . $row['participant_name'], 0, 1);
        $pdf->Cell(0, 10, 'Nama Acara: ' . $row['event_name'], 0, 1);
        $pdf->Cell(0, 10, 'Tanggal Acara: ' . $row['event_date'], 0, 1);
        $pdf->Cell(0, 10, 'Isi Sertifikat: ' . $row['certificate_text'], 0, 1);
        $pdf->Ln(10);
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data sertifikat.', 0, 1);
}

// Output PDF ke browser
$pdf->Output('sertifikat.pdf', 'D');

// Tutup koneksi
$conn->close();
?>
