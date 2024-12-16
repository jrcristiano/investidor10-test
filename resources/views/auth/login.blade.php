<x-guest-layout>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto border justify-content-center p-5 mt-5 rounded shadow">
               <div class="text-center mb-4">
                    <a class="px-4" href="/">
                        <x-application-logo id="logo" />
                    </a>
               </div>

                <div class="w-100 d-flex w-100 justify-content-center">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            @if (Route::has('password.request'))
                                <a class="i10-text-dark" href="{{ route('password.request') }}">
                                    Esqueceu sua senha?
                                </a>
                            @endif

                            <button type="submit" class="btn btn-gold">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
