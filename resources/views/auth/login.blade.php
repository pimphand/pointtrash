@extends('layouts.guest')

@section('content')
    <div
        class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 lg:max-w-md">
        <div class="text-center p-6 bg-slate-900 rounded-t">
            <a href="index.html"><img src="assets/images/logo-sm.png" alt="" class="w-14 h-14 mx-auto mb-2"></a>
            <h3 class="font-semibold text-white text-xl mb-1">Let's Get Started Robotech</h3>
            <p class="text-xs text-slate-400">Sign in to continue to Robotech.</p>
        </div>

        <form class="p-6">
            <div>
                <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">Email</label>
                <input type="text" id="username"
                       class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-2 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                       placeholder="Your Email" required>
            </div>
            <div class="mt-4">
                <label for="password" class="font-medium text-sm text-slate-600 dark:text-slate-400">Your
                    password</label>
                <input type="password" id="password"
                       class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-2 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                       placeholder="Password" required>
            </div>
            <a href="#" class="text-xs font-medium text-brand-500 underline ">Forget Password?</a>
            <div class="block mt-3">
                <label class="custom-label block dark:text-slate-300">
                    <div
                        class="bg-white dark:bg-slate-700  border border-slate-200 dark:border-slate-600 rounded w-4 h-4  inline-block leading-4 text-center -mb-[3px]">
                        <input type="checkbox" class="hidden">
                        <i class="fas fa-check hidden text-xs text-slate-700 dark:text-slate-200"></i>
                    </div>
                    Remember me
                </label>
            </div>
            <div class="mt-4">
                <button
                    class="w-full px-2 py-2 tracking-wide text-white transition-colors duration-200 transform bg-brand-500 rounded hover:bg-brand-600 focus:outline-none focus:bg-brand-600">
                    Login
                </button>
            </div>
        </form>
        <p class="mb-5 text-sm font-medium text-center text-slate-500"> Don't have an account? <a
                href="auth-register.html"
                class="font-medium text-brand-500 hover:underline">Sign up</a>
        </p>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('form').submit(function (e) {
                e.preventDefault();
                const username = $('#username').val();
                const password = $('#password').val();
                $.ajax({
                    url: '{{route('login')}}',
                    type: 'POST',
                    data: {
                        username: username,
                        password: password,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            window.location.href = '{{route('dashboard')}}';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred. Please try again later.');
                    }
                });
            });
        });
    </script>
@endpush
