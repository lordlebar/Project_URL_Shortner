<!-- delete modal -->
<div id="deleteUrlUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="linkUser.php$email=<?php echo $_GET['email']; ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title"><strong class='text-danger'>Delete</strong> short url <span class="modal-data-short_url text-danger"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delete_modalBody">
                    <h6>for email <span class="modal-data-email text-primary"></h6>

                    <p>You are about to delete short url <span class="modal-data-short_url text-danger"></span> go to <span class="modal-data-long_url text-danger"></span>, this procedure is irreversible.</p>
                    <p>Do you want to proceed ?</p>
                    <p class="debug-url"></p>
                    <input type="hidden" name="delete-url" id="delete-url" class="modal-data-short_url" required>
                    <input type="hidden" name="email_url" id="delete-url_user" class="modal-data-email" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirm-delete" type="submit" class="btn btn-danger btn-rounded" data-bs-dismiss="modal"><i class="fa-solid fa-triangle-exclamation"></i> Confirm delete </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// si l'envoie du formulaire delete a été fait

if (isset($_POST["delete-url"]) && isset($_POST['email_url'])) {
    $short_url = $_POST["delete-url"];
    $email = $_POST['email_url'];
    delete_url($short_url, $email);

    echo "<script>$('#valid-delete-url').show('medium'); setTimeout(function(){ $('#valid-delete-url').hide('medium'); }, 5000);</script>";
}

?>
<!-- /delete modal -->