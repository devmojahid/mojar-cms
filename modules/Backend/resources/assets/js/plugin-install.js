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
            CustomToast.show({
                title: response.status ? 'Success!' : 'Error!',
                message: response.message,
                type: response.status ? 'success' : 'error',
                duration: 4000,
                onClose: function() {
                    // Optional callback when toast is closed
                    //
                }
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
