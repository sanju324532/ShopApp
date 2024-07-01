<?php 
include '../config.php';
session_start();
if($_SESSION['email'] == ""){
    header('Location: login_verify.php');
}

$email = $_SESSION['email'];
$res = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'");
if(mysqli_num_rows($res)>0){
    $row = mysqli_fetch_assoc($res);
}else{
    header('Location: login_verify.php');
}

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
    'https://img.freepik.com/free-photo/close-up-portrait-young-beautiful-attractive-tender-ginger-redhair-girl-happy-smiling-digital-tab_1258-116829.jpg?t=st=1717580778~exp=1717584378~hmac=4244435a42262d8c4069b332f34aca3fd5e5fa5ece2dff80d65e4fe1fc998c46&w=826',
    'https://img.freepik.com/free-photo/excited-girl-love-christmas-holidays-receiving-presents-holding-lovely-new-year-gift-smiling-joy_1258-126419.jpg?t=st=1717580830~exp=1717584430~hmac=67d3bb286df9da732ecc741aca3195aacf7d053a8f2fa5b076ec3679a984fa4b&w=826',
    'https://img.freepik.com/free-photo/fun-people-concept-headshot-portrait-charming-ginger-red-hair-girl-with-freckles-smiling-making-ok-sign-with-finger-pastel-blue-background-copy-space_1258-128512.jpg?t=st=1717580858~exp=1717584458~hmac=723724bbb2b6327e90283f53b337392da079822380145171e86055c3eab031e0&w=826'
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span>
        <img src="https://img.icons8.com/?size=100&id=sSqpW97QE6ny&format=png&color=000000" style="width:30px;height: 30px;"></span>
        <a class="navbar-brand" href="#"></a>
       <a class="nav-link dropdown-toggle navbar-toggler" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo $row['filepath']; ?>" alt="Profile" class="profile-picture">
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
                    <a href="#">
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
                    <a href="user_register.php">
                    <img src="assets/images/add-user.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">Refer</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="collect.php">
                    <img src="assets/images/payment.png" alt="home" style="width:55px;height:55px;">
                    </a>
                    <p class="text-center">Collect</p>
                </div>
            </div>
            <div class="icon">
                <div class="container">
                    <a href="termandcondition.php">
                    <img src="assets/images/handshake.png" alt="tc" style="width:55px;height:55px;">
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
                <strong class = "me-auto"> Benefits </strong>  
                <button type = "button" class = "btn-close" data-bs-dismiss = "toast"> </button>  
                </div>  
                <div class = "toast-body">  
                <section class="modal-container-body rtf">
            <span>Quarum ambarum rerum cum medicinam pollicetur, luxuriae licentiam pollicetur.</span>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Unum nescio, quo modo possit, si luxuriosus sit, finitas cupiditates habere. Hoc est non modo cor non habere, sed ne palatum quidem. Sic, et quidem diligentius saepiusque ista loquemur inter nos agemusque communiter. Paulum, cum regem Persem captum adduceret, eodem flumine invectio? Quid igitur dubitamus in tota eius natura quaerere quid sit effectum? Duo Reges: constructio interrete. </p>

            <span>Ut proverbia non nulla veriora sint quam vestra dogmata.</span>

            <p>Quasi vero, inquit, perpetua oratio rhetorum solum, non etiam philosophorum sit. Tria genera cupiditatum, naturales et necessariae, naturales et non necessariae, nec naturales nec necessariae. Sin aliud quid voles, postea. Consequatur summas voluptates non modo parvo, sed per me nihilo, si potest; </p>

            <p>Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Primum in nostrane potestate est, quid meminerimus? Eam tum adesse, cum dolor omnis absit; Quodsi ipsam honestatem undique pertectam atque absolutam. Aliam vero vim voluptatis esse, aliam nihil dolendi, nisi valde pertinax fueris, concedas necesse est. Nec enim, cum tua causa cui commodes, beneficium illud habendum est, sed faeneratio, nec gratia deberi videtur ei, qui sua causa commodaverit. Universa enim illorum ratione cum tota vestra confligendum puto. Sed residamus, inquit, si placet. Sed vobis voluptatum perceptarum recordatio vitam beatam facit, et quidem corpore perceptarum. Itaque primos congressus copulationesque et consuetudinum instituendarum voluntates fieri propter voluptatem; Ita enim se Athenis collocavit, ut sit paene unus ex Atticis, ut id etiam cognomen videatur habiturus. Atque hoc loco similitudines eas, quibus illi uti solent, dissimillimas proferebas. </p>

            <span>An hoc usque quaque, aliter in vita?</span>
            <ol>
                <li>Etenim nec iustitia nec amicitia esse omnino poterunt, nisi ipsae per se expetuntur.</li>
                <li>Pisone in eo gymnasio, quod Ptolomaeum vocatur, unaque nobiscum Q.</li>
                <li>Certe nihil nisi quod possit ipsum propter se iure laudari.</li>
                <li>Itaque e contrario moderati aequabilesque habitus, affectiones ususque corporis apti esse ad naturam videntur.</li>
            </ol>

            <p>Utilitatis causa amicitia est quaesita. Qui autem de summo bono dissentit de tota philosophiae ratione dissentit. Quamquam non negatis nos intellegere quid sit voluptas, sed quid ille dicat. Sed emolumenta communia esse dicuntur, recte autem facta et peccata non habentur communia. Hoc positum in Phaedro a Platone probavit Epicurus sensitque in omni disputatione id fieri oportere. Potius inflammat, ut coercendi magis quam dedocendi esse videantur. Roges enim Aristonem, bonane ei videantur haec: vacuitas doloris, divitiae, valitudo; Totum autem id externum est, et quod externum, id in casu est. Non autem hoc: igitur ne illud quidem. Simul atque natum animal est, gaudet voluptate et eam appetit ut bonum, aspernatur dolorem ut malum. Quamquam tu hanc copiosiorem etiam soles dicere. Quid enim necesse est, tamquam meretricem in matronarum coetum, sic voluptatem in virtutum concilium adducere? Hoc positum in Phaedro a Platone probavit Epicurus sensitque in omni disputatione id fieri oportere. Videsne quam sit magna dissensio? </p>

            <span>Claudii libidini, qui tum erat summo ne imperio, dederetur.</span>

            <p>Eorum enim est haec querela, qui sibi cari sunt seseque diligunt. Cum audissem Antiochum, Brute, ut solebam, cum M. An obliviscimur, quantopere in audiendo in legendoque moveamur, cum pie, cum amice, cum magno animo aliquid factum cognoscimus? Qui igitur convenit ab alia voluptate dicere naturam proficisci, in alia summum bonum ponere? Magni enim aestimabat pecuniam non modo non contra leges, sed etiam legibus partam. Haec mirabilia videri intellego, sed cum certe superiora firma ac vera sint, his autem ea consentanea et consequentia, ne de horum quidem est veritate dubitandum. At, illa, ut vobis placet, partem quandam tuetur, reliquam deserit. Sed utrum hortandus es nobis, Luci, inquit, an etiam tua sponte propensus es? Sed est forma eius disciplinae, sicut fere ceterarum, triplex: una pars est naturae, disserendi altera, vivendi tertia. Nemo enim est, qui aliter dixerit quin omnium naturarum simile esset id, ad quod omnia referrentur, quod est ultimum rerum appetendarum. Quid est, quod ab ea absolvi et perfici debeat? Quod cum accidisset ut alter alterum necopinato videremus, surrexit statim. Tantum dico, magis fuisse vestrum agere Epicuri diem natalem, quam illius testamento cavere ut ageretur. Quod iam a me expectare noli. Quod totum contra est. Semper enim ita adsumit aliquid, ut ea, quae prima dederit, non deserat. </p>

            <span>Sed nimis multa.</span>

            <p>Nec vero alia sunt quaerenda contra Carneadeam illam sententiam. Negat enim summo bono afferre incrementum diem. Causa autem fuit huc veniendi ut quosdam hinc libros promerem. Deinde prima illa, quae in congressu solemus: Quid tu, inquit, huc? Minime vero probatur huic disciplinae, de qua loquor, aut iustitiam aut amicitiam propter utilitates adscisci aut probari. Nulla profecto est, quin suam vim retineat a primo ad extremum. Sed ad illum redeo. Quem quidem vos, cum improbis poenam proponitis, inpetibilem facitis, cum sapientem semper boni plus habere vultis, tolerabilem. Huic ego, si negaret quicquam interesse ad beate vivendum quali uteretur victu, concederem, laudarem etiam; Non igitur de improbo, sed de callido improbo quaerimus, qualis Q. His singulis copiose responderi solet, sed quae perspicua sunt longa esse non debent. Quae cum ita sint, effectum est nihil esse malum, quod turpe non sit. </p>

            <button type = "button" class = "btn btn-primary" data-bs-dismiss = "toast">Close Benefits</button>

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

   

<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel = "stylesheet"> 
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
