<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu Example</title>

    <!-- MDBootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit/css/mdb.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>


    <!-- Avatar -->
    <li class="nav-item dropdown"> 
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
                        <h6 class="mb-0">Marie Campbell</h6> 
                        <p class="mb-2">mariecampbell@example.com</p> 
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
    </li>
    <style>
        .dropdown-menu.dropdown-menu-end.show {
            background-color: rgb(108, 108, 112);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit/js/mdb.min.js"></script>
    <script src="profilep.js"></script>
</body>

</html>