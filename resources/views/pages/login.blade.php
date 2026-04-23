<x-layout title="Login | HMTIF UNPAS">
    <x-organisms.navbar />

    <main class="min-h-screen flex items-center justify-center bg-gray-50 py-20 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1">Masuk ke akun HMTIF UNPAS kamu</p>
                </div>

                <form id="login-form" class="space-y-5">
                    @csrf
                    <x-molecules.forms.form-field id="username" label="Username" :required="true">
                        <x-atoms.input id="username" name="username" type="text" placeholder="nama@email.com"
                            required />
                    </x-molecules.forms.form-field>

                    <x-molecules.forms.form-field id="password" label="Password" :required="true">
                        <x-atoms.input id="password" name="password" type="password" placeholder="••••••••" required />
                    </x-molecules.forms.form-field>

                    <div id="login-error"
                        class="hidden text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3"></div>

                    <x-atoms.button id="login-btn" type="submit" class="w-full">
                        Masuk
                    </x-atoms.button>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function (e) {
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
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
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
    </script>
</x-layout>