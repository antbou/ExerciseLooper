document.querySelectorAll(".fa.fa-trash").forEach(item => {
    item.addEventListener("click", function () {
        if (!confirm(item.dataset.confirm) || item.dataset.method != 'delete') return false;

        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        if (!csrf) return false;

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () { // listen for state changes
            if (xhttp.readyState == 4 && xhttp.status == 200) { // when completed we can move away
                let text = JSON.parse(xhttp.responseText); // Get route url via api
                window.location = text.route;
            }
        }
        xhttp.open("POST", item.dataset.href, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("_method=delete&token=" + csrf);
    })
});

document.querySelectorAll(".status").forEach(item => {
    item.addEventListener("click", function () {
        if (!confirm(this.dataset.confirm)) {
            return false;
        }

        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        if (!csrf) return false;

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () { // listen for state changes
            if (xhttp.readyState == 4 && xhttp.status == 200) { // when completed we can move away
                let text = JSON.parse(xhttp.responseText); // Get route url via api
                window.location = text.route;
            }
        }
        xhttp.open("POST", item.dataset.href, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("_method=delete&token=" + csrf);
    })
});

