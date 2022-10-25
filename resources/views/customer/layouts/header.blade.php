<div class="customer-header">
    <div class="customer-main-content-container customer-navbar-container">
        <div class="customer-logo-language-container">
            <div class="customer-logo">
                LOGO
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

        </div>

        <div class="theme-contaier">
            <select class="theme">
                <option selected value="light">Light</option>
                <option value="dark">Dark</option>
                <option value="pink">Pink</option>
            </select>
        </div>
        <div class="customer-navlinks-container">
            <a href="/">Home</a>
            <a href="#">Shop</a>
            <a href="{{route('training_center.index')}}">Training Center</a>

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
    </div>
</div>
