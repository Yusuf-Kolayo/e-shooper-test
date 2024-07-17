<?php require 'partials/hd.php';

if (count($_SESSION)>0) {
    if ($_SESSION['logged_in']!=true) {
         header('location:login.php');
    } 
} 


if (isset($_POST['btn_change_dp'])) {
    var_dump($_POST);
    var_dump($_FILES);
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Profile</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Profile</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    
    <div class="page-wrapper px-3 mt-3">
         <div class="row">
              <div class="col-md-8 mx-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="img/avatar_dummy.png" alt="" class="w-50 d-block mx-auto mt-4">
                                <div class="card-body text-center">
                                    Yinka Adeleke
                                </div>
                                <div class="card-footer">
                                <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                    Change DP
                                </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-light">
                                <tr>
                                    <td>Name</td> <td><?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></td>
                                </tr>
                                <tr>
                                    <td>Email</td> <td><?=$_SESSION['email']?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td> <td><?=$_SESSION['phone']?></td>
                                </tr>
                                <tr>
                                    <td>Address</td> <td><?=$_SESSION['address']?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td> <td><?=$_SESSION['gender']?></td>
                                </tr>                                 
                            </table>
                        </div>
                    </div>
              </div>
         </div>
    </div>





    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
             <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Select Picture:</label>
                        <input type="file" name="new_dp" class="form-control" id="recipient-name">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_change_dp" class="btn btn-primary">Submit</button>
                </div>
             </form>
        </div>
    </div>
    </div>



    
   <!-- Footer Start  -->
   <?php require 'partials/footer.php' ?> 
   <!-- Footer End  -->
    
 