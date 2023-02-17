<?php
        //resume session here to fetch session values
        session_start();
        /*
            if user is not login then redirect to login page,
            this is to prevent users from accessing pages that requires
            authentication such as the dashboard
        */
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin'){
            header('location: ../landing/landing.php');
        }

    require_once '../tools/variables.php';
    $page_title = 'BubbleBest | Pending Orders';
    $dashboard = 'active';

    require_once '../includes/adhead.php';
?>
<div class="body-wrapper">
    <?php require_once '../includes/adsidebar.php'; ?>
        <div class="main-wrapper mdc-drawer-app-content">
            <?php require_once '../includes/adheader.php'; ?>

            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <main class="content-wrapper">
                    <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <div class="mdc-card p-0">
                            <div class="table-responsive">
                                <table class="table" id="table-id">
                                        <thead>
                                            <tr>
                                            <th class="text-left">Order Number</th>
                                            <th>Customer Name</th>
                                            <th>Purchased</th>
                                            <th>Date</th>
                                            <th>Delivery Address</th>
                                            <th>Payment Method</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            require_once '../classes/orders.class.php';

                                            $order = new Order();
                                            //We will now fetch all the records in the array using loop
                                            //use as a counter, not required but suggested for the table

                                            //loop for each record found in the array
                                            foreach ($order->show() as $value){ //start of loop
                                        ?>
                                            <tr>
                                                <!-- always use echo to output PHP values -->
                                                <td><?php echo $value['order_number'] ?></td>
                                                <td><?php echo $value['customer_name'] ?></td>
                                                <td><?php echo $value['item_purchased'] ?></td>
                                                <td><?php echo $value['date'] ?></td>
                                                <td><?php echo $value['delivery_address'] ?></td>
                                                <td><?php echo $value['payment_method'] ?></td>
                                                    <td>
                                                        <div class="action">
                                                            <a class="action-edit" href="#">Approve</a>
                                                            <a class="action-delete" href="#">View</a>
                                                            <a class="action-delete" href="#">Decline</a>
                                                        </div>
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </main>
            <?php require_once '../includes/adfooter.php'; ?>
            </div>
        </div>
</div>

<?php require_once '../includes/adend.php'; ?>
<script>
jQuery(document).ready(function($) {
    $('#table-id').DataTable();
} );
</script>