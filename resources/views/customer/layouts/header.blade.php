<div class="overlay">

</div>
<div class="customer-header index-page-header">
    <div class="customer-main-content-container customer-navbar-container">
        <div class="customer-logo-language-container">
            <div class="customer-logo">
                LOGO
            </div>
            <div class="customer-language-container">
                <div class="customer-language-flag-container">
                    <img src="../imgs/ukflag.png">
                </div>

                <select>
                    <option value="">Myanmar</option>
                    <option value="">English</option>
                </select>
            </div>

        </div>
        <div class="customer-navlinks-container">
            @guest
            <a href="{{route('home')}}">Home</a>
            @endguest
            @auth
            <a href="{{route('social_media')}}">Home</a>
            @endauth
            <a href="#">Shop</a>
            {{-- <a href="#">Training Center</a> --}}
        </div>

        <div class="customer-nav-btns-container">
            @guest
          <a href="{{route('login')}}" class="customer-primary-btn customer-login-btn">Log In</a>
          <a href="{{route('customer_register')}}" class="customer-secondary-btn customer-signup-btn">Sign Up</a>
          @endguest
          @auth
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="customer-primary-btn customer-login-btn" type="submit">Logout</button>
        </form>
        @endauth
        </div>
    </div>
</div>
