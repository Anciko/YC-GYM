@extends('customer.layouts.app_home')

@section('content')
@include('sweetalert::alert')
@guest
<section class="index-hero-section ">
    <div class="customer-main-content-container index-hero-text">
        <h1>Lorem ipsum dolor sit amet consectetur <span>adipiscing elit Ut et.</span></h1>
        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien.</p>
        <div class="index-hero-btns-container">
            <a href="{{route('login')}}" class="customer-primary-btn">Log In</a>
            <a href="{{route('customer_register')}}" class="customer-secondary-btn">Sign Up</a>
        </div>
    </div>
</section>
@endguest
<section class="index-aboutus-section">
    <div class="customer-main-content-container">
        <div class="section-header">
            <p>About Us</p>
            <div class="section-header-underline">

            </div>
        </div>

        <div class="index-about-us-content-container">
            <div class="index-about-us-img-container">
                <img src="{{ asset('image/about-us.jpg') }}">

            <div class="index-about-us-text-container">
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
                <a href="#" class="customer-secondary-btn">
                    Read More
                    <iconify-icon icon="akar-icons:arrow-right" class="readmore-icon"></iconify-icon>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="index-prices-section">
    <div class="customer-main-content-container">
        <div class="section-header">
            <p>Pricing Details</p>
            <div class="section-header-underline">

            </div>
        </div>

        <div class="index-price-details-container">
            <div class="index-price-detail-container">
                <h1>Platinum</h1>
                <p class="index-price-detail-price">MMK 5000 / month</p>

                <div class="index-price-detail-benefits">
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:cross" class="index-price-detail-benefit-icon cross"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                </div>
                <a href="#" class="customer-secondary-btn">Upgrade</a>
            </div>
            <div class="index-price-detail-container">
                <h1>Platinum</h1>
                <p class="index-price-detail-price">MMK 5000 / month</p>

                <div class="index-price-detail-benefits">
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:cross" class="index-price-detail-benefit-icon cross"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                </div>
                <a href="#" class="customer-secondary-btn">Upgrade</a>
            </div>
            <div class="index-price-detail-container">
                <h1>Platinum</h1>
                <p class="index-price-detail-price">MMK 5000 / month</p>

                <div class="index-price-detail-benefits">
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:cross" class="index-price-detail-benefit-icon cross"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                </div>
                <a href="#" class="customer-secondary-btn">Upgrade</a>
            </div>
            <div class="index-price-detail-container">
                <h1>Platinum</h1>
                <p class="index-price-detail-price">MMK 5000 / month</p>

                <div class="index-price-detail-benefits">
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:cross" class="index-price-detail-benefit-icon cross"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                </div>
                <a href="#" class="customer-secondary-btn">Upgrade</a>
            </div>
            <div class="index-price-detail-container">
                <h1>Platinum</h1>
                <p class="index-price-detail-price">MMK 5000 / month</p>

                <div class="index-price-detail-benefits">
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:check" class="index-price-detail-benefit-icon check"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                    <div class="index-price-detail-benefit">
                        <iconify-icon icon="akar-icons:cross" class="index-price-detail-benefit-icon cross"></iconify-icon>
                        <p>Benefit 1</p>
                    </div>
                </div>
                <a href="#" class="customer-secondary-btn">Upgrade</a>
            </div>
        </div>
    </div>
</section>

<section class="index-trainers-section">
    <div class="customer-main-content-container">
        <div class="section-header">
            <p>Our Trainers</p>
            <div class="section-header-underline">

            </div>
        </div>
        <div class="index-trainer-container">
            <div class="index-trainer-img-container left-img">
                <img src="{{ asset('image/trainer1.jpg') }}">
            </div>

            <div class="index-trainer-text-container">
                <h1>Trainer Name</h1>
                <p>
                    <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="index-trainer-icon"></iconify-icon>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
            </div>
        </div>
        <div class="index-trainer-container">
            <div class="index-trainer-img-container right-img">
                <img src="{{ asset('image/trainer2.jpg') }}">
            </div>

            <div class="index-trainer-text-container">
                <h1>Trainer Name</h1>
                <p>
                    <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="index-trainer-icon"></iconify-icon>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
            </div>
        </div>
        <div class="index-trainer-container">
            <div class="index-trainer-img-container left-img">
                <img src="{{ asset('image/trainer3.jpg') }}">
            </div>

            <div class="index-trainer-text-container">
                <h1>Trainer Name</h1>
                <p>
                    <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="index-trainer-icon"></iconify-icon>
                    Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
            </div>
        </div>
    </div>


