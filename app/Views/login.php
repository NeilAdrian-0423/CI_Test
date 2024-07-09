<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets\css\bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(#1E2022, #52616B);
            overflow: hidden;
        }

        .wrapper {
            width: 400px;
            padding: 30px;
            background: #F0F5F9;
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 10px;
        }

        h1 {
            font-size: 30px;
            color: #1E2022;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 16px;
            color: #1E2022;
        }

        .form-control {
            font-size: 16px;
            color: #1E2022;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(to right, #1E2022, #52616B);
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
            font-size: 16px;
            color: #F0F5F9;
            font-weight: 500;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }

        .btn-primary:hover {
            background: #1E2022;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Login</h1>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?= form_open('auth/login_action', ['class' => 'needs-validation', 'novalidate' => '']); ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>" required>
            <div class="invalid-feedback">
                Please provide a valid email.
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <div class="invalid-feedback">
                Please provide a password.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="mt-2 d-flex">
            <p>Don't have an account?</p><a href="<?php echo base_url(); ?>auth/register" class="ms-1">Register Now!</a>
        </div>
        <?= form_close(); ?>
    </div>

    <script>
        // Bootstrap form validation
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets\js\bootstrap.min.js"></script>
</body>

</html>