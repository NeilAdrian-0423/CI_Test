<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">+<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-TkZm9TjK2/pE2ZwWPMKZ6fSotBVH0ok7fEKx43sE9IETyjT3Jh2vk0syVMr5F1pFWAFxOM40F4uHvH4m8o+J9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .form-container {
            background-color: #F0F5F9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 100%;
            width: 100%;
        }

        .form-container h1 {
            color: #1E2022;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            color: #1E2022;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="file"] {
            width: 100%;
            height: 40px;
            font-size: 16px;
            color: #1E2022;
            padding: 8px;
            background-color: #F0F5F9;
            border: 1px solid #1E2022;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .form-container button[type="submit"] {
            width: 100%;
            height: 40px;
            background-color: #1E2022;
            color: #F0F5F9;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button[type="submit"]:hover {
            background-color: #52616B;
        }

        .error-msg {
            color: red;
            margin-bottom: 10px;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 20px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            top: 10px;
            z-index: 1;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all .2s ease-in-out;
            text-align: center;
        }

        .avatar-upload .avatar-edit label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
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
                        <span class="nav-text">Dashboard</span>
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
                <div class="form-container">
                    <h1 class="text-black">Profile</h1>

                    <?php if (isset($validation)) : ?>
                        <div class="error-msg">
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open_multipart('dashboard/update_profile'); ?>
                    <div class="form-group">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="profile_picture" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url(<?php echo !empty($user['picture']) ? base_url('public/uploads/' . $user['picture']) : base_url('uploads/default.png'); ?>);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-50 mx-auto">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="<?= set_value('name', $user->name ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" value="<?= set_value('email', $user->email ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password (leave blank to keep current password):</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.wrapper -->

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- jQuery for image preview -->
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function() {
                readURL(this);
            });
        </script>
</body>

</html>