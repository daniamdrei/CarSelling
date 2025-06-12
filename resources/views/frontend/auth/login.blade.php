@extends('frontend.layout.head' , ['cssClass'=>'page-signup'])
  @section('title','login page')
  @section('childContent')
  <body class="page-login">
    <main>
      <div class="container-small page-login">
        <div class="flex" style="gap: 5rem">
          <div class="auth-page-form">
            <div class="text-center">
              <a href="/">
                <img src="{{ asset('appAssets/img/logo2.png') }}" alt="" width="50%"/>
              </a>
            </div>
            <h1 class="auth-page-title">@lang('vendors.login')</h1>

            <form action="{{ route('login') }}" id="login-form" method="POST">
                @csrf
              <div class="form-group">
                <input type="email" name="email" required value="{{ old('email') }}"  placeholder="@lang('constants.email')" />
              </div>
              <div class="form-group">
                <input type="password" name="password" required placeholder="@lang('constants.password')" />
              </div>
              <div class="text-right mb-medium">
                <a href="{{ route('password.request') }}" class="auth-page-password-reset"
                >@lang('auth.reset_password')</a>
              </div>

              <button type="submit" id="login-submit" class="btn btn-primary btn-login w-full">@lang('vendors.login')</button>

              <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                
              <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                <a href="{{ route('auth.google_redirection') }}" class="btn btn-default flex justify-center items-center gap-1">
                    <img src="{{ asset('appAssets/img/google.png') }}" alt="" style="width: 20px" />
                    Google
                </a>
                <a href="{{ route('auth.facebook_redirection') }}" class="btn btn-default flex justify-center items-center gap-1">
                  <img src="{{ asset('appAssets/img/facebook.png') }}" alt="" style="width: 20px" />
                  Facebook
                </a>
              </div>
              <div class="login-text-dont-have-account">
                @lang("auth.don't_have_an_account")? -
                <a href="{{ route('showRegisterForm') }}"> @lang('vendors.sing_up')</a>
              </div>
            </form>
          </div>
          <div class="auth-page-image">
            <img src="{{ asset('appAssets/img/car-png-39071.png') }}" alt="" class="img-responsive" />
          </div>
        </div>
      </div>
    </main>

@push('script')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const registerMessages = {
        sending: "{{ __('auth.sending') }}",
        registered: "{{ __('auth.Registered') }}",
        errorOccurred: "{{ __('auth.error_occurred') }}",
        registrationFailed: "{{ __('auth.registration_failed') }}",
        createAccount: "{{ __('auth.create_account') }}"
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#login-form').on('submit', function (e) {
            e.preventDefault();

            const formData = {
                email: $('input[name="email"]').val().trim(),
                password: $('input[name="password"]').val(),
            };

            $('#login-submit').prop('disabled', true).text(registerMessages.sending);

            $.post($('#login-form').attr('action'), formData)
                .done(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: registerMessages.registered,
                        text: response.message
                    }).then(() => {
                        window.location.href = response.redirect || '/';
                    });
                })
                .fail(function (xhr) {
                    let message = registerMessages.errorOccurred;
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).flat()[0];
                    }

                    Swal.fire({
                        icon: 'error',
                        title: registerMessages.registrationFailed,
                        text: message
                    });

                    $('#login-submit').prop('disabled', false).text(registerMessages.createAccount);
                });
        });
    });
</script>
@endpush
@endsection
