<div class="customer-header customer-header-with-shadow">
    <div class="customer-main-content-container customer-navbar-container">
        <div class="customer-logo-language-container">
            <div class="customer-logo">
                {{-- LOGO --}}
            </div>
            <div class="customer-language-container">
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
            <a href="#">Search</a>
            @hasanyrole('Diamond|Platinum|Gym Member')
            <a href="{{route('training_center.index')}}">Training Center</a>
            @endhasanyrole

            @hasanyrole('Gold|Ruby|Ruby Premium')
            <a href="{{route('group')}}">Training Center</a>
            @endhasanyrole

            <div class="customer-dropdown-container">
                <ul>
                    <li class="customer-dropdown">
                    <a href="#" data-toggle="dropdown">
                        <img class="nav-profile-img" src="{{asset('img/avatar.jpg')}}"/>
                        <i class="icon-arrow"></i></a>
                    <ul class="customer-dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><form class="dropdown-item" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="customer-primary-btn customer-login-btn" type="submit">Logout</button>
                        </form></li>

                    </ul>
                    </li>
                </ul>
            </div>
        </div>

        {{-- <div class="customer-navlinks-notiprofile-container">
            <a href="#"><iconify-icon icon="akar-icons:bell" class="nav-icon"></iconify-icon></a>
            <div class="dropdown customer-navlinks-profile-dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="nav-profile-img" src="{{asset('img/avatar.jpg')}}"/>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><form class="dropdown-item" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="customer-primary-btn customer-login-btn" type="submit">Logout</button>
                </form></li>

                </ul>
            </div>

        </div> --}}
        <div class="customer-navlinks-notiprofile-container">
            <a href="#"><iconify-icon icon="akar-icons:bell" class="nav-icon"></iconify-icon></a>
            <iconify-icon icon="pajamas:hamburger" class="burger-icon"></iconify-icon>
            <iconify-icon icon="akar-icons:cross" class="close-nav-icon"></iconify-icon>
        </div>




    </div>
</div>
