<?php
include "includes/conn.php";

$bookid = $_POST['bookid'];

$sql = "select * from tbl_book where id=" . $bookid;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
?>

    <div class="card-body">
        <form action="updatecode.php" method="POST">
            <div class="row">
                <div class="col-lg-5">
                    <img src="<?php echo "../uploads/" . $row['book_image']; ?>" height="300" width="260" alt="">
                </div>
                <br>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group field-title required has-error">
                                <label class="control-label"><b>Title</b></label>
                                <br><?php echo $row['book_name'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group field-author required has-error">
                                <label class="control-label"><b>Author</b></label>
                                <br><?php echo $row['author'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group field-publisher required has-error">
                                <label class="control-label"><b>Publisher</b></label>
                                <br><?php echo $row['publisher'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group field-copyright required has-error">
                        <label class="control-label"><b>Copyright Year</b></label>
                        <br><?php echo $row['year'] ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group field-edition required has-error">
                        <label class="control-label"><b>Edition</b></label>
                        <br><?php echo $row['edition'] ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group field-volume required has-error">
                        <label class="control-label"><b>Volume</b></label>
                        <br><?php echo $row['volume'] ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group field-isbn required has-error">
                        <label class="control-label"><b>ISBN</b></label>
                        <br><?php echo $row['isbnno'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group field-category required has-error">
                        <label class="control-label"><b>Category</b></label>
                        <br><?php echo $row['category'] ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group field-subject required has-error">
                        <label class="control-label"><b>Subject</b></label>
                        <br><?php echo $row['subject'] ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group field-description required has-error">
                        <label class="control-label"><b>Short Description</b></label>
                        <br><?php echo $row['short_desc'] ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <button type="button" class="col-sm-2 btn btn-danger" data-bs-dismiss="modal"><span class="fa fa-window-close"></span> Close</button>

<?php } ?>