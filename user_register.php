<?php 
include '../config.php';

$name='customer name';
$shop_name = 'Shop XYZ';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Web Application</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/?size=100&id=sSqpW97QE6ny&format=png&color=000000">

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
    'https://img.freepik.com/free-photo/close-up-portrait-young-beautiful-attractive-tender-ginger-redhair-girl-happy-smiling-digital-tab_1258-116829.jpg?t=st=1717580778~exp=1717584378~hmac=4244435a42262d8c4069b332f34aca3fd5e5fa5ece2dff80d65e4fe1fc998c46&w=826',
    'https://img.freepik.com/free-photo/excited-girl-love-christmas-holidays-receiving-presents-holding-lovely-new-year-gift-smiling-joy_1258-126419.jpg?t=st=1717580830~exp=1717584430~hmac=67d3bb286df9da732ecc741aca3195aacf7d053a8f2fa5b076ec3679a984fa4b&w=826',
    'https://img.freepik.com/free-photo/fun-people-concept-headshot-portrait-charming-ginger-red-hair-girl-with-freckles-smiling-making-ok-sign-with-finger-pastel-blue-background-copy-space_1258-128512.jpg?t=st=1717580858~exp=1717584458~hmac=723724bbb2b6327e90283f53b337392da079822380145171e86055c3eab031e0&w=826'
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

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span>
        <img src="https://img.icons8.com/?size=100&id=sSqpW97QE6ny&format=png&color=000000" style="width:30px;height: 30px;"></span>
        <a class="navbar-brand" href="#"></a>
       <a class="nav-link dropdown-toggle navbar-toggler" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="https://img.icons8.com/?size=100&id=kDoeg22e5jUY&format=png&color=000000" alt="Profile" class="profile-picture">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </nav>
    
    <br>
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
        <h5 class="text-center">Services</h5><hr>
        <div class="d-flex flex-wrap justify-content-center" id="icon-section">
            <!-- Icons will be inserted dynamically here -->
            <div class="d-flex flex-wrap justify-content-center" id="icon-section">
            <!-- Icons will be inserted dynamically here -->
            <div class="icon">
                <div class="container">
                    <a href="User_panel_web_application.php">
                    <img src="assets/images/home.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">Home</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="benefit.php">
                    <img src="assets/images/inr.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">बेनिफिट्स</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="wallet.php">
                    <img src="assets/images/savings.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">वॉलेट</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="transaction.php">
                    <img src="assets/images/3d-report.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">ट्रांज़ैक्शन</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="profile.php">
                    <img src="assets/images/profile.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">प्रोफाइल</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="sell.php">
                    <img src="assets/images/growth.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">Today Sell</p>
                </div>
            </div>

            <div class="icon">
                <div class="container">
                    <a href="#">
                    <img src="assets/images/add-user.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">Refer</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="termandcondition.php">
                    <img src="https://img.icons8.com/?size=100&id=hxKYIOW0uvG5&format=png&color=000000" alt="tc" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">T&C</p>
                </div>
            </div>
            
        </div>
            
        </div>
    </div>
    <hr>
    <div class = "container mt-3">   
        <div class = "toast show p-2">  
            <div class = "toast-header">  
                <strong class = "me-auto"> Register Customer </strong>  
                
                </div>  
                <div class = "toast-body">  
                <section class="modal-container-body rtf">
                        <form id="loginForm" action="" method="POST">
                            <div class="form-group">
                                <label for="font-awesome">Partner ID</label>
                                <input type="text" class="form-control" id="fname" placeholder="Enter Partner ID" required name="sponser">
                            </div>
                            <div class="form-group">
                                <label for="font-awesome">First Name</label>
                                <input type="text" class="form-control" id="fname" placeholder="First Name" required name="fname">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required name="emailId">
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
                                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register!</button>
                        </form>
                </section> 
                </div>  
            </div>  
    </div>   
    <br><hr><br>
    <footer class="footer bg-dark text-center py-3">
        <div class="container">
            <span>&copy; <span id="year"></span> <?php echo $shop_name; ?>. All rights reserved.</span>
        </div>
    </footer>

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




