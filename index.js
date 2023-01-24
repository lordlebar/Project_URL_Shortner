window.onload = init;
$.ajaxSetup({ cache: false });

function init() {
    var search = document.getElementById('search');
    if (search) {
        jQuery.ajax({
            type: "POST",
            url: 'src/managers/getUrlsSearch.php',
            dataType: 'json',
            data: {search: search.value},
            success: function (obj, textstatus) {
                              createUrlTable(obj);
                    }
        });
    } else {
   	$.getJSON("src/managers/getUrls.php", function (data) {
		createUrlTable(data);
    	});
    }
}

function createUrlTable(urls) {
    $(`#bodyOfUrlArray`).empty();
    if (urls.length == 0) {
        let tr = document.createElement("tr");
        let td = document.createElement("td");
        td.setAttribute("colspan", "5");
        td.classList.add("text-center");
        td.innerHTML = `<h4 class="text-center">No url found</h4>`;
        tr.appendChild(td);
        bodyOfUrlArray.appendChild(tr);
        return;
    }
    for (const url in urls) {
        let row = urls[url];
        let tr = document.createElement("tr");

        td = document.createElement("td");
        td.classList.add("align-middle");
        td.innerHTML = `<a href="https://${window.location.host}/${row.short_url}" data-toggle="tooltip" data-placement="top" title="Go to url ${row.long_url}">${window.location.host}/${row.short_url}</a>`;
        tr.appendChild(td);

        td = document.createElement("td");
        td.classList.add("align-middle");
        let temp_url = row.long_url;
        // si row.long_url conotien un http:// ou https://
        if (temp_url.includes("http://"))
            // remove http://
            temp_url = row.long_url.replace("http://", "");
        else if (temp_url.includes("https://"))
            temp_url = temp_url.replace("https://", "");

        // si row.long_url contient un www.
        if (temp_url.includes("www.")) temp_url = temp_url.replace("www.", "");

        // si row.long_url contient un / à la fin
        // if (temp_url.includes("/")) temp_url = temp_url.replace("/", "");

        // si row.long_url contien plus de 30 caractères
        if (temp_url.length > 30) temp_url = temp_url.substring(0, 30) + "...";

        // // mettre la premiere lettre en majuscule
        // temp_url = temp_url.charAt(0).toUpperCase() + temp_url.slice(1);

        td.innerHTML = `<a href="${row.long_url}" data-toggle="tooltip" data-placement="top" title="short Url ${row.short_url}">${temp_url}</a>`;
        tr.appendChild(td);

        td = document.createElement("td");
        td.classList.add("align-middle");
        td.innerHTML = row.nb_click;
        tr.appendChild(td);

        // modifie l'url
        td = document.createElement("td");
        td.classList.add("align-middle");
        updateButton = document.createElement("button");
        updateButton.classList.add("btn", "btn-warning", "btn-rounded");
        updateButton.setAttribute("data-toggle", "tooltip");
        updateButton.setAttribute("data-placement", "top");
        updateButton.setAttribute("title", "Update url " + row.short_url);
        updateButton.onclick = () => updateUrl(row, tr);
        updateButton.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;
        td.appendChild(updateButton);
        tr.appendChild(td);

        // supprime l'url
        td = document.createElement("td");
        td.classList.add("align-middle");
        deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-danger", "btn-rounded");
        deleteButton.setAttribute("data-toggle", "tooltip");
        deleteButton.setAttribute("data-placement", "top");
        deleteButton.setAttribute("title", "Delete User " + row.email);
        deleteButton.onclick = () => deleteUrl(row, tr);
        deleteButton.innerHTML = `<i class="fa-solid fa-trash-can"></i>`;
        td.appendChild(deleteButton);
        tr.appendChild(td);

        bodyOfUrlArray.appendChild(tr);
    }
}

function updateUrl(row, tr) {
    $(`#updateUrlModal`).modal("show");
    $(`.modal-data-short_url`).text(row.short_url);
    $(`.modal-data-short_url`).val(row.short_url);
    $(`.modal-data-long_url`).val(row.long_url);
}

function deleteUrl(row, tr) {
    $(`#deleteUrlModal`).modal("show");
    $(`.modal-data-short_url`).text(row.short_url);
    $(`.modal-data-short_url`).val(row.short_url);

    if (row.long_url.length > 45)
        row.long_url = row.long_url.substring(0, 45) + "...";

    // si row.long_url conotien plus de 40 caractères et screen en dessous de 350 px
    if (row.long_url.length > 40 && window.screen.width < 390) {
        // si row.long_url contient un http:// ou https://
        if (row.long_url.includes("http://"))
            // remove http://
            row.long_url = row.long_url.replace("http://", "");
        else if (row.long_url.includes("https://"))
            row.long_url = row.long_url.replace("https://", "");

        // on coupe a plus de 33 caracteres
        row.long_url = row.long_url.substring(0, 27) + "...";
    }
    $(`.modal-data-long_url`).text(row.long_url);
}

function createAlert(id, name) {
    $(`.alert-name`).text(name);
    $(`#${id}`).show("medium");
    setTimeout(function () {
        $(`#${id}`).hide("medium");
    }, 5000);
}
