<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 50%;
            height: 50%;
            background-color: #f0f0f0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div>
        <form method="post" action="../Controllers/logCheckController.php">
            <label for="id">ID:</label>
            <input type="text" name="id" placeholder="Your ID">
            <label for="id">Pass:</label>
            <input type="text" name="pass" placeholder="Your Password"><br>
            <button type="submit">Login</button>
            <a href="../../home.php"><button type="button">Cancel</button></a>
        </form>
    </div>
</body>
</html>
