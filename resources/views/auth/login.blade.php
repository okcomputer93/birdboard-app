@extends('layouts.app')

@section('content')
<div class="card bg-card lg:w-1/2 lg:mx-auto bg-white mt-4 p-6 md:px-16 md:py-12 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">
        Login
    </h1>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-8">
                <label for="email" class="inline-block mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email"
                       type="email"
                       class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="inline-block mb-2">{{ __('Password') }}</label>

                    <input
                        id="password"
                        type="password"
                        class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="mb-8">
                <input class="align-middle" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="align-middle" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <button type="submit" class="button-blue mr-2">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="focus:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </div>
</div>
@endsection
