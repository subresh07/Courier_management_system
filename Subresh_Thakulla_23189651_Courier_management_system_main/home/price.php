<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            background-image: url('../images/SAJHA_7.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .table-custom {
            background-color: #ffe599;
        }
    </style>
    <!-- Add Bootstrap CSS for styling the navbar -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #343a40;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }
        .navbar-custom .nav-link:hover {
            color: #d1d1d1;
        }
        .navbar-custom .navbar-nav .nav-item.active .nav-link {
            color: #f8f9fa;
            ;
            border-radius: 5px;
        }
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>

    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-custom">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.N</th> 
                        <th scope="col">Weight(kg)</th>
                        <th scope="col">Price(Rs)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>0-1.5</td>
                        <td>300</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>1.5-3</td>
                        <td>800</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>3-5</td>
                        <td>1500</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>5-8</td>
                        <td>2500</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>8-10</td>
                        <td>3500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  
    <div align='center' style="font-weight: bold; font-family: 'Times New Roman', Times, serif">
        <br><br><br><br>
        <h2>This is a SAJHA Courier Management Service</h2>
        <h3>The fastest courier service of Nepal</h3>
        <h4>As Per Your Courier Weight.<br> You can pay with ESEWA-9847301883 Khalti-976792001</h4>
    </div>
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
 