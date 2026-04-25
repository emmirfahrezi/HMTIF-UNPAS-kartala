/**
 * Login Page Script
 */
export function initLogin() {
    const loginForm = document.getElementById('login-form');
    if (!loginForm) return;

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const getCsrfToken = () =>
        document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
        loginForm.querySelector('input[name="_token"]')?.value ||
        '';

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = document.getElementById('login-btn');
        const errorBox = document.getElementById('login-error');
        const email = emailInput?.value.trim() || '';
        const password = passwordInput?.value || '';

        if (!email) {
            errorBox.textContent = 'Masukkan email terlebih dahulu.';
            errorBox.classList.remove('hidden');
            emailInput?.focus();
            return;
        }

        if (!password) {
            errorBox.textContent = 'Masukkan password terlebih dahulu.';
            errorBox.classList.remove('hidden');
            passwordInput?.focus();
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Memproses...';
        errorBox.classList.add('hidden');

        try {
            const res = await fetch('/api/v1/login', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({ email, password }),
            });

            const json = await res.json();

            if (!res.ok) {
                errorBox.textContent = json.message || 'Email atau password belum cocok.';
                errorBox.classList.remove('hidden');
                passwordInput?.focus();
                return;
            }

            if (json?.data?.token) {
                sessionStorage.setItem('auth_token', json.data.token);
            } else {
                sessionStorage.removeItem('auth_token');
            }
            window.location.href = '/';
        } catch (err) {
            errorBox.textContent = 'Terjadi gangguan saat menghubungi server. Coba beberapa saat lagi.';
            errorBox.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Masuk';
        }
    });
}
