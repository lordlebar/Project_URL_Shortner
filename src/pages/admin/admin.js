window.onload = init;
$.ajaxSetup({ cache: false });

function init() {
    const search = document.getElementById("search");
    if (search) {
        jQuery.ajax({
            type: "POST",
            url: "../../managers/getUsersSearch.php",
            dataType: "json",
            data: { search: search.value },
            success: function (obj, textstatus) {
                createUsersTable(obj);
            },
        });
    } else {
        console.log("init");
        $.getJSON("../../managers/getUsers.php", function (data) {
            createUsersTable(data);
        });
    }
}

function createUsersTable(users) {
    $(`#bodyOfUsersArray`).empty();
    for (const user in users) {
        let row = users[user];
        let tr = document.createElement("tr");

        td = document.createElement("td");
        td.classList.add("align-middle");
        if (row.is_admin == 1) {
            td.innerHTML =
                `<div data-toggle="tooltip" data-placement="top" title="Administrator"><i class="fa-solid fa-user-shield text-info"></i> ` +
                row.name +
                `</div>`;
        } else {
            td.innerHTML =
                `<div data-toggle="tooltip" data-placement="top" title="User">` +
                row.name +
                `</div>`;
        }
        tr.appendChild(td);

        td = document.createElement("td");
        td.classList.add("align-middle");
        // link to user's links with email as parameter

        td.innerHTML = `<a href="http://${window.location.host}/Project_URL_Shortner/src/pages/admin/linkUser.php?email=${row.email}" data-toggle="tooltip" data-placement="top" title="Go to links of User ${row.email}">${row.email}</a>`;
        tr.appendChild(td);

        td = document.createElement("td");
        td.classList.add("align-middle");
        // row.is_verified == 1 ? (td.innerText = "Yes") : (td.innerText = "No");
        if (row.is_verified == 1) {
            td.innerHTML = `<div data-toggle="tooltip" data-placement="top" title="Verified"><i class="fa-solid fa-check-circle text-success"></i></div>`;
        } else {
            td.innerHTML = `<div data-toggle="tooltip" data-placement="top" title="Not Verified"><i class="fa-solid fa-times-circle text-danger"></i></div>`;
        }

        tr.appendChild(td);

        td = document.createElement("td");
        td.classList.add("align-middle");
        // row.is_admin == 1 ? (td.innerText = "Yes") : (td.innerText = "No");
        if (row.is_admin == 1) {
            td.innerHTML = `<div data-toggle="tooltip" data-placement="top" title="Administrator"><i class="fa-solid fa-user-shield text-info"></i></div>`;
        } else {
            td.innerHTML = `<div data-toggle="tooltip" data-placement="top" title="User"><i class="fa-solid fa-user text-secondary"></i></div>`;
        }
        tr.appendChild(td);

        // modifie le compte
        if (row.is_admin == 1) {
            td = document.createElement("td");
            tr.appendChild(td);
        } else {
            td = document.createElement("td");
            td.classList.add("align-middle");
            updateButton = document.createElement("button");
            updateButton.classList.add("btn", "btn-warning", "btn-rounded");
            updateButton.setAttribute("data-toggle", "tooltip");
            updateButton.setAttribute("data-placement", "top");
            updateButton.setAttribute("title", "Update User " + row.email);
            updateButton.onclick = () => updateUser(row, tr);
            updateButton.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;
            td.appendChild(updateButton);
            tr.appendChild(td);
        }

        if (row.is_admin == 1) {
            td = document.createElement("td");
            tr.appendChild(td);
        } else {
            td = document.createElement("td");
            td.classList.add("align-middle");
            deleteButton = document.createElement("button");
            deleteButton.classList.add("btn", "btn-danger", "btn-rounded");
            deleteButton.setAttribute("data-toggle", "tooltip");
            deleteButton.setAttribute("data-placement", "top");
            deleteButton.setAttribute("title", "Delete User " + row.email);
            deleteButton.onclick = () => deleteUser(row, tr);
            deleteButton.innerHTML = `<i class="fa-solid fa-trash-can"></i>`;
            td.appendChild(deleteButton);
            tr.appendChild(td);
        }

        bodyOfUsersArray.appendChild(tr);
    }
}

function updateUser(row, tr) {
    $(`#updateModal`).modal("show");
    $(`.modal-data-name`).text(row.name);
    $(`.modal-data-name`).val(row.name);
    $(`.modal-data-email`).val(row.email);
    $(`.modal-data-valid`).val(row.is_verified);
    $(`.modal-data-admin`).val(row.is_admin);
    $(`.modal-data-password`).val(row.password);

    if (row.is_admin == 1)
        $("input:checkbox[name=update-admin]").prop("checked", true);
    else $("input:checkbox[name=update-admin]").prop("checked", false);

    if (row.is_verified == 1)
        $("input:checkbox[name=update-verif]").prop("checked", true);
    else $("input:checkbox[name=update-verif]]").prop("checked", false);
}

function deleteUser(row, tr) {
    $(".modal-data-name").text(row.name);
    $(`.modal-data-email`).text(row.email);
    $(`.modal-data-email`).val(row.email);

    if (row.is_admin == 1) {
        createAlert("invalid-delete-user", row.email);
        return;
    }
    $(`#deleteModal`).modal("show");
}

function createAlert(id, name) {
    $(`.alert-name`).text(name);
    $(`#${id}`).show("medium");
    setTimeout(function () {
        $(`#${id}`).hide("medium");
    }, 5000);
}
