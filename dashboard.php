<?php
session_start();

include('connection.php');

$connect = mysqli_connect("localhost", "root", "", "thesis_spc");
$gender = "SELECT gender, count(*) as number FROM members GROUP BY gender";
$resultgender = mysqli_query($connect, $gender);
$designation = "SELECT designation, count(*) as number FROM members GROUP BY designation";
$resultdesignation = mysqli_query($connect, $designation);



if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

    <?php

    if (isset($_POST['save'])) {
        $member_id = mysqli_real_escape_string($connect, $_POST['member_idnumber']);
        $sql = "SELECT * from members where id_number = $'member_id'";
        $res = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            $r = mysqli_fetch_assoc($res);
            $_SESSION['UID'] = $r['id'];
            header('Location:dashboard.php');
        }
    }
    ?>



    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />


        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">

        <!--  Icons -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">



        <!-- charts -->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Gender', 'Number'],

                    <?php
                    while ($row = mysqli_fetch_array($resultgender)) {
                        echo "['" . $row["gender"] . "', " . $row["number"] . "],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Gender',
                    backgroundColor: '#ffffff',
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart-gender'));

                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Designation', 'Number'],

                    <?php
                    while ($row = mysqli_fetch_array($resultdesignation)) {
                        echo "['" . $row["designation"] . "', " . $row["number"] . "],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Designation / Jobs',
                    backgroundColor: '#ffffff',
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart-designation'));

                chart.draw(data, options);
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#executeButton').click(function() {
                    $.post('/execute', function(response) {
                        alert(response);
                    });
                });
            });
        </script>


        <title>Dashboard | BP Computers</title>
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
                                            echo '<a href="members.php">' . $notif_result['full_name'] . ' added to members!</a>';
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
                                    <a href="profile.php">
                                        <span class="td-image">
                                            <?php echo '<img src="upload_profile/' . $r['image'] . '" alt="image file" style="width:80%;">' ?>
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
                        <li><a href="dashboard.php"><button class="active"><i class='bx bxs-dashboard'></i>Dashboard</button></a></li>
                        <li><a href="images.php"><button><i class='bx bxs-image'></i>Images Tracked</button></a></li>
                        <li class="convert-arrow"><a href="members.php"><button><i class='bx bxs-user-plus'></i>Members</button></a></li>
                        <li><a href="profile.php"><button><i class="material-icons">&#xe7fd;</i>Profile</button></a></li>
                    </ul>

                </div>


                <div class="second-section-container">
                    <div class="search-wrapper flex-display flex-space-between">
                        <h1 class="text-center">Welcome <?php echo $_SESSION['name'] ?>!</h1>

                    </div>

                    <div class="flex-display flex-end capture-buttons">
                        <form method="post">
                            <input type="submit" name="run_python" value="Start Camera">
                        </form>
                        <?php
                        if (isset($_POST['run_python'])) {
                            // Execute the Python file
                            exec('D:/DOCUMENTS/xampp/htdocs/cameraDetection/py/capture_images/capture.py');
                        }
                        ?>
                        <form action="">
                            <button>Match Images</button>
                        </form>
                    </div>

                    <div class="second-section-upper-container flex-display flex-space-between">
                        <div class="s-c-div-1">

                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "thesis_spc");
                            $sql = "SELECT count(*) FROM members";
                            $result = mysqli_query($conn, $sql);

                            $query = "SELECT * FROM members";
                            $query_run = mysqli_query($conn, $query);
                            ?>

                            <div class="flex-display flex-space-between flex-column main-divs">
                                <div>
                                    <span>
                                        <h4>Number of Staffs</h4>
                                    </span>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <p><?php echo $row['count(*)'] ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <button id="myBtn1">View All Staffs</button>

                                    <!-- The Modal -->
                                    <div id="myModal1" class="modal1">

                                        <!-- Modal content -->
                                        <div class="modal-content-intrusions">
                                            <span class="close1">&times;</span>
                                            <h2>NUMBER OF STAFFS</h2>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Image</th>
                                                        <th>More Info</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $row['full_name'] ?></td>
                                                                <td><?php echo '<img src="upload/' . $row['image'] . '" width="100px" height = "100px" alt="image file">' ?></td>
                                                                <td class="more-info"><a href="members.php"><button>click here</button></a></td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="s-c-div-3 record-tracking">
                            <div class="flex-display flex-space-between flex-column main-divs">
                                <div>
                                    <span>
                                        <h4>Log Records</h4>
                                    </span>
                                    <p>00</p>
                                </div>
                                <div>
                                    <button id="myBtn4">View All Records</button>
                                    <!-- The Modal -->
                                    <div id="myModal4" class="modal4">
                                        <!-- Modal content -->
                                        <div class="modal-content-records">
                                            <span class="close4">&times;</span>
                                            <h2>RECORDS TRACKED</h2>
                                            <form action="#" method="GET" class="mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search by date..." name="search" style="width:100%;">
                                                    <div class="input-group-append flex-display flex-center ">
                                                        <button type="submit" class="btn btn-primary" style="background-color:#013237; color:#ffffff; width:40%; padding: 15px;">Search</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <table>
                                                <div class="" style="max-width:95%; min-height:100px; object-fit:cover; flex-wrap:wrap; gap:2em;">
                                                    <h2 style="color:#013237; margin-top:1em;">SEARCH RESULTS</h2>
                                                    <div class="flex-display flex-space-around" style="flex-wrap:wrap; gap:2em; margin: 0 auto;">
                                                        <?php
                                                        include('include_images.php');
                                                        ?>
                                                    </div>
                                                </div>
                                                <hr style="background-color:#013237;">
                                                <hr style="background-color:#013237;">
                                                <hr style="background-color:#013237;">
                                                <hr style="background-color:#013237;">
                                                <hr style="margin-bottom: 2em; background-color:#013237;">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="second-section-lower-container flex-display flex-space-between">
                        <div class="graph-div">
                            <h2>Charts</h2>
                            <div class="flex-display flex-evenly graphs">
                                <div id="piechart-gender"></div>
                                <div id="piechart-designation"></div>
                            </div>
                        </div>
                    </div>
                    <!--------DASHBOARD---------->
                    <footer>
                    </footer>
                </div>
            </section>

        </div>
        <script src="js/main.js"></script>
        <script src="js/dashboard.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    </body>

    </html>
<?php

} else {
    header("Location: login.php");
    exit();
}
?>