<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .form-control-file {
            font-size: 16px;
            color: #1E2022;
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
        <h1>Register</h1>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <?= form_open_multipart('auth/register_action', ['class' => 'needs-validation', 'novalidate' => '']); ?>
        <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name'); ?>" required>
            <div class="invalid-feedback">
                Please provide a name.
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" required>
            <div class="invalid-feedback">
                Please provide a valid email.
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
            <div class="invalid-feedback">
                Please provide a password.
            </div>
        </div>
        <div class="form-group">
            <label for="picture" class="form-label">Profile Picture:</label>
            <input type="file" class="form-control-file" name="picture" id="picture" required>
            <div class="invalid-feedback">
                Please upload a profile picture.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <div class="mt-2 d-flex">
            <p>Already have an Account?</p>
            <a href="<?php echo base_url(); ?>" class="ml-1">Login Here!</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>