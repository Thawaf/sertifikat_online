<?php
// Include TCPDF library
require_once('tcpdf/tcpdf.php');

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sertifikat_online";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data sertifikat assignment2
$sql = "SELECT ca.assignment_id, c.participant_name, c.event_name, c.event_date, c.certificate_text, u.full_name
        FROM certificate_assignments2 ca
        JOIN certificates c ON ca.certificate_id = c.certificate_id
        JOIN users u ON ca.user_id = u.user_id";

$result = $conn->query($sql);

// Inisialisasi PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Certificate Assignments');
$pdf->SetHeaderData('', 0, 'Certificate Assignments', '');

// Buat halaman baru
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Tambahkan isi ke PDF
$html = '<h1>Certificate Assignments</h1>';
$html .= '<table border="1">';
$html .= '<tr><th>Assignment ID</th><th>Participant Name</th><th>Event Name</th><th>Event Date</th><th>Certificate Text</th><th>Assigned To</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['assignment_id'] . '</td>';
        $html .= '<td>' . $row['participant_name'] . '</td>';
        $html .= '<td>' . $row['event_name'] . '</td>';
        $html .= '<td>' . $row['event_date'] . '</td>';
        $html .= '<td>' . $row['certificate_text'] . '</td>';
        $html .= '<td>' . $row['full_name'] . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF ke browser atau simpan ke file
$pdf->Output('certificate_assignments.pdf', 'D');

// Tutup koneksi database
$conn->close();
?>
