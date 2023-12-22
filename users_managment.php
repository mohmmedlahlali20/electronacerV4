<?php
 require_once 'UserDAO.php';
 $users =new UserDAO();
  $dbs= new Database();

    // Toggle the disable status for the specified user
    

// Fetch users from the database
$userSql = $users->get_users();

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
    $user = new User($userId,$editUsername,$editEmail,NULL,$editRole,$editVerified,$editFullName,$editPhoneNumber,$editAddress, $editCity,$editDisabled);
         
    if ($users-> updat_users( $user , $userId) ) {
        echo '<div class="alert alert-success" role="alert">User details updated successfully!</div>';
        // Redirect to the same page to avoid resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Redirect to the same page to avoid resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<div class="container">
&
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
               foreach($userSql as $row) {
                    echo '<tr>';
                    echo '<td>' . $row->getUserId() . '</td>';
                    echo '<td>' . $row->getUsername() . '</td>';
                    echo '<td>' . $row->getEmail() . '</td>';
                    echo '<td>' . $row->getRole(). '</td>';
                    echo '<td>' . ($row->getRole() ? 'Yes' : 'No') . '</td>';
                    
                    echo '<td>' . $row->getFullName() . '</td>';
                    echo '<td>' . $row->getPhoneNumber() . '</td>';
                    echo '<td>' . $row->getAddress() . '</td>';
                    echo '<td>' . $row->getCity() . '</td>';
                    echo '<td>' . (array_key_exists('disabled',$userSql ) ? ($row->isDisabled() ? 'Disabled' : 'Enabled') : 'N/A') . '</td>';
                    echo '<td>';
                    echo '<button type="submit" name="toggle_disable" class="btn btn-warning btn-sm btn-disable mx-2" value="' . $row->getUserId(). '">';
                    echo (array_key_exists('disabled', $userSql) && $row->getUserId() ? 'Enable' : 'Disable');
                    echo '</button>';
                    echo '<button type="button" class="btn btn-primary btn-sm btn-modify" data-bs-toggle="modal" data-bs-target="#editModal' . $row->getUserId() . '">Modify</button>';
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


// Modal for editing users
foreach($userSql as $row){
    echo '<div class="modal fade" id="editModal' . $row->getUserId() . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $row->getUserId() . '" aria-hidden="true">';
    echo '   <div class="modal-dialog">';
    echo '       <div class="modal-content">';
    echo '           <div class="modal-header">';
    echo '               <h5 class="modal-title" id="editModalLabel' . $row->getUserId() . '">Edit User</h5>';
    echo '               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '           </div>';
    echo '           <div class="modal-body">';
    echo '               <!-- Your form for editing user details goes here -->';
    echo '               <form method="post" >';
    echo '                   <input type="hidden" name="user_id" value="' .$row->getUserId() . '">';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editUsername' . $row->getUserId(). '" class="form-label">Username</label>';
    echo '                       <input type="text" class="form-control" id="editUsername' .$row->getUserId() . '" name="edit_username" value="' .  $row->getUserId(). '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editEmail' . $row->getUserId() . '" class="form-label">Email</label>';
    echo '                       <input type="text" class="form-control" id="editEmail' . $row->getUserId() . '" name="edit_email" value="' .  $row->getUsername(). '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editRole' . $row->getUserId() . '" class="form-label">Role</label>';
    echo '                       <input type="text" class="form-control" id="editRole' . $row->getUserId() . '" name="edit_role" value="' . $row->getEmail() . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editVerified' . $row->getUserId() . '" class="form-label">Verified</label>';
    echo '                       <select class="form-select" id="editVerified' .$row->getUserId() . '" name="edit_verified">';
    echo '                           <option value="1" ' . ($row->isVerified() == 1 ? 'selected' : '') . '>Yes</option>';
    echo '                           <option value="0" ' . ($row->isVerified() == 0 ? 'selected' : '') . '>No</option>';
    echo '                       </select>';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editFullName' .$row->getUserId() . '" class="form-label">Full Name</label>';
    echo '                       <input type="text" class="form-control" id="editFullName' . $row->getUserId() . '" name="edit_full_name" value="' . $row->getFullName() . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editPhoneNumber' . $row->getUserId() . '" class="form-label">Phone Number</label>';
    echo '                       <input type="text" class="form-control" id="editPhoneNumber' .$row->getUserId() . '" name="edit_phone_number" value="' .  $row->getPhoneNumber() . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editAddress' . $row->getUserId() . '" class="form-label">Address</label>';
    echo '                       <input type="text" class="form-control" id="editAddress' . $row->getUserId(). '" name="edit_address" value="' .  $row->getAddress() . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editCity' . $row->getUserId() . '" class="form-label">City</label>';
    echo '                       <input type="text" class="form-control" id="editCity' . $row->getUserId() . '" name="edit_city" value="' .  $row->getCity() . '">';
    echo '                   </div>';
    echo '                   <div class="mb-3">';
    echo '                       <label for="editDisabled' . $row->getUserId() . '" class="form-label">Disabled</label>';
    echo '                       <select class="form-select" id="editDisabled' . $row->getUserId() . '" name="edit_disabled">';
    echo '                           <option value="1" ' . ($row->isDisabled() == 1 ? 'selected' : '') . '>Yes</option>';
    echo '                           <option value="0" ' . ($row->isDisabled() == 0 ? 'selected' : '') . '>No</option>';
    echo '                       </select>';
    echo '                   </div>';
    echo '                   <button type="submit" class="btn btn-primary">Save Changes</button>';
    echo '               </form>';
    echo '           </div>';
    echo '       </div>';
    echo '   </div>';
    echo '</div>';
}
include("footer.php");
?>