<?php
session_start();

include('connection.php');


$conn = mysqli_connect("localhost","root","","thesis_spc");


////////////////////////////
////////// edit ////////////
////////////////////////////

if(isset($_POST['save'])){
    $id = $_POST['edited_id'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $contact1 = $_POST['contact1'];
    $contact2 = $_POST['contact2'];
    $textarea_profile = $_POST['textarea_profile'];

    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($image != ''){
        $update_filename = $_FILES['image']['name'];
    } else {
        $update_filename = $old_image;
    }

    if (file_exists("upload_profile/".$_FILES['image']['name'])){
        $filename = $_FILES['image']['name'];

        $query = "UPDATE user SET email1='$email1',email2='$email2', contact1='$contact1',contact2='$contact2', textarea_profile='$textarea_profile',image = '$update_filename' WHERE id = '$id'" ;
        $query_run = mysqli_query($conn,$query);

        $_SESSION['success'] = "Information Updated!";
        header('Location: profile.php');

    } else{
        $query = "UPDATE user SET email1='$email1',email2='$email2', contact1='$contact1',contact2='$contact2', textarea_profile='$textarea_profile',image = '$update_filename' WHERE id = '$id'" ;
        $query_run = mysqli_query($conn,$query);


        if($query_run){

            if($_FILES['image']['name'] != ''){
                move_uploaded_file($_FILES["image"]["tmp_name"], "upload_profile/".$_FILES["image"]["name"]);
                unlink("upload_profile/".$old_image);
            }

            $_SESSION['success'] = "Updated Successfully!";
            header('Location: profile.php');

        } else {
            $_SESSION['status'] = "Image not updated!";
            header('Location: profile.php');
        }
    }
}





//////////////////////////////
/////////// show /////////////
//////////////////////////////

/*
if(isset($_POST['checking_viewbtn'])){
    $m_id = $_POST['profile_id'];

    $query = "SELECT * FROM user WHERE id = '$m_id' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            echo $return = '
            <input type="hidden" name="edited_id" value="'.$row['id'].'">
            <div class="profile-edit-modal-first-section">
            <div class="modal-nav">
                <ul>
                    <li class="image-button modal-nav-buttons"><button name="image_button" id="imageBtn">Profile Picture</button></li>
                    <li class="contact-button modal-nav-buttons"><button name="contact_button" id="contactBtn"  >Contacts</button></li>
                    <li class="background-button modal-nav-buttons"><button name="background_button" id="backgroundBtn">Background</button></li>
                </ul>
            </div>
        </div>
        <div class="vertical-line-separator-modal profile-edit-modal-middle-section"></div>
        <div class="profile-edit-modal-last-section">
            <form class="flex-display add-form" method="post" action="profile.php" enctype="multipart/form-data">
        
                <div class="image-edit flex-display flex-center" id="imageEdit">
                    <div class="flex-display image-container">
                        <div>
                            <img src="images/profile.jpg" alt="" id="profileDisplay" name="old_image">
                        </div>
                    </div>
                    <input type="file" name="image" id="file" onchange="displayImage(this)">
                    <label for="file" class="file-label flex-display flex-center" style="color: #ffffff;"><span><i class="fa-solid fa-camera"></i>/span></label>                                        
                    <div class="text-center">
                        <h4>'.$row['name'].'</h4>
                        <small>Designer</small>
                        <h4>Thesis author</h4>
                        <h5>since December 2022</h5>
                    </div>
                </div>
                <div class="contacts-edit" id="contactsEdit">
                    <h2>Contact Info</h2>
                    <div>
                        <div class="flex-display contact-holder flex-space-between">
                            <div class="flex-display email-edit">
                                <label for="">Email:</label>
                                <input type="text" placeholder="exampleemail1@gmail.com" value="'.$row['email1'].'" name="email1">
                                <input type="text" placeholder="exampleemail2@gmail.com" value="'.$row['email2'].'" name="email2">
                            </div>
                            <div class="flex-display number-edit">
                                <label for="">Phone/Cellphone #:</label>
                                <input type="text" placeholder="+63&#8211;9&#8211;0000&#8211;0000" value="'.$row['contact1'].'" name="contact1">
                                <input type="text" placeholder="+63&#8211;9&#8211;0000&#8211;0001" value="'.$row['contact2'].'" name="contact2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="background-edit" id="backgroundEdit">
                    <h2>Users Background</h2>

                </div>
                <div class="flex-display flex-end">
                    <button name="save">save</button>
                </div>
            </form>
        </div>
        ';
        }
    }
}

*/