</section>

<section class="index-milestone-section">
    <div class="customer-main-content-container">
        <div class="customer-milestone-parent-container">
            <!-- <div class="customer-milestone-path-container"> -->
                <div class="customer-milestone-path"></div>
                <div class="customer-milestone-stone">
                    <div class="customer-milestone-text-container">
                        <div class="customer-milestone-text">
                            <p>2017</p>
                            <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                        </div>
                        <div class="customer-milestone-text-line"></div>
                    </div>
                </div>
                <div class="customer-milestone-path"></div>
                <div class="customer-milestone-stone">
                    <div class="customer-milestone-text-container">
                        <div class="customer-milestone-text">
                            <p>2018</p>
                            <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                        </div>
                        <div class="customer-milestone-text-line"></div>
                    </div>
                </div>
                <div class="customer-milestone-path"></div>
                <div class="customer-milestone-stone">
                    <div class="customer-milestone-text-container">
                        <div class="customer-milestone-text">
                            <p>2019</p>
                            <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                        </div>
                        <div class="customer-milestone-text-line"></div>
                    </div>
                </div>
                <div class="customer-milestone-path"></div>
                <div class="customer-milestone-stone">
                    <div class="customer-milestone-text-container">
                        <div class="customer-milestone-text">
                            <p>2020</p>
                            <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                        </div>
                        <div class="customer-milestone-text-line"></div>
                    </div>
                </div>

            <!-- </div> -->
        </div>
    </div>

</section>

<section class="index-appad-section">
    <div class="customer-main-content-container">
        <div class="index-appad-content-container">
            <div class="index-appad-img-container">
                <img src="{{ asset('image/appad.png') }}">
            </div>
            <div class="index-appad-text-container">
                <h1>Lorem ipsum dolor sit amet consectetur adipiscing elit.</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus..</p>
                <div class="index-appad-btns-container">
                    <a href="#" class="index-appad-btn">
                        <iconify-icon icon="cib:google-play" class="index-appad-icon"></iconify-icon>
                        <div class="index-appad-text">
                            <span>Download from</span>
                            <p>Google Play</p>
                        </div>
                    </a>
                    <a href="#" class="index-appad-btn">
                        <iconify-icon icon="ant-design:apple-filled" class="index-appad-icon"></iconify-icon>
                        <div class="index-appad-text">
                            <span>Download from</span>
                            <p>App Store</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="index-contact-section">
    <div class="customer-main-content-container">
        <div class="section-header">
            <p>Contact Us</p>
            <div class="section-header-underline">

            </div>
        </div>

        <form class="index-contact-us-form-parent-container">
            <div class="index-contact-us-form-container">
                <div class="index-contact-us-inputs-container">
                    <input type="email" required placeholder="Email">
                    <textarea placeholder="Message"></textarea>
                </div>

                <div class="index-contact-us-details-container">
                    <div class="index-contact-us-detail">
                        <iconify-icon icon="akar-icons:phone" class="index-contact-us-detail-icon"></iconify-icon>
                        <p>09-12345678</p>
                    </div>
                    <div class="index-contact-us-detail">
                        <iconify-icon icon="akar-icons:envelope" class="index-contact-us-detail-icon"></iconify-icon>
                        <p>someEmail@gmail.com</p>
                    </div>
                    <div class="index-contact-us-detail">
                        <iconify-icon icon="akar-icons:location" class="index-contact-us-detail-icon"></iconify-icon>
                        <p>some street, some city, some country,some street, some city, some country</p>
                    </div>
                </div>

                <div class="index-contact-us-btns-container">
                    <button type="submit" class="customer-primary-btn">Send Message</button>
                    <button type="submit" class="customer-secondary-btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</section>
    <div class="customer-header customer-header-with-shadow">
        <div class="customer-main-content-container customer-navbar-container">
            <div class="customer-logo-language-container">
                <div class="customer-logo">
                    LOGO
                </div>
                <div class="customer-language-container">
                    <div class="customer-language-flag-container">
                        <img src="{{ asset('image/ukflag.png') }}">
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
            </div>
        </div>
    </div>

    <div class="customer-main-content-container">
        <section class="home-aboutus-section margin-top" >

                <div class="section-header">
                    <p>About Us</p>
                    <div class="section-header-underline">

                    </div>
                </div>

                <div class="home-about-us-content-container">
                    <div class="home-about-us-img-container">
                        <img src="{{ asset('image/about-us.jpg') }}">
                    </div>

                    <div class="home-about-us-text-container">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
                        <a href="#" class="customer-secondary-btn">
                            Read More
                            <iconify-icon icon="akar-icons:arrow-right" class="readmore-icon"></iconify-icon>
                        </a>
                    </div>
                </div>

        </section>

        <section class="home-prices-section">
                <div class="section-header">
                    <p>Pricing Details</p>
                    <div class="section-header-underline">

                    </div>
                </div>

                <div class="home-price-details-container">
                    <div class="home-price-detail-container">
                        <h1>Platinum</h1>
                        <p class="home-price-detail-price">MMK 5000 / month</p>

                        <div class="home-price-detail-benefits">
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:cross" class="home-price-detail-benefit-icon cross"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                        </div>
                        <a href="#" class="customer-secondary-btn">Upgrade</a>
                    </div>
                    <div class="home-price-detail-container">
                        <h1>Platinum</h1>
                        <p class="home-price-detail-price">MMK 5000 / month</p>

                        <div class="home-price-detail-benefits">
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:cross" class="home-price-detail-benefit-icon cross"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                        </div>
                        <a href="#" class="customer-secondary-btn">Upgrade</a>
                    </div>
                    <div class="home-price-detail-container">
                        <h1>Platinum</h1>
                        <p class="home-price-detail-price">MMK 5000 / month</p>

                        <div class="home-price-detail-benefits">
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:cross" class="home-price-detail-benefit-icon cross"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                        </div>
                        <a href="#" class="customer-secondary-btn">Upgrade</a>
                    </div>
                    <div class="home-price-detail-container">
                        <h1>Platinum</h1>
                        <p class="home-price-detail-price">MMK 5000 / month</p>

                        <div class="home-price-detail-benefits">
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:cross" class="home-price-detail-benefit-icon cross"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                        </div>
                        <a href="#" class="customer-secondary-btn">Upgrade</a>
                    </div>
                    <div class="home-price-detail-container">
                        <h1>Platinum</h1>
                        <p class="home-price-detail-price">MMK 5000 / month</p>

                        <div class="home-price-detail-benefits">
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:check" class="home-price-detail-benefit-icon check"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                            <div class="home-price-detail-benefit">
                                <iconify-icon icon="akar-icons:cross" class="home-price-detail-benefit-icon cross"></iconify-icon>
                                <p>Benefit 1</p>
                            </div>
                        </div>
                        <a href="#" class="customer-secondary-btn">Upgrade</a>
                    </div>
                </div>

        </section>

        <section class="home-trainers-section">

                <div class="section-header">
                    <p>Our Trainers</p>
                    <div class="section-header-underline">

                    </div>
                </div>
                <div class="home-trainer-container">
                    <div class="home-trainer-img-container left-img">
                        <img src="{{ asset('image/trainer1.jpg') }}">
                    </div>

                    <div class="home-trainer-text-container">
                        <h1>Trainer Name</h1>
                        <p>
                            <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="home-trainer-icon"></iconify-icon>
                            Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
                    </div>
                </div>
                <div class="home-trainer-container">
                    <div class="home-trainer-img-container right-img">
                        <img src="{{ asset('image/trainer2.jpg') }}">
                    </div>

                    <div class="home-trainer-text-container">
                        <h1>Trainer Name</h1>
                        <p>
                            <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="home-trainer-icon"></iconify-icon>
                            Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
                    </div>
                </div>
                <div class="home-trainer-container">
                    <div class="home-trainer-img-container left-img">
                        <img src="{{ asset('image/trainer3.jpg') }}">
                    </div>

                    <div class="home-trainer-text-container">
                        <h1>Trainer Name</h1>
                        <p>
                            <iconify-icon icon="ci:double-quotes-r" flip="horizontal" class="home-trainer-icon"></iconify-icon>
                            Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus. Nullam quis imperdiet augue. Vestibulum auctor ornare leo, non suscipit magna interdum eu. Curabitur pellentesque nibh nibh, at maximus ante.</p>
                    </div>
                </div>



        </section>

        <section class="home-milestone-section">

                <div class="customer-milestone-parent-container">

                        <div class="customer-milestone-path"></div>
                        <div class="customer-milestone-stone">
                            <div class="customer-milestone-text-container">
                                <div class="customer-milestone-text">
                                    <p>2017</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                                </div>
                                <div class="customer-milestone-text-line"></div>
                            </div>
                        </div>
                        <div class="customer-milestone-path"></div>
                        <div class="customer-milestone-stone">
                            <div class="customer-milestone-text-container">
                                <div class="customer-milestone-text">
                                    <p>2018</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                                </div>
                                <div class="customer-milestone-text-line"></div>
                            </div>
                        </div>
                        <div class="customer-milestone-path"></div>
                        <div class="customer-milestone-stone">
                            <div class="customer-milestone-text-container">
                                <div class="customer-milestone-text">
                                    <p>2019</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                                </div>
                                <div class="customer-milestone-text-line"></div>
                            </div>
                        </div>
                        <div class="customer-milestone-path"></div>
                        <div class="customer-milestone-stone">
                            <div class="customer-milestone-text-container">
                                <div class="customer-milestone-text">
                                    <p>2020</p>
                                    <span>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et.</span>
                                </div>
                                <div class="customer-milestone-text-line"></div>
                            </div>
                        </div>

                </div>


        </section>

        <section class="home-appad-section">

                <div class="home-appad-content-container">
                    <div class="home-appad-img-container">
                        <img src="{{ asset('image/appad.png') }}">
                    </div>
                    <div class="home-appad-text-container">
                        <h1>Lorem ipsum dolor sit amet consectetur adipiscing elit.</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien fringilla, mattis ligula consectetur, ultrices mauris. Maecenas vitae mattis tellus..</p>
                        <div class="home-appad-btns-container">
                            <a href="#" class="home-appad-btn">
                                <iconify-icon icon="cib:google-play" class="home-appad-icon"></iconify-icon>
                                <div class="home-appad-text">
                                    <span>Download from</span>
                                    <p>Google Play</p>
                                </div>
                            </a>
                            <a href="#" class="home-appad-btn">
                                <iconify-icon icon="ant-design:apple-filled" class="home-appad-icon"></iconify-icon>
                                <div class="home-appad-text">
                                    <span>Download from</span>
                                    <p>App Store</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


        </section>

        <section class="home-contact-section">

                <div class="section-header">
                    <p>Contact Us</p>
                    <div class="section-header-underline">

                    </div>
                </div>

                <form class="home-contact-us-form-parent-container">
                    <div class="home-contact-us-form-container">
                        <div class="home-contact-us-inputs-container">
                            <input type="email" required placeholder="Email">
                            <textarea placeholder="Message"></textarea>
                        </div>

                        <div class="home-contact-us-details-container">
                            <div class="home-contact-us-detail">
                                <iconify-icon icon="akar-icons:phone" class="home-contact-us-detail-icon"></iconify-icon>
                                <p>09-12345678</p>
                            </div>
                            <div class="home-contact-us-detail">
                                <iconify-icon icon="akar-icons:envelope" class="home-contact-us-detail-icon"></iconify-icon>
                                <p>someEmail@gmail.com</p>
                            </div>
                            <div class="home-contact-us-detail">
                                <iconify-icon icon="akar-icons:location" class="home-contact-us-detail-icon"></iconify-icon>
                                <p>some street, some city, some country,some street, some city, some country</p>
                            </div>
                        </div>

                        <div class="home-contact-us-btns-container">
                            <button type="submit" class="customer-primary-btn">Send Message</button>
                            <button type="submit" class="customer-secondary-btn">Cancel</button>
                        </div>
                    </div>
                </form>

        </section>
    </div>

@endsection
@push('scripts')
        <script>
             $(document).ready(function(){
            $(window).scroll(function(){
                var scroll = $(window).scrollTop()
                if(scroll>50){
                    $('.index-page-header').addClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#ffffff")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#ffffff")
                    // $(".index-page-header select").css("color","#ffffff")
                    // $(".index-page-header select option").css("color","#000000")
                }else{
                    $('.index-page-header').removeClass("sticky-state")
                    // $(".index-page-header .customer-logo").css("color","#000000")
                    // $(".index-page-header .customer-navlinks-container a").css("color","#000000")
                    // $(".index-page-header select").css("color","#000000")
                }
            })
        })
        </script>
    @endpush
