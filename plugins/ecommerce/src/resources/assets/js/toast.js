class ToastNotification {
    constructor() {
        this.toast = document.querySelector("#toast");
        this.toastTimer = document.querySelector("#timer");
        this.closeToastBtn = document.querySelector("#toast-close");
        this.countdown = null;

        if (this.closeToastBtn) {
            this.closeToastBtn.addEventListener("click", () => this.close());
        }

        // Auto-show toast if it exists on page load
        if (this.toast) {
            this.show();
        }
    }

    show() {
        this.toast.style.animation = "open 0.3s cubic-bezier(.47,.02,.44,2) forwards";
        this.toastTimer.classList.add("timer-animation");

        clearTimeout(this.countdown);
        this.countdown = setTimeout(() => {
            this.close();
        }, parseInt(this.toast.dataset.duration || 5000));
    }

    close() {
        this.toast.style.animation = "close 0.3s cubic-bezier(.87,-1,.57,.97) forwards";
        this.toastTimer.classList.remove("timer-animation");
        clearTimeout(this.countdown);
    }

    static init() {
        return new ToastNotification();
    }
}

// Initialize on document load
document.addEventListener('DOMContentLoaded', () => {
    ToastNotification.init();
});

// Initialize when navigating with Turbolinks (if used)
document.addEventListener('turbolinks:load', () => {
    ToastNotification.init();
});
