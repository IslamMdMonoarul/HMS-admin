<!DOCTYPE html>
<html>
<head>
    <title>MM Hospital</title>

    <style>
        body {
            background-image: url('pic/1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .center {
            text-align: center;
            margin-top: 50px; 
        }

        .login-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease; /* Smooth transition for color change */
        }

        .login-button:hover {
            background-color: #0056b3; /* Change color on hover */
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }   

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {

            color: white;
        }

        .photo-row {
            display: flex;
        }

        .photo-container {
            flex: 1;
            margin: 0 5px; /* Adjust margin as needed */
            text-align: center;
        }

        .photo-container img {
            width: 100%;
            height: 300px;
            border: 4px solid black;
            box-sizing: border-box;
        }

        .photo-container button {
            margin-top: 5px; /* Adjust margin as needed */
        }
    </style>
</head>
<body>
    <div class="topnav">
        <h1 style="color:ghostwhite;padding-left:16px" class="text-white">Hospital Management System</h1>
        <a class="active" href="home.php">Home</a>
        <a href="MVC/Views/about.php">About</a>
        <a href="MVC/Controllers/logController.php" class="nav-link text-white">Admin</a>
        <a href="#" class="nav-link] text-white">Doctor</a>
        <a href="#" class="nav-link text-white">Patient</a>
        <a href="MVC/Views/contact.php">Contact</a>
    </div><br>

    <div class="photo-row">
        <div class="photo-container">
            <img src="pic/info.jpg" alt="Photo 1">
            <a href="MVC/Views/about.php"><button>More information</button></a>
        </div>
        <div class="photo-container">
            <img src="pic/patient.jpg" alt="Photo 2">
            <button>Patient</button>
        </div>
        <div class="photo-container">
            <img src="pic/docter.jpg" alt="Photo 3">
            <button>Doc</button>
        </div>
    </div>

    <div class="center">
        <a href="MVC/Controllers/logController.php" class="login-button">Login</a>
    </div>

</body>
</html>
