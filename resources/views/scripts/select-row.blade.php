<script>
    let selected = [];
    let selectAll = false;

    function toggleSelectAll(numRows) {
        selectAll = !selectAll;
        for (let i = 1; i <= numRows; i++) {
            document.querySelectorAll('#check-' + i).forEach(el => {
                el.checked = selectAll;
            });
            toggleSelected(i, selectAll);
        }
    }

    function toggleSelected(id, value) {
        if (value === undefined) {
            selected[id] = !selected[id];
        } else {
            selected[id] = value;
        }

        if (selected.filter(s => s === true).length > 0) {
            document.querySelector('#row-actions').classList.remove('hidden');
        } else {
            document.querySelector('#row-actions').classList.add('hidden');
        }

        // array of [id, class-toggle, invert]
        let elems = [
            ['tr', 'row-selected', false],
            ['marker', 'hidden', true],
        ];

        for (let el of elems) {
            document.querySelectorAll('#' + el[0] + '-' + id).forEach(e => {
                if (selected[id] !== undefined && (selected[id] === true)) {
                    if (!el[2]) {
                        e.classList.add(el[1]);
                    } else {
                        e.classList.remove(el[1]);
                    }
                } else {
                    if (!el[2]) {
                        e.classList.remove(el[1]);
                    } else {
                        e.classList.add(el[1]);
                    }
                }
            });
        }

        // array of [class, class-selected, class-unselected]
        elems = [
            ['tdh', 'tdh-selected', 'tdh-unselected'],
            // ['tdl', 'tdl-selected', 'tdl-unselected'],
        ];

        for (let el of elems) {
            document.querySelectorAll('#tr-' + id + ' > [class~="' + el[0] + '"]').forEach(e => {
                if (selected[id] !== undefined && (selected[id] === true)) {
                    e.classList.add(el[1]);
                    e.classList.remove(el[2]);
                } else {
                    e.classList.remove(el[1]);
                    e.classList.add(el[2]);
                }
            });
        }
    }
</script>
