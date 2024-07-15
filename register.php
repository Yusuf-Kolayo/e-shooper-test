<?php require 'partials/hd.php' ?>

<!-- Header Start  -->
<?php require 'partials/header.php' ?>
<!-- Header End  -->

<!-- Topbar Start -->
<?php require 'partials/top_bar.php'; ?>
<!-- Topbar End -->

 
<!-- Navbar Start -->
<?php require 'partials/nav_bar.php';   
    
    
       if (isset($_POST['btn_submit'])) {

                   
            $first_name = $_POST['first_name'];
            $last_name  = $_POST['last_name'];
            $email      = $_POST['email'];
            $phone       = $_POST['phone'];
            $gender     = $_POST['gender'];
            $address     = $_POST['address'];
            $password1    = $_POST['password1'];
            $password2    = $_POST['password2'];


            if ($password1==$password2) {
                $hashed_password = password_hash($password1, PASSWORD_DEFAULT); 
                $sql = "INSERT INTO users (first_name, last_name, email, phone, address, gender, password) 
                VALUES('$first_name','$last_name','$email','$phone','$address','$gender','$hashed_password')";

                // executes the SQL statement 
                $result = mysqli_query($connection, $sql);
                
                // get the number of records saved
                $num  = mysqli_affected_rows($connection);

                if ($num>0) {
                    $msg = 'Registration was successfull!';
                } else {
                    $msg = 'something went wrong, pls try again';
                }
            } else {
                $msg = 'Passwords does not match';
            }

       }

?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Register</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Register</p>
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
                    <label for="" class="form-label">First Name</label>
                    <input name="first_name" required type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Last Name</label>
                    <input name="last_name" required type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input name="email" required type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Gender</label>
                    <select name="gender" id="" required class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Phone</label>
                    <input name="phone" type="text" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Address</label>
                    <input name="address" type="text" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input name="password1" type="password" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input name="password2" type="password" required class="form-control">
                </div>

                <div class="d-flex mt-2">
                    <button type="reset" class="btn btn-secondary">Clear</button>
                    <button type="submit" name="btn_submit" class="btn btn-primary ml-auto">Submit</button>
                </div>
            </div>
        </div>

    </form>



   <!-- Footer Start  -->
   <?php require 'partials/footer.php' ?> 
   <!-- Footer End  -->