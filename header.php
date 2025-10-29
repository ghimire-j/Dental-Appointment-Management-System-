<header class="header">
    <div class="buttons">
        <?php if ($loggedIn): ?>
            <div class="profile-dropdown">
                <div onclick="toggle()" class="profile-dropdown-btn">
                    <div class="profile-img">

                        <?php if ($userdetail['Image'] !== null): ?>
                            <img src="<?php echo $userdetail['Image']; ?>" alt="Profile Picture">
                        <?php else: ?>
                            <img src="../../Media/Default/default.jpg" alt="Profile Image">

                        <?php endif; ?>
                    </div>

                    <span><?php echo $userdetail['fullname']; ?> <i class="fa-solid fa-angle-down"></i></span>
                </div>


                <ul class="profile-dropdown-list">
                    <div id="profile-details">
                        <?php if ($userdetail['Image'] !== null): ?>
                            <img src="<?php echo $userdetail['Image']; ?>" alt="Profile Picture"
                                style="width: 70px; height: 70px;">
                        <?php else: ?>
                            <img src="../../Media/Default/default.jpg" alt="User Logo" style="width: 100px; height: 100px;">
                            <form action="../../Backend/UserProfile/upload_profile_picture.php" method="post"
                                enctype="multipart/form-data">
                                <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                                    onchange="this.form.submit()">
                                <button type="button"
                                    onclick="document.getElementById('profile_picture').click()">upload</button>
                            </form>
                        <?php endif; ?>
                        <h1><?php echo $userdetail['fullname']; ?></h1>
                        <p><?php echo $userdetail['email']; ?></p>
                        <p><?php echo $userdetail['number']; ?></p>

                    </div>
                    <li class="profile-dropdown-list-item">

                        <a href="edit_profile.php">
                            <i class="fa-regular fa-user"></i>
                            Edit Profile
                        </a>
                    </li>
                    <li class="profile-dropdown-list-item">

                        <a href="Cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Cart
                        </a>
                    </li>

                    <li class="profile-dropdown-list-item">
                        <a href="#">
                            <i class="fa-regular fa-envelope"></i>
                            Inbox
                        </a>
                    </li>
                    <hr/>

                    <li class="profile-dropdown-list-item">
                        <a href="Logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Log out
                        </a>
                    </li>
                </ul>
            </div>

        <?php else: ?>
            <a href="Loginpage.php" class="Login">login</a>
            <a href="Registration.php" class="button">
                <span class="signup">Sign up</span>
                <span class="signup-2" aria-hidden="true">Sign up</span>
            </a>
        <?php endif; ?>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </div>
</header>