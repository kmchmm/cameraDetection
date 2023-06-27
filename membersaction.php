<?php
session_start();

include('connection.php');



$conn = mysqli_connect("localhost","root","","thesis_spc");


////////////////////////////
/////////// add ////////////
////////////////////////////
if (isset($_POST['save'])){

    echo "<pre>", print_r($_FILES['image']['name']), "</pre>";
    $fname = $_POST['full_name'];
    $idnum = rand(100000,999999);
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];
    $designation = $_POST['designation'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $age = date_diff(date_create($birthdate),date_create('today'))->y;
    $description = $_POST['descriptions'];
    $gender = $_POST['gender'];
    $image = $_FILES['image']['name'];

    $target = "upload/".basename($_FILES['image']['name']);
    
    if (file_exists("upload/" . $_FILES["image"]["name"])){
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already existed!";
       header('Location: members.php');
    } else {
        $query = "INSERT INTO members (full_name,id_number,age,address,contact_number,designation,birthdate,descriptions,gender,image) VALUES ('$fname','$idnum','$age','$address','$contact','$designation','$birthdate','$description','$gender','$image')";

        mysqli_query($conn, $query);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

            $_SESSION['success'] = "Data successfully uploaded!";
            header("Location: members.php");
        } else {
            $_SESSION['fail'] = 'Data not inserted';
            header("Location:members.php");
        }
    }
    if (!$fname){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$idnum){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$contact){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$birthdate){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$gender){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$designation){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }
    if (!$description){
        $_SESSION['status'] = "Some data missing!";
        header('Location: members.php');
    }

}

////////////////////////////
////////// edit ////////////
////////////////////////////

if(isset($_POST['update'])){
    $id = $_POST['edited_id'];
    $fname = $_POST['full_name'];
    $idnum = $_POST['id_number'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];
    $designation = $_POST['designation'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $age = date_diff(date_create($birthdate),date_create('today'))->y;
    $description = $_POST['descriptions'];
    $gender = $_POST['gender'];

    $image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($image != ''){
        $update_filename = $_FILES['image']['name'];
    } else {
        $update_filename = $old_image;
    }

    if (file_exists("upload/".$_FILES['image']['name'])){
        $filename = $_FILES['image']['name'];

        $query = "UPDATE members SET full_name='$fname',id_number='$idnum', age='$age',address='$address', contact_number='$contact', designation ='$designation', birthdate='$birthdate', descriptions = '$description', gender='$gender',image = '$update_filename' WHERE id = '$id'" ;
        $query_run = mysqli_query($conn,$query);

        $_SESSION['success'] = "Information Updated!";
        header('Location: members.php');

    } else{
        $query = "UPDATE members SET full_name='$fname',id_number='$idnum', age='$age',address='$address', contact_number='$contact', designation ='$designation', birthdate='$birthdate', descriptions = '$description', gender='$gender',image = '$update_filename' WHERE id = '$id'" ;
        $query_run = mysqli_query($conn,$query);


        if($query_run){

            if($_FILES['image']['name'] != ''){
                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/".$_FILES["image"]["name"]);
                unlink("upload/".$old_image);
            }

            $_SESSION['success'] = "Updated Successfully!";
            header('Location: members.php');

        } else {
            $_SESSION['status'] = "Image not updated!";
            header('Location: members.php');
        }
    }
}


//////////////////////////////
/////////// show /////////////
//////////////////////////////


if(isset($_POST['checking_viewbtn'])){
    $m_id = $_POST['members_id'];

    $query = "SELECT * FROM members WHERE id = '$m_id' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            echo $return = '
            <div class="first-content-divs">
                <div class="flex-column">
                    <div>
                        <img src="upload/'.$row['image'].'" alt="image file" class="td-image">
                    </div>
                    <div class="flex-display flex-column text-center" style="font-weight: 700;">
                        <div>
                            '.$row['full_name'].'
                        </div>
                        <small style="color: #4CA771;">
                           '.$row['designation'].'
                        </small>
                    </div>
                </div>
            </div>


            <div class="flex-display flex-column second-content-divs">
                <div class="flex-display flex-space-between staff-info">

                    <div class="flex-display flex-column">
                        <div class="flex-display flex-column text-left">
                            <span>ID number</span>
                            '.$row['id_number'].'
                        </div>
                        <div class="flex-display flex-column text-left">
                            <span>Contact Number</span>
                            '.$row['contact_number'].'   
                        </div>  
                        <div class="flex-display flex-column text-left">
                            <span>Gender</span>
                            '.$row['gender'].'
                        </div>                                                        
                    </div>

                    <div class="flex-display flex-column">
                        <div class="flex-display flex-column text-left">
                            <span>Address</span>
                            '.$row['address'].'
                        </div>
                        <div class="flex-display flex-column text-left">
                            <span>Age</span>
                            '.$row['age'].'
                        </div>
                        <div class="flex-display flex-column text-left">
                            <span>Birthdate</span>
                            '.$row['birthdate'].'
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex-display flex-column text-left">
                        <span>Description</span>
                        '.$row['descriptions'].'
                    </div>
                    <div>
                        
                    </div>
                </div>
            </div>
            ';
        }
    }
}



//////////////////////////////
////////// delete ////////////
//////////////////////////////

if(isset($_POST['data_delete'])){

    $id = $_POST['delete_id'];
    $member_image = $_POST['delete_image'];
    
    
    $query = "DELETE FROM members WHERE id = '$id'" ; 
    $query_run = mysqli_query($conn,$query);


    if($query_run){

        unlink("upload/".$member_image);
        $_SESSION['success'] = "Data successfully deleted!";
        header("Location: members.php");

    } else {
        $_SESSION['success'] = "Data not deleted!";
        header("Location: members.php");

    }

}
