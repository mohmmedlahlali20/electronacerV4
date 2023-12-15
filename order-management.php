<?php

// Fetch orders with user full name from the database
$orderSql = "SELECT Orders.*, Users.full_name
             FROM Orders 
             JOIN Users ON Orders.user_id = Users.user_id";
$orderResult = $conn->query($orderSql);

// Handle form submission for order modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["order_id"])) {
        $orderId = $_POST["order_id"];
        $editStatus = isset($_POST["edit_status"]) ? $_POST["edit_status"] : '';
        $editAmount = isset($_POST["edit_amount"]) ? $_POST["edit_amount"] : '';
        $editCustomer = isset($_POST["edit_customer"]) ? $_POST["edit_customer"] : '';

        // Check if $editCustomer is not empty before using it in the query
        if (!empty($editCustomer)) {
            // Use prepared statements to prevent SQL injection
            $updateQuery = "UPDATE Orders SET
                order_status = ?,
                total_price = ?,
                user_id = ?
                WHERE order_id = ?";

            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sssi", $editStatus, $editAmount, $editCustomer, $orderId);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">Order details updated successfully!</div>';
                // Redirect to the same page to avoid resubmission on refresh
                header("Location: admin-dashboard.php?page=order-management");
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">Error updating order details: ' . $stmt->error . '</div>';
                // Redirect to the same page to avoid resubmission on refresh
                header("Location: admin-dashboard.php?page=order-management");
                exit();
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid customer ID!</div>';
        }
    }
    // Handle order deletion
    if (isset($_POST["delete_order_id"])) {
        $deleteOrderId = $_POST["delete_order_id"];
        $deleteQuery = "DELETE FROM Orders WHERE order_id = $deleteOrderId";

        if ($conn->query($deleteQuery) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Order deleted successfully!</div>';
            // Redirect to the same page to avoid resubmission on refresh
            header("Location: admin-dashboard.php?page=order-management");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error deleting order: ' . $conn->error . '</div>';
            // Redirect to the same page to avoid resubmission on refresh
            header("Location: admin-dashboard.php?page=order-management");
            exit();
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Order List</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Order Date</th>
                    <th>Send Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($orderData = $orderResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $orderData['order_id'] . '</td>';
                    echo '<td>' . $orderData['full_name'] . '</td>';
                    echo '<td>' . $orderData['order_date'] . '</td>';
                    echo '<td>' . $orderData['send_date'] . '</td>';
                    echo '<td>' . $orderData['delivery_date'] . '</td>';
                    echo '<td>' . $orderData['order_status'] . '</td>';
                    echo '<td>' . $orderData['total_price'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal' . $orderData['order_id'] . '">
                                Edit
                              </button>';
                    echo '<button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal' . $orderData['order_id'] . '">
                                Delete
                              </button>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<?php
// Reset the result pointer to the beginning
$orderResult->data_seek(0);

// Modal for editing and deleting orders
while ($orderData = $orderResult->fetch_assoc()) {
    echo '<div class="modal fade" id="editModal' . $orderData['order_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $orderData['order_id'] . '" aria-hidden="true">';
    echo '   <div class="modal-dialog">';
    echo '       <div class="modal-content">';
    echo '           <div class="modal-header">';
    echo '               <h5 class="modal-title" id="editModalLabel' . $orderData['order_id'] . '">Edit Order</h5>';
    echo '               <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '                  <span aria-hidden="true">&times;</span>';
    echo '               </button>';
    echo '           </div>';
    echo '           <div class="modal-body">';
    echo '               <form method="post" onsubmit="return submitEditForm(' . $orderData['order_id'] . ');">';
    echo '                   <input type="hidden" name="order_id" value="' . $orderData['order_id'] . '">';
    echo '                   <div class="form-group">';
    echo '                       <label for="editStatus' . $orderData['order_id'] . '">Status</label>';
    echo '                       <select class="form-control" id="editStatus' . $orderData['order_id'] . '" name="edit_status">';
    echo '                           <option value="Pending" ' . ($orderData['order_status'] == 'Pending' ? 'selected' : '') . '>Pending</option>';
    echo '                           <option value="Validated" ' . ($orderData['order_status'] == 'Validated' ? 'selected' : '') . '>Validated</option>';
    echo '                           <option value="Cancelled" ' . ($orderData['order_status'] == 'Cancelled' ? 'selected' : '') . '>Cancelled</option>';
    // Add more status options as needed
    echo '                       </select>';
    echo '                   </div>';
    echo '                   <div class="form-group">';
    echo '                       <label for="editAmount' . $orderData['order_id'] . '">Total Price</label>';
    echo '                       <input type="text" class="form-control" id="editAmount' . $orderData['order_id'] . '" name="edit_amount" value="' . $orderData['total_price'] . '">';
    echo '                   </div>';
    echo '                   <div class="form-group">';
    echo '                       <label for="editCustomer' . $orderData['order_id'] . '">User ID</label>';
    echo '                       <input type="text" class="form-control" id="editCustomer' . $orderData['order_id'] . '" name="edit_customer" value="' . $orderData['user_id'] . '">';
    echo '                   </div>';
    echo '                   <div class="form-group">';
    echo '                       <label for="editSendDate' . $orderData['order_id'] . '">Send Date</label>';
    echo '                       <input type="date" class="form-control" id="editSendDate' . $orderData['order_id'] . '" name="edit_send_date" value="' . $orderData['send_date'] . '">';
    echo '                   </div>';
    echo '                   <div class="form-group">';
    echo '                       <label for="editDeliveryDate' . $orderData['order_id'] . '">Delivery Date</label>';
    echo '                       <input type="date" class="form-control" id="editDeliveryDate' . $orderData['order_id'] . '" name="edit_delivery_date" value="' . $orderData['delivery_date'] . '">';
    echo '                   </div>';
    echo '                   <button type="submit" class="btn btn-primary">Save Changes</button>';
    echo '               </form>';
    echo '           </div>';
    echo '       </div>';
    echo '   </div>';
    echo '</div>';
    // Modal for deleting orders
    echo '<div class="modal fade" id="deleteModal' . $orderData['order_id'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . $orderData['order_id'] . '" aria-hidden="true">';
    echo '   <div class="modal-dialog">';
    echo '       <div class="modal-content">';
    echo '           <div class="modal-header">';
    echo '               <h5 class="modal-title" id="deleteModalLabel' . $orderData['order_id'] . '">Delete Order</h5>';
    echo '               <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '                  <span aria-hidden="true">&times;</span>';
    echo '               </button>';
    echo '           </div>';
    echo '           <div class="modal-body">';
    echo '               <p>Are you sure you want to delete this order?</p>';
    echo '           </div>';
    echo '           <div class="modal-footer">';
    echo '               <form method="post" onsubmit="return submitDeleteForm(' . $orderData['order_id'] . ');">';
    echo '                   <input type="hidden" name="delete_order_id" value="' . $orderData['order_id'] . '">';
    echo '                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    echo '                   <button type="submit" class="btn btn-danger">Delete</button>';
    echo '               </form>';
    echo '           </div>';
    echo '       </div>';
    echo '   </div>';
    echo '</div>';
}
?>