
    $(function() {
        $('.btn-add-menu').on('click', function(e) {
            e.preventDefault();
            console.log('test');
            CustomAlert.show({
                title: "{{ trans('cms::app.are_you_sure') }}",
                message: "{{ trans('cms::app.action_cannot_be_undone') }}",
                icon: "danger",
                confirmText: "{{ trans('cms::app.ok') }}",
                cancelText: "{{ trans('cms::app.cancel') }}",
            });
        });
    });
