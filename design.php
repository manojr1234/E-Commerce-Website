<?php
// Set error reporting to show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$db = mysqli_connect("localhost", "root", "", "tshirt_store");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['upload'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./image/" . $filename;

        // Check if file already exists in database
        $result = mysqli_query($db, "SELECT COUNT(*) AS count FROM image WHERE filename='$filename'");
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] > 0) {
            $msg = "File already exists.";
        } else {
            // Insert new filename into database
            $sql = "INSERT INTO image (filename) VALUES ('$filename')";
            if (mysqli_query($db, $sql)) {
                // Move uploaded file to specified folder
                if (!is_dir('./image')) {
                    mkdir('./image');
                }
                if (move_uploaded_file($tempname, $folder)) {
                    $msg = "Image uploaded successfully!";
                } else {
                    $msg = "Failed to move uploaded file.";
                }
            } else {
                $msg = "Failed to insert filename into database.";
            }
        }
    } else {
        $msg = "Failed to upload file. Please try again.";
    }
}

// Display the uploaded images
$query = "SELECT * FROM image";
$result = mysqli_query($db, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sty.css" />
</head>
<body>
    <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <?php if (!empty($msg)): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $msg ?>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
    <div id="display-image">
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
            <img src="./image/<?php echo $data['filename']; ?>">
        <?php } ?>
    </div>
    <div style="display: flex; justify-content: center;">
    <a href="index.php">Back to Home</a>
</div>
</body>
</html>
<?php
mysqli_close($db);
?>
