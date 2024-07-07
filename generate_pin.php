<?php 
date_default_timezone_set('Asia/Kolkata');
include '../config.php';
session_start();
if($_SESSION['email'] == ""){
    header('Location: login_verify.php');
}
$status = '';
$error_message = '';
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

$filter_array = array($row['customer_id']);
$temp = $filter_array[0][0].$filter_array[0][1];

if($temp != 'CR'){
    header('Location:login_verify.php');
}
$stmt->close();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = 'disabled';
    $cid = $row['customer_id'];
    $epin = $_POST['epin'];
    $password = $_POST['password'];

    try{
        if($row['tpin'] == '')
        {
            if(password_verify($password, $row['password'])){
                $stmt = $conn->prepare("UPDATE customer SET tpin = ? WHERE customer_id = ?");
                $stmt->bind_param('is', $epin, $cid);
                $stmt->execute();

                $success = 'आपका ट्रांसक्शन पिन सफलतापूर्वक बन चूका है |';
                $status = '';
                $stmt->close();
            }else{
                $error_message = 'एंटर किया गया पासवर्ड गलत है |';
                $status = '';
            }
        }
    }catch(Exception $e){
        $error_message = "".$e->getMessage();
        $status = '';
    }

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


</style>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    var sidebarCollapse = document.getElementById('sidebarCollapse');
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var togglePassword = document.getElementById('togglePassword');
    var password = document.getElementById('password');

    sidebarCollapse.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
    });

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the eye slash icon
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});


// scripts.js

// Example banner images
const bannerImages = [
    'assets/images/s1.jpg',
    'assets/images/s2.jpg',
    'assets/images/s3.jpg'
];

/* Example icons
const icons = [
    { name: 'Home', image: 'assets/images/home.png',link: 'User_panel_web_application.php',id: '#' },
    { name: 'बेनिफिट्स', image: 'assets/images/inr.png',link: 'benefit.php',id: '#' },
    { name: 'वॉलेट', image: 'assets/images/savings.png', link: '#wallet.php', id: '#' },
    { name: 'ट्रांज़ैक्शन', image: 'assets/images/3d-report.png', link: 'transaction.php', id: '#' },
    { name: 'प्रोफाइल', image: 'assets/images/profile.png', link: 'profile.php', id: '#' },
    { name: 'Today Sell', image: 'assets/images/growth.png', link: 'sell.php', id: '#'},
    { name: 'Refer', image: 'assets/images/add-user.png', link: 'user_register.php', id: '#'},
    { name: 'T&C', image: 'https://img.icons8.com/?size=100&id=hxKYIOW0uvG5&format=png&color=000000',link:'termandcondition.php',id:'#'}
    
];*/

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

/* Function to load icons dynamically
function loadIcons() {
    const iconSection = document.getElementById('icon-section');
    icons.forEach(icon => {
        const div = document.createElement('div');
        div.className = 'icon';
        div.innerHTML = `
            <div class="container">
            <a href="${icon.link}">
            <img src="${icon.image}" alt="${icon.name}" style="width:55px;height:55px;">
            </a>
            <p class="text-center">${icon.name}</p></div>
        `;
        iconSection.appendChild(div);
    });
}*/

// Initialize the dynamic content when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    loadBannerImages();
    loadIcons();
});


</script>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">

        <a class="navbar-brand text-light" href="#" style="font-family: fantasy;">दुकानदार स्वास्थ ऍप</a>
       <a class="nav-link dropdown-toggle navbar-toggler" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $row['filepath']; ?>" alt="Profile" class="profile-picture">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="generate_pin.php">Account Manage</a>
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
        
        <h4 class="text-center text-dark">Balance :- &#8377;<?php echo $row['wallet_balance']; ?></h4><hr>
        <div class="d-flex flex-wrap justify-content-center" id="icon-section">
            <!-- Icons will be inserted dynamically here -->
            <div class="icon">
                <div class="container">
                    <a href="User_panel_web_application.php">
                    <img src="assets/images/home.png" alt="home">
                    </a>
                    <p class="text-center">Home</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="benefit.php">
                    <img src="assets/images/benefit.png" alt="home">
                    </a>
                    <p class="text-center">Benefits</p>
                </div>
            </div>
            <?php
                if($temp=='CR'){
            ?>
            <div class="icon">
                <div class="container">
                    <a href="wallet.php">
                    <img src="assets/images/wallet.png" alt="home">
                    </a>
                    <p class="text-center">Wallet</p>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="icon">
                <div class="container">
                    <a href="transaction.php">
                    <img src="assets/images/transaction.png" alt="home">
                    </a>
                    <p class="text-center">Transaction</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="profile.php">
                    <img src="assets/images/profile.png" alt="home">
                    </a>
                    <p class="text-center">Profile</p>
                </div>
            </div>

            <?php
                if($temp == 'ED'){
            ?>
            <div class="icon">
                <div class="container">
                    <a href="sell.php">
                    <img src="assets/images/growth.png" alt="home">
                    </a>
                    <p class="text-center">Collection</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="user_register.php">
                    <img src="assets/images/add-user.png" alt="home">
                    </a>
                    <p class="text-center">Refer</p>
                </div>
            </div>
            
            <div class="icon">
                <div class="container">
                    <a href="collect.php">
                    <img src="assets/images/money.png" alt="home">
                    </a>
                    <p class="text-center">Collect</p>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="icon">
                <div class="container">
                    <a href="termandcondition.php">
                    <img src="assets/images/policy.png" alt="tc">
                    </a>
                    <p class="text-center">Policy</p>
                </div>
            </div>
            
        </div>
    </div>
    <hr>

    
    <div class = "container mt-3">   
        <div class = "toast show p-2">  
            <div class = "toast-header">  
                <strong class = "me-auto"> Customer Amount Collection </strong>  
                
                </div>  
                <div class = "toast-body">  
                <section class="modal-container-body rtf">
                    <div class="alert alert-danger"> ट्रांसक्शन पिन केवल एक ही बार बना सकते है बाद में चेंज नहीं होगा।  </div>
                    <form id="loginForm" method="POST">
                        <div class="form-group">
                            <label for="font-awesome">Name</label>
                            <input type="text" class="form-control" id="customer" required name="customerid" value="<?php echo strtoupper($row['name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="font-awesome">Customer ID</label>
                            <input type="text" class="form-control" id="customer" placeholder="Enter Customer ID" required name="customerid" value="<?php echo $row['customer_id']; ?>" readonly>
                        </div>
                        <?php if($row['tpin'] == ''){ ?>
                        <div class="form-group">
                            <label for="password">Enter Your PIN</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="password" placeholder="PIN"  required name="epin" maxlength="6">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($row['tpin'] != ''){?>
                        <div class="form-group">
                            <label for="password">Your PIN</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="password" maxlength="6" value="<?php echo $row['tpin']; ?>" name="epin" readonly />
                            </div>
                        </div>
                        <?php } ?>
                        <?php 
                        if($row['tpin'] !=''){
                        ?>
                        <div class="alert alert-success">आपका ट्रांसक्शन पिन बन चूका है |</div>
                        <?php } ?>

                        <?php if($row['tpin'] == ''){?>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group"> 
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($row['tpin'] == ''){?>
                            <button type="submit" class="btn btn-primary btn-block">Generate PIN</button><?php } ?>
                    </form><br>
                    <?php 
                        if($error_message !=''){

                    ?>
                    <div class="alert alert-danger"> <?php echo $error_message; ?> 

                    </div>
                    <?php }?>
                    
                </section> 
                </div>  
            </div>  
    </div>
    <br><hr><br>
    

   

<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel = "stylesheet"> 
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>