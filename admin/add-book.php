<?php

if (isset($_POST['record'])) {

  require_once 'includes/conn.php';

  $book_name = $_POST['book_name'];
  $category_name = $_POST['category'];
  $isbn = $_POST['isbnno'];
  $author_name = $_POST['author'];
  $publisher_name = $_POST['publisher'];
  $quantity = $_POST['quantity'];
  $year = $_POST['year'];
  $edition = $_POST['edition'];
  $volume = $_POST['volume'];
  $subject = $_POST['subject'];
  $short_desc = $_POST['short_desc'];

  $book_image = $_FILES['book_image'];
  $img_loc = $_FILES['book_image']['tmp_name'];
  $book_image = $_FILES['book_image']['name'];

  $img_des = "../uploads/" . $book_image;
  move_uploaded_file($img_loc, '../uploads/' . $book_image);

  $insert_book = mysqli_query($conn, "insert into tbl_book set book_name='$book_name', category='$category_name', isbnno='$isbn', quantity='$quantity',author='$author_name', publisher='$publisher_name', year='$year',volume='$volume',subject='$subject',edition='$edition',short_desc='$short_desc',book_image='$img_des'");

  if ($insert_book > 0) {
    header("Location: books.php?success=Successfully Added Book Information");
  } else {
    header("Location: books.php?error=FAILED");
    mysqli_error($conn);
  }
}
?>
