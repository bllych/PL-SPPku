
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPPku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Background -->
    <div class="min-h-screen bg-cover bg-contain bg-center bg-no-repeat flex items-center justify-end"
         style="background-image: url('{{ asset('images/background-login.png') }}');">

        <!-- Card Login -->
        <div class="bg-white w-[550px] p-11 rounded-3xl shadow-xl mr-16">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo/logo SPPku(1).png') }}"
                     alt="Logo SPPku"
                     class="w-20">
            </div>

            <!-- Judul -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-semibold text-gray-600">
                    Sign in ke akun Anda
                </h2>

                <p class="text-gray-400 text-lg">
                    Masuk untuk mengakses layanan SPPku.
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login.authenticate') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block mb-2">
                        E-mail
                    </label>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        placeholder="Masukkan e-mail Anda"
                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 outline-none">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="block mb-2">
                        Password
                    </label>

                    <input type="password"
                        name="password"
                        autocomplete="current-password"
                        required
                        placeholder="Masukkan password Anda"
                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 outline-none">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lupa Password -->
                <div class="text-right mb-11">
                    <a href="#" class="text-sky-400">
                        Lupa password?
                    </a>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-sky-400 text-white text-xl font-bold py-4 rounded-2xl shadow-md">
                    Sign In
                </button>

            </form>

        </div>

    </div>

</body>
</html>
