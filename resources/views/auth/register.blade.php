@extends('layouts.app')

@section('content')
<div class="card bg-card lg:w-1/2 lg:mx-auto bg-white mt-4 p-6 md:px-16 md:py-12 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Register
        </h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-8">
                <label for="name" class="inline-block mb-2">{{ __('Name') }}</label>

                <input id="name"
                       type="text"
                       class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm @error('name') is-invalid @enderror"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autocomplete="name"
                       autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-8">

                <label for="email" class="inline-block mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email"
                       type="email"
                       class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password"class="inline-block mb-2">{{ __('Password') }}</label>

                <input id="password"
                       type="password"
                       class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm @error('password') is-invalid @enderror"
                       name="password"
                       required
                       autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password-confirm" class="inline-block mb-2">{{ __('Confirm Password') }}</label>

                <input
                    id="password-confirm"
                    type="password"
                    class="border-solid border-2 focus:outline-none border-border focus:border-border-focus rounded bg-card w-full p-2 text-sm"
                    name="password_confirmation"
                    required autocomplete="new-password">
            </div>

            <button type="submit" class="button-blue">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>
@endsection
