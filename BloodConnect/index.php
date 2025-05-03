<!DOCTYPE html>
<html>
<head>
    <title>Blood Donation Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            color: white;
            background-color: #e74c3c;
            padding: 12px 20px;
            margin: 10px;
            display: inline-block;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Welcome to the Blood Donation Portal</h2>
        <a href="user/login.php">User Login</a>
        <a href="admin/login.php">Admin Login</a>
        <a href="user/register.php">Register</a>
    </div>
</body>
</html>
