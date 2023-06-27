<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!--  Icons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
    <title>Login | BP Computers</title>
</head>

<body>
    <div class="container flex-display">
        <div class="flex-display flex-space-between login-container">
            <div class="login-form">
                <h1>Login</h1>
                <div>Doesn&apos;t have an account yet? <a href="#" target="_self">Sign Up</a></div>
                <form action="loginaccess.php" method="post">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <label>Username</label>
                    <input type="text" placeholder="exampleusername" name="uname">
                    <label class="flex-display flex-space-between"><span>Password</span> <span><a href="#">Forgot Password?</a></span></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <div class="flex-display flex-start"><input type="checkbox" checked="checked"> Remember me</div>
                    <button class="login-button">LOGIN</button>
                </form>
                <div>
                    <span class="line">or login with</span>
                </div>

                <div class="form-buttons">
                    <button class="flex-display flex-center"><i class='bx bxl-google'></i>Google</button>
                    <button><i class='bx bxl-facebook'></i>Facebook</button>
                </div>
            </div>
            <div class="image-part flex-display">
                <h1>BP COMPUTERS MONITORING SYSTEM</h1>
                <img src="images/profile.jpg" alt="image-computer">
            </div>
        </div>
    </div>
</body>

</html>