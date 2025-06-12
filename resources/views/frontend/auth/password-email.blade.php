
@extends('frontend.layout.head' ,['cssClass'=>'page-signup'])

@section('title','Password.email')

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
          <h1 class="auth-page-title">@lang('passwords.email_send')</h1>

          <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
              <input type="email" name="email" placeholder="@lang('constants.email')" />
            </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            <button type="submit" class="btn-primary btn-login w-full h-1">
              @lang('auth.email_send')
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
