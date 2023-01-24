<!-- Update Modal -->
<div id="updateUrlModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Update url <span class="modal-data-short_url text-primary"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="update_long_url" class="col-form-label">Long URL:</label>
                        <input type="text" class="form-control modal-data-long_url" id="update_long_url" name="update_long_url" required>
                        <input type="hidden" name="update_hidden_long_url" class="modal-data-long_url">
                    </div>
                    <div class="mb-3">
                        <label for="update" class="col-form-label">Short URL:</label>
                        <input type="text" class="form-control modal-data-short_url" id="update" name="update_short_url" required>
                        <input type="hidden" name="update_hidden_short_url" class="modal-data-short_url">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-rounded confirm-update" data-bs-target="modal"><i class="fa-solid fa-triangle-exclamation"></i> Confirm Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php
// si l'envoie du formulaire a été fait
if (isset($_POST["update_short_url"]) && isset($_POST["update_hidden_short_url"]) && isset($_POST["update_long_url"]) && isset($_POST["update_hidden_long_url"])) {
    // on récupère les valeurs du formulaire
    $update_short_url = $_POST["update_short_url"];
    $update_hidden_short_url = $_POST["update_hidden_short_url"];
    $update_hidden_long_url = $_POST["update_hidden_long_url"];
    $update_long_url = $_POST["update_long_url"];

    // si update_long_url n'as pas http:// ou https:// on n'ajoute http://
    if (!preg_match('#^https?://#', $update_long_url)) {
        $update_long_url = 'http://' . $update_long_url;
    }


    $url_exist = find_url_by_long_url($update_long_url, $_SESSION['email']);
    if ($url_exist[3] == $update_long_url && $update_long_url != $update_hidden_long_url) {
        echo "<script>$('#long_url_already_exist').show('medium'); setTimeout(function(){ $('#long_url_already_exist').hide('medium'); }, 5000);</script>";
    }

    // on vérifie que les champs ne sont pas vides
    else if (!empty($update_short_url) && !empty($update_hidden_short_url) && !empty($update_long_url) && !empty($update_hidden_long_url)) {

        if (strlen($update_short_url) < 3) {
            echo "<script>$('#short_url_must_be_at_least_3_characters').show('medium'); setTimeout(function(){ $('#short_url_must_be_at_least_3_characters').hide('medium'); }, 5000);</script>";
        } else if (strlen($update_short_url) > 20) {
            echo "<script>$('#short_url_must_be_less_than_20_characters').show('medium'); setTimeout(function(){ $('#short_url_must_be_less_than_20_characters').hide('medium'); }, 5000);</script>";
        } else if (!is_pattern_url_good($update_short_url)) {
            echo "<script>$('#short_url_must_only_contains_letter_and_number').show('medium'); setTimeout(function(){ $('#short_url_must_only_contains_letter_and_number').hide('medium'); }, 5000);</script>";
        } else if (is_short_url_exists($update_short_url) && $update_short_url != $update_hidden_short_url) {
            echo "<script>$('#short_url_already_exist').show('medium'); setTimeout(function(){ $('#short_url_already_exist').hide('medium'); }, 5000);</script>";
        } else {
            update_url($update_short_url, $update_hidden_short_url, $update_long_url, $_SESSION['email']);

            echo "<script>$('#update_url_success').show('medium'); setTimeout(function(){ $('#update_url_success').hide('medium'); }, 5000);</script>";
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> Please fill all the fields.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>
<!--/ Update modal -->