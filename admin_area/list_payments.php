<?php
include('../includes/connect.php');
?>

<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
<?php
    $get_payments="Select * from `user_payments`";
    $result=mysqli_query($con,$get_payments);
    $row_count=mysqli_num_rows($result);
    echo "<tr>
            <th>SL no</th>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Payment mode</th>
            <th>Order date</th>
</tr>
</thead>
<tbody class='bg-secondary text-light'>";
if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No payments</h2>";

}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $amount=$row_data['amount'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
        $invoice_number=$row_data['invoice_number'];
        $number++;
        echo "<tr>
        <td>$number</td>
        <td> $invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
    </tr>";

    }
}






    ?>
        
    
</tbody>
</table>