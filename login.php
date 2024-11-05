<?php 
$email = '';
$password = '';
$job = '';
$errors = array();
$successMessage = '';

$staticAccounts = [
    [
        'username' => 'patrick',
        'password' => 'carlpatrick',
        'position' => 'admin'
    ],
    [
        'username' => 'carlpatrick',
        'password' => 'patrick',
        'position' => 'content manager'
    ],
    [
        'username' => 'kuyapats',
        'password' => 'kuyapats',
        'position' => 'system user'
    ]
];

$jobPositions = [
    'admin' => 'Admin',
    'content manager' => 'Content Manager',
    'system user' => 'System User'
];

if (isset($_POST['btn'])) {
    $email = htmlspecialchars(stripslashes(trim($_POST['gmail'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password']))); 
    $job = $_POST['job'];

    if (empty($email)) {
        $errors[] = 'Email is required';
    } 

    if (empty($password)) {
        $errors[] = 'Password is required';
    } 

    if (empty($job)) {
        $errors[] = 'Position is required'; 
    }

    if (empty($errors)) {
        $validCredentials = false;
        foreach ($staticAccounts as $account) {
            if ($email === $account['username'] && $password === $account['password'] && $job === $account['position']) {
                $validCredentials = true;
                break;
            }
        }

        if ($validCredentials) {
            $successMessage = "Login successful! Welcome, $email!";
        } else {
            $errors[] = 'Invalid credentials. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body#LoginForm {
            background: whitesmoke;
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            color: white;
            margin: 0;
        }

        .main-div {
            background: white;
            border-radius: 10px;
            padding: 50px 70px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .panel h2 {
            color: #ff0077;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group input,
        .form-group select {
            height: 50px;
            border-radius: 30px;
            font-size: 16px;
            padding-left: 20px;
            border: 2px solid #ccc;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #ff0077;
            outline: none;
        }

        .btn-success {
            background: linear-gradient(45deg, #ff0077, #ff7e00);
            border: none;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            padding: 12px;
            font-size: 18px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #ff7e00, #ffd700);
        }

        .alert {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        .alert ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .form-text{
            color: black;
            text-align: center;
            font-weight: bold;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body id="LoginForm">
<div class="container">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger mt-3" id="errorMessages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($successMessage): ?>
        <div class="alert alert-success mt-3">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Login</h2>
                    <p class = "form-text">Please enter your email and password</p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="gmail" placeholder="Username" value="<?php echo htmlspecialchars($email); ?>" onfocus="clearErrors()" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" onfocus="clearErrors()" required>
                </div>
                <div class="form-group">
                    <select name="job" class="form-control" onfocus="clearErrors()" required>
                        <option value="">Select Job</option>
                        <?php foreach ($jobPositions as $value => $displayName): ?>
                            <option value="<?php echo $value; ?>" <?php echo ($job === $value) ? 'selected' : ''; ?>>
                                <?php echo $displayName; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success" name="btn" value="login" onclick="clearErrors()">Login</button>
            </div>
        </div>
    </form>     
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
    function clearErrors() {
        document.getElementById('errorMessages').innerHTML = '';
        document.getElementById('errorMessages').style.display = 'none';
    }
</script>
</body>
</html>
