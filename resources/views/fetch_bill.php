<?php
use app\Models\Bill;
use app\Models\User;
use app\Http\Controllers\BillController;



$bill = new Bill();
if(isset($_POST['status'])) {
    $request = $_POST['status'];
    if ($request == 'All') {
        $result = Bill::orderBy('created_at', 'desc')->get();
    }else if ($request == 'pending') {
    $result = Bill::where('status', 'unpaid')->orderBy('created_at', 'desc')->get();
    }else {
    $result = Bill::where('status', 'paid')->orderBy('created_at', 'desc')->get();
    }
    $count = $result->count(); 
    if($count > 0) {
    foreach($result as $row) {
?>
    <tr>
        <td><?= $row->house_no; ?></td>
        <td><?= $row->bill; ?></td>
        <td class="fw-bold text-dark">$<?= number_format($row->amount, 2); ?></td>
        <td><?= $row->month; ?></td>
        <td>
            <span class="status-badge <?= $row->status == 'paid' ? 'bg-success text-white' : 'bg-warning text-dark' ?>">
                <?= strtoupper($row->status); ?>
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