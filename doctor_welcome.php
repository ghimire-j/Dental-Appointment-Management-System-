<?php
// session_start();
require_once ('config.php');
session_start();
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
  <title>Dental Appointment</title>
  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <!-- swiper css link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!-- custom css file link  -->
  <link rel="stylesheet" href="style.css" />
</head>
<?php
if (isset($_SESSION['loginMessage'])) {
  echo $_SESSION['loginMessage'];
  unset($_SESSION['loginMessage']);
}
?>

<body>
  <!-- Header Section -->
  <header class="header">
    <nav class="navbar">
      <a href="#"><img src="images/logo.png" alt="logo" /></a>
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#services">Services</a>
      <a href="#team">Our-Team</a>
      <a href="#Schedule">Schedule</a>
    </nav>

    <a href="#contact" class="btn"> Make Appointment </a>

    <div id="menu-btn" class="fas fa-bars"></div>

    <!-- LogOut button for user -->
    <!-- <a href="index.html" class="btn"> Logout </a> -->

    <a href="logout.php" class="btn"> Logout </a>

    <div id="profile">
      <a href="#"><img src="images/profile.png" alt="" /></a>
      <h2>Doctor</h2>
    </div>
  </header>

  <!-- home -->

  <section class="home" id="home">
    <div class="content">
      <h3>"Life is short, but a beautiful smile lasts forever."</h3>
      <p>
        Welcome to Kathmandu Dental, where we believe that a healthy smile is
        the key to a happy life. Our state-of-the-art dental clinic is
        dedicated to providing you and your family with the highest quality
        dental care in a comfortable and relaxing environment.Our mission is
        to help you achieve and maintain a healthy, beautiful smile that you
        can be proud of. Whether you're a new patient or a returning one, we
        look forward to serving you and your family. Contact us today to
        schedule an appointment and experience the Kathmandu Dental
        difference!
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
            <h3>Dr. Sama Pradhan</h3>
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
            <h3>Dr. Kushal Bimb</h3>
            <span>Oral and Maxillofacial Surgeon</span>
          </div>
          <a href="doctor_bimb.php" class="btn">Feedbacks</a>
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
            <h3>Dr. Shreeya Aryal</h3>
            <span>Periodontist (MDS)</span>
          </div>
          <a href="doctor_shreya.php" class="btn">Feedbacks</a>
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
            <h3>Dr. Saloni Shilphi</h3>
            <span>Endodontist (BDS,MDS)</span>
          </div>
          <a href="doctor_shilpi.php" class="btn">Feedbacks</a>
        </div>
      </div>
    </div>
  </section>

  <!-- team section ends -->



  <!-- contact -->
  <style>
    .prefer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .prefer span {
      margin-right: 10px;
    }
  </style>

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

  <!-- 
    <script>
      function validateForm(event) {
        event.preventDefault(); // Prevent form submission

        var form = document.getElementById("appointmentForm");
        var inputs = form.getElementsByTagName("input");
        var select = document.getElementById("Preferred_doctor");

        var isEmpty = false;

        // Check if any input field is empty
        for (var i = 0; i < inputs.length; i++) {
          if (inputs[i].value === "") {
            isEmpty = true;
            break;
          }
        }

        // Check if select field is empty
        if (select.value === "") {
          isEmpty = true;
        }

        // Display popup if any field is empty
        if (isEmpty) {
          alert("Please fill in all fields.");
        } else {
          form.submit(); // Submit the form if all fields are filled
        }
      }
    </script> -->

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

  <!-- contact ends-->

  <!-- table -->
  <section class="about" id="Schedule">
    <h1 class="heading">Schedule</h1>
    <div class="content5">
      <h3>View your Appointment/Schedule</h3>
      <a href="doctortable.php" class="btn1">Schedule</a>
    </div>
    </div>
  </section>
  <!-- table end -->

  <!-- PDF admin -->
  <section class="about">
    <h1 class="heading">Patient Report</h1>
    <div class="content5"
      style="text-align: center;font-size: 1.7rem;line-height: 2;padding-top:5px; color: var(--primary); ">
      <form action="search.php" method="POST">
        <h3>Enter Appointment ID:</h3> <br>
        <input type="text" id="appointment_id" name="appointment_id" required
          style=" text-align: center; border: 2px solid black;">
        <br>
        <input type="submit" name="search" value="search" class="btn">
      </form>
    </div>
  </section>
  <!-- end PDF admin -->


  <!-- footer -->

  <section class="footer" id="social">
    <div class="box-container">
      <div class="box">
        <h3>address</h3>
        <p>Tinchuli-Boudha, Kathmandu, Nepal</p>
        <div class="share">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-linkedin"></a>
          <a href="#" class="fab fa-instagram"></a>
        </div>
      </div>

      <div class="box">
        <h3>e-mail</h3>
        <!-- <a href="#social" class="link"></a> -->
        <a href="#social" class="link">jubingc15@gmail.com</a>
      </div>

      <div class="box">
        <h3>call us</h3>
        <p>+977 9823548051</p>
        <p>+977 9841586031</p>
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
      created by <span> Jubin Ghimire</span> | all rights reserved!
    </div>
  </section>

  <!-- footer ends -->

  <!-- swiper js link  -->
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

  <!-- custom js file link  -->
  <script src="scriptmain.js"></script>
</body>

</html>


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