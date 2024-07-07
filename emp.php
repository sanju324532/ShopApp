<?php 
include '../config.php';
session_start();
//common variables
$error_message='';
$msg = '';
$email = $_SESSION['email'];
$password = $_SESSION['password'];

$stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
if($row = $result->fetch_assoc()){
    if(!password_verify($password, $row['password'])){
        header('Location:login_verify.php');
    }
}else{
    header('Location:login_verify.php');
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES["image"])){

    $sponser = trim($row['customer_id']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $address = $_POST['address'];
    $password = $_POST['pass'];
    $dob = $_POST['dob'];
    $imgname = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $upload_dir = "assets/profile/";
    
    //allowed only

    $file_type = mime_content_type($tmp_name);
    $allowed_types = ['image/jpeg', 'image/jpg'];

    if (!in_array($file_type, $allowed_types)) {
        $msg = "<script>alert('Only JPG and JPEG formats are allowed.')</script>";
        header('Refresh:0 url=user_register.php');
        die($msg);
    }

    if($_FILES["image"]["size"] > 350000){
        $msg = "<script>alert('image size should be less than 350 KB')</script>";
        header('Refresh:0 url=user_register.php');
        die($msg);
    }

    $q1 = "SELECT * FROM customer WHERE mobile = ? OR email= ? ";
    $stmt = $conn->prepare($q1);
    $stmt->bind_param("ss",$mobile,$email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0) {
        $msg = "<script>alert('employee already register with mobile number or email')</script>";
        die($msg);
    }

    $stmt->close();

    $file_path = $upload_dir . basename($imgname);
    if (move_uploaded_file($tmp_name, $file_path)) {
        $imgContent = addslashes(file_get_contents($file_path));

        $hashPassword = password_hash($password, PASSWORD_BCRYPT);

        $customer_id = 'ED'.rand(100000,9999999);
        $full = $fname." ".$lname;
        $q2 = "INSERT INTO customer(sponser_id,name,email,mobile,address,password,customer_id,image_name,image,filepath,date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt= $conn->prepare($q2);
        $stmt->bind_param("sssssssssss",$sponser,$full,$email,$mobile,$address,$hashPassword,$customer_id,$imgname,$imgContent,$file_path,$dob);
        if($stmt->execute()){

            header("Location: wc.php?customer_id=$customer_id");
        }
        else{
            $error_message = 'Some error occured. please try later..!';
        }
        $stmt->close();
    }else{
        $msg = "<script>alert('failed to upload profile picture.')</script>";
        die($msg);
    }
}else{
    $msg = 'All field required!<br> image size should be less than or equal to 350 KB';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="assets/images/shoplogo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style type="text/css">
    .profile-picture {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #343a40;
    color: white;
    padding: 10px 0;
}

.footer .container .row .col a {
    color: white;
    font-size: 24px;
}

.footer .container .row .col a:hover {
    color: #d3d3d3;
}


/* styles.css */

.carousel-inner img {
    width: 100%;
    height: auto;
}

.icon {
    width: 80px;
    height: 80px;
    margin: 10px;
}

.icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card:hover {
 box-shadow: 0 8px 50px #23232333;
}

#togglePassword {
    cursor: pointer;
}

</style>

<script type="text/javascript">

// Example banner images
const bannerImages = [
    'assets/images/s1.jpg',
    'assets/images/s2.jpg',
    'assets/images/s3.jpg'
];


// Function to load banner images dynamically
function loadBannerImages() {
    const carouselInner = document.getElementById('carousel-inner');
    bannerImages.forEach((image, index) => {
        const div = document.createElement('div');
        div.className = `carousel-item ${index === 0 ? 'active' : ''}`;
        div.innerHTML = `<img src="${image}" class="d-block w-100" alt="Banner ${index + 1}">`;
        carouselInner.appendChild(div);
    });
}


// Initialize the dynamic content when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    loadBannerImages();
    loadIcons();
});


</script>

<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">

        <a class="navbar-brand text-light" href="#" style="font-family: fantasy;">दुकानदार स्वास्थ सेवा</a>
       <a class="nav-link dropdown-toggle navbar-toggler" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $row['filepath']; ?>" alt="Profile" class="profile-picture">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Account Manage</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="login_verify.php">Logout</a>
        </div>
    </nav>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="container">
        <div id="dynamic-banner" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" id="carousel-inner">
                <!-- Banner images will be inserted dynamically here -->
            </div>
            <a class="carousel-control-prev" href="#dynamic-banner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#dynamic-banner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <hr>
        <div class="d-flex flex-wrap justify-content-center" id="icon-section">
            <!-- Icons will be inserted dynamically here -->
            <div class="icon">
                <div class="container">
                    <a href="admin_login.php">
                    <img src="assets/images/home.png" alt="home">
                    </a>
                    <p class="text-center">Home</p>
                </div>
            </div>
            
            <div class="icon">
                <div class="container">
                    <a href="tp.php">
                    <img src="assets/images/transaction.png" alt="home">
                    </a>
                    <p class="text-center">Total Transaction</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="emp.php">
                    <img src="assets/images/add-user.png" alt="home">
                    </a>
                    <p class="text-center">Add-Employee</p>
                </div>
            </div>
            
        </div>
    </div>
    <hr>

    <div class = "container mt-3">   
        <div class = "toast show p-2">  
            <div class = "toast-header">  
                <strong class = "me-auto">  Employee Registration </strong>  
                
                </div>  
                <div class = "toast-body">  
                <section class="modal-container-body rtf">
                    <form id="loginForm" action="" method="POST" enctype="multipart/form-data">
                        <span class="text-danger"><b><?php echo $msg; ?></b></span>
                        <div class="form-group">
                            <label for="mobile">Profile image</label>
                            <input type="file" class="form-control" id="phone" placeholder="Enter Phone" name="image" id="image" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="font-awesome">ADMIN ID</label>
                            <input type="text" class="form-control" id="partner" placeholder="Enter Partner ID" required name="sponser" value="<?php echo $row['customer_id']; ?>" readonly>
                            
                        </div>
                        <div class="form-group">
                            <label for="font-awesome">First Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="First Name" required name="fname">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" placeholder="Last Name" required name="lname">
                        </div>
                        <div class="form-group">
                            <label for="lname">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" required name="dob">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" required name="email">
                            
                        </div>
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone" required name="mobile">
                            
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter Address & Landmark" required name="address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password" required name="pass">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Register!</button>
                    </form>
                    <span class="text-danger"><?php echo $error_message; ?></span>
                </section> 
                </div>  
            </div>  
    </div>   
    <br><hr><br>
    

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    var togglePassword = document.getElementById('togglePassword');
    var password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});

</script>
   

<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel = "stylesheet"> 
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>




