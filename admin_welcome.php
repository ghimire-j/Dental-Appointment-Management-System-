<?php
// session_start();
require_once ('config.php');
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
  <link rel="stylesheet" href="profile.css" />

  <!-- custom css file link  -->
  <link rel="stylesheet" href="style.css" />
  <style>
        .home-button {
            background-color: #2f66d4;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin: 10px 0;
            text-decoration: none;
            position: absolute;
            /* top: 223px;
            left: 142px; */
            /* top: 30px; */
            left: 140px;
        }
    </style>
</head>
<?php
if (isset($_SESSION['loginMessage'])) {
  echo $_SESSION['loginMessage'];
  unset($_SESSION['loginMessage']);
}
?>

<body>
  <!-- Header Section -->
  <header class="header" style="display:none;">
    <nav class="navbar">
      <a href="#"><img src="images/logo.png" alt="logo" /></a>
      <a href="#home">Dashboard</a>
      <a href="#about">Doctors</a>
      <a href="#services">Patients</a>
      <a href="#team">Appointments</a>
      <a href="#pricing">Pricing</a>
      <a href="#Schedule">Schedule</a>
    </nav>

    <a href="#contact" class="btn"> Make Appointment </a>
    <div id="menu-btn" class="fas fa-bars"></div>

    <!-- LogOut button for user -->
    <!-- <a href="index.html" class="btn"> Logout </a> -->

    <a href="logout.php" class="btn"> Logout </a>


    <!-- <div id="profile">
      <a href="#"><img src="images/profile.png" alt="" /></a>
    </div> -->

    <div class="buttons">
      <div class="profile-dropdown">
        <div onclick="toggle()" class="profile-dropdown-btn">
          <div class="profile-img">

            <img src="images/profile.png" alt="Profile Image">

          </div>

          <span>Admin <i class="fa-solid fa-angle-down"></i></span>
        </div>


        <ul class="profile-dropdown-list">
          <div id="profile-details">
            <img src="images/profile.png" alt="User Logo" style="width: 50px; height: 50px;">
            <form action="uploadprofilepic.php" method="post" enctype="multipart/form-data">
              <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                onchange="this.form.submit()">
              <!-- <button type="button" onclick="document.getElementById('profile_picture').click()">upload</button> -->
            </form>
            <h1> Admin </h1>
            <p> jubingc15@gmail.com </p>

            <li class="profile-dropdown-list-item">
              <a href="Logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log out
              </a>
            </li>
        </ul>
      </div>
    </div>
  </header>





  <!-- services end-->

  <!-- team section -->

  <section class="team" id="team">
  <a href="http://localhost/edoc-doctor-appointment-system-main\admin\index.php" class="home-button">Home</a>

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
          <a href="admin_sama.php" class="btn">Feedbacks</a>
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
          <a href="admin_bimb.php" class="btn">Feedbacks</a>
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
          <a href="admin_shreya.php" class="btn">Feedbacks</a>
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
          <a href="admin_shilpi.php" class="btn">Feedbacks</a>
        </div>
      </div>
    </div>
  </section>

  <!-- team section ends -->

  <!-- pricing plan  -->



  <script>
    function validateForm(event) {
      // event.preventDefault(); // Prevent form submission

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
  </script>
  <!-- contact ends-->

  <!-- table -->
 

  <!-- footer ends -->

  <!-- swiper js link  -->
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

  <!-- custom js file link  -->
  <script src="scriptmain.js"></script>
  <script src="profilep.js"></script>

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