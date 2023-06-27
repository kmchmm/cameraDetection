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
        <link rel="stylesheet" type="text/css" href="css/members.css">

        <!--  Icons -->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="https://kit.fontawesome.com/ef8250c0e2.js" crossorigin="anonymous"></script>




        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
        <title>Members | BP Computers</title>
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
                        <li><a href="dashboard.php"><button><i class='bx bxs-dashboard'></i>Dashboard</button></a></li>
                        <li><a href="images.php"><button><i class='bx bxs-image'></i>Images Tracked</button></a></li>
                        <li class="convert-arrow"><a href="members.php"><button class="active"><i class='bx bxs-user-plus'></i>Members</button></a></li>
                        <li><a href="profile.php"><button><i class="material-icons">&#xe7fd;</i>Profile</button></a></li>
                    </ul>


                </div>

                <div class="second-section-container">
                    <div class="member-box">
                        <div class="flex-display flex-end">
                            <button class="add-button" id="addBtn"><i class='bx bx-plus-medical'></i>ADD</button>
                        </div>
                        <div class="container-fluid">
                            <?php
                            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                                echo '<h2 class="success-upload">' . $_SESSION['success'] . '</h2>';
                                unset($_SESSION['success']);
                            }
                            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                echo '<h2 class="status-upload">' . $_SESSION['status'] . '</h2>';
                                unset($_SESSION['status']);
                            }
                            if (isset($_SESSION['fail']) && $_SESSION['fail'] != '') {
                                echo '<h2 class="fail-upload">' . $_SESSION['fail'] . '</h2>';
                                unset($_SESSION['fail']);
                            }
                            ?>
                        </div>
                        <!------------------------->
                        <!-----------MODAL--------->
                        <!------------------------->
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div>
                                    <span class="close">&times;</span>
                                    <h1>New Staff</h1>
                                </div>
                                <div>
                                    <form class="flex-display add-form" method="POST" action="membersaction.php" enctype="multipart/form-data">
                                        <div class="flex-display flex-space-between">
                                            <div class="flex-display add-modal-column">
                                                <label>Full Name</label>
                                                <input type="text" placeholder="Admin name" name="full_name">
                                            </div>
                                            <div class="flex-display add-modal-column">
                                                <label>ID number</label>
                                                <input type="text" placeholder="00000000" name="id_number" readonly>
                                            </div>
                                        </div>
                                        <div class="flex-display flex-space-between">
                                            <div class="flex-display add-modal-column">
                                                <label>Age</label>
                                                <input type="text" placeholder="Calculated by Date of Birth" name="age" readonly>
                                            </div>
                                            <div class="flex-display add-modal-column">
                                                <label>Birthdate</label>
                                                <input type="date" placeholder="Birthdate" name="birthdate">
                                            </div>
                                        </div>
                                        <div class="flex-display flex-space-between">
                                            <div class="flex-display add-modal-column">
                                                <label>Address</label>
                                                <input type="text" placeholder="Admin City" name="address">
                                            </div>
                                            <div class="flex-display add-modal-column">
                                                <label>Contact Number</label>
                                                <input type="text" placeholder="0900000000" name="contact_number">
                                            </div>
                                        </div>
                                        <div class="flex-display flex-space-between">
                                            <div class="flex-display add-modal-column">
                                                <label>Designation</label>
                                                <div class="custom-select">
                                                    <select name="designation">
                                                        <option value="Designate a Job">SELECT</option>
                                                        <option value="Computer Technician">Computer Technician</option>
                                                        <option value="Graphic Designer">Graphic Designer</option>
                                                        <option value="Encoder">Encoder</option>
                                                        <option value="Video Editor">Video Editor</option>
                                                        <option value="Web Developer">Web Developer</option>
                                                        <option value="Web Designer">Web Designer</option>
                                                        <option value="Content Creator">Content Creator</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="flex-display add-modal-column">
                                                <label>Gender</label>
                                                <div class="custom-select">
                                                    <select name="gender" id="">
                                                        <option value="">Gender</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <label>Description</label>
                                        <textarea placeholder=" Lorem ipsum dolor sit amet consectetur adipisicing elit... " name="descriptions" rows="5"></textarea>
                                        <div class="flex-display image-container">
                                            <div>
                                                <img src="images/placeholder.png" alt="" onclick="triggerClick()" id="profileDisplay">
                                            </div>
                                            <div>
                                                <label for="file" class="file-label flex-display flex-center" style="color: #ffffff;"><i class='bx bx-camera'></i> Choose a photo</label>
                                                <input type="file" name="image" id="file" onchange="displayImage(this)">
                                            </div>
                                        </div>
                                        <div class="flex-display flex-end">
                                            <button name="save"> save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!------------------------->
                        <!----TABLE FOR MEMBERS---->
                        <!------------------------->
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "thesis_spc");
                        $query = "SELECT * FROM members";
                        $query_run = mysqli_query($conn, $query);
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th colspan="2">Description</th>
                                    <th>Image</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                        <tr>
                                            <td class="member_name" style="display: none;"><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['full_name'] ?></td>
                                            <td><?php echo $row['designation'] ?></td>
                                            <td colspan="2"><?php echo $row['descriptions'] ?></td>
                                            <td><?php echo '<img src="upload/' . $row['image'] . '" alt="image file" class="td-image">' ?>
                                            </td>
                                            <td class="action-buttons">
                                                <!--------------------->
                                                <!-----SHOW BUTTON----->
                                                <!--------------------->


                                                <button class="show-button" id="showBtn" name="show_data" value="<?php echo $row['id'] ?>"><i class="fa-regular fa-eye"></i> <span>VIEW</span></button>

                                                <div id="myShowModal" class="modal show-modal">
                                                    <div class="show_modal_content" style="color: #013237;">
                                                        <div>
                                                            <span class="show-close" data-dismiss="modal" aria-label="Close"><a href="members.php" rel="modal:close">&times;</a></span>
                                                            <h1>Staff's Information</h1>
                                                        </div>
                                                        <div class="flex-display flex-space-between show-modal-content-divs">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--------------------->
                                                <!-----EDIT BUTTON----->
                                                <!--------------------->

                                                <form action="membersedit.php" method="post">
                                                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                                    <button class="edit-button" id="editBtn" name="data_edit"><i class='bx bxs-edit'></i> <span>EDIT</span></button>
                                                </form>


                                                <!-------------------->
                                                <!---DELETE BUTTON---->
                                                <!-------------------->
                                                <form action="membersaction.php" method="post">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                                    <input type="hidden" name="delete_image" value="<?php echo $row['image'] ?>">
                                                    <button class="del-button" type="submit" name="data_delete"><i class='bx bxs-trash'></i> <span>DELETE </span></button>
                                                </form>
                                            </td>
                                        </tr>

                                <?php
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

            <!--------MAIN PART---------->

            <footer></footer>

        </div>

        <script src="js/main.js"></script>
        <script src="js/members.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {

                $('.show-button').click(function(e) {
                    e.preventDefault();

                    var member_name = $(this).closest('tr').find('.member_name').text();

                    $.ajax({
                        type: "POST",
                        url: "membersaction.php",
                        data: {
                            'checking_viewbtn': true,
                            'members_id': member_name,
                        },
                        success: function(response) {
                            $('.show-modal-content-divs').html(response);
                            $('#myShowModal').modal('show');
                        }
                    });

                });
            });
        </script>
    </body>

    </html>



<?php

} else {
    header("Location: login.php");
    exit();
}
?>