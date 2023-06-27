<?php
session_start();

include('connection.php');

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />


        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/images.css">

        <!--  Icons -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="https://kit.fontawesome.com/ef8250c0e2.js" crossorigin="anonymous"></script>

        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
        <title>Images | BP Computers</title>
    </head>

    <body onload="initClock()">

        <div class="container">
            <!----------NAVIGATION------------>
            <header>
                <nav class="flex-display flex-space-between">
                    <div class="flex-display nav-first-div">
                        <img src="images/profile.jpg">
                        <h1>BP Computers</h1>
                    </div>
                    <div class="flex-display flex-space-between notification-div">

                        <ul class="hamburger-nav">
                            <li aria-controls="first-section-container" aria-expanded="false" class="barNav">
                                <div class="bar"></div>
                                <div class="bar"></div>
                                <div class="bar"></div>
                            </li>
                        </ul>
                        <?php
                        $sql_get = mysqli_query($conn, "SELECT * FROM members WHERE status=0");
                        $sql_get1 = mysqli_query($conn, "SELECT * FROM images WHERE status=0");
                        $count = mysqli_num_rows($sql_get);
                        $count1 = mysqli_num_rows($sql_get1);
                        ?>
                        <ul class="flex-display notifications">
                            <li class="dropdown">
                                <i class='bx bxs-chat dropbtn' onclick="myFunction1()"></i><span class="" id="message_count"><?php echo $count1; ?></span>

                                <div id="myDropdown1" class="dropdown-content">
                                    <?php
                                    $sql_get_notif1 = mysqli_query($conn, "SELECT * FROM images WHERE status=0");
                                    if (mysqli_num_rows($sql_get_notif1) > 0) {
                                        while ($notif_result1 = mysqli_fetch_assoc($sql_get_notif1)) {
                                            echo '<a href="images.php">Intruder Detected! Check here.</a>';
                                        }
                                    }
                                    ?>
                                    <a href="#" class="message-view">View All Messages</a>
                                </div>
                            </li>

                            <li class="dropdown">
                                <i class='bx bxs-bell dropbtn' onclick="myFunction2()"></i><span class="" id="notif_count"><?php echo $count; ?></span>

                                <div id="myDropdown2" class="dropdown-content">
                                    <?php
                                    $sql_get_notif = mysqli_query($conn, "SELECT * FROM members WHERE status=0");
                                    if (mysqli_num_rows($sql_get_notif) > 0) {
                                        while ($notif_result = mysqli_fetch_assoc($sql_get_notif)) {
                                            echo '<a href="members.php>' . $notif_result['full_name'] . ' added to members!</a>';
                                        }
                                    }
                                    ?>
                                    <a href="#" class="notification-view">All Notifications</a>
                                </div>
                            </li>

                            <li class="dropdown">
                                <h4 onclick="myFunction()" class="dropbtn flex-display"><?php echo $_SESSION['name']; ?>
                                    <i class='bx bx-chevron-down dropbtn'></i>
                                </h4>
                                <?php
                                $q = mysqli_query($conn, "SELECT * FROM user WHERE user_name = '$_SESSION[user_name]'");
                                $r = mysqli_fetch_assoc($q);
                                ?>
                                <div id="myDropdown" class="dropdown-content">
                                    <a href="profile.php" class="flex-display flex-space-between">
                                        <span>
                                            <?php echo '<img src="upload_profile/' . $r['image'] . '" alt="image file" class="td-image" style="width:80%;">' ?>
                                        </span>
                                        <span>
                                            <b><?php echo $_SESSION['name']; ?></b>
                                            <small>admin</small>
                                        </span>
                                    </a>
                                    <div class="dropdown-br"></div>
                                    <a href="#"><i class="material-icons">&#xe7fd;</i> Account</a>
                                    <a href="#"><i class='bx bxs-cog'></i> Settings</a>
                                    <div class="dropdown-br"></div>
                                    <a href="logout.php"><i class='bx bx-power-off'></i> Logout</a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </header>

            <!--------LEFT SIDE DASHBOARD---------->
            <section class="flex-display">
                <div class="first-section-container" data-visible="false">
                    <div class="datetime">
                        <div class="date flex-display flex-center">
                            <span id="dayname">Day</span>
                            <span>&ndash;</span>
                            <span id="month">Month</span>
                            <span id="daynum">00</span>,
                            <span id="year">Year</span>
                        </div>
                        <div class="time flex-display flex-center">
                            <span id="hour">00</span>:
                            <span id="minutes">00</span>:
                            <span id="seconds">00</span>
                            <span id="period">AM</span>
                        </div>
                    </div>
                    <ul class="">
                        <li><a href="dashboard.php"><button><i class='bx bxs-dashboard'></i>Dashboard</button></a></li>
                        <li><a href="images.php"><button class="active"><i class='bx bxs-image'></i>Images Tracked</button></a></li>
                        <li class="convert-arrow"><a href="members.php"><button><i class='bx bxs-user-plus'></i>Members</button></a></li>
                        <li><a href="profile.php"><button><i class="material-icons">&#xe7fd;</i>Profile</button></a></li>
                    </ul>

                </div>

                <div class="second-section-container">
                    <!--------MAIN PART---------->
                    <div class="image-box">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time (PST)</th>
                                    <th>Images</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                date_default_timezone_set('Asia/Manila');
                                $dir_path = "py/capture_images/images/";
                                $extensions_array = array('jpg', 'png', 'jpeg');
                                if (is_dir($dir_path)) {
                                    $files = scandir($dir_path);

                                    foreach ($files as $file) {
                                        if ($file != '.' && $file != '..' && in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions_array)) {
                                            $timestamp = filemtime($dir_path . $file);
                                            $date = date('Y-m-d', $timestamp);
                                            $time = date('h:i:s A', $timestamp);
                                            $image_path = $dir_path . $file; // Construct the image path

                                ?>
                                            <tr>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td><a href="images.php"><img src="<?php echo $image_path; ?>" style="width: 150px; height: 150px; object-fit:cover;"></a></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <footer>
                    </footer>
                </div>
            </section>


            <footer></footer>

        </div>
        <script src="js/main.js"></script>
        <script src="js/profile.js"></script>
    </body>

    </html>



<?php

} else {
    header("Location: login.php");
    exit();
}
?>