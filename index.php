<?php

require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

$pdfTemplate = 'doc.pdf';

$pdf = new FPDI();
$pdf->AddPage();
$pdf->setSourceFile($pdfTemplate);
$pageId = $pdf->importPage(1);
$pdf->useTemplate($pageId, 0, 0);
$pdf->SetFont('Helvetica', 'B');
$pdf->SetFontSize(10);

$userInput = [
    'area_code' => 'KAR',
    'ao_type' => 'W',
    'range_code' => '312',
    'ao_no' => '11',
    'last_name' => 'ANANDAH',
    'first_name' => 'JOHN',
    'middle_name' => 'Doe',
    'name_on_card' => 'JOHN Doe ANANDAH',
    'f_first_name' => 'Arun',
    'f_middle_name' => 'Kumar',
    'f_last_name' => 'Mishra',
    'm_first_name' => 'Rina',
    'm_middle_name' => 'Kumari',
    'm_last_name' => 'Mishra',
    'flat_room' => '12 No Flat',
    'building_village' => 'Village Name',
    'post_office' => 'Post Office',
    'locality' => 'Bengalore',
    'district' => 'Bengalore',
    'state' => 'Karnataka',
    'country' => 'India',
    'dob_month' => '03',
    'dob_day' => '30',
    'dob_year' => '2000',
    'pincode' => '562123',
    'subscribe' => true,
];

function placeTextInBoxes($pdf, $text, $startX, $startY, $boxWidth, $boxHeight, $charLimit) {
    $text = strtoupper($text);
    $length = strlen($text);
    
    if ($charLimit) {
        $length = min($length, $charLimit);
    }

    for ($i = 0; $i < $length; $i++) {
        $pdf->SetXY($startX + ($i * $boxWidth), $startY);
        $pdf->Cell($boxWidth, $boxHeight, $text[$i], 0, 0, 'C');
    }
}

function drawCheckbox($pdf, $x, $y, $size, $checked = 1) {
    $pdf->Rect($x, $y, $size, $size);
        if ($checked) {
        //ye kam nhi kr rha h font i think font sahi nhi h  baad me dekhte h isko
        // $pdf->AddFont('DejaVuSans', '', 'vendor/font/DejaVuSans.php'); // Ensure this path is correct
        // $pdf->SetFont('DejaVuSans', '', 12); // Use DejaVu Sans for the checkmark
        // $pdf->Text($x + 1, $y + $size - 1, '✓'); // Place checkmark inside the checkbox
        $pdf->SetFont('Arial', '', 12); // Use DejaVu Sans for the checkmark
        $pdf->Text($x + 1, $y + $size - 1, '0'); // Place checkmark inside the checkbox
    }
}

placeTextInBoxes($pdf, $userInput['area_code'], 45, 42, 8, 10, 3);
placeTextInBoxes($pdf, $userInput['ao_type'], 72, 42, 8, 10, 1);
placeTextInBoxes($pdf, $userInput['range_code'], 92, 42, 8, 10, 3);
placeTextInBoxes($pdf, $userInput['ao_no'], 120, 42, 8, 10, 2);
placeTextInBoxes($pdf, $userInput['last_name'], 68, 78, 5, 10, 12);
placeTextInBoxes($pdf, $userInput['middle_name'], 68, 88, 5, 10, 12);
placeTextInBoxes($pdf, $userInput['first_name'], 68, 83, 5, 10, 12);
placeTextInBoxes($pdf, $userInput['name_on_card'], 17, 100, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['f_last_name'], 68, 179, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['f_first_name'], 68, 184, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['f_middle_name'], 68, 189, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['m_last_name'], 68, 198, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['m_first_name'], 68, 203, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['m_middle_name'], 68, 208, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['flat_room'], 68, 235, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['building_village'], 68, 240, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['post_office'], 68, 245, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['locality'], 68, 250, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['district'], 68, 255, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['state'], 20, 265, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['country'], 130, 265, 5, 10, 55);
placeTextInBoxes($pdf, $userInput['dob_day'], 18, 155, 5, 10, 2);
placeTextInBoxes($pdf, $userInput['dob_month'], 32, 155, 5, 10, 2);
placeTextInBoxes($pdf, $userInput['dob_year'], 47, 155, 5, 10, 4);
placeTextInBoxes($pdf, $userInput['pincode'], 86, 265, 5, 10, 6);

$checkboxX = 35; 
$checkboxY = 190; 
$checkboxSize = 5; 

drawCheckbox($pdf, $checkboxX, $checkboxY, $checkboxSize, $userInput['subscribe']);

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="filled_form.pdf"');

$pdf->Output('I'); 
?>
