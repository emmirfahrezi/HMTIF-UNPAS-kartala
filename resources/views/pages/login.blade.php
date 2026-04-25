<x-layouts.app title="Login | HMTIF UNPAS">
    <main class="min-h-screen flex items-center justify-center bg-gray-50 py-20 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Masuk</h1>
                    <p class="text-sm text-gray-500 mt-1">Masuk ke akun HMTIF UNPAS kamu</p>
                </div>

                <form id="login-form" class="space-y-5" novalidate>
                    @csrf
                    <x-molecules.pages.forms.form-field id="email" label="Email" :required="true">
                        <x-atoms.pages.input id="email" name="email" type="email" autocomplete="username"
                            inputmode="email" placeholder="nama@email.com"
                            required />
                    </x-molecules.pages.forms.form-field>

                    <x-molecules.pages.forms.form-field id="password" label="Password" :required="true">
                        <x-atoms.pages.input id="password" name="password" type="password" placeholder="••••••••"
                            required />
                    </x-molecules.pages.forms.form-field>

                    <div id="login-error"
                        class="hidden text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg px-4 py-3" role="alert" aria-live="polite"></div>

                    <x-atoms.pages.button id="login-btn" type="submit" class="w-full">
                        Masuk
                    </x-atoms.pages.button>
                </form>
            </div>
        </div>
    </main>
</x-layouts.app>
