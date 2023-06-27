<?php
date_default_timezone_set('Asia/Manila');
$dir_path = "py/capture_images/images/";
$extensions_array = array('jpg', 'png', 'jpeg');
$search_query = isset($_GET['search']) ? $_GET['search'] : ''; // Get the search query from the URL parameter

if (!empty($search_query) && is_dir($dir_path)) { // Only proceed if search query is not empty and directory exists
    $files = scandir($dir_path);
    $found = false; // Flag to keep track if any images matching the search query are found

    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions_array)) {
            $timestamp = filemtime($dir_path . $file);
            $date = date('Y-m-d', $timestamp);
            $time = date('h:i:s A', $timestamp);
            $image_path = $dir_path . $file; // Construct the image path

            // Check if the date matches the search query
            if (strpos($date, $search_query) !== false) {
                // Output the image HTML
                echo '<a href="#">';
                echo '<img src="' . $image_path . '" style="width: 150px; height: 150px; object-fit:cover;">';
                echo '</a>';
                $found = true; // Set flag to true as matching image is found
            }
        }
    }

    if (!$found) { // If no images matching the search query are found
        echo 'No images found.';
    }
}
?>