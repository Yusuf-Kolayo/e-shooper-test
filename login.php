<?php require 'partials/hd.php';

    // if the login button submits succesfully to ther server 
    if (isset($_POST['btn_login'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email=?";

        $stmt = mysqli_prepare($connection, $sql);       // prepare the sql statement
        mysqli_stmt_bind_param($stmt, "s", $email);      // bind the parameters
        mysqli_stmt_execute($stmt);                      // execute the prepared statement
        $result = mysqli_stmt_get_result($stmt);         // get execution results 
        $n_row = mysqli_num_rows($result);               // get the number of rows returned
    
        if ($n_row > 0) {
            $row = mysqli_fetch_array($result);
            if (password_verify($password, $row['password'])) {
                // register a logged_in data in the session that 
                // indicates that the current user is logged in !
                 $_SESSION['logged_in'] = true;
                 $_SESSION = [...$_SESSION, ...$row];
 
                 header('location:profile.php');
            } else {
                $msg = 'login failed, pls try again';
            }
      
        } else {
            $msg = 'login failed, pls try again';
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    
  <form action="" method="post">
    <div class="row">
            <div class="col-6 mx-auto">

                <?php 
                // if there is a message, echo it
                    if (strlen($msg)>0) { 
                        echo '<div class="alert alert-primary mb-3">'.$msg.'</div>';
                    }
                ?>    
                
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input name="email" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>

                <div class="d-flex mt-2">
                    <button class="btn btn-secondary" type="reset">Clear</button>
                    <button name="btn_login" type="submit" class="btn btn-primary ml-auto">Submit</button>
                </div>
            </div>
     </div>
  </form>




   <!-- Footer Start  -->
   <?php require 'partials/footer.php' ?> 
   <!-- Footer End  -->