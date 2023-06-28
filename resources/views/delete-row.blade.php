<script>
function deleteTableRow(formId) {
    event.preventDefault();

    var choice = confirm(event.target.getAttribute("data-confirm"));

    if (choice) {
        document.querySelector("#" + formId).submit();
    }
}
</script>
