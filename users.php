<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | GUNI HMS</title>
</head>
<body>
    <style>
        body{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .list{
            margin-top: 15rem;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            width: 30%;
        }
        a{
            color: #fff;
            text-align: center;
            margin: 1rem;
            padding: 1rem;
            border-radius: 20px;
            font-size: 40px;
            text-decoration: none;
        }
        a:nth-child(1){
            background-color: #222E54;
        }
        a:nth-child(2){
            background-color: #3B76EF;
        }
        a:nth-child(3){
            background-color: #FFB051;
        }
        @media screen and (max-width:768px) {
            .list{
                width: 90%;
            }
        }
        @media screen and (max-width:500px) {
            a{
                font-size: 25px;
            }
        }
    </style>
    <div class="list">
        <a href="admin/login.php">Admin Login</a>
        <a href="doctor/login.php">Doctor Login</a>
    </div>
</body>
</html>