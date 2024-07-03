<?php

$conn = mysqli_connect ('localhost','root','','libsys');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            
                $book_name = $row['0'];
                $category = $row['1'];
                $isbnno = $row['2'];
                $quantity = $row['3'];
                $author = $row['4'];
                $publisher = $row['5'];
                $year = $row['6'];
                $volume = $row['7'];
                $subject = $row['8'];
                $edition = $row['9'];
                $short_desc = $row['10'];

                $studentQuery = "INSERT INTO tbl_book (book_name,category,isbnno,quantity,author,publisher,year,volume,subject,edition,short_desc) VALUES ('$book_name','$category','$isbnno','$quantity','$author','$publisher','$year','$volume','$subject','$edition','$short_desc')";
                $result = mysqli_query($conn, $studentQuery);
                $msg = true;
          
        }

        if ($msg > 0) {
            header("Location: import.php?success=Successfully Imported Excel Book Information");
          } else {
            header("Location: import.php?error=FAILED");
            mysqli_error($conn);
          }
        }
}
?>