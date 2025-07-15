<div id="row-actions" class="hidden relative">
  <div class="absolute top-0 left-14 flex h-12 items-center space-x-3 bg-white sm:left-12">
    <form action="{{$editLink}}" method="post" id="editForm" data-array-var="{{ $arrayVar }}">
      @csrf
    <button type="submit"
            class="inline-flex items-center rounded-sm bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
      {{ __('PermissionsUI::permissions.global.bulk_edit') }}
    </button>
    </form>
    <form action="{{$deleteLink}}" method="post" id="deleteForm" data-array-var="{{ $arrayVar }}"
          data-confirm="{{ __('PermissionsUI::permissions.global.confirm_action') }}">
      @csrf
    <button type="submit"
            class="inline-flex items-center rounded-sm bg-white px-2 py-1 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
      {{ __('PermissionsUI::permissions.global.delete_all') }}
    </button>
    </form>
  </div>
</div>
<script>
    document.querySelectorAll("#editForm, #deleteForm").forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            if (selected === undefined) return false;

            const form = event.currentTarget;
            let count = 0;

            selected.forEach((value, id)=>{
                if (value) {
                    count++;
                    const rowId = document.querySelector('#check-' + id).getAttribute('data-id');
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = form.getAttribute('data-array-var');
                    hiddenField.value = rowId;
                    form.appendChild(hiddenField);
                }
            });

            if (count === 0) return false; // no rows selected

            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'returnUrl';
            hiddenField.value = location.href;
            form.appendChild(hiddenField);

            if (form.id === 'deleteForm') {
                if(!confirm(form.getAttribute('data-confirm'))) return false;
            }
            form.submit();
        });
    });
</script>
