$mysqli = new mysqli('localhost','root','','thesis_spc') or die ($mysqli->connect_error);
$table = 'images';

<?php
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    5 => 'Missing a temporary folder',
    6 => 'Failed to write file to disk',
    7 => 'A PHP extension stopped the file upload'
);

if (isset($_FILES['userfile'])) {
    $file_array = reArrayFiles($_FILES['userfile']);

    for ($i = 0; $i < count($file_array); $i++) {
        if ($file_array[$i]['error']) {
?> <div class="alert alert-danger">
                <?php echo "{$file_array[$i]['name']} - Invalid extension!" ?></div>
        <?php
        } else {
            move_uploaded_file(
                $file_array[$i]['tmp_name'],
                'captured_images/' . $file_array[$i]['name']
            );
        ?> <div class="alert alert-success">
                <?php echo $file_array[$i]['name'] . ' - ' . $phpFileUploadErrors[$file_array[$i]['error']]; ?></div>
<?php
        }
    }
}

function reArrayFiles(&$file_post)
{

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
