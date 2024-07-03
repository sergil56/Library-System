<?php
//Start of the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit();
}
?>

<?php
$session = $_SESSION['id'];
include 'includes/conn.php';
$result = mysqli_query($conn, "SELECT * FROM admins where id= '$session'");
while ($row = mysqli_fetch_array($result)) {
  $sessionuname = $row['username'];
  $sessionname = $row['name'];
  $sessionemail = $row['AdminEmail'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Book Listing</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
  <link rel="icon" href="assets/img/libhub-logo.png">
  <link rel="stylesheet" href="assets/css/style2.css" class="rel">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/maxcdnbootstrap.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php include "includes/sidebar.php" ?>
    <div class="main">
      <?php include "includes/header.php" ?>
      <main class="content px-3 py-2">
        <div class="mb-3">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="landingpage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listed Books</li>
          </ul>
        </div>
        <div class="container-fluid">
          <!-- Table Element -->
          <div class="card border" id="admin">
            <div class="">
              <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert"><?php echo $_GET['success']; ?></div>
              <?php } ?>
            </div>
            <div class="">
              <?php if (isset($_GET['delete'])) { ?>
                <div class="alert alert-danger" role="alert"><?php echo $_GET['delete']; ?></div>
              <?php } ?>
            </div>
            <div class="card-header">
              <div class="col-md-12 ">
                <td style="font-size: large; ">
                  <button class="btn btn-success btn-small float-end" style=" --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#popOver"><span class="fa fa-plus"></span><b>Add Book</b></button>
                </td>
                <td style="font-size: large;">
                  <a href="export_excel.php"><button type="submit" name="send" onclick="return confirm('Export Book Infromation to Excel ?');" class="btn btn-success float-end" style=" --bs-btn-font-size: .75rem;margin-right:10px;"><b>Export to Book Informations To Excel</b> </button></a>
                </td>
              </div>
              <i class="fa fa-info-circle"></i>
              View Book Details
            </div>


            <div class="card-body">
              <div class="table-responsive" id="card">
                <?php include 'includes/conn.php';
                $sql = "SELECT * FROM tbl_book"; ?>
                <?php $result = $conn->query($sql);
                if ($result->num_rows > 0) { ?>
                  <table class="table table-hover" id="dataTables-example">
                    <thead>
                      <th>#</th>
                      <th>Image</th>
                      <th>ISBN</th>
                      <th>Book Title</th>
                      <th>Category</th>
                      <th>Available</th>
                      <th colspan="2">Action</th>
                      </tr>
                    </thead>

                    <?php
                    $sn = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $sn; ?></td>
                        <td><img src="<?php echo $row['book_image']; ?>" height="60" width="50" alt=""></td>
                        <td><?php echo $row['isbnno']; ?></td>
                        <td><a href="#" data-id='<?php echo $row['id']; ?>' class="bookinfo"><?php echo $row['book_name']; ?></a> <br> <em><?php echo $row['author']; ?> </em></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>
                          <a href="view_book.php?id=<?php echo $row['id']; ?>" id="action">
                            <i class="fas fa-user-edit text-primary"></i></a>
                          ||
                          <a href="delbook.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Do you really want to Delete ?');" id="action">
                            <i class="fas fa-trash text-danger"></i></a>
                        </td>
                        <?php $sn++;
                        ?>
                      </tr>
                  <?php
                    }
                  } else {
                    echo " 0 results";
                  }
                  $conn->close();
                  ?>
                  </table>

              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- MODAL -->
      <div class="modal fade" id="popOver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <form action="add-book.php" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="modal-content">
                <div class="card-header">
                  <i class="fa-solid fa-circle-info"></i> Add Book Information
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Book Image</label>
                        <input type="file" class="form-control" name="book_image" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Book Title</label>
                        <input type="text" class="form-control" name="book_name" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="author" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Book Quantity</label>
                        <input type="text" class="form-control" name="quantity" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Publisher</label>
                        <input type="text" class="form-control" name="publisher" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Book Category</label>
                        <input type="text" class="form-control" name="category" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Subject</label>
                        <select class="form-control" name="subject">
                          <option></option>
                          <?php
                          $sql = "SELECT * FROM subject";
                          $query = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($query)) { ?>
                            <option value="<?php echo $row['sub_name'] ?>" <?php echo isset($_GET['sub_name']) && $_GET['sub_name'] == $row['sub_name'] ? "selected" : "" ?>><?php echo $row['sub_name']; ?></option>
                          <?php  } ?>
                        </select>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Volume</label>
                        <select class="form-control" name="volume">
                          <option><?php echo $row['volume'] ?></option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                          <option>9</option>
                          <option>10</option>
                        </select>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>Short Description</label>
                        <input type="text" class="form-control" name="short_desc" maxlength="500" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control" name="year" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Edition</label>
                        <input type="text" class="form-control" name="edition" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbnno" maxlength="30" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-danger" value="X Close" data-bs-dismiss="modal"></input>
                  <input type="submit" name="record" value="Save changes" class="btn btn-primary"></input>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<script type='text/javascript'>
  $(document).ready(function() {
    $('.bookinfo').click(function() {
      var bookid = $(this).data('id');
      $.ajax({
        url: 'code.php',
        type: 'POST',
        data: {
          bookid: bookid
        },
        success: function(response) {
          $('.modal-body').html(response);
          $('#empModal').modal('show');
        }
      });
    });
  });
</script>

<div class="modal fade" id="empModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

<!-- end -->

</html>