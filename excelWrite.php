<?php
// DOWNLOAD PHPEXCEL LATEST LIBRARY https://phpexcel.codeplex.com/ OR https://github.com/PHPOffice/PHPExcel
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

########### DIRECTORY & FILE DEFINE WHICH ONE YOU GOING TO READ THAN WRITE  #########
$Dir = dirname(__FILE__).'/directory';
$objPHPExcel = PHPExcel_IOFactory::load($Dir."/file-name.xlsx");

//HERE WILL ARRAY FOR EXCEL WRITE
$Array = 'ARRAY DATA';

###############       DYNAMIC HEADER & THEIR VALUES *START*      ###################
//DYNAMIC HEADER WRITE AND THEIR VALUES
//LAST VALUE SET FOR COLUMN "B", SO HEADER WRITE WILL START FROM "C" AND I HAVE DEFIEND "C" AS 2 FOR HEADER LOOP START
$col = 2;
$fieldArray = "here will be array of header lables and their id so we can get lable according to their id for write the column";
foreach($fieldArray as $fields){
  //HERE WILL START HEADER LABEL WRITE
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,1, $fields['label']);
	// HERE WILL START VALUE WRITE OF LABEL SET AND WE WILL START TO WRITE FROM ROW 2 
	$frow = 2;
	foreach($Array as $data){
	 //FOR WRITE THE DYNAMIC HEADER VALUE, WE WILL DATA ACCORDING TO THE PRIMARY ARRAY ID & ACCORDING TO FIELD ARRAY ID
		$fvalue = demoFunction($fields['id'],$data['id']);
		if($fvalue){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$frow, $fvalue['value']);
		}
		$frow++;
	}
	$col++;
}
###############       DYNAMIC HEADER & THEIR VALUES  *CLOSE*     ###################

###############       DEFINED HEADER & THEIR VALUE WRITE  *START* ##################
//START ROW WRITE FROM ROW 2
$i=2;
$query =mysql_query("SELECT * FROM `tableName`");
foreach($Array as $data){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $data['colA']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $data['colB']);
  $i++;
}
###############       DEFINED HEADER & THEIR VALUE WRITE  *CLOSE* ##################

##############        HEADER DEFINE FOR SAVE EXCEL FILE         ####################
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="saved-file-name.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
?>
