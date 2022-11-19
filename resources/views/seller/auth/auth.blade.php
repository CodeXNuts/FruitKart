<x-seller.guest-layout>
    <x-slot name="addOnCss">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            section {
                position: relative;
                min-height: 100vh;
                background-color: #f8dd30;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .success {
                position: relative;
                width: 100%;
                /* height: 70px; */
                background: rgb(106, 247, 78);
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                /* align-content: center; */
                margin: 0px;
                /* align-content: center; */
                justify-content: left;
            }

            .success p {
                color: rgb(0, 0, 0);
            }

            section .container {
                position: relative;
                width: 800px;
                height: 500px;
                background: #fff;
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            section .container .user {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
            }

            section .container .user .imgBx {
                position: relative;
                width: 50%;
                height: 100%;
                background: #ff0;
                transition: 0.5s;
            }

            section .container .user .imgBx img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            section .container .user .formBx {
                position: relative;
                width: 50%;
                height: 100%;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 40px;
                transition: 0.5s;
            }

            section .container .user .formBx form h2 {
                font-size: 18px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 2px;
                text-align: center;
                width: 100%;
                margin-bottom: 10px;
                color: #555;
            }

            section .container .user .formBx form input {
                position: relative;
                width: 100%;
                padding: 10px;
                background: #f5f5f5;
                color: #333;
                border: none;
                outline: none;
                box-shadow: none;
                margin: 8px 0;
                font-size: 14px;
                letter-spacing: 1px;
                font-weight: 300;
            }

            section .container .user .formBx form input[type='submit'] {
                max-width: 100px;
                background: #677eff;
                color: #fff;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                letter-spacing: 1px;
                transition: 0.5s;
            }

            section .container .user .formBx form .signup {
                position: relative;
                margin-top: 20px;
                font-size: 12px;
                letter-spacing: 1px;
                color: #555;
                text-transform: uppercase;
                font-weight: 300;
            }

            section .container .user .formBx form .signup a {
                font-weight: 600;
                text-decoration: none;
                color: #677eff;
            }

            section .container .signupBx {
                pointer-events: none;
            }

            section .container.active .signupBx {
                pointer-events: initial;
            }

            section .container .signupBx .formBx {
                left: 100%;
            }

            section .container.active .signupBx .formBx {
                left: 0;
            }

            section .container .signupBx .imgBx {
                left: -100%;
            }

            section .container.active .signupBx .imgBx {
                left: 0%;
            }

            section .container .signinBx .formBx {
                left: 0%;
            }

            section .container.active .signinBx .formBx {
                left: 100%;
            }

            section .container .signinBx .imgBx {
                left: 0%;
            }

            section .container.active .signinBx .imgBx {
                left: -100%;
            }

            @media (max-width: 991px) {
                section .container {
                    max-width: 400px;
                }

                section .container .imgBx {
                    display: none;
                }

                section .container .user .formBx {
                    width: 100%;
                }
            }

            .error {
                color: rgba(223, 39, 39, 0.596);
            }

            .errorInput {
                border: 1px solid red !important;
            }
        </style>
    </x-slot>

    @if (session()->has('success'))
        <div class="success">
            {!! session('success') !!}
        </div>
    @endif

    <section>


        <div class="container {{ request()->routeIs('seller.register') ? 'active' : '' }}">
            <div class="user signinBx">
                <div class="imgBx"><img src="{{ asset('app-logo.png') }}" alt="" /></div>
                <div class="formBx">
                    <form action="{{ route('seller.login') }}" method="POST">
                        @csrf
                        <h2>Seller - Sign In</h2>
                        <input type="text" class="{{ $errors->has('email') ? 'errorInput' : '' }}" name="email"
                            placeholder="email" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="password" name="password"
                            class="{{ $errors->has('password') ? 'errorInput' : '' }}" placeholder="Password" />
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="submit" name="" value="Login" />
                        <p class="signup">
                            Don't have an account ?
                            <a href="javascript:void(0)" onclick="toggleForm();">Sign Up.</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="{{ route('seller.register') }}" method="POST">
                        @csrf
                        <h2>Create a seller account</h2>

                        <input type="text" class="{{ $errors->has('name') ? 'errorInput' : '' }}" name="name"
                            value="{{ old('name') ?? '' }}" placeholder="Your name" />
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="email" name="email" class="{{ $errors->has('email') ? 'errorInput' : '' }}"
                            value="{{ old('email') ?? '' }}" placeholder="Email Address" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="text" name="username"
                            class="{{ $errors->has('username') ? 'errorInput' : '' }}"
                            value="{{ old('username') ?? '' }}" placeholder="Username" />
                        @error('username')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="password" name="password"
                            class="{{ $errors->has('password') ? 'errorInput' : '' }}" placeholder="Create Password" />
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="password" name="password_confirmation"
                            class="{{ $errors->has('password_confirmation') ? 'errorInput' : '' }}"
                            placeholder="Confirm Password" />
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <input type="submit" name="" value="Sign Up" />
                        <p class="signup">
                            Already have an account ?
                            <a href="javascript:void(0)" onclick="toggleForm();">Sign in.</a>
                        </p>
                    </form>
                </div>
                <div class="imgBx"><img src="{{ asset('app-logo.png') }}" alt="" /></div>
            </div>
        </div>
    </section>
    <x-slot name="addOnJs">
        <script>
            const toggleForm = () => {
                const container = document.querySelector('.container');
                container.classList.toggle('active');
            };
        </script>
    </x-slot>

</x-seller.guest-layout>
