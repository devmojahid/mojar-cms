document.addEventListener('DOMContentLoaded', function() {
    const steps = [
        { id: 1, name: "Welcome", path: "index.html" },
        { id: 2, name: "Requirements", path: "requirements.html" },
        { id: 3, name: "Environment", path: "environment.html" },
        { id: 4, name: "Theme", path: "theme.html" },
        { id: 5, name: "Account", path: "account.html" },
        { id: 6, name: "License", path: "license.html" },
        { id: 7, name: "Complete", path: "complete.html" },
    ];

    const currentPath = window.location.pathname.split('/').pop();
    const currentStep = steps.findIndex(step => step.path === currentPath) + 1;

    const stepper = document.getElementById('stepper');
    if (stepper) {
        steps.forEach((step, index) => {
            const stepElement = document.createElement('div');
            stepElement.className = `step ${index + 1 <= currentStep ? 'active' : ''}`;
            stepElement.innerHTML = `
                <div class="step-icon">${index + 1}</div>
                <div class="step-label">${step.name}</div>
            `;
            stepper.appendChild(stepElement);
        });
    }

    // Requirements page functionality
    const requirementsContainer = document.getElementById('requirements');
    const permissionsContainer = document.getElementById('permissions');
    const continueBtn = document.getElementById('continueBtn');

    if (requirementsContainer && permissionsContainer && continueBtn) {
        const requirements = [
            { name: "PHP Version (>= 8.1.0)", status: true },
            { name: "MySQL Version (>= 5.7)", status: true },
            { name: "BCMath PHP Extension", status: true },
            { name: "Ctype PHP Extension", status: true },
            { name: "JSON PHP Extension", status: true },
            { name: "Mbstring PHP Extension", status: false },
            { name: "OpenSSL PHP Extension", status: true },
            { name: "PDO PHP Extension", status: true },
            { name: "Tokenizer PHP Extension", status: true },
            { name: "XML PHP Extension", status: true },
        ];

        const permissions = [
            { path: "/storage/app", status: true },
            { path: "/storage/framework", status: true },
            { path: "/storage/logs", status: false },
            { path: "/bootstrap/cache", status: true },
            { path: "/.env", status: true },
        ];

        requirements.forEach(req => {
            const reqElement = document.createElement('div');
            reqElement.className = "flex items-center justify-between p-3 rounded-lg bg-gray-50";
            reqElement.innerHTML = `
                <span class="text-sm font-medium">${req.name}</span>
                ${req.status
                    ? '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                    : '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                }
            `;
            requirementsContainer.appendChild(reqElement);
        });

        permissions.forEach(perm => {
            const permElement = document.createElement('div');
            permElement.className = "flex items-center justify-between p-3 rounded-lg bg-gray-50";
            permElement.innerHTML = `
                <span class="text-sm font-medium">${perm.path}</span>
                ${perm.status
                    ? '<div class="flex items-center gap-2 text-green-500"><span class="text-sm">Writable</span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>'
                    : '<div class="flex items-center gap-2 text-red-500"><span class="text-sm">Not Writable</span><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>'
                }
            `;
            permissionsContainer.appendChild(permElement);
        });

        const allRequirementsMet = requirements.every(r => r.status) && permissions.every(p => p.status);
        continueBtn.disabled = !allRequirementsMet;
        if (!allRequirementsMet) {
            continueBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Theme page functionality
    const themesContainer = document.getElementById('themes');
    if (themesContainer) {
        const themes = [
            { id: 1, name: "Default Light", image: "/placeholder.svg?height=200&width=300", selected: true },
            { id: 2, name: "Modern Dark", image: "/placeholder.svg?height=200&width=300", selected: false },
            { id: 3, name: "Classic", image: "/placeholder.svg?height=200&width=300", selected: false },
            { id: 4, name: "Minimal", image: "/placeholder.svg?height=200&width=300", selected: false },
        ];

        themes.forEach(theme => {
            const themeElement = document.createElement('div');
            themeElement.className = `relative rounded-lg overflow-hidden border-2 transition-all cursor-pointer ${theme.selected ? 'border-[#066fd1] shadow-md' : 'border-transparent hover:border-gray-200'}`;
            themeElement.innerHTML = `
                <img src="${theme.image}" alt="${theme.name}" class="w-full h-[200px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4">
                    <h3 class="text-lg font-medium text-white">${theme.name}</h3>
                </div>
                ${theme.selected ? `
                    <div class="absolute top-4 right-4">
                        <div class="w-6 h-6 rounded-full bg-[#066fd1] text-white flex items-center justify-center">
                            ✓
                        </div>
                    </div>
                ` : ''}
            `;
            themesContainer.appendChild(themeElement);
        });
    }
});
