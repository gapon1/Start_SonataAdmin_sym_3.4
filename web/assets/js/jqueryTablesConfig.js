$(document).ready(function () {
    $('#example').DataTable(
        {
            initComplete: function () {

                var api = this.api();
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                $('.thead2', this.api().table().header()).each(function (i) {
                    if ($(this).hasClass('filterhead')) {
                        var column = api.column(i);
                        var title = column.header();
                        //replace spaces with dashes
                        title = $(title).html().replace(/[W]/g, '-');

                        var select = $('<select id="' + title + '" class="select2" ></select>')
                            .appendTo($(this).empty())
                            .on('change', function () {
                                //Get the "text" property from each selected data
                                //regex escape the value and store in array
                                var data = $.map($(this).select2('data'), function (value, key) {
                                    return value.text ? '^' + $.fn.dataTable.util.escapeRegex(value.text) + '$' : null;
                                });

                                //if no data selected use ""
                                if (data.length === 0) {
                                    data = [""];
                                }

                                //join array into string with regex or (|)
                                var val = data.join('|');

                                //search for the option(s) selected
                                column
                                    .search(val ? val : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });

                        //use column title as selector and placeholder
                        $('#' + title).select2({
                            multiple: true,
                            closeOnSelect: false,
                            placeholder: "Выбрать " + title
                        });

                        //initially clear select otherwise first option is selected
                        $('.select2').val(null).trigger('change');
                    }
                });
            },
            "language": {
                "lengthMenu": "Отображать _MENU_  записей на странице",
                "zeroRecords": "Ничего не найдено - извините",
                "info": "Показано страниц _PAGE_ из _PAGES_",
                "infoEmpty": "Нет доступных записей",
                "search": "Поиск",
                "paginate": {
                    "previous": 'Предыдущий',
                    "next": 'Следующий'
                },
                "infoFiltered": "(Отфильтровано из _MAX_ общее количество записей)"
            },

            "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Все"]],
            "iDisplayLength": 5,
        }
    );

});

function checkAll(bx) {
    var cbs = document.getElementsByTagName('input');
    for (var i = 0; i < cbs.length; i++) {
        if (cbs[i].type == 'checkbox') {
            cbs[i].checked = bx.checked;
        }
    }
}

sortingBetween('#min', '#max', 6);
sortingBetween('#min1', '#max1', 8);
sortingBetween('#min2', '#max2', 9);
sortingBetween('#min3', '#max3', 10);

$(document).ready(function () {
    var table = $('#example').DataTable();
    // Event listener to the two range filtering inputs to redraw on input
    $('#max, #max1, #max2, #max3, #min, #min1, #min2, #min3').change(function () {
        table.draw();
    });
});

function sortingBetween(idMin, IdMax, number) {
    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = parseInt($(idMin).val(), 10);
            var max = parseInt($(IdMax).val(), 10);
            var totalArea = parseFloat(data[number]) || 0; // use data for the age column

            if ((isNaN(min) && isNaN(max)) ||
                (isNaN(min) && totalArea <= max) ||
                (min <= totalArea && isNaN(max)) ||
                (min <= totalArea && totalArea <= max)) {
                return true;
            }

            return false;
        }
    );
}
