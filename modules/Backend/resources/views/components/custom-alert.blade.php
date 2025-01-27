<!-- Reusable Custom Alert Modal -->
<div class="modal fade" id="customAlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close m-2 ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        
        <!-- Status strip at the top -->
        <div class="modal-status" id="customAlertModalStatus"></div>
        
        <!-- Modal body -->
        <div class="modal-body text-center py-4">
          <svg 
            id="customAlertModalIcon" 
            xmlns="http://www.w3.org/2000/svg" 
            class="icon mb-2 icon-lg" 
            width="24" 
            height="24" 
            viewBox="0 0 24 24" 
            stroke-width="2" 
            stroke="currentColor" 
            fill="none" 
            stroke-linecap="round" 
            stroke-linejoin="round"
          >
            <!-- Example path for 'danger' icon; we will update dynamically -->
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3 id="customAlertModalTitle">Are you sure?</h3>
          <div class="text-secondary" id="customAlertModalMessage">Do you really want to ... ?</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button 
                  class="btn w-100" 
                  data-bs-dismiss="modal"
                  id="customAlertModalCancelBtn"
                >
                  Cancel
                </button>
              </div>
              <div class="col">
                <button
                  class="btn w-100 btn-danger"
                  id="customAlertModalConfirmBtn"
                >
                  Confirm
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Immediately-Invoked Function Expression (IIFE) to avoid polluting global scope
    (function() {
      // Make sure DOM is ready
      document.addEventListener('DOMContentLoaded', function() {
        // Grab the modal element
        const modalEl = document.getElementById('customAlertModal');
        // Bootstrap's modal instance
        const bsModal = new bootstrap.Modal(modalEl, {
          backdrop: 'static',  // do not close on backdrop click (if you want)
          keyboard: false      // do not close on ESC (if you want)
        });
  
        // Grab sub-elements
        const modalStatusEl   = document.getElementById('customAlertModalStatus');
        const modalIconEl     = document.getElementById('customAlertModalIcon');
        const modalTitleEl    = document.getElementById('customAlertModalTitle');
        const modalMessageEl  = document.getElementById('customAlertModalMessage');
        const cancelBtnEl     = document.getElementById('customAlertModalCancelBtn');
        const confirmBtnEl    = document.getElementById('customAlertModalConfirmBtn');
  
        // We'll store the current callbacks so we can call them properly
        let onConfirmCallback = null;
        let onCancelCallback  = null;
  
        // Attach event listeners to the buttons
        cancelBtnEl.addEventListener('click', function() {
          // If user provided a custom onCancel callback, call it
          if (typeof onCancelCallback === 'function') {
            onCancelCallback();
          }
        });
  
        confirmBtnEl.addEventListener('click', function() {
          // If user provided a custom onConfirm callback, call it
          if (typeof onConfirmCallback === 'function') {
            onConfirmCallback();
          }
        });
  
        // Build a global object with a .show() method
        window.CustomAlert = {
          /**
           * Show the custom alert modal
           * @param {Object} options - configuration object
           * @param {string} options.title - the title text
           * @param {string} options.message - the message body
           * @param {string} options.icon - one of 'danger' | 'success' | 'info' | 'warning' | etc.
           * @param {string} options.confirmText - label for confirm button
           * @param {string} options.cancelText - label for cancel button
           * @param {string} options.confirmBtnClass - extra classes for confirm button (e.g. 'btn-danger')
           * @param {function} options.onConfirm - callback for confirm
           * @param {function} options.onCancel - callback for cancel
           */
          show: function(options) {
            // Set defaults if needed
            const {
              title          = 'Are you sure?',
              message        = 'Do you really want to do this?',
              icon           = 'danger', // possible values: danger|success|info|warning
              confirmText    = 'Confirm',
              cancelText     = 'Cancel',
              confirmBtnClass= 'btn-danger',
              onConfirm      = null,
              onCancel       = null
            } = options;
  
            // Store callbacks so we can call them later
            onConfirmCallback = onConfirm;
            onCancelCallback  = onCancel;
  
            // Update title & message
            modalTitleEl.innerText   = title;
            modalMessageEl.innerText = message;
  
            // Update the top bar color
            // e.g., 'bg-danger', 'bg-success', 'bg-info', etc. 
            // We'll remove the old "bg-" classes and add the new one
            modalStatusEl.className = 'modal-status bg-' + icon;
  
            // Change the icon color or SVG path as needed 
            // For demonstration, let's just update the CSS class 
            // that changes the stroke color:
            modalIconEl.className = 'icon mb-2 icon-lg text-' + icon;
            
            // You could also add logic to change the <path> inside the SVG,
            // or swap out the <svg> entirely based on the icon type.
  
            // Update the button labels
            cancelBtnEl.textContent  = cancelText;
            confirmBtnEl.textContent = confirmText;
  
            // Remove any old class (like 'btn-danger', 'btn-success') from confirm button
            confirmBtnEl.className = 'btn w-100 ' + confirmBtnClass;
  
            // Now, finally, show the modal
            bsModal.show();
          },
  
          /**
           * Hide the modal programmatically if needed
           */
          hide: function() {
            bsModal.hide();
          }
        };
  
      });
    })();
  </script>