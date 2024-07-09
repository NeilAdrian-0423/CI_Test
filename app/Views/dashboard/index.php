<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .wrapper {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #adb5bd;
        }

        .content {
            flex: 1;
            margin-left: 250px;
            /* Adjust based on sidebar width */
            padding: 20px;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
        }

        .logo {
            display: block;
            margin-bottom: 20px;
            text-align: center;
        }

        .bottom {
            position: absolute;
            bottom: 0;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <?php if (session()->has('user_id')) : ?>
                    <a href="#">
                        <?php if (!empty($user['picture'])) : ?>
                            <a href="<?= site_url('dashboard/profile') ?>">
                                <img src="<?= base_url('public/uploads/' . $user['picture']) ?>" class="profile-picture" alt="Profile Picture">
                            </a>
                            <h5 class="card-title text-decoration-none"><?= $user['name'] ?></h5>
                        <?php else : ?>
                            <a href="<?= site_url('dashboard/profile') ?>">
                                <img src="<?= base_url('uploads/default.png') ?>" alt="Default Profile Picture">
                            </a>
                            <h5 class="card-title"><?= $user['name'] ?></h5>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            <ul>
                <li>
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fa fa-home"></i>
                        <span class="nav-text">Dasboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('dashboard/profile') ?>">
                        <i class="fa fa-user fa-lg"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('dashboard/search') ?>">
                        <i class="fa fa-search fa-lg"></i>
                        <span class="nav-text">Search</span>
                    </a>
                </li>
                <li class="bottom">
                    <a href="<?= site_url('auth/logout') ?>">
                        <i class="fa fa-sign-out fa-lg"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <!-- Content area -->
                <?php if (session()->has('user_id')) : ?>
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <?php if (!empty($user['picture'])) : ?>
                                <img src="<?= base_url('public/uploads/' . $user['picture']) ?>" alt="Profile Picture" class="profile-picture mb-3">
                            <?php else : ?>
                                <img src="<?= base_url('uploads/default.png') ?>" alt="Default Profile Picture" class="profile-picture mb-3">
                            <?php endif; ?>
                            <h5 class="card-title">Welcome, <?= $user['name'] ?></h5>
                            <p class="card-text">Email: <?= $user['email'] ?></p>
                            <!-- Add more user information as needed -->
                        </div>
                    </div>
                <?php else : ?>
                    <p class="text-danger">You are not logged in. Please <a href="<?= site_url('auth/login') ?>">login</a>.</p>
                <?php endif; ?>
            </div>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.wrapper -->

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>