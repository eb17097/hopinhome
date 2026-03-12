document.addEventListener('alpine:init', () => {
    Alpine.data('authModal', () => ({
        showModal: false,
        step: 'email',
        email: '',
        emailError: '',
        error: '',
        password: '',
        passwordError: '',
        showPassword: false,
        showRegisterPassword: false,
        isLoading: false,
        isResending: false,
        verifyCode: ['', '', '', '', '', ''],
        otpError: '',
        otpSuccessMessage: '',
        resendTimer: 60,
        resendInterval: null,
        resetToken: '',
        passwordConfirmation: '',
        firstName: '',
        lastName: '',
        country: '',
        agreeTerms: false,
        receiveUpdates: false,
        registerError: '',

        init() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('reset_token') && urlParams.has('email')) {
                this.showModal = true;
                this.step = 'reset_password';
                this.resetToken = urlParams.get('reset_token');
                this.email = urlParams.get('email');

                const cleanUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }
        },

        resetModal() {
            this.step = 'email';
            this.email = '';
            this.emailError = '';
            this.error = '';
            this.password = '';
            this.passwordError = '';
            this.showPassword = false;
            this.showRegisterPassword = false;
            this.verifyCode = ['', '', '', '', '', ''];
            this.otpError = '';
            this.otpSuccessMessage = '';
            this.registerError = '';
            this.passwordConfirmation = '';
            this.firstName = '';
            this.lastName = '';
            this.country = '';
            this.agreeTerms = false;
            this.receiveUpdates = false;
            clearInterval(this.resendInterval);
            this.resendTimer = 60;
        },

        startResendTimer() {
            this.resendTimer = 60;
            clearInterval(this.resendInterval);
            this.resendInterval = setInterval(() => {
                if (this.resendTimer > 0) {
                    this.resendTimer--;
                } else {
                    clearInterval(this.resendInterval);
                }
            }, 1000);
        },

        async handleEmailContinue() {
            if (this.email.trim() === '') {
                this.emailError = 'Email address is required.';
                return;
            }

            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/check-email', { email: this.email });
                
                if (data.exists) {
                    this.step = 'password';
                } else {
                    await this.sendOtp();
                }
            } catch (err) {
                this.emailError = 'An error occurred. Please try again.';
            } finally {
                this.isLoading = false;
            }
        },

        async sendOtp() {
            try {
                const { data } = await axios.post('/ajax/send-otp', { email: this.email });
                if (data.status === 'success') {
                    this.step = 'verify_email';
                    this.startResendTimer();
                } else {
                    this.emailError = data.message || 'Failed to send verification code.';
                }
            } catch (err) {
                this.emailError = 'An error occurred sending the code.';
            }
        },

        async resendOtp(inputSelector) {
            if (this.resendTimer > 0 || this.isResending) return;
            
            this.otpError = '';
            this.otpSuccessMessage = '';
            this.isResending = true;
            
            try {
                const { data } = await axios.post('/ajax/send-otp', { email: this.email });
                if (data.status === 'success') {
                    this.otpSuccessMessage = 'A new code has been sent!';
                    this.verifyCode = ['', '', '', '', '', ''];
                    this.startResendTimer();
                    setTimeout(() => {
                        const inputs = document.querySelectorAll(inputSelector);
                        if (inputs[0]) inputs[0].focus();
                    }, 10);
                } else {
                    this.otpError = data.message || 'Failed to resend.';
                }
            } catch (err) {
                this.otpError = 'An error occurred while resending the code.';
            } finally {
                this.isResending = false;
            }
        },

        async handleVerifyOtp() {
            const code = this.verifyCode.join('');
            if (code.length < 6) {
                this.otpError = 'Please enter the 6-digit code.';
                return;
            }

            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/verify-otp', { email: this.email, code });
                if (data.status === 'success') {
                    this.step = 'finish_signup';
                } else {
                    this.otpError = data.message || 'Invalid code.';
                }
            } catch (err) {
                this.otpError = 'An error occurred verifying the code.';
            } finally {
                this.isLoading = false;
            }
        },

        async handleLogin() {
            if (!this.password) {
                this.passwordError = 'Password is required.';
                return;
            }

            this.isLoading = true;
            this.error = '';
            this.passwordError = '';

            try {
                const { data } = await axios.post('/ajax/login', {
                    email: this.email,
                    password: this.password
                });

                if (data.status === '2fa_required') {
                    this.step = 'two_factor_verify';
                    this.verifyCode = ['', '', '', '', '', ''];
                    this.startResendTimer();
                    setTimeout(() => {
                        const inputs = document.querySelectorAll('.otp-input-2fa');
                        if (inputs[0]) inputs[0].focus();
                    }, 10);
                } else if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.reload();
                }
            } catch (err) {
                const data = err.response?.data;
                if (data?.errors) {
                    this.passwordError = data.errors.password?.[0] || '';
                    this.error = data.errors.email?.[0] || '';
                } else {
                    this.error = 'An unknown error occurred.';
                }
            } finally {
                this.isLoading = false;
            }
        },

        async handleRegister() {
            if (!this.firstName || !this.lastName || !this.country || !this.agreeTerms || !this.password) {
                this.registerError = 'Please fill out all required fields and agree to the terms.';
                return;
            }

            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/register', {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    email: this.email,
                    country: this.country,
                    password: this.password
                });

                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    this.registerError = data.message || 'Registration failed.';
                }
            } catch (err) {
                this.registerError = 'An error occurred during registration.';
            } finally {
                this.isLoading = false;
            }
        },

        async handleForgotPassword() {
            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/forgot-password', { email: this.email });
                if (data.status === 'success') {
                    this.step = 'forgot_password_sent';
                } else {
                    this.error = data.message || 'Failed to send reset link.';
                }
            } catch (err) {
                this.error = 'An error occurred. Please try again.';
            } finally {
                this.isLoading = false;
            }
        },

        async handleResetPassword() {
            if (!this.password || !this.passwordConfirmation) {
                this.error = 'Both password fields are required.';
                return;
            }
            if (this.password !== this.passwordConfirmation) {
                this.error = 'Passwords do not match.';
                return;
            }

            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/reset-password', {
                    token: this.resetToken,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                });

                if (data.status === 'success') {
                    this.step = 'password_reset_success';
                    this.password = '';
                    this.passwordConfirmation = '';
                } else if (data.errors) {
                    this.error = Object.values(data.errors)[0][0] || 'Reset failed.';
                }
            } catch (err) {
                this.error = 'An error occurred. Please try again.';
            } finally {
                this.isLoading = false;
            }
        },

        async handleVerify2FA() {
            const code = this.verifyCode.join('');
            if (code.length < 6) {
                this.otpError = 'Please enter the 6-digit code.';
                return;
            }

            this.isLoading = true;
            try {
                const { data } = await axios.post('/ajax/verify-login-2fa', { email: this.email, code });
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    this.otpError = data.message || 'Invalid code.';
                }
            } catch (err) {
                this.otpError = 'An error occurred verifying the code.';
            } finally {
                this.isLoading = false;
            }
        }
    }));
});
