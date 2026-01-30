<?php
require_once '../config/Database.php';
require_once '../includes/auth.php';
require_once '../models/Bill.php';

$db = new Database();
$conn = $db->getConnection();

$bill = new Bill();

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    if ($request == 'All') {
        $result = $bill->getAllBills();
    }else{
    $result = $bill->filterBills($request);
    }
    $count = $result->rowCount(); 
    if($count > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
?>
    <tr>
        <td><?= $row['house_no']; ?></td>
        <td><?= $row['bill']; ?></td>
        <td class="fw-bold text-dark">$<?= number_format($row['amount'], 2); ?></td>
        <td><?= $row['month']; ?></td>
        <td>
            <span class="status-badge <?= $row['bill_status'] == 'paid' ? 'bg-success text-white' : 'bg-warning text-dark' ?>">
                <?= strtoupper($row['bill_status']); ?>
            </span>
        </td>
    </tr>
<?php
    }
    } else {
        echo '<tr><td colspan="5" class="text-center">No bills found.</td></tr>';
    }
}   
?>