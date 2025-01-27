(function () {
    // Create a global "CustomToast" object
    window.CustomToast = {
        /**
         * Show a new toast
         * @param {Object} options
         *   options.title - string (optional)
         *   options.message - string (required)
         *   options.type - "success", "error", "warning", "info", etc. (default "info")
         *   options.duration - time in ms to auto-hide (default 3000)
         *   options.onClose - callback when the toast is closed
         */
        show: function (options) {
            const {
                title = "",
                message = "",
                type = "info",
                duration = 3000,
                onClose = null,
            } = options || {};

            // Ensure container exists
            let container = document.querySelector(".custom-toast-container");
            if (!container) {
                container = document.createElement("div");
                container.className = "custom-toast-container";
                document.body.appendChild(container);
            }

            // Build the toast element
            const toastEl = document.createElement("div");
            toastEl.className = `custom-toast border-${mapTypeToBorder(type)}`;

            // Fill the toast content
            toastEl.innerHTML = `
          <div class="custom-toast-header">
            <span class="custom-toast-title">${title || ""}</span>
            <button type="button" class="custom-toast-close" aria-label="Close">&times;</button>
          </div>
          <div class="custom-toast-message">${message}</div>
        `;

            // Append it to the container
            container.appendChild(toastEl);

            // Use slight delay to trigger animation
            setTimeout(() => {
                toastEl.classList.add("show-toast");
            }, 10);

            // Handle manual close
            const closeBtn = toastEl.querySelector(".custom-toast-close");
            closeBtn.addEventListener("click", function () {
                removeToast(toastEl, onClose);
            });

            // Auto-hide after "duration" ms (if duration > 0)
            if (duration && duration > 0) {
                setTimeout(() => {
                    removeToast(toastEl, onClose);
                }, duration);
            }
        },
    };

    // Helper to remove the toast
    function removeToast(toastEl, onClose) {
        toastEl.classList.remove("show-toast");
        // Wait for CSS transition
        setTimeout(() => {
            toastEl.remove();
            if (typeof onClose === "function") {
                onClose();
            }
        }, 300);
    }

    // Helper to map "type" -> correct color classes
    function mapTypeToBorder(type) {
        switch (type) {
            case "success":
                return "success";
            case "error":
                return "danger";
            case "warning":
                return "warning";
            case "info":
                return "info";
            default:
                return "info";
        }
    }
})();


/**
 * Usage:
 CustomToast.show({
  title: "Success!",
  message: "Your plugin was activated successfully.",
  type: "success", // success | error | warning | info
  duration: 4000,  // 4s
  onClose: function() {
    console.log("Toast closed!");
  }
    });
* for error
    CustomToast.show({
  title: "Oops!",
  message: "Something went wrong while deleting the plugin.",
  type: "error",
  duration: 0 // if you want the toast to stay until user closes
});
 */