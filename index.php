
<?php
include '../config.php';
session_start();
$error_message='';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $email_id = $_POST['email'];
    $password = $_POST['password'];

    if($email_id == $ADMIN_CREDENTIAL_U){
        $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->bind_param('s',$email_id);

        $stmt->execute();
        $result = $stmt->get_result();
        if($aow = $result->fetch_assoc()){
            if(password_verify($password, $aow['password'])){
                $_SESSION['email'] = $email_id;
                $_SESSION['password'] = $password;
                header('Location: admin_login.php');
            }else{
                $error_message='<div class="alert alert-danger">something went wrong! Login failed..</div>';
            }
        }
    }else{

        $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->bind_param('s',$email_id);

        $stmt->execute();
        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){

            if(password_verify($password, $row['password'])){
                $_SESSION['email'] = $email_id;
                $_SESSION['password'] = $password;
                setcookie($email_id,time() + (86400 * 30));
                header('Location: User_panel_web_application.php');
            }else{
                $error_message='<div class="alert alert-danger">something went wrong! Login failed..</div>';
            }
        }else{
            $error_message='<div class="alert alert-danger">something went wrong! Login failed..</div>';
        }
    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $shop_name; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="assets/images/shoplogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<style type="text/css">
	body {
    font-family: Arial, sans-serif;
}

.jumbotron {
    background-color: #f8f9fa;
    padding: 2rem 1rem;
}

.navbar-brand {
    font-weight: bold;
}

#sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: -250px;
    background-color: #007bff;
    color: white;
    transition: 0.3s;
    padding-top: 60px;
    z-index: 1000;
}

#sidebar ul.components {
    padding: 0;
}

#sidebar ul li {
    padding: 10px;
    text-align: center;
}

#sidebar ul li a {
    color: white;
    display: block;
    text-decoration: none;
}

#sidebar ul li a:hover {
    background-color: #575757;
}

#sidebar.active {
    left: 0;
}

.navbar-toggler {
    outline: none;
    border: none;
}

.card {
    margin-top: 2rem;
}

#togglePassword {
    cursor: pointer;
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


</script>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-primary">
        <a class="navbar-brand text-light" href="#"><?php echo $shop_name; ?></a>
        <button class="navbar-toggler" type="button" id="sidebarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <ul class="list-unstyled components">

           <li>
               <h5><b> <?php echo $shop_name; ?> </b> </h5>
            </li>
            <li>
                <a href="#home">Home</a>
            </li>
            <li>
                <a href="#service">Service</a>
            </li>
            <li>
                <a href="#aboutus">About us</a>
            </li>
            <li>
                <a href="#contactus">Contact</a>
            </li>

             <li>
                <a href="#login">Login</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <!--h1>Welcome to Our <?php echo $shop_name; ?></h1>
            <p>Advantages to connect with our organization.</p>-->
            <img src="assets/images/shoplogo.png" alt="logg image" width="88" heigh="49" />
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="loginForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email"  name="email" required autocomplete="false" autosave="false" autofocus="false" />
                            </div>

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
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <br>
                        <?php echo $error_message; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <footer class="footer bg-light text-center py-3">
        <div class="container">
            <span>&copy; <span id="year"></span> <?php echo $shop_name; ?>. All rights reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap and JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
