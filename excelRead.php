<?php
// DOWNLOAD PHPEXCEL LATEST LIBRARY https://phpexcel.codeplex.com/ OR https://github.com/PHPOffice/PHPExcel
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

$target_dir = "directory-url/";
$target_file = $target_dir . basename('file-name.xlsx');

	try {
		$inputFileType = PHPExcel_IOFactory::identify($target_file);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($target_file);
	} catch (Exception $e) {
		die('Error loading file "' . pathinfo($target_file, PATHINFO_BASENAME) 
		. '": ' . $e->getMessage());
	}
	
	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();

//LOOP STARTED FROM ROW	2
$colCell = '';
for ($row = 2; $row <= $highestRow; $row++){
    //EVERY ROW DATA
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, TRUE,TRUE);
    //COLLECT COLUMN CELL DATA ACCORDING TO USAGE
    $colCell .= $rowData[$row]['B'];
}
echo  $colCell.'<br/>';
?>
