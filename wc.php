<?php 
include '../config.php';
session_start();
$wc_cust = $_GET['customer_id'];
$qu = mysqli_query($conn,"SELECT * FROM customer WHERE customer_id = '$wc_cust'");
if(mysqli_num_rows($qu)>0){
    $cust = mysqli_fetch_array($qu);
}else{
    header('Location:emp.php');
}

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

$filter_array = array($row['email']);
$temp = $filter_array[0][0].$filter_array[0][1];

if($temp != 'ad'){
    header('Location:login_verify.php');
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
    { name: 'Home', image: 'assets/images/home.png',link: '#User_panel_web_application.php',id: '#' },
    { name: 'बेनिफिट्स', image: 'assets/images/inr.png',link: 'benefit.php',id: '#' },
    { name: 'वॉलेट', image: 'assets/images/savings.png', link: 'wallet.php', id: '#' },
    { name: 'ट्रांज़ैक्शन', image: 'assets/images/3d-report.png', link: 'transaction.php', id: '#' },
    { name: 'प्रोफाइल', image: 'assets/images/profile.png', link: 'profile.php', id: '#' },
    { name: 'Today Sell', image: 'assets/images/growth.png', link: 'sell.php', id: '#'},
    { name: 'Refer', image: 'assets/images/add-user.png', link: 'user_register.php', id: '#'},
    { name: 'T&C', image: 'https://img.icons8.com/?size=100&id=hxKYIOW0uvG5&format=png&color=000000',link:'termandcondition.php',id:'#'}
    
];
*/
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
            <p class="text-center">${icon.name}</p>
            </div>
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
    <div class="container mt-3">
        <div class = "toast show p-2">  
            <div class = "toast-header"> 
                <img src="<?php echo $cust['filepath']; ?>" height="144" width="144">
            </div>
          <div class="col-md-6 p-4 ps-md-0">
            <h5 class="mt-0">Employee : <?php echo $cust['name']; ?></h5>
            <p>प्रिय श्रीमान/श्रीमती <?php echo $cust['name']; ?> आपका स्वागत है। आपका हमारे संगठन के साथ सफलतापूर्वक पंजीकरण चूका है और आपका आईडी <?php echo $cust['customer_id']; ?>  है और हमें आशा है कि आप हमारे संगठन का हिस्सा बनकर प्रसन्न महसूस करेंगे |</p>
            <a href="#" class="stretched-link">Home</a>
          </div>
        </div>
    </div>
    <br><hr><br>
    
    </div></div>
    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
