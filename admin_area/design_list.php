<?php
include('../includes/connect.php');
?>

<h3 class="text-center text-success">All images</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Image id</th>
            <th>Image</th>
            <th>Filename</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
        <?php
        // Delete image if delete button is clicked
        if (isset($_GET['delete_image'])) {
            $id = $_GET['delete_image'];
            $query = "SELECT filename FROM image WHERE id=$id";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $filename = $row['filename'];

            // Remove file from directory
            $filepath = "./image/" . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }

            // Remove filename from database
            $sql = "DELETE FROM image WHERE id=$id";
            if (mysqli_query($con, $sql)) {
                $msg = "Image deleted successfully!";
            } else {
                $msg = "Failed to delete image.";
            }
        }

        // Display the uploaded images
        $query = "SELECT * FROM image";
        $result = mysqli_query($con, $query);
        $number = 0;
        while ($data = mysqli_fetch_assoc($result)) {
            $number++;
            $id = $data['id'];
            $filename = $data['filename'];
        ?>
            <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><img src="./image/<?php echo $filename; ?>"></td>
                <td><?php echo $filename; ?></td>
                <td><a href='index.php?delete_image=<?php echo $id; ?>' class='text-light'><i class='fas fa-trash'></i></a></td>
            </tr>
        <?php } ?>
        <?php mysqli_close($con); ?>
    </tbody>
</table>
