<!-- Modal add user -->
<div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="addUserModalLabel" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="adminPanel.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="addUserModalLabel">Create <strong class='text-danger'>New User</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_add">Email address:</label>
                        <input type="email" class="form-control" id="email_add" name="email_add" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 d-flex flex-direction-row gap-4 m-2">
                        <div class="form-check form-switch form-check-reverse">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverseVerified" id="is_verified" name="is_verified" checked>
                            <label class="form-check-label" for="flexSwitchCheckReverseVerified">Verified ?</label>
                        </div>
                        <div class="form-check form-switch form-check-reverse">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverseAdmin" id="is_admin" name="is_admin">
                            <label class="form-check-label" for="flexSwitchCheckReverseAdmin">Admin ?</label>
                        </div>
                    </div>

                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-rounded" data-bs-target="modal"><i class="fa-solid fa-user-plus"></i> Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
// si l'envoie du formulaire a été fait
if (isset($_POST['name']) && isset($_POST['email_add']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email_add = $_POST['email_add'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    $is_verified = isset($_POST['is_verified']) ? 1 : 0;

    // si l'utilisateur n'existe pas déjà
    if (!find_user_by_email($email_add)) {
        // on ajoute l'utilisateur
        insert_user($name, $email_add, $password, $is_admin, $is_verified);
        echo "<script>$('#valid-add-user').show('medium'); setTimeout(function(){ $('#valid-add-user').hide('medium'); }, 5000);</script>";
    } else {
        echo "<script>$('#invalid-add-user-already-exist').show('medium'); setTimeout(function(){ $('#invalid-add-user-already-exist').hide('medium'); }, 5000);</script>";
    }
}
?>
<!--/ Modal add user -->