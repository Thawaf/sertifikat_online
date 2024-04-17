<?php
require_once('tcpdf/tcpdf.php');

// Function to generate certificate PDF
function generateCertificateAssignmentFromDatabase($assignmentId) {
    // Create new PDF document
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Certificate Assignment');

    // Set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // ---------------------------------------------------------

    // Add a page
    $pdf->AddPage();

    // Fetch certificate assignment information from the database
    $assignmentInfo = fetchCertificateAssignmentInfoFromDatabase($assignmentId);

    // Set font
    $pdf->SetFont('times', 'B', 20);

    // Title
    $pdf->Cell(0, 10, 'Certificate of Participation', 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Set font
    $pdf->SetFont('times', '', 14);

    // Participant's name
    $pdf->Cell(0, 10, 'This certificate is awarded to ' . $assignmentInfo['participant_name'] . ' for participation in', 0, 1, 'C');

    // Event name
    $pdf->Cell(0, 10, '"' . $assignmentInfo['event_name'] . '"', 0, 1, 'C');

    // Event date
    $pdf->Cell(0, 10, 'held on ' . $assignmentInfo['event_date'], 0, 1, 'C');

    // Line break
    $pdf->Ln(10);

    // Certificate text
    $pdf->MultiCell(0, 10, $assignmentInfo['certificate_text'], 0, 'C');

    // ---------------------------------------------------------

    // Close and output PDF document
    // This method has several options, check the documentation for more info.
    $pdf->Output('certificate_assignment.pdf', 'I');
}

// Example usage:
$assignmentId = 1; // ID penugasan sertifikat yang ingin Anda cetak
generateCertificateAssignmentFromDatabase($assignmentId);

// Function to fetch certificate assignment information from database
function fetchCertificateAssignmentInfoFromDatabase($assignmentId) {
    // Lakukan kueri ke database untuk mendapatkan informasi penugasan sertifikat berdasarkan ID
    // Di sini saya menggunakan contoh koneksi ke database dan kueri dengan PDO
    $dbhost = 'localhost';
    $dbname = 'sertifikat_online';
    $username = 'root';
    $password = '';

    // Buat koneksi PDO
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);

    // Set mode error PDO menjadi Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kueri SQL untuk mengambil informasi penugasan sertifikat berdasarkan ID
    $stmt = $conn->prepare("SELECT certificates.participant_name, events.event_name, events.event_date, certificates.certificate_text 
                            FROM certificate_assignments 
                            INNER JOIN certificates ON certificate_assignments.certificate_id = certificates.certificate_id 
                            INNER JOIN events ON certificate_assignments.event_id = events.event_id 
                            WHERE certificate_assignments.assignment_id = :assignment_id");

    // Bind parameter
    $stmt->bindParam(':assignment_id', $assignmentId);

    // Eksekusi kueri
    $stmt->execute();

    // Ambil hasil kueri
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
?>
