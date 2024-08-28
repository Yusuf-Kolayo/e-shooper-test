<?php require 'partials/hd.php';

    // if the button submits succesfully to ther server 
    if (isset($_POST['btn_submit'])) {
        // fet5ch all info
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // fetch user_id from session
        $user_id = $_SESSION['id'];

        // get the current timestamp
        $timestamp = time();


        // get uploaded pic
        $pic_name = $_FILES['pic']['name'];
        $pic_tmp_name = $_FILES['pic']['tmp_name'];
        $pic_size = $_FILES['pic']['size'];
        $pic_type = $_FILES['pic']['type'];

        // check if the file format is among the allowed ones declared above
        $allowedFormats = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($pic_type, $allowedFormats)) {

            // check the filesize
            if ($pic_size<2000000) {
               // if format is allowed, move the pic to the server
               $upload = move_uploaded_file($pic_tmp_name, 'img_products/'. $pic_name);
               if ($upload===true) {
                    // insert into db
                    $sql = "INSERT INTO products (user_id, title, price, description, pic_name, timestamp) VALUES (?,?,?,?,?,?)";
                    // prepare the sql statement
                    $stmt = mysqli_prepare($connection, $sql);
                    // bind the parameters
                    mysqli_stmt_bind_param($stmt, "ssssss", $user_id, $title, $price, $description, $pic_name, $timestamp);
                    // execute the prepared statement
                    mysqli_stmt_execute($stmt);
                    //check number of rows affected
                    $num = mysqli_affected_rows($connection);
                    // close the statement
                    mysqli_stmt_close($stmt);

                    if ($num>0) {
                        $msg = 'Product added successfully!';
                    } else {
                        $msg = 'Failed to add product!';
                    }
               } else {
                $msg = 'Failed to upload the picture!';
               }
            } else {
                $msg = 'File size is too large!';
            }
 
          
            
        } else {
            $msg = 'Only jpeg, png, and gif formats are allowed!';
        }

    }
?>

<!-- Header Start  -->
<?php require 'partials/header.php' ?>
<!-- Header End  -->

<!-- Topbar Start -->
<?php require 'partials/top_bar.php'; ?>
<!-- Topbar End -->


<!-- Navbar Start -->
<?php require 'partials/nav_bar.php';
    
    

    ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">New Product</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
            <div class="col-6 mx-auto">

                <?php 
                // if there is a message, echo it
                    if (strlen($msg)>0) { 
                        echo '<div class="alert alert-primary mb-3">'.$msg.'</div>';
                    }
                ?>    
                
                <div class="mb-3">
                    <label for="" class="form-label">Product Title</label>
                    <input name="title" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input name="description" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Picture</label>
                    <input type="file" class="form-control" name="pic" id="">
                </div>

                <div class="d-flex mt-2">
                    <button class="btn btn-secondary" type="reset">Clear</button>
                    <button name="btn_submit" type="submit" class="btn btn-primary ml-auto">Submit</button>
                </div>
            </div>
     </div>
  </form>




   <!-- Footer Start  -->
   <?php require 'partials/footer.php' ?> 
   <!-- Footer End  -->