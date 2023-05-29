<!-- delete modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="profile.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Account <span class='text-danger'><?php echo $_SESSION['email']; ?></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delete_modalBody">
                    <p>Are you sure you want to delete Your account <span class='text-danger'><?php echo $_SESSION['email']; ?></span> ?</p>
                    <p>Do you want to proceed ?</p>
                    <p class="debug-url"></p>
                    <input type="hidden" name="delete-user" id="delete-user" value='<?php echo $email ?>' required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirm-delete" type="submit" class="btn btn-danger btn-rounded" data-bs-dismiss="modal"><i class='fa-solid fa-triangle-exclamation'> </i> Confirm delete </button>
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
    echo "<script>console.log('delete user : " . $email_delete . "');</script>";
    if (find_user_by_email($email_delete)) {
        // on delete l'utilisateur
        delete_user_by_email($email_delete);
        unset($_SESSION["is_logged"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["is_admin"]);

        // on redirige vers la page d'accueil
        echo "<script>window.location.href = 'http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/';</script>";
    }
}
?>
<!-- /delete modal -->