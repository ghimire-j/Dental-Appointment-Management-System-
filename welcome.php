<?php
session_start();
include 'config.php';

// if (isset($_SESSION['loginMessage'])) {
//   echo $_SESSION['loginMessage'];
//   unset($_SESSION['loginMessage']);
//   echo ($_SESSION['email']);
// }

$loggedIn = isset($_SESSION['valid']);

$userdetail = [];
if ($loggedIn) {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM admin WHERE email = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $userdetail = mysqli_fetch_assoc($result);
} else {

  header("Location: signIn.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Dental Appointment </title>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <!-- swiper css link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!-- table boostrap css -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

  <!-- khalti js -->
  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>


  <!-- custom css link -->
  <!-- <link rel="stylesheet" href="../../CSS/User-Css/header-s.css"> -->

  <!-- custom css file link  -->
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="profile.css" />

  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>


</head>


<body>
  <!-- Header Section -->
  <header class="header">
    <nav class="navbar">
      <a href="#"><img src="images/logo.png" alt="logo" /></a>
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#services">Services</a>
      <a href="#team">Our-Team</a>
      <a href="#Detail">Doctor</a>
      <a href="#Schedule">Schedule</a>
    </nav>
    <pre>                 </pre>

    <a href="#contact" class="btn"> Make Appointment </a>
    <div id="menu-btn" class="fas fa-bars"></div>
    <pre> </pre>

    <!-- LogOut button for user -->
    <!-- <a href="index.html" class="btn"> Logout </a> -->

    <a href="logout.php" class="btn"> Logout </a>
    <pre></pre>

    <!-- Profile -->

    <div class="buttons">
      <?php if ($loggedIn): ?>
        <div class="profile-dropdown">
          <div onclick="toggle()" class="profile-dropdown-btn">
            <div class="profile-img">

              <?php if ($userdetail['Image'] !== null): ?>
                <img src="<?php echo $userdetail['Image']; ?>" alt="Profile Picture">
              <?php else: ?>
                <img src="images/profile.png" alt="Profile Image">

              <?php endif; ?>
            </div>

            <span><?php echo $userdetail['name']; ?> <i class="fa-solid fa-angle-down"></i></span>
          </div>


          <ul class="profile-dropdown-list">
            <div id="profile-details">
              <?php if ($userdetail['Image'] !== null): ?>
                <img src="<?php echo $userdetail['Image']; ?>" alt="Profile Picture" style="width: 70px; height: 70px;">
              <?php else: ?>
                <img src="images/profile.png" alt="User Logo" style="width: 50px; height: 50px;">
                <form action="uploadprofilepic.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                    onchange="this.form.submit()">
                  <button type="button" onclick="document.getElementById('profile_picture').click()">upload</button>
                </form>
              <?php endif; ?>
              <h1 class="name1"><?php echo $userdetail['name']; ?></h1>
              <p class="email1"><?php echo $userdetail['email']; ?></p>

            </div>
            <li class="profile-dropdown-list-item">

              <a href="editprofile.php">
                <i class="fa-regular fa-user"></i>
                Edit Profile
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="notification.php">
                <i class="fa-regular fa-envelope"></i>
                Inbox
              </a>
            </li>
            <hr />

            <li class="profile-dropdown-list-item">
              <a href="Logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log out
              </a>
            </li>
          </ul>
        </div>

      <?php else: ?>
        <a href="signIn.php" class="Login">login</a>
        <a href="signUp.php" class="button">
          <span class="signup">Sign up</span>
          <span class="signup-2" aria-hidden="true">Sign up</span>
        </a>
      <?php endif; ?>
      <div class="icons">
        <div id="menu-btn" class="fas fa-bars" style="display:none"></div>
      </div>
    </div>



    <?php
    // Add debug statements to check $_SESSION['valid'] and $loggedIn
    // echo "Session valid: " . (isset($_SESSION['valid']) ? $_SESSION['valid'] : "Not set");
    // echo "LoggedIn: " . ($loggedIn ? "true" : "false");
    ?>
    <!-- <div id="profile">
      <a href="#"><img src="images/profile.png" alt="" /></a>
    </div> -->

    <!-- profile -->

    <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center py-1" href="#"
            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="30" alt=""
                loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" style="min-width: 19rem;">
            <li>
                <div class="px-3 pt-3 d-flex">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle me-3"
                        height="40" alt="" loading="lazy" />
                    <div>
                        <h6 class="mb-0"><?php echo $userdetail['name']; ?></h6>
                        <p class="mb-2"><?php echo $email ?></p>
                        <a class="mb-0" href="">Manage your Google Account</a>
                    </div>
                </div>
                <hr class="mb-2">
            </li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle fa-fw me-3"></i><span>Your
                        channel</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign fa-fw me-3"></i><span>Paid
                        memberships</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-play-circle fa-fw me-3"></i><span>YouTube
                        Studio</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-users-cog fa-fw me-3"></i><span>Switch
                        account</span><i class="fas fa-chevron-right float-end mt-1"></i></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-3"></i><span>Sign out</span></a>
            </li>
            <hr class="my-2">
            <li><a class="dropdown-item" href="#"><i class="fas fa-sun fa-fw me-3"></i><span>Appearance: Device
                        theme</span><i class="fas fa-chevron-right float-end mt-1"></i></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-language fa-fw me-3"></i><span>Language:
                        English</span><i class="fas fa-chevron-right float-end mt-1"></i></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-globe fa-fw me-3"></i><span>Location: United
                        Kingdom</span><i class="fas fa-chevron-right float-end mt-1"></i></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw me-3"></i><span>Settings</span></a>
            </li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-shield-alt fa-fw me-3"></i><span>Your data in
                        YouTube</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-question-circle fa-fw me-3"></i><span>Help</span></a>
            </li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-comment-alt fa-fw me-3"></i><span>Send
                        feedback</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-keyboard fa-fw me-3"></i><span>Keyboard
                        shortcuts</span></a></li>
            <hr class="my-2">
            <li><a class="dropdown-item mb-2" href="#"><span>Restricted Mode: Off</span><i
                        class="fas fa-chevron-right float-end mt-1"></i></a></li>
        </ul>
    </li> -->
  </header>

  <!-- home -->
  <section class="home" id="home">
    <div class="content">
      <h3>"Life is short, but a beautiful smile lasts forever."</h3>
      <p>
        Welcome to Hamro Dental, where we believe that a healthy smile is
        the key to a happy life. Our state-of-the-art dental clinic is
        dedicated to providing you and your family with the highest quality
        dental care in a comfortable and relaxing environment.Our mission is
        to help you achieve and maintain a healthy, beautiful smile that you
        can be proud of. Whether you're a new patient or a returning one, we
        look forward to serving you and your family. Contact us today to
        schedule an appointment and experience the best dental services!!
      </p>
      <a href="#contact" class="btn">Make appointment</a>
    </div>
  </section>

  <!-- home end -->

  <!-- about us section-->

  <section class="about" id="about">
    <h1 class="heading">about us</h1>

    <div class="row">
      <div class="image">
        <img src="images/about.jpg" alt="" />
      </div>

      <div class="content">
        <h3>our clinic is made for you to be smiling all the time</h3>
        <p>
          Kathmandu Dental is a premier dental clinic that has been serving
          the people of Nepal since its founding on February 14th, 2000. We
          offer a comprehensive range of dental services, including routine
          cleanings, restorative dentistry, orthodontics, and cosmetic
          dentistry. With a team of highly skilled and experienced dental
          professionals, we are committed to providing the best possible care
          to our patients. Our dedication to quality and patient satisfaction
          has made us well-known throughout Nepal, and we are proud to be a
          trusted provider of dental care for the people of Kathmandu and
          beyond.
        </p>
        <!-- <a href="#" class="btn">read more</a> -->
      </div>
    </div>
  </section>

  <!-- about end -->

  <!-- services -->

  <section class="services" id="services">
    <h1 class="heading">our services</h1>

    <div class="box-container">
      <div class="box">
        <img src="images/services-1.webp" alt="" />
        <h3>online schedule</h3>
        <p>
          Easily book dental appointments from the comfort of their own homes.
          Instead of calling a dental clinic during business hours and trying
          to find an available appointment time, patients can simply go online
          and view the available appointment slots.
        </p>
      </div>
      <div class="box">
        <img src="images/braces.jpg" alt="" />
        <h3>Orthodontic treatments</h3>
        <p>
          Orthodontic treatments are used to straighten crooked teeth and
          correct bite problems. Traditional braces and clear aligners such as
          Invisalign are two common orthodontic treatments.
        </p>
      </div>

      <div class="box">
        <img src="images/services-2.webp" alt="" />
        <h3>Cosmetic dentistry</h3>
        <p>
          Cosmetic dentistry involves treatments that improve the appearance
          of your teeth and smile. Common cosmetic treatments include teeth
          whitening, veneers, and cosmetic bonding.
        </p>
      </div>

      <div class="box">
        <img src="images/services-3.webp" alt="" />
        <h3>Restorative dentistry</h3>
        <p>
          Restorative dentistry involves repairing damaged or missing teeth.
          Common restorative treatments include fillings, crowns, bridges, and
          dental implants.
        </p>
      </div>
    </div>
  </section>

  <!-- services end-->

  <!-- team section -->

  <section class="team" id="team">
    <h1 class="heading">our team</h1>

    <div class="swiper team-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <div class="image">

            <img src="images/Dr_sama.jpg" alt="" />
            <div class="share">
              <!-- <a href="#" class="fab fa-facebook-f"></a> -->
              <a href="https://twitter.com/PradhanSamu" class="fab fa-twitter"></a>
              <!-- <a href="#" class="fab fa-instagram"></a> -->
              <a href="https://www.linkedin.com/in/sama-pradhan-33a126169/?originalSubdomain=np"
                class="fab fa-linkedin"></a>
            </div>
          </div>
          <div class="content">
            <h3>Dr. Sama Pradhan <br>
              <p style="font-size: x-small;">(10am-2pm)</p>
            </h3>
            <span>Endodontist (MDS)</span>
          </div>
          <a href="sama_rating.php" class="btn">Feedbacks</a>

        </div>

        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/dr_kushal.jpg" alt="" />
            <div class="share">
              <!-- <a href="#" class="fab fa-facebook-f"></a> -->
              <a href="https://twitter.com/k_vaishnani?lang=en" class="fab fa-twitter"></a>
              <!-- <a href="#" class="fab fa-instagram"></a> -->
              <a href="https://np.linkedin.com/in/dr-kushal-bimb-b467124b" class="fab fa-linkedin"></a>
            </div>
          </div>
          <div class="content">
            <h3>Dr. Kushal Bimb <br>
              <p style="font-size: x-small;">(11am-3pm)</p>
            </h3>
            <span>Oral and Maxillofacial Surgeon</span>
          </div>
          <a href="bimb_rating.php" class="btn">Feedbacks</a>
        </div>

        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/dr_aryal.jpg" alt="" />
            <div class="share">
              <!-- <a href="#" class="fab fa-facebook-f"></a> -->
              <a href="https://twitter.com/aryal_shreeya" class="fab fa-twitter"></a>
              <!-- <a href="#" class="fab fa-instagram"></a> -->
              <a href="https://www.linkedin.com/in/shreeya-aryal-26b102115/" class="fab fa-linkedin"></a>
            </div>
          </div>
          <div class="content">
            <h3>Dr. Shreeya Aryal <br>
              <p style="font-size: x-small;">(12pm-4pm)</p>
            </h3>
            <span>Periodontist (MDS)</span>
          </div>
          <a href="shreya_rating.php" class="btn">Feedbacks</a>
        </div>

        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/dr_saloni.jpg" alt="" />
            <div class="share">
              <!-- <a href="#" class="fab fa-facebook-f"></a> -->
              <a href="https://twitter.com/SaloniShillu" class="fab fa-twitter"></a>
              <!-- <a href="#" class="fab fa-instagram"></a> -->
              <a href="https://www.linkedin.com/in/shilpi-saloni-a72891b6/?trk=pub-pbmap&originalSubdomain=in"
                class="fab fa-linkedin"></a>
            </div>
          </div>
          <div class="content">
            <h3>Dr. Saloni Shilphi <br>
              <p style="font-size: x-small;">(3pm-6pm)</p>
            </h3>
            <span>Endodontist (BDS,MDS)</span>
          </div>
          <a href="shilpi_rating.php" class="btn">Feedbacks</a>
        </div>
      </div>
    </div>
  </section>

  <!-- team section ends -->

  <!-- contact -->
  <script>
    function validateAppointment() {
      var appointmentDate = new Date(document.getElementById("appointment_date").value);
      var currentDate = new Date();

      // Compare appointment date with current date
      if (appointmentDate < currentDate) {
        alert("Please select a future date and time for your appointment.");
        return false; // Prevent form submission
      }
      return true; // Allow form submission
    }
  </script>

  <section class="contact" id="contact">
    <h1 class="heading">Make appointment</h1>

    <form action="appointment_process.php" method="POST" onsubmit="return validateAppointment();">
      <!-- <form action="reschedule.php" method="POST"> -->

      <form action="cancel.php" method="POST">
        <span>Your name :</span>
        <div class="inputBox">
          <input type="text" placeholder="first name" name="first_name" required />
          <input type="text" placeholder="last name" name="last_name" required />
        </div>

        <span>Your email :</span>
        <input type="email" value="<?php echo $email ?>" placeholder="enter your email" class="box" name="email"
          required readonly />

        <span>Your Number :</span>
        <input type="text" placeholder="enter your number" class="box" name="phone" required />

        <div style="font-size: 1.7rem; line-height: 2; color: var(--primary);">Appointment date :</div>
        <input type="datetime-local" class="box" name="appointment_date" id="appointment_date" required />

        <span>Problem:</span>
        <input type="text" placeholder="enter your problem/symptom" class="box" name="problem" required />

        <div>
          <label for="Preferred_doctor" style="font-size: 1.7rem; color:var(--primary);">Preferred Doctor:</label>
<?php 
$specialties_result = $conn->query("SELECT * FROM specialties");
?>

<select name="Preferred_doctor" id="Preferred_doctor" style="font-size: 1.7rem; justify-content:space-between;" required>
<br>
<br>
        <?php
        while ($row = $specialties_result->fetch_assoc()) {
            $doctor_name = $row['Doctor']; // Assuming 'sname' contains the doctor's name
            echo "<option value=\"$doctor_name\">$doctor_name</option>";
        }
        ?>
            </select>

        </div>
        <br>



        <!-- <div style="font-size: 1.7rem;line-height: 2; color: var(--primary);">Minimal Payment: *</div> -->
        <!-- <button id="payment-button">Pay with Khalti</button> -->
        <input type="submit" name="submit" value="Book now" class="btn" />
        <input type="submit" value="reschedule" name="reschedule" class="btn" formaction="reschedule.php" />
        <input type="submit" value="cancel" name="cancel" class="btn" />
        <!-- <form style= "padding-top: 20px"; method="post"> -->
        </div>
      </form>
      <!-- </form> -->
    </form>
  </section>
  <!-- <script>
    function validateAppointment() {
      var appointmentDate = new Date(document.getElementById("appointment_date").value);
      var currentDate = new Date();

      // Compare appointment date with current date
      if (appointmentDate < currentDate) {
        alert("Please select a future date and time for your appointment.");
        return false; // Prevent form submission
      }
      return true; // Allow form submission
    }
  </script> -->
  <!-- contact ends-->
  <!-- <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script> -->

  <!-- pricing plan  -->
  <!-- pricing plan ends -->

  <section class="about" id="Detail">
    <h1 class="heading">Doctor's Detail</h1>
    <div class="content5">
      <h3>View Doctors and their speciality</h3>
      <a href="viewdoctor.php" class="btn1">View</a>

    </div>
    </div>
  </section>
  <!-- table -->
  <section class="about" id="Schedule">
    <h1 class="heading">Schedule</h1>
    <div class="content5">
      <h3>View your Appointment/Schedule</h3>
      <a href="table.php" class="btn1">Schedule</a>
    </div>
    </div>

  </section>
  <!-- table end -->

  <!-- footer -->
  <hr>


  <section class="footer" id="social">
    <div class="box-container">
      <div class="box">
        <h3>address</h3>
        <p>Tinchuli-Boudha, Kathmandu, Nepal</p>
        <div class="share">
          <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-linkedin"></a>
          <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
        </div>
      </div>

      <div class="box">
        <h3>e-mail</h3>
        <a href="#social" class="link">jubingc15@gmail.com</a>
      </div>

      <div class="box">
        <h3>call us</h3>
        <p>+977 9841586032</p>
        <p>+977 9823548051</p>
      </div>

      <div class="box">
        <h3>opening hours</h3>
        <p>
          Sunday - Friday : 8:00 - 6:00 <br />
          Feel Free to visit us!
        </p>
      </div>
    </div>

    <div class="credit">
      created by <span>L6CG2</span> | all rights reserved!
    </div>
  </section>
  <script src="profilep.js"></script>
  <!-- footer ends -->

  <!-- swiper js link  -->
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

  <!-- custom js file link  -->
  <script src="scriptmain.js"></script>
  <script src="profilep.js"></script>
  <style>
    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important;
    }

    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important;
    }

    * {
      text-transform: capitalize;
    }
  </style>

</body>

</html>