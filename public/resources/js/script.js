document.querySelectorAll(".fa.fa-trash").forEach(item => {
    item.addEventListener("click", function (event) {
        const a = this.parentElement;
        if (!confirm(a.dataset.confirm) || a.dataset.method != 'delete') {
            event.preventDefault();
        }
    })
});

document.querySelectorAll(".fa.fa-comment").forEach(item => {
    item.parentElement.addEventListener("click", function (event) {
        if (!confirm(this.dataset.confirm) || this.dataset.method != 'put') {
            event.preventDefault();
        }
    })
});

