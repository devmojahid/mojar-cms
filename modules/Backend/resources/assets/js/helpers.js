toastr.options.timeOut = 3000;

function toastr_message(message, status, title = null) {
    if (status == true) {
        toastr.success(message, title || mojar.lang.successfully + ' !!');
    } else {
        toastr.error(message, title || mojar.lang.error + ' !!');
    }
}

function confirm_message(question, callback, title = '', type = 'warning') {
    Swal.fire({
        title: title,
        text: question,
        type: type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: mojar.lang.yes + '!',
        cancelButtonText: mojar.lang.cancel + '!',
    }).then((result) => {
        callback(result.value);
    });
}

function get_message_response(response) {
    // Get response message
    if (response.data) {
        if (response.data.message) {
            return {
                status: response.status,
                message: response.data.message
            };
        }
        return false;
    }

    // Get message validate
    if (response.responseJSON) {
        if (response.responseJSON.errors) {
            let message = '';
            $.each(response.responseJSON.errors, function (index, msg) {
                message = msg[0];
                return false;
            });

            return {
                status: false,
                message: message
            };
        }

        else if (response.responseJSON.message) {
            return {
                status: false,
                message: response.responseJSON.message
            };
        }
    }

    // Get message errors
    if (response.message) {
        return {
            status: false,
            message: response.message.message
        };
    }
}

function show_message(response, append = false) {
    let msg = get_message_response(response);
    if (!msg) {
        return;
    }

    // let msgHTML = `<div class="alert alert-${msg.status ? 'success' : 'danger'} jw-message">
    //     <button type="button" class="close" data-dismiss="alert" aria-label="${mojar.lang.close}">
    //         <span aria-hidden="true">&times;</span>
    //     </button>

    //     ${msg.status ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'} ${msg.message}
    // </div>`;
    let msgHTML = `<div class="alert alert-${msg.status ? 'success' : 'danger'} alert-dismissible jw-message" role="alert">
        <div class="d-flex">
            <div>
                ${msg.status ? '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>'}
            </div>
            <div>
                ${msg.message}
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close" data-id="${msg.id}"></a>
        </div>
    </div>`;

    if (append) {
        $('#jquery-message').append(msgHTML);
    } else {
        $('#jquery-message').html(msgHTML);
    }
}

function show_notify(response) {
    let msg = get_message_response(response);
    toastr_message(msg.message, msg.status);
}

function htmlspecialchars(str) {
    str = String(str);
    return str.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
}

function toggle_global_loading(status, timeout = 300) {
    if (status) {
        $("#admin-overlay").fadeIn(300);
    } else {
        setTimeout(function () {
            $("#admin-overlay").fadeOut(300);
        }, timeout);
    }
}
