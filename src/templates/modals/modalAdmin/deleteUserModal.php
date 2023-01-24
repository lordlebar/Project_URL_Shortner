<!-- delete modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="adminPanel.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Delete user <span class="modal-data-name text-danger"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delete_modalBody">
                    <p>You are about to delete user <span class="modal-data-email text-danger"></span>, this procedure is irreversible.</p>
                    <p>Do you want to proceed ?</p>
                    <p class="debug-url"></p>
                    <input type="hidden" name="delete-user" id="delete-user" class="modal-data-email" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirm-delete" type="submit" class="btn btn-danger btn-rounded" data-bs-dismiss="modal"><i class="fa-solid fa-triangle-exclamation"></i> Confirm delete </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
// si l'envoie du formulaire delete a été fait
if (isset($_POST['delete-user'])) {
    $email_delete = $_POST['delete-user'];
    if (find_user_by_email($email_delete)) {
        // on delete l'utilisateur
        delete_user_by_email($email_delete);
        echo "<script>$('#valid-delete-user').show('medium'); setTimeout(function(){ $('#valid-delete-user').hide('medium'); }, 5000);</script>";
    }
}
?>
<!-- /delete modal -->