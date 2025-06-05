<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="img/logo-tablet.png">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DFj-i_GL.css') }}">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-login-green min-h-screen flex items-center justify-center">
    <!-- Wrapper Mobile Padding -->
    <div class="w-full max-w-5xl mx-auto p-4">
        <!-- Neobrutalism Shape Container -->
        <div
            class="flex flex-col md:flex-row h-auto md:h-[500px] border-2 overflow-hidden drop-shadow-[5px_5px_0_rgba(0,0,0,1)]">
            <!-- Left Side (Welcome) -->
            <div class="w-full md:w-1/2 bg-leftside-green text-white flex flex-col items-center justify-center p-8">
                <img src="img/logo.png" alt="ParkinTime Logo" class="w-40 mb-4" />
                <h2 class="text-2xl flex flex-col items-center text-center">
                    <span>Welcome to</span>
                    <span class="font-bold">ParkinTime</span>
                </h2>
                <p class="text-lg">Log in to access your account</p>
            </div>

            <!-- Right Side (Login) -->
            <div class="w-full md:w-1/2 bg-white border-3 flex flex-col items-center justify-center p-8">
                <!-- Title -->
                <h2 class="text-2xl font-bold mb-6">Login Account</h2>

                <!-- Form Card -->
                <div class="w-full bg-white p-6 rounded-sm border-2 border-black shadow-[6px_6px_0_#000]">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email"
                                value="{{ old('email') }}"
                                class="w-full p-2 border-2 border-black rounded-sm mt-1 placeholder-gray-500 focus:outline-none focus:border-leftside-green transition" />
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" id="password" name="password" required
                                placeholder="Enter your password"
                                class="w-full p-2 border-2 border-black rounded-sm mt-1 placeholder-gray-500 focus:outline-none focus:border-leftside-green transition" />
                        </div>
                        <button type="submit"
                            class="w-full bg-black text-white py-2 rounded-sm hover:bg-slate-600 transition">
                            Sign In
                        </button>
                        <a href="#" class="block text-sm text-black mt-4 underline">
                            Forgot password?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showLoginSuccess() {
        Swal.fire({
            icon: 'success',
            title: 'Login Successful',
            text: 'Welcome to ParkinTime!',
            confirmButtonColor: '#000',
        });
    }
</script>

@if ($errors->has('email'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '{{ $errors->first('email') }}',
        confirmButtonColor: '#000',
    });
</script>
@endif
    <script type="module" src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
</body>

</html>
