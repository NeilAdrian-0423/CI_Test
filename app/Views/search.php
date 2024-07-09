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

        .result-img{
            max-width: 300px;
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
                <h1 class="mt-5 mb-4">Search Results</h1>

                <form id="searchForm">
                    <div class="form-group">
                        <label for="query">Search for images/videos:</label>
                        <input type="text" name="query" id="query" value="<?= set_value('query') ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <div id="resultsContainer" class="mt-4">
                    <!-- Results will be displayed here dynamically -->
                </div>

            </div>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                var query = $('#query').val(); // Get the query from input field

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('dashboard/search_action') ?>', // Adjust URL if necessary
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(response) {
                        displayResults(response.results); // Call function to display results
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            function displayResults(results) {
                var container = $('#resultsContainer');
                container.empty(); // Clear previous results

                if (results.length > 0) {
                    var html = '<div class="row">';
                    $.each(results, function(index, result) {
                        if (result.pageURL) {
                            html += '<div class="col-md-4 mb-3">';
                            html += '<img src="' + result.previewURL + '" alt="Result" class="result-img" />';
                            html += '</img>';
                            html += '</div>';
                        }
                    });
                    html += '</div>';
                    container.html(html);
                } else {
                    container.html('<p class="mt-3">No results found.</p>');
                }
            }

        });
    </script>
</body>

</html>