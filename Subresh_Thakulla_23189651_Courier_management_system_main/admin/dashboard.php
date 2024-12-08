<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: grey;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #f8f9fa;
        }
        .admintitle {
            background: rgba(255, 255, 255, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 800px;
        }
        .admintitle h1 {
            text-shadow: 0.1em 0.1em 0.15em #f9829b;
            margin: 0;
            color: #f9829b;
        }
        .links {
            background:rgba(255, 255, 255, 0.8);
            color: lightblue;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
            width: 80%;
            max-width: 800px;
        }
        .links a {
            display: inline-block;
            margin: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: lightblue;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #ffffff;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            background: rgba(0, 0, 0, 0.8);
        }
        .navbar a {
            color: aliceblue;
            text-decoration: none;
            padding: 15px;
            font-weight: bold;
        }
        .navbar a:hover {
            color: #f9829b;
        }
        .btn-custom {
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #495057;
            transform: scale(1.05);
        }
        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger-custom:hover {
            background-color: #bd2130;
            border-color: #bd2130;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h5><a href="../index.php">LoginAsUser</a></h5>
        <h5><a href="logout.php">LogOut</a></h5>
    </div>
    <div class="admintitle">
        <h1>Welcome To Admin Dashboard</h1>
    </div>
    <div class="links">
        <a href="deletedata.php" class="btn btn-primary-custom btn-lg btn-custom">Delete Data</a>
        <a href="deleteusers.php" class="btn btn-danger-custom btn-lg btn-custom">Delete Users</a>
    </div>
</body>

</html>
