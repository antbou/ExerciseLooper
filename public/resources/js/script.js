document.querySelectorAll(".fa.fa-trash").forEach(item => {
    item.addEventListener("click", function (event) {
        const a = this.parentElement;
        if (!confirm(a.dataset.confirm) || a.dataset.method != 'delete') {
            event.preventDefault();
        }
    })
});