<div class="customer-header">
    <div class="customer-main-content-container customer-navbar-container">
        <div class="customer-logo-language-container">
            <div class="customer-logo">
                {{-- LOGO --}}
            </div>
            <div class="customer-language-container">
                <div class="customer-language-flag-container">
                    <img src={{ asset('img/customer/imgs/ukflag.png')}}>
                </div>

                <select>
                    <option value="">Myanmar</option>
                    <option value="">English</option>
                </select>
            </div>

            <div class="theme-contaier">
                <select class="theme">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="pink">Pink</option>
                </select>
            </div>

        </div>


        <div class="customer-navlinks-container">
            <a href="/">Home</a>
            <a href="#">Shop</a>
            @hasanyrole('Diamond|Platinum|Gym Member')
            <a href="{{route('training_center.index')}}">Training Center</a>
            @endhasanyrole
            @hasanyrole('Gold|Ruby|Ruby Premium')
            <a href="{{route('groups')}}">Training Center</a>
            @endhasanyrole
            @hasanyrole('Trainer')
            <a href="{{route('trainer')}}">Training Center</a>
            @endhasanyrole
        </div>

        <div class="customer-nav-btns-container">
            @guest
            {{-- @if (Route::has('login')) --}}
            <a href="{{ route('login') }}" class="customer-primary-btn customer-login-btn">Sign In</a>

            <a href="{{route('customer_register')}}" class="customer-secondary-btn customer-signup-btn">Sign Up</a>


            @endguest

            @if(Auth::user())

            <p>{{Auth()->user()->name}}</p>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="customer-primary-btn customer-login-btn" type="submit">Logout</button>
            </form>

            @endif
        </div>



        <iconify-icon icon="pajamas:hamburger" class="burger-icon"></iconify-icon>
        <iconify-icon icon="akar-icons:cross" class="close-nav-icon"></iconify-icon>
    </div>
</div>
