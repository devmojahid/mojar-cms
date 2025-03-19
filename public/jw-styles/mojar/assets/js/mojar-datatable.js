class mojarTable {

    constructor(e) {
        this.url = e.url;
        this.action_url = e.action_url;
        this.remove_url = e.remove_url || null;
        this.status_url = e.status_url || null;
        // this.remove_question = (e.remove_question) ? e.remove_question : mojar.lang.remove_question.replace(':name', mojar.lang.the_selected_items);
        this.detete_button = (e.detete_button) ? e.detete_button : "#delete-item";
        this.status_button = (e.status_button) ? e.status_button : ".status-button";
        this.apply_button = (e.apply_button) ? e.apply_button : "#apply-action";
        this.table = (e.table) ? e.table : 'mojarTable';
        this.field_id = (e.field_id) ? e.field_id : 'id';
        this.form_search = (e.form_search) ? e.form_search : "#form-search";
        this.sort_name = (e.sort_name) ? e.sort_name : 'id';
        this.sort_order = (e.sort_order) ? e.sort_order : 'desc';
        this.page_size = (e.page_size) ? e.page_size : 10;
        this.search = (e.search) ? e.search : false;
        this.method = (e.method) ? e.method : 'get';
        this.locale = (e.locale) ? e.locale : 'en-US';
        this.chunk_action = (e.chunk_action) ? e.chunk_action : false;
        this.inputRow = "";
        this.init();
    }

    init() {

        let table = this.table;
        let form_search = this.form_search;
        let action_url = this.action_url;
        let remove_url = this.remove_url;
        let data_url = this.url;
        let field_id = this.field_id;
        let method = this.method;
        let locale = this.locale;
        let status_url = this.status_url;
        let chunk_action = this.chunk_action;
        let search = this.search;
        let apply_button = $(this.apply_button);
        let btn_status = $(this.status_button);
        let bulkActionButton = $('.bulk-action-button');
        apply_button.prop('disabled', true);
        btn_status.prop('disabled', true);
        bulkActionButton.prop('disabled', true);

        let dataTableState = new DataTable("#mojarTable", {
            "dom": '<"top">rt<"card-footer d-flex align-items-center"ip><"clear">',
            "paging": true,
            "searching": search,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "autoWidth": true,
            "responsive": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 75, 100],
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
            "language": {
                "search": "",
                "searchPlaceholder": "Search..."
            },
            "initComplete": function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        $(".search").on("keyup", function () {
            dataTableState.search($(this).val()).draw();
        });

        $('.entries-count').on('change', function () {
            dataTableState.page.len(this.value).draw();
        });

    }


}