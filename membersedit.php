<?php
session_start();
include('connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/editmembers.css">

    <!--  Icons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">

    <title>Edit Members | BP Computers</title>
    <title>Document</title>
</head>

<body>
    <div class="members-edit-container flex-display">
        <div class="edit-members-container">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "thesis_spc");
            if (isset($_POST['data_edit'])) {
                $id = $_POST['edit_id'];

                $query = "SELECT * FROM members WHERE id = '$id' ";
                $query_run = mysqli_query($conn, $query);
                foreach ($query_run as $row) {
            ?>
                    <div class="flex-display flex-space-between">
                        <h1>Edit Staff</h1>
                        <a href="members.php" class="flex-display align-center">
                            <span class="close"><i class='bx bx-arrow-back'></i></span>
                        </a>
                    </div>
                    <form action="membersaction.php" method="POST" enctype="multipart/form-data" class="edit-form flex-display">
                        <input type="hidden" name="edited_id" value="<?php echo $row['id'] ?>">
                        <div class="flex-display flex-space-between">
                            <div class="flex-display add-modal-column">
                                <label>Full Name</label>
                                <input type="text" value="<?php echo $row['full_name'] ?>" name="full_name">
                            </div>
                            <div class="flex-display add-modal-column">
                                <label>ID number</label>
                                <input type="text" value="<?php echo $row['id_number'] ?>" name="id_number" readonly>
                            </div>
                        </div>
                        <div class="flex-display flex-space-between">
                            <div class="flex-display add-modal-column">
                                <label>Age</label>
                                <input type="text" value="<?php echo $row['age'] ?>" name="age" readonly>
                            </div>
                            <div class="flex-display add-modal-column">
                                <label>Birthdate</label>
                                <input type="date" value="<?php echo $row['birthdate'] ?>" name="birthdate">
                            </div>
                        </div>
                        <div class="flex-display flex-space-between">
                            <div class="flex-display add-modal-column">
                                <label>Address</label>
                                <input type="text" value="<?php echo $row['address'] ?>" name="address">
                            </div>
                            <div class="flex-display add-modal-column">
                                <label>Contact Number</label>
                                <input type="text" value="<?php echo $row['contact_number'] ?>" name="contact_number">
                            </div>
                        </div>
                        <div class="flex-display flex-space-between">
                            <div class="flex-display add-modal-column">
                                <label>Designation</label>
                                <div class="custom-select">
                                    <select name="designation">
                                        <option value="<?php echo $row['designation'] ?>"><?php echo $row['designation'] ?></option>
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
                                        <option value="<?php echo $row['gender'] ?>"><?php echo $row['gender'] ?></option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label>Description</label>
                        <textarea value="<?php echo $row['descriptions'] ?>" name="descriptions" rows="5"><?php echo $row['descriptions'] ?></textarea>
                        <div class="image-edit flex-display">
                            <div>
                                <img src="<?php echo "upload/" . $row['image'] ?>" onclick="triggerClick()" id="profileDisplay">
                            </div>
                            <div>
                                <input type="file" name="image" id="file" onchange="displayImage(this)">
                                <input type="hidden" value="<?php echo $row['image'] ?>" name="old_image">
                                <label for="file" class="file-label flex-display flex-center" style="color: #ffffff;"><i class='bx bx-camera'></i> Change photo</label>
                            </div>
                        </div>
                        <div class="flex-display flex-end">
                            <button name="update" type="submit">update</button>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/editmembers.js"></script>
</body>

</html>