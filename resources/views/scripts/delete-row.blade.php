<script>
function deleteTableRow(formId) {
    event.preventDefault();

    let txt = event.target.getAttribute("data-confirm");
    if (!txt) {
        txt = event.currentTarget.getAttribute("data-confirm");
        if (!txt) {
            txt = 'Are you sure?';
        }
    }
    let choice = confirm(txt);

    if (choice) {
        document.querySelector("#" + formId).submit();
    }
}
</script>
