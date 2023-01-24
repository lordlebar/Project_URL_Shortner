<!-- Alert -->
<div class="alert alert-success alert-dismissible fade show" role="alert" id="valid-delete-user">
    <p><i class="fa-solid fa-check-circle"></i> Account <strong><?php echo $_POST['delete-user'] ?></strong> has been deleted.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-delete-user" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i> User <strong><?php echo $_POST['delete-user'] ?></strong> doesn't exist</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="valid-update-user" class="alert alert-success alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-check-circle"></i> User <strong><?php echo $_POST['email_update'] ?></strong> Updated</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-update-user" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i> User <strong><?php echo $_POST['email_update'] ?></strong> Is Not Available !</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-update-other-admin" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Can't edit user <strong><?php echo $_POST['email_previous_update'] ?></strong> it is an administrator</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="valid-add-user" class="alert alert-success alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-check-circle"></i> User <strong><?php echo $_POST['email_add'] ?></strong> Added Successful</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-add-user-already-exist" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i> User <strong><?php echo $_POST['email_add'] ?></strong> Is Not Available ! </p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-update-character" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Name must contain only letters, numbers, _ and -, and spaces, but less of 20 characters</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div id="invalid-update-less-character" class="alert alert-danger alert-dismissible fade show" role="alert">
    <p><i class="fa-solid fa-triangle-exclamation"></i>Name must contain less than 20 characters</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="long_url_already_exist">
    <p><i class="fa-solid fa-triangle-exclamation"></i> This long URL already exists.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="short_url_must_be_at_least_3_characters">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Short URL must be at least 3 characters.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="short_url_must_be_less_than_20_characters">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Short URL must be less than 20 characters.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="short_url_must_only_contains_letter_and_number">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Short URL must only contains letter and number.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="short_url_already_exist">
    <p><i class="fa-solid fa-triangle-exclamation"></i> Short URL <?php echo $_POST["update_short_url"] ?> already in use.
    </p>
    <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="update_url_success">
    <p><i class="fa-solid fa-check-circle"></i> Update <?php echo $_POST["update_short_url"] ?> success.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="valid-delete-url">
    <p> <i class="fa-solid fa-check-circle"></i> URL <?php echo $_POST["delete-url"] ?> deleted.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="long_url_already_shortened">
    <p> <i class="fa-solid fa-triangle-exclamation"></i> This long URL is already shortened.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="url_shortened_success">
    <p> <i class="fa-solid fa-check-circle"></i> URL shortened successfully.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-success alert-dismissible fade show" role="alert" id="connect_success">
    <p> <i class="fa-solid fa-check-circle"></i> Connection success.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id='fill_all_fields'>
    <p> <i class="fa-solid fa-triangle-exclamation"></i> Please fill all the fields.</p>
    <!-- <button type="button" class="btn-close pos-btn" data-bs-dismiss="alert" aria-label="Close"></button> -->
</div>

<!-- /Alert -->