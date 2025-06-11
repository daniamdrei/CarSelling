
  @extends('frontend.layout.head' , ['cssClass'=>'page-signup'])
  @section('title','signup page')
  @section('childContent')


  <body class="page-signup">
    <main>
      <div class="container-small page-login">
        <div class="flex" style="gap: 5rem">
          <div class="auth-page-form">
            <div class="text-center">
              <a href="/">
                <img src="{{ asset('appAssets/img/logo2.png') }}" alt="" width="50%" />
              </a>
            </div>
            <h1 class="auth-page-title">{{ __('vendors.sing_up') }}</h1>

            <form action="{{ route('register') }}" method="POST" id="register-form">
                @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="{{ __('constants.email') }}" required />
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="{{ __('constants.password') }}" required />
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="{{ __('constants.password_confirmation') }}"  required/>
            </div>
            <hr />
            <div class="form-group">
                <input type="text" name="name" placeholder="{{ __('constants.name') }}" required />
            </div>
            <div class="form-group">
                <input type="phone" name="phone" placeholder="{{ __('constants.mobile') }}" required />
            </div>
            <button type="submit" id="register-submit" class="btn btn-primary btn-login w-full">{{ __('vendors.sing_up') }}</button>

            {{-- <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                <a href="#" class="btn btn-default flex justify-center items-center gap-1">
                <img src="{{ asset('appAssets/img/google.png') }}" alt="" style="width: 20px" /> Google
                </a>
                <a href="#" class="btn btn-default flex justify-center items-center gap-1" >
                <img src="{{ asset('appAssets/img/facebook.png') }}" alt="" style="width: 20px" /> Facebook
                </a>
            </div> --}}

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
</body>
</html>



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
        $('#register-form').on('submit', function (e) {
            e.preventDefault();

            const formData = {
                name: $('input[name="name"]').val().trim(),
                email: $('input[name="email"]').val().trim(),
                password: $('input[name="password"]').val(),
                password_confirmation: $('input[name="password_confirmation"]').val(),
                phone: $('input[name="phone"]').val().trim(),
            };

            $('#register-submit').prop('disabled', true).text(registerMessages.sending);

            $.post($('#register-form').attr('action'), formData)
                .done(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: registerMessages.registered,
                        text: response.message
                    }).then(() => {
                        window.location.href = response.redirect || 'login';
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

                    $('#register-submit').prop('disabled', false).text(registerMessages.createAccount);
                });
        });
    });
</script>



@endsection
