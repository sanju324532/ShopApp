<?php 
include '../config.php';
session_start();
if($_SESSION['email'] == ""){
    header('Location: login_verify.php');
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

$filter_array = array($row['customer_id']);
$temp = $filter_array[0][0].$filter_array[0][1];



$ud = "".date('d-m-Y');
$pid = $row['customer_id'];
$stmt = $conn->prepare("SELECT amount FROM transaction WHERE partner_id = ? AND tdate = ?");
$stmt->bind_param('ss', $pid, $ud);
$stmt->execute();
$ji = $stmt->get_result();
if($ji->num_rows>0){
    $am=0;
    while($pow = $ji->fetch_assoc()){
        $am+=$pow['amount'];
    }
}else{
    $am=0;
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
    { name: 'बेनिफिट्स', image: 'assets/images/inr.png',link: '#benefit.php',id: '#' },
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
            <p class="text-center">${icon.name}</p></div>
        `;
        iconSection.appendChild(div);
    });
}
*/
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
        <?php if($temp == 'CR'){?>
        <h4 class="text-center text-dark">Balance :- &#8377;<?php echo $row['wallet_balance']; ?></h4>
        <?php }
        else if($temp == 'ED'){
        ?>
        <h4 class="text-center text-dark">Today Collection :- &#8377;<?php echo $am; ?></h4>
        <?php } ?>
        <hr>
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
                    <a href="#">
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
                <strong class = "me-auto"> Benefits </strong>  
                <button type = "button" class = "btn-close" data-bs-dismiss = "toast"> </button>  
                </div>  
                <div class = "toast-body">  
                <section class="modal-container-body rtf">
            <span class="text-danger">1.कैंसर </span>

            <p><?php echo $shop_name; ?> कैंसर से संबंधित लाभ प्रदान करता है, जिससे प्रभावित व्यक्तियों और उनके परिवारों को आवश्यक सहायता और संसाधन प्राप्त हो सकें। हम चिकित्सा सहायता, परामर्श सेवाएं, और वित्तीय सहायता प्रदान करके उनके संघर्ष को कम करने का प्रयास करते हैं। हमारा उद्देश्य है कि प्रत्येक व्यक्ति को सर्वोत्तम उपचार और देखभाल मिले ताकि वे इस चुनौतीपूर्ण समय का सामना कर सकें और बेहतर भविष्य की ओर बढ़ सकें।</p>

            <span class="text-danger">2.हार्टाटैक</span>

            <p><?php echo $shop_name; ?> हार्ट अटैक से संबंधित विभिन्न लाभ प्रदान करता है। हमारे द्वारा प्रदान किए जाने वाले लाभों में चिकित्सा सहायता, उपचार और पुनर्वास सेवाएं शामिल हैं। हमारा उद्देश्य आपके स्वास्थ्य को सुरक्षित और संजीवनी देना है ताकि आप बेफिक्र होकर जीवन का आनंद ले सकें।</p>


            <span class="text-danger">3. एड्स </span>

            <p><?php echo $shop_name; ?> एड्स से संबंधित लाभ प्रदान करता है, जिसमें निःशुल्क चिकित्सा परामर्श, आवश्यक दवाएं, और मानसिक स्वास्थ्य समर्थन शामिल है। हमारा उद्देश्य एड्स से पीड़ित व्यक्तियों को संपूर्ण स्वास्थ्य और कल्याण में मदद करना है, ताकि वे जीवन को बेहतर और स्वस्थ तरीके से जी सकें।</p>

            <span class="text-danger">4. दुर्घटना में हाथ पैर कट जाने की सर्जरी </span>

            <p><?php echo $shop_name; ?> दुर्घटना में हाथ पैर कट जाने की सर्जरी से संबंधित सभी प्रकार के लाभ प्रदान करता है। हमारे लाभों में उच्चतम गुणवत्ता की सर्जरी, विशेष पुनर्वास सेवाएं, और वित्तीय सहायता शामिल हैं, ताकि पीड़ित व्यक्ति शीघ्र ही स्वस्थ हो सकें और अपनी सामान्य दिनचर्या में वापस आ सकें। </p>

            <span class="text-danger">5. बिजली गिरने से छतिग्रस्त होने पर</span>

            <p><?php echo $shop_name; ?> बिजली गिरने से होने वाले नुकसान के लिए विशेष लाभ प्रदान करता है। इस लाभ के तहत, आपके घर या संपत्ति को बिजली गिरने से हुए नुकसान की मरम्मत और पुनर्स्थापन के लिए आर्थिक सहायता प्रदान की जाती है। हमारा उद्देश्य है कि आप प्राकृतिक आपदाओं के कारण उत्पन्न होने वाले कठिन समय में आर्थिक सुरक्षा और समर्थन प्राप्त कर सकें। हम आपके साथ हर कदम पर हैं, ताकि आप अपने जीवन को फिर से सामान्य स्थिति में ला सकें।</p>

            <span class="text-danger">6.किडनी चेंज </span>

            <p><?php echo $shop_name; ?> किडनी प्रत्यारोपण से संबंधित लाभ प्रदान करता है। हम किडनी प्रत्यारोपण के लिए वित्तीय सहायता, चिकित्सा देखभाल, और परामर्श सेवाएं उपलब्ध कराते हैं। हमारा लक्ष्य है कि हर जरूरतमंद मरीज को समय पर और उचित चिकित्सा सुविधाएं मिल सकें। हम आपके स्वस्थ और उज्ज्वल भविष्य की कामना करते हैं।</p>

            <span class="text-danger">7 लीवर चेंज</span>

            <p><?php echo $shop_name; ?> किडनी प्रत्यारोपण से संबंधित लाभ प्रदान करता है। हम किडनी प्रत्यारोपण के लिए वित्तीय सहायता, चिकित्सा देखभाल, और परामर्श सेवाएं उपलब्ध कराते हैं। हमारा लक्ष्य है कि हर जरूरतमंद मरीज को समय पर और उचित चिकित्सा सुविधाएं मिल सकें। हम आपके स्वस्थ और उज्ज्वल भविष्य की कामना करते हैं।</p>


            <span class="text-danger">8 एबोला बायरस</span>

            <p><?php echo $shop_name; ?> एबोला वायरस से संबंधित लाभ प्रदान करता है, जिससे प्रभावित व्यक्तियों को चिकित्सा सहायता, वित्तीय सहायता, और आवश्यक संसाधन उपलब्ध कराए जाते हैं। हम रोगियों और उनके परिवारों के लिए परामर्श सेवाएं भी प्रदान करते हैं, ताकि वे इस कठिन समय में मानसिक और भावनात्मक समर्थन प्राप्त कर सकें। हमारा लक्ष्य है कि एबोला वायरस से प्रभावित हर व्यक्ति को संपूर्ण देखभाल और समर्थन मिले, जिससे वे स्वस्थ और सुरक्षित जीवन जी सकें।</p>

            <span class="text-danger">9.स्मेलपॉक्स</span>

            <p><?php echo $shop_name; ?> स्मॉलपॉक्स से संबंधित व्यापक लाभ प्रदान करता है। हम प्रभावित व्यक्तियों को उच्च गुणवत्ता वाली स्वास्थ्य सेवाएं, आर्थिक सहायता, और मानसिक स्वास्थ्य समर्थन प्रदान करने के लिए प्रतिबद्ध हैं। हमारा लक्ष्य है कि हर मरीज को सबसे बेहतरीन उपचार और देखभाल मिल सके, ताकि वे जल्द से जल्द स्वस्थ हो सकें और सामान्य जीवन जी सकें।</p>

            <button type = "button" class = "btn btn-primary" data-bs-dismiss = "toast">Close Benefits</button>

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
