<?php require 'partials/hd.php';


// redirect users to login page if not authenticated yet
if (count($_SESSION)>0) {
    if ($_SESSION['logged_in']!=true) {
         header('location:login.php');
    } 
} 



if (isset($_POST['btn_change_dp'])) {
    var_dump($_POST);
    var_dump($_FILES);

    $dp_name = $_FILES['new_dp']['name'];          // name of picture on your device
    $dp_size = $_FILES['new_dp']['size'];          // size of the uploaded picture
    $dp_type = $_FILES['new_dp']['type'];          // filetype of the uploaded pic
    $dp_tmp_name = $_FILES['new_dp']['tmp_name'];  // temporary storage of the pic on server  

    // Not allow non-approved picture formats
    // Not allow any DP > 1MB
    
    $allowedFormats = ['image/png','image/jpeg','image/webp'];
    // check if the file format is among the allowed ones declared above
    if (in_array($dp_type, $allowedFormats)) {  
         // check if the file size is less than or equal to 1MB
        if ($dp_size <= 1048576) {    
            // move the pic to final destination
           $upload = move_uploaded_file($dp_tmp_name, 'display_pics/'.$dp_name);
           if ($upload===true) {

              
                // get the user_id from session
                $user_id = $_SESSION['id'];

                // get the previous dp from the database
                $query = "SELECT picture FROM users WHERE id = '$user_id'";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $prev_dp = $row['picture'];

                // delete the previous dp from the server
                if (is_writable('display_pics/'.$prev_dp)&&$prev_dp!='') {
                    unlink('display_pics/'.$prev_dp);
                }

                // update the user's dp
                $user_id = $_SESSION['id'];
                $query = "UPDATE users SET picture = '$dp_name' WHERE id = '$user_id'";
                $result = mysqli_query($connection, $query);

                // overide the old picture in the session
                $_SESSION['picture'] = $dp_name;

               $msg = 'Upload was sucessfull';
           } else {
               $msg = "Upload was'nt successful, pls try again ...";
           }
        } else {
             $msg = 'File size too large! Expected size = less 1MB';
        }
    } else {
        $msg = 'File format not allowed/supported!';
    }

}



$picture = $_SESSION['picture'];


if (is_writable('display_pics/'.$picture)&&$picture!='') {
    $picture_html = '<img src="display_pics/'.$picture.'" alt="" class="w-50 d-block mx-auto mt-4">'; 
} else {
    $picture_html = '<img src="img/avatar_dummy.png" alt="" class="w-50 d-block mx-auto mt-4">';   
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
                    <?php 
                        // if there is a message, echo it
                        if (strlen($msg)>0) { 
                            echo '<div class="alert alert-primary mb-3">'.$msg.'</div>';
                        }
                    ?>   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <?=$picture_html?>
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
                        <label for="recipient-name" class="col-form-label">Select Picture</label>
                        <input type="file" name="new_dp" class="form-control" id="recipient-name">
                    </div> 
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?php echo $user_id ?>" name="user_id">
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
    
 