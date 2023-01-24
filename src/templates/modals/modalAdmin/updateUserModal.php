<!-- Update Modal -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="adminPanel.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Update user <span class="modal-data-name text-primary"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="modal-data-name">Name:</label>
                            <input type="text" class="form-control modal-data-name" id="modal-data-name" name="modal-data-name" aria-describedby="modal-data-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_update">Email address:</label>
                            <input type="hidden" class="form-control modal-data-email" id="modal-email_update" name="email_previous_update" aria-describedby="modal-data-email" required>
                            <input type="email" class="form-control modal-data-email" id="modal-email_update2" name="email_update" aria-describedby="modal-data-email" required>
                        </div>
                        <div class="mb-3 d-flex flex-direction-row gap-4 m-2">
                            <div class="form-check form-switch form-check-reverse">
                                <input class="form-check-input" type="checkbox" id="update-verif" id="is_verified" name="update-verif">
                                <label class="form-check-label" for="update-verif">Verified ?</label>
                            </div>
                            <div class="form-check form-switch form-check-reverse">
                                <input class="form-check-input" type="checkbox" id="update-admin" id="is_admin" name="update-admin">
                                <label class="form-check-label" for="update-admin">Admin ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-rounded confirm-update" data-bs-target="modal"><i class="fa-solid fa-triangle-exclamation"></i> Confirm Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php
// si l'envoie du formulaire a été fait
if (isset($_POST['modal-data-name']) && isset($_POST['email_update'])) {
    $name = $_POST['modal-data-name'];
    $email_update = $_POST['email_update'];
    $previous_email_update = $_POST['email_previous_update'];
    $is_verified = isset($_POST['update-verif']) ? 1 : 0;
    $is_admin = isset($_POST['update-admin']) ? 1 : 0;

    // name doit etre inferieur a 20 caracteres
    if (!preg_match("/^[a-zA-Z0-9 _-]+$/", $name))
        echo "<script>$('#invalid-update-character').show('medium'); setTimeout(function(){ $('#invalid-update-less-character').hide('medium'); }, 5000);</script>";
    else if (strlen($name) > 20)
        echo "<script>$('#invalid-update-less-character').show('medium'); setTimeout(function(){ $('#invalid-update-less-character').hide('medium'); }, 5000);</script>";
    else if (!find_user_by_email($email_update) || $email_update == $previous_email_update) {
        // on update l'utilisateur
        update_user($name, $email_update, $is_admin, $is_verified, $previous_email_update);

        if ($previous_email_update == $_SESSION['email']) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email_update;
            $_SESSION['is_admin'] = $is_admin;
        }

        echo "<script>$('#valid-update-user').show('medium'); setTimeout(function(){ $('#valid-update-user').hide('medium'); }, 5000);</script>";
    } else {
        echo "<script>$('#invalid-update-user').show('medium'); setTimeout(function(){ $('#invalid-update-user').hide('medium'); }, 5000);</script>";
    }
}
?>
<!--/ Update modal -->