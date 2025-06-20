
@extends('frontend.layout.head' ,['cssClass'=>'page-signup'])

@section('title','Password reset')

@section('childContent')
<main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="{{ asset('appAssets/img/logo2.png') }}" alt="" width="50%" />
            </a>
          </div>
          <h1 class="auth-page-title">@lang('auth.reset_password')</h1>

          <form action="{{ route('password.update') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="email" name="email" placeholder="@lang('constants.email')" />
            </div>

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <input id="password" type="password"  name="password" required placeholder="{{ __('constants.password') }}" autocomplete="new-password">
            </div>

            <div class="form-group">
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ __('constants.password_confirmation') }}" autocomplete="new-password">
            </div>

               <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            <button type="submit" class="btn-primary btn-login w-full h-1">
              @lang('auth.reset_password')
            </button>

            <div class="login-text-dont-have-account">
             {{ __('auth.already_have_an_account') }}? -
                <a href="{{ route('showLoginForm') }}">{{ __('vendors.login') }} </a>
            </div>
          </form>
        </div>
        <div class="auth-page-image">
          <img src="{{ asset('appAssets/img/car-png-39071.png') }}" alt="" class="img-responsive" />
        </div>
      </div>
    </div>
  </main>

  @endsection
