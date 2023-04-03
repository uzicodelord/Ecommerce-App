<head>
    <title>Uzi-Shop - Register</title>
    @include('home.css')
    <style>
        @import url({{asset('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap')}});
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        ::selection{
            color: #fff;
            background: #5372F0;
        }
        .wrapper{
            width: 380px;
            padding: 40px 30px 50px 30px;
            background: #fff;
            border-radius: 5px;
            text-align: center;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        .wrapper header{
            font-size: 35px;
            font-weight: 600;
        }
        .wrapper form{
            margin: 40px 0;
        }
        form .field{
            width: 100%;
            margin-bottom: 20px;
        }
        form .field.shake{
            animation: shake 0.3s ease-in-out;
        }
        @keyframes shake {
            0%, 100%{
                margin-left: 0px;
            }
            20%, 80%{
                margin-left: -12px;
            }
            40%, 60%{
                margin-left: 12px;
            }
        }
        form .field .input-area{
            height: 50px;
            width: 100%;
            position: relative;
        }
        form input{
            width: 100%;
            height: 100%;
            outline: none;
            padding: 0 45px;
            font-size: 18px;
            background: none;
            caret-color: #5372F0;
            border-radius: 5px;
            border: 1px solid #bfbfbf;
            border-bottom-width: 2px;
            transition: all 0.2s ease;
        }
        form .field input:focus,
        form .field.valid input{
            border-color: #5372F0;
        }
        form .field.shake input,
        form .field.error input{
            border-color: #dc3545;
        }
        .field .input-area i{
            position: absolute;
            top: 50%;
            font-size: 18px;
            pointer-events: none;
            transform: translateY(-50%);
        }
        .input-area .icon{
            left: 15px;
            color: #bfbfbf;
            transition: color 0.2s ease;
        }
        .input-area .error-icon{
            right: 15px;
            color: #dc3545;
        }
        form input:focus ~ .icon,
        form .field.valid .icon{
            color: #5372F0;
        }
        form .field.shake input:focus ~ .icon,
        form .field.error input:focus ~ .icon{
            color: #bfbfbf;
        }
        form input::placeholder{
            color: #bfbfbf;
            font-size: 17px;
        }
        form .field .error-txt{
            color: #dc3545;
            text-align: left;
            margin-top: 5px;
        }
        form .field .error{
            display: none;
        }
        form .field.shake .error,
        form .field.error .error{
            display: block;
        }
        form .pass-txt{
            text-align: left;
            margin-top: -10px;
        }
        .wrapper a{
            color: #5372F0;
            text-decoration: none;
        }
        .wrapper a:hover{
            text-decoration: underline;
        }
        form input[type="submit"]{
            height: 50px;
            margin-top: 30px;
            color: #fff;
            padding: 0;
            border: none;
            background: #5372F0;
            cursor: pointer;
            border-bottom: 2px solid rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        form input[type="submit"]:hover{
            background: #2c52ed;
        }
    </style>
</head>

@include('home.header')
<body>
<br><br><br>
<div class="wrapper">
    <header>Register</header>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field name">
            <div class="input-area">
                <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                <i class="icon fa fa-user"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('name') {{ $message }} @enderror</div>
        </div>

        <div class="field email">
            <div class="input-area">
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                <i class="icon fa fa-envelope"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('email') {{ $message }} @enderror</div>
        </div>

        <div class="field phone">
            <div class="input-area">
                <input type="number" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                <i class="icon fa fa-phone"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('phone') {{ $message }} @enderror</div>
        </div>

        <div class="field address">
            <div class="input-area">
                <input type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
                <i class="icon fa fa-map-marker"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('address') {{ $message }} @enderror</div>
        </div>

        <div class="field password">
            <div class="input-area">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="icon fa fa-lock"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('password') {{ $message }} @enderror</div>
        </div>

        <div class="field password_confirmation">
            <div class="input-area">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                <i class="icon fa fa-lock"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">@error('password_confirmation') {{ $message }} @enderror</div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="field terms">
                <div class="input-area">
                    <label for="terms">
                        <input type="checkbox" name="terms" id="terms" required>
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="terms-link">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="terms-link">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </label>
                </div>
                <div class="error error-txt">@error('terms') {{ $message }} @enderror</div>
            </div>
        @endif
        <br>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div class="sign-txt">Already a member? <a href="{{ route('login') }}">Login!</a></div>
</div>
</body>



