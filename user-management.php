<?php

// Check if the user is logged in as an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    // Redirect to the login page if not logged in or not an admin
    header("Location: login.php");
    exit();
}

// Get user role from the session
$userRole = $_SESSION['user']['role'];

// Handle form submission for enabling/disabling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["toggle_disable"])) {
    $userId = $_POST["toggle_disable"];

    // Toggle the disable status for the specified user
    toggleDisableStatus($conn, $userId);

    // Redirect to the same page to avoid resubmission on refresh
    header("Location: admin-dashboard.php?page=user-management");
    exit();
}
function toggleDisableStatus($conn, $userId)
{
    // Toggle the disable status
    $conn->query("UPDATE Users SET disabled = NOT disabled WHERE user_id = $userId");
}


// Fetch users from the database
$userSql = "SELECT * FROM Users";
$userResult = $conn->query($userSql);
// Handle form submission for user modification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];
    $editUsername = $_POST["edit_username"];
    $editEmail = $_POST["edit_email"];
    $editRole = $_POST["edit_role"];
    $editVerified = $_POST["edit_verified"];
    $editFullName = $_POST["edit_full_name"];
    $editPhoneNumber = $_POST["edit_phone_number"];
    $editAddress = $_POST["edit_address"];
    $editCity = $_POST["edit_city"];
    $editDisabled = $_POST["edit_disabled"];

    // Update the user information
    $updateQuery = "UPDATE Users SET
        username = '$editUsername',
        email = '$editEmail',
        role = '$editRole',
        verified = $editVerified,
        full_name = '$editFullName',
        phone_number = '$editPhoneNumber',
        address = '$editAddress',
        city = '$editCity',
        disabled = $editDisabled
        WHERE user_id = $userId";

    if ($conn->query($updateQuery) === TRUE) {
        echo '<div class="alert alert-success" role="alert">User details updated successfully!</div>';
        // Redirect to the same page to avoid resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Error updating user details: ' . $conn->error . '</div>';
        // Redirect to the same page to avoid resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<div class="container">

    <h2 class="mb-4">User List</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Add User
    </button>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Verified</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($userData = $userResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $userData['user_id'] . '</td>';
                    echo '<td>' . $userData['username'] . '</td>';
                    echo '<td>' . $userData['email'] . '</td>';
                    echo '<td>' . $userData['role'] . '</td>';
                    echo '<td>' . ($userData['verified'] ? 'Yes' : 'No') . '</td>';
                    echo '<td>' . $userData['full_name'] . '</td>';
                    echo '<td>' . $userData['phone_number'] . '</td>';
                    echo '<td>' . $userData['address'] . '</td>';
                    echo '<td>' . $userData['city'] . '</td>';
                    echo '<td>' . (array_key_exists('disabled', $userData) ? ($userData['disabled'] ? 'Disabled' : 'Enabled') : 'N/A') . '</td>';
                    echo '<td>';
                    echo '<button type="submit" name="toggle_disable" class="btn btn-warning btn-sm btn-disable mx-2" value="' . $userData['user_id'] . '">';
                    echo (array_key_exists('disabled', $userData) && $userData['disabled'] ? 'Enable' : 'Disable');
                    echo '</button>';
                    echo '<button type="button" class="btn btn-primary btn-sm btn-modify" data-bs-toggle="modal" data-bs-target="#editModal' . $userData['user_id'] . '">Modify</button>';
                    echo '</td>';

                    echo '</tr>';
                }
                ?>


            </tbody>
        </table>
    </form>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding a new user goes here -->
                <form method="post">
                    <!-- Add the necessary input fields for the new user information -->
                    <!-- Example: -->
                    <div class="mb-3">
                        <label for="newUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="newUsername" name="new_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="newEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="newEmail" name="new_email" required>
                    </div>
                    <!-- Add more fields as needed -->

                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
// Reset the result pointer to the beginning
$userResult->data_seek(0);

// Modal for editing users
while ($userData = $userResult->fetch_assoc()) {
    echo '<div class="modal fade" id="editModal' . $userData['user_id'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $userData['user_id'] . '" aria-hidden="true">';
    echo '   <div class="modal-dialog">';
    echo '       <div class="modal-content">';
    echo '           <div class="modal-header">';
    echo '               <h5 class="modal-title" id="editModalLabel' . $userData['user_id'] . '">Edit User</h5>';
    echo '               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '           </div>';
    echo '           <div class="modal-body">';
    echo '               <!-- Your form for editing user details goes here -->';
    echo '               <form method="post" >';
    echo '                   <input type="hidden" name="user_id" value="' . $userData['user_id'] . '">';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editUsername' . $userData['user_id'] . '" class="form-label">Username</label>';
    echo '                       <input type="text" class="form-control" id="editUsername' . $userData['user_id'] . '" name="edit_username" value="' . $userData['username'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editEmail' . $userData['user_id'] . '" class="form-label">Email</label>';
    echo '                       <input type="text" class="form-control" id="editEmail' . $userData['user_id'] . '" name="edit_email" value="' . $userData['email'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editRole' . $userData['user_id'] . '" class="form-label">Role</label>';
    echo '                       <input type="text" class="form-control" id="editRole' . $userData['user_id'] . '" name="edit_role" value="' . $userData['role'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editVerified' . $userData['user_id'] . '" class="form-label">Verified</label>';
    echo '                       <select class="form-select" id="editVerified' . $userData['user_id'] . '" name="edit_verified">';
    echo '                           <option value="1" ' . ($userData['verified'] == 1 ? 'selected' : '') . '>Yes</option>';
    echo '                           <option value="0" ' . ($userData['verified'] == 0 ? 'selected' : '') . '>No</option>';
    echo '                       </select>';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editFullName' . $userData['user_id'] . '" class="form-label">Full Name</label>';
    echo '                       <input type="text" class="form-control" id="editFullName' . $userData['user_id'] . '" name="edit_full_name" value="' . $userData['full_name'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editPhoneNumber' . $userData['user_id'] . '" class="form-label">Phone Number</label>';
    echo '                       <input type="text" class="form-control" id="editPhoneNumber' . $userData['user_id'] . '" name="edit_phone_number" value="' . $userData['phone_number'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editAddress' . $userData['user_id'] . '" class="form-label">Address</label>';
    echo '                       <input type="text" class="form-control" id="editAddress' . $userData['user_id'] . '" name="edit_address" value="' . $userData['address'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editCity' . $userData['user_id'] . '" class="form-label">City</label>';
    echo '                       <input type="text" class="form-control" id="editCity' . $userData['user_id'] . '" name="edit_city" value="' . $userData['city'] . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editDisabled' . $userData['user_id'] . '" class="form-label">Disabled</label>';
    echo '                       <select class="form-select" id="editDisabled' . $userData['user_id'] . '" name="edit_disabled">';
    echo '                           <option value="1" ' . ($userData['disabled'] == 1 ? 'selected' : '') . '>Yes</option>';
    echo '                           <option value="0" ' . ($userData['disabled'] == 0 ? 'selected' : '') . '>No</option>';
    echo '                       </select>';
    echo '                   </div>';
    echo '                   <button type="submit" class="btn btn-primary">Save Changes</button>';
    echo '               </form>';
    echo '           </div>';
    echo '       </div>';
    echo '   </div>';
    echo '</div>';
}
?>