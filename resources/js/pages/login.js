/**
 * Login Page Script
 */
export function initLogin() {
    const loginForm = document.getElementById('login-form');
    if (!loginForm) return;

    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = document.getElementById('login-btn');
        const errorBox = document.getElementById('login-error');
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        btn.disabled = true;
        btn.textContent = 'Memproses...';
        errorBox.classList.add('hidden');

        try {
            const res = await fetch('/api/v1/login', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ username, password }),
            });

            const json = await res.json();

            if (!res.ok) {
                errorBox.textContent = json.message || 'Username atau password salah.';
                errorBox.classList.remove('hidden');
                return;
            }

            localStorage.setItem('auth_token', json.data.token);
            window.location.href = '/';
        } catch (err) {
            errorBox.textContent = 'Terjadi kesalahan. Coba lagi.';
            errorBox.classList.remove('hidden');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Masuk';
        }
    });
}
