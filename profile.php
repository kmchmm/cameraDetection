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
        <link rel="stylesheet" type="text/css" href="css/profile.css">

        <!--  Icons -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="https://kit.fontawesome.com/ef8250c0e2.js" crossorigin="anonymous"></script>

        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
        <title>Profile | BP Computers</title>
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
                            <?php
                            $q = mysqli_query($conn, "SELECT * FROM user WHERE user_name = '$_SESSION[user_name]'");
                            $r = mysqli_fetch_assoc($q);
                            ?>
                            <li class="dropdown">
                                <h4 onclick="myFunction()" class="dropbtn flex-display"><?php echo $_SESSION['name']; ?>
                                    <i class='bx bx-chevron-down dropbtn'></i>
                                </h4>

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
                        <li><a href="images.php"><button><i class='bx bxs-image'></i>Images Tracked</button></a></li>
                        <li class="convert-arrow"><a href="members.php"><button><i class='bx bxs-user-plus'></i>Members</button></a></li>
                        <li><a href="profile.php"><button class="active"><i class="material-icons">&#xe7fd;</i>Profile</button></a></li>
                    </ul>

                </div>


                <!--------MAIN PART---------->
                <div class="second-section-container">
                    <div class="flex-display flex-end">

                        <form action="profileedit.php" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $_SESSION['id'] ?>">
                            <button class="add-button" id="addBtn" value="" name="data_edit">Edit Profile</button>
                        </form>
                    </div>


                    <div class="flex-display flex-space-between second-section-container-division">
                        <div class="second-section-division first-division flex-display">
                            <div class="first-division-container first-division flex-display">
                                <div>
                                    <?php echo '<img src="upload_profile/' . $r['image'] . '" alt="image file" class="td-image">' ?>
                                </div>
                                <div class="text-center">
                                    <h4><?php echo $_SESSION['name'] ?></h4>
                                    <small>Designer</small>
                                    <h4>Thesis author</h4>
                                    <h5>since December 2022</h5>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-line-separator"></div>
                        <div class="second-section-division second-division">
                            <div class="flex-display flex-space-between second-division-lists">
                                <div class="contacts">
                                    <h4>Contact Info</h4>
                                    <ul>
                                        <li><a href="#"><?php echo $r['email1'] ?></a></li>
                                        <li><a href="#"><?php echo $r['email2'] ?></a></li>
                                        <li><a href="#" class="edited-a"><?php echo $r['contact1'] ?></a></li>
                                        <li><a href="#" class="edited-a"><?php echo $r['contact2'] ?></a></li>
                                    </ul>
                                </div>
                                <div class="links">
                                    <h4>Links</h4>
                                    <ul>
                                        <li><a href="#" target="_blank">Facebook</a></li>
                                        <li><a href="#" target="_blank">LinkedIn</a></li>
                                        <li><a href="#" target="_blank">Instagram</a></li>
                                        <li><a href="#" target="_blank">Twitter</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="second-division-paragraphs">
                                <h4>
                                    User&apos;s background
                                </h4>
                                <p placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore odio illo error quae incidunt molestias a odit eos atque illum possimus voluptate nostrum modi distinctio magni debitis veniam, itaque non!">
                                    <?php echo $r['textarea_profile'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <footer>
                    </footer>
                </div>
            </section>



        </div>
        <script src="js/main.js"></script>
        <script src="js/profile.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <!-----
    <script>

        $(document).ready(function(){

            $('.add-button').click(function(e) {
                e.preventDefault();
                
                var profile_edit = $(this).closest('div').find('.second-section-container-division').text();  

                $.ajax({
                    type: "POST",
                    url: "profileactions.php",
                    data: {
                        'checking_viewbtn': true,
                        'profile_id': profile_edit,
                    },
                    success: function (response){
                        $('.profile-edit-modal').html(response);
                        $('#myModal').modal('show');
                    }
                });
                
            });
        });
    </script>
    -->
    </body>

    </html>

<?php
} else {
    header("Location: login.php");
    exit();
}
?>