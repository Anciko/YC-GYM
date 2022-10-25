<div class="customer-header customer-header-with-shadow">
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
        <div class="theme-contaier">
            <select class="theme">
                <option selected value="light">Light</option>
                <option value="dark">Dark</option>
                <option value="pink">Pink</option>
            </select>
        </div>
        <div class="customer-navlinks-container">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Search</a>
            <a href="#">Training Center</a>
            <a href="#">Notifications</a>
            <a href="#">Account</a>
            <div style="float:right;margin-left:30px">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="customer-primary-btn customer-login-btn" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

