<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Book Catalog</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .card-content {
            width: 100%;
            height: 100%;
        }

        .main-panel {
            margin: auto;
            width: 98%;
        }

        .card-list {
            margin: 20px;
        }

        .btn-sm {
            float: right !important;
        }

        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-5" href="#">Simple Book Catalog</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="">Books <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.sourcecodester.com/" target="_blank">Visit Projects with Free Source Code</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main -->
    <div class="main-panel">
        <div class="container-fluid">
            <div class="row">
                <div class="side-bar ml-5 mt-5 col-md-3">
                    <h3>Book Categories</h3>
                    <hr>
                    <div class="card border-0">
                        <a href="http://localhost/book-catalog-app/" class="btn btn-outline-secondary category-filter-link" data-category="All">All Books</a>
                        <a href="http://localhost/book-catalog-app/educational.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Educational" id="categoryEducational">Educational</a>
                        <a href="http://localhost/book-catalog-app/fiction.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Fiction" id="categoryFiction">Fiction</a>
                        <a href="http://localhost/book-catalog-app/fantasy.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Fantasy" id="categoryFantasy">Fantasy</a>
                        <a href="http://localhost/book-catalog-app/romance.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Romance" id="categoryRomance">Romance</a>
                        <a href="http://localhost/book-catalog-app/horror.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Horror" id="categoryHorror">Horror</a>
                        <a href="http://localhost/book-catalog-app/scifi.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Science Fiction" id="categoryScienceFiction">Science Fiction</a>
                        <a href="http://localhost/book-catalog-app/mystery.php/" class="btn mt-1 btn-outline-secondary category-filter-link" data-category="Mystery" id="categoryMystery">Mystery</a>
                    </div>
                </div>

                <div class="main-content ml-5 mt-5 col-md-8">
                    <div class="card card-content">
                        <div class="d-flex justify-content-between mt-3">

                            <!-- Modal -->
                            <button type="button" class="btn btn-secondary ml-3" data-toggle="modal" data-target="#addBookModal">&#10010; Add Book </button>



                            <form class="form-inline justify-content-end mr-3">
                                <input class="form-control mr-sm-2" id="searchInput" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                        <div class="row book-list">
                            <?php include 'user/includes/conn.php';
                            $query = "SELECT * FROM tbl_book";
                            $query_run = mysqli_query($conn, $query);
                            ?>

                            <?php if ($query_run) {
                                foreach ($query_run as $row) { ?>
                                    <div class="card card-list mb-2" style="width:17rem;height:23rem;" data-category="<?= $bookCategory ?>">


                                        <h6 id="bookID-<?= $bookID ?>" hidden><?php echo $bookID ?></h6>
                                        <h6 id="bookAuthor-<?= $bookID ?>" hidden><?php echo $bookAuthor ?></h6>
                                        <p id="bookAbstract-<?= $bookID ?>" hidden><?php echo $bookAbstract ?></p>
                                        <div class="d-flex justify-content-center align-items-center" style="height: 280px;">
                                            <img id="bookImage-<?= $bookID ?>" src="<?php echo "uploads/" . $row['book_image']; ?>" class="card-img-top mt-2" alt="book" style="max-width: 150px; max-height: 200px;">
                                        </div>
                                        <div class="card-body">
                                            <h6 id="bookTitle-<?= $bookID ?>" class="card-title"><?php echo $row['book_name']; ?></h6>
                                            <i class="text-muted">Category: </i><i id="bookCategory-<?= $bookID ?>" class="card-subtitle text-muted"><?php echo $row['category']; ?></i><br>
                                            <small class="block text-muted text-info">Created: </small><small class="block text-muted text-info" id="bookDateAdded-<?= $bookID ?>"><?php echo $row['created_at']; ?></small>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


    <script>
        function view_details(id) {
            $("#viewBookDetailsModal").modal("show");

            // Retrieve book details from the clicked card
            let bookImage = $("#bookImage-" + id).attr("src");
            let bookTitle = $("#bookTitle-" + id).text();
            let bookCategory = $("#bookCategory-" + id).text();
            let bookAuthor = $("#bookAuthor-" + id).text();
            let bookDateAdded = $("#bookDateAdded-" + id).text();
            let bookAbstract = $("#bookAbstract-" + id).text();

            // Populate the view modal with the retrieved details
            $("#viewBookImage").attr("src", bookImage);
            $(".viewBookTitle").text(bookTitle);
            $(".viewBookCategory").text(bookCategory);
            $(".viewBookAuthor").text("Author/s: " + bookAuthor);
            $(".viewBookDateAdded").text("Date Created: " + bookDateAdded);
            $(".viewBookAbstract").text(bookAbstract);
        }

        function update_book(id) {
            $("#updateBookModal").modal("show");

            // Retrieve book details from the clicked card
            let updateBookID = $("#bookID-" + id).text();
            let updateBookImage = $("#bookImage-" + id).attr("src");
            let updateBookTitle = $("#bookTitle-" + id).text();
            let updateBookCategory = $("#bookCategory-" + id).text();
            let updateBookAuthor = $("#bookAuthor-" + id).text();
            let updateBookDateAdded = $("#bookDateAdded-" + id).text();
            let updateBookAbstract = $("#bookAbstract-" + id).text();

            // Populate the view modal with the retrieved details
            $("#updateBookID").val(updateBookID);
            $("#updateBookImage").attr("src", updateBookImage);
            $("#updateBookTitle").val(updateBookTitle);
            $("#updateBookCategory").val(updateBookCategory);
            $("#updateBookAuthor").val(updateBookAuthor);
            $("#updateBookDateAdded").val(updateBookDateAdded);
            $("#updateBookAbstract").val(updateBookAbstract);
        }

        function delete_book(id) {

            if (confirm("Do you confirm to delete this book?")) {
                window.location = "http://localhost/book-catalog-app/endpoint/delete_book.php?delete=" + id
            }
        }

        $(document).ready(function() {
            // Function to filter books based on search query
            $("#searchInput").on("keyup", function() {
                var searchQuery = $(this).val().toLowerCase();

                $(".card-list").each(function() {
                    var bookTitle = $(this).find(".card-title").text().toLowerCase();
                    if (bookTitle.includes(searchQuery)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>