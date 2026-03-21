document.addEventListener('alpine:init', () => {
    Alpine.data('onboardingStep', (initialData = {}) => ({
        isLoading: false,
        data: initialData,

        submit(route, options = {}) {
            if (this.isLoading) return;
            this.isLoading = true;

            const isFormData = options.isFormData || false;
            let body;
            let headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Accept': 'application/json',
            };

            if (isFormData) {
                body = options.formData;
            } else {
                body = JSON.stringify(this.data);
                headers['Content-Type'] = 'application/json';
            }

            fetch(route, {
                method: 'POST',
                headers: headers,
                body: body
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    this.isLoading = false;
                    // Potential error handling here if needed
                }
            })
            .catch(err => {
                this.isLoading = false;
                console.error('Onboarding submission failed:', err);
            });
        }
    }));
});
