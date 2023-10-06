<?php
include('../includes/connect.php');
?>

<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
<?php
    $get_payments="Select * from `user_table`";
    $result=mysqli_query($con,$get_payments);
    $row_count=mysqli_num_rows($result);
    echo "<tr>
            <th>SL no</th>
            <th>user name</th>
            <th>user email</th>
            <th>user adddress</th>
            <th>user mobile</th>
</tr>
</thead>
<tbody class='bg-secondary text-light'>";
if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No Users</h2>";

}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td> $username</td>
        <td>$user_email</td>
        <td>$user_address</td>
        <td>$user_mobile</td>
    </tr>";

    }
}






    ?>
        
    
</tbody>
</table>