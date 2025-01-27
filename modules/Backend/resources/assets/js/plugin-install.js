$(document).ready(function () {
    let bodyElement = $("body");

    function showNotification(response) {
        if (
            typeof juzaweb !== "undefined" &&
            typeof juzaweb.message !== "undefined"
        ) {
            // Use Juzaweb's built-in notification system
            juzaweb.message(response.data);
        } else {
            // Create toast element
            const toastHtml = `
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" style="position: fixed; top: 20px; right: 20px; z-index: 9999 !important;">
                    <div class="toast-header">
                        <span class="avatar avatar-xs me-2 ${
                            response.status ? "bg-success" : "bg-danger"
                        }">
                            <i class="fas fa-${
                                response.status ? "check" : "times"
                            } text-white"></i>
                        </span>
                        <strong class="me-auto">${
                            response.status ? "Success" : "Error"
                        }</strong>
                        <small>just now</small>
                        <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${response.message}
                    </div>
                </div>
            `;

            // Create toast container if it doesn't exist
            let toastContainer = document.querySelector(".toast-container");
            if (!toastContainer) {
                toastContainer = document.createElement("div");
                toastContainer.className =
                    "toast-container position-fixed top-0 end-0 p-3";
                document.body.appendChild(toastContainer);
            }

            // Add toast to container
            const toastElement = $(toastHtml).appendTo(toastContainer)[0];

            // Initialize Bootstrap toast
            const toast = new bootstrap.Toast(toastElement);
            toast.show();

            // Remove toast after it's hidden
            $(toastElement).on("hidden.bs.toast", function () {
                $(this).remove();
            });
        }
    }

    bodyElement.on("click", ".install-plugin", function () {
        let plugin = $(this).data("plugin");
        let btn = $(this);
        let btnHtml = btn.html();
        let cardEl = btn.closest(".card");
        let progressBar = cardEl.find(".progress-bar");

        // Disable button and show loading state
        btn.prop("disabled", true);
        btn.html(
            '<i class="fa fa-spinner fa-spin"></i> ' +
                (mojar.lang.please_wait || "Installing...")
        );

        // Show progress animation
        progressBar
            .addClass("progress-bar-animated progress-bar-striped")
            .css("width", "100%")
            .attr("aria-valuenow", 100);

        jwCMSUpdate(
            "plugin",
            1,
            null,
            { plugin: plugin },
            function (response) {
                // Success callback
                showNotification({
                    status: true,
                    message:
                        response.message ||
                        mojar.lang.install_success ||
                        "Plugin installed successfully!",
                });

                // Update button to activation state
                btn.html(mojar.lang.activate || "Activate");
                btn.removeClass("install-plugin")
                    .addClass("active-plugin")
                    .prop("disabled", false);

                // Reset progress bar
                progressBar.removeClass(
                    "progress-bar-animated progress-bar-striped"
                );
            },
            function (response) {
                // Error callback
                showNotification({
                    status: false,
                    message:
                        response.message ||
                        mojar.lang.install_failed ||
                        "Installation failed",
                });

                // Reset button state
                btn.prop("disabled", false);
                btn.html(btnHtml);

                // Reset progress bar
                progressBar
                    .removeClass("progress-bar-animated progress-bar-striped")
                    .css("width", "0%");
            }
        );
    });

    bodyElement.on("click", ".active-plugin", function () {
        let plugin = $(this).data("plugin");
        let btn = $(this);
        let btnHtml = btn.html();

        // Update UI
        btn.prop("disabled", true);
        btn.html(
            '<i class="fa fa-spinner fa-spin"></i> ' +
                (mojar.lang.activating || "Activating...")
        );

        ajaxRequest(
            mojar.adminUrl + "/plugins/bulk-actions",
            {
                ids: [plugin],
                action: "activate",
            },
            {
                method: "POST",
                callback: function (response) {
                    showNotification(response);
                    showNotification({
                        status: true,
                        message:
                            mojar.lang.activated ||
                            "Plugin activated successfully!",
                    });

                    // Update button to activated state
                    btn.html(
                        `<i class="fa fa-check"></i> ${
                            mojar.lang.activated || "Activated"
                        }`
                    );
                    btn.removeClass("active-plugin")
                        .addClass("btn-success")
                        .prop("disabled", true);
                },
                failCallback: function (response) {
                    showNotification(response);

                    showNotification({
                        status: false,
                        message:
                            response.message ||
                            mojar.lang.activation_failed ||
                            "Activation failed",
                    });
                    // Reset button state
                    btn.prop("disabled", false);
                    btn.html(btnHtml);
                },
            }
        );
    });
});

// $(document).ready(function () {
//     let bodyElement = $('body');
//     bodyElement.on('click', '.install-plugin', function () {
//         let plugin = $(this).data('plugin');
//         let btn = $(this);
//         let btnText = btn.html();
//         btn.prop("disabled", true);
//         btn.html('<i class="fa fa-spinner fa-spin"></i> ' + mojar.lang.please_wait);

//         jwCMSUpdate(
//             'plugin',
//             1,
//             null,
//             { plugin: plugin },
//             function (response) {
//                 btn.html(mojar.lang.activate);
//                 btn.removeClass('install-plugin');
//                 btn.addClass('active-plugin');
//                 btn.prop("disabled", false);
//             },
//             function (response) {
//                 show_message(response);
//                 btn.prop("disabled", false);
//                 btn.html(btnText);
//             }
//         );
//     });

//     bodyElement.on('click', '.active-plugin', function () {
//         let plugin = $(this).data('plugin');
//         let btn = $(this);
//         btn.prop("disabled", true);

//         ajaxRequest(mojar.adminUrl + '/plugins/bulk-actions', {
//             ids: [plugin],
//             action: 'activate',
//         }, {
//             method: 'POST',
//             callback: function (response) {
//                 show_message(response);
//                 btn.html(`<i class="fa fa-check"></i> ${mojar.lang.activated}`);
//                 btn.removeClass('active-plugin');
//                 btn.prop("disabled", true);
//             },
//             failCallback: function (response) {
//                 show_message(response);
//                 btn.prop("disabled", false);
//             }
//         });
//     });
// });
