// stepper.js
const steps = [
    { id: 1, name: "Welcome", path: "/installer/welcome" },
    { id: 2, name: "Requirements", path: "/installer/requirements" },
    { id: 3, name: "Environment", path: "/installer/environment" },
    { id: 4, name: "Theme", path: "/installer/theme" },
    { id: 5, name: "Account", path: "/installer/account" },
    { id: 6, name: "License", path: "/installer/license" },
    { id: 7, name: "Complete", path: "/installer/complete" }
];

class Stepper {
    constructor() {
        this.currentStep = 1;
        this.init();
    }

    init() {
        const wrapper = document.querySelector('.stepper-wrapper');
        const stepsHtml = `
            <div class="stepper-progress">
                <div class="stepper-progress-bar" style="width: 0%"></div>
            </div>
            <div class="stepper-steps">
                ${steps.map(step => this.createStepElement(step)).join('')}
            </div>
        `;
        wrapper.innerHTML = stepsHtml;
        this.updateProgress();
    }

    createStepElement(step) {
        return `
            <a href="#" class="step-item" data-step="${step.id}">
                <div class="step-circle">
                    <i class="fas fa-circle"></i>
                </div>
                <span class="step-label">${step.name}</span>
            </a>
        `;
    }

    updateProgress() {
        const progressBar = document.querySelector('.stepper-progress-bar');
        const progress = ((this.currentStep - 1) / (steps.length - 1)) * 100;
        progressBar.style.width = `${progress}%`;

        document.querySelectorAll('.step-item').forEach((item, index) => {
            const stepNumber = index + 1;
            const circle = item.querySelector('.step-circle');
            const label = item.querySelector('.step-label');

            if (stepNumber === this.currentStep) {
                circle.style.borderColor = '#066fd1';
                circle.style.color = '#066fd1';
                label.style.opacity = '1';
            } else if (stepNumber < this.currentStep) {
                circle.style.borderColor = '#066fd1';
                circle.style.backgroundColor = '#066fd1';
                circle.style.color = '#fff';
                label.style.opacity = '1';
            } else {
                circle.style.borderColor = 'rgba(255, 255, 255, 0.4)';
                circle.style.color = 'rgba(255, 255, 255, 0.4)';
                label.style.opacity = '0.4';
            }
        });
    }

    setStep(step) {
        this.currentStep = step;
        this.updateProgress();
    }
}

// Initialize stepper
const stepper = new Stepper();
