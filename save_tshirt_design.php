<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST['data'];

  // Remove the "data:image/png;base64," from the base64 data
  $data = str_replace("data:image/png;base64,", "", $data);

  // Decode the base64 data
  $data = base64_decode($data);

  // Save the image to the server
  file_put_contents('tshirt_design.png', $data);
}
?>
