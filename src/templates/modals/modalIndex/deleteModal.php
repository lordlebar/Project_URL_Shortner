<!-- delete modal -->
<div id="deleteUrlModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Delete short url <script>
                            window.location.host
                        </script><span class="modal-data-short_url text-danger"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delete_modalBody">
                    <p>You are about to delete short url <span class="modal-data-short_url text-danger"></span> go to <span class="modal-data-long_url text-danger"></span>, this procedure is irreversible.</p>
                    <p>Do you want to proceed ?</p>
                    <p class="debug-url"></p>
                    <input type="hidden" name="delete-url" id="delete-user" class="modal-data-short_url" required>
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

if (isset($_POST["delete-url"])) {
    $short_url = $_POST["delete-url"];
    delete_url($short_url, $_SESSION['email']);
    echo "<script>$('#valid-delete-url').show('medium'); setTimeout(function(){ $('#valid-delete-url').hide('medium'); }, 5000);</script>";
}

?>
<!-- /delete modal -->