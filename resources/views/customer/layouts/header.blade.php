<div class="overlay">

</div>
<div class="customer-header index-page-header">
    <div class="customer-main-content-container customer-navbar-container">
        <div class="customer-logo-language-container">
            <div class="customer-logo">

            </div>
            <div class="customer-language-container">

                <select>
                    <option value="">Myanmar</option>
                    <option value="">English</option>
                </select>
            </div>

            <div class="theme-contaier">
                <select class="theme">
                    <option selected value="light">Light</option>
                    <option value="dark">Dark</option>
                    <option value="pink">Pink</option>
                </select>
            </div>

        </div>
        <div class="customer-navlinks-container">
            <a href="{{route('home')}}">Home</a>
            <a href="#">Shop</a>
            {{-- <a href="#">Training Center</a> --}}
        </div>

        <div class="customer-navlinks-notiprofile-container">
            {{-- <a href="#"><iconify-icon icon="akar-icons:bell" class="nav-icon"></iconify-icon></a> --}}
            <iconify-icon icon="pajamas:hamburger" class="burger-icon"></iconify-icon>
            <iconify-icon icon="akar-icons:cross" class="close-nav-icon"></iconify-icon>
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
