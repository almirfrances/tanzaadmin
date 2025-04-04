<x-layouts.app>
    @section('title', 'App Settings & Configurations')

    <x-partials.breadcrumb :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings']
        ]" style="style1" />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>App Settings & Configurations</h4>
        <p class="mb-4">
            Here you can manage all the essential settings of your application. Customize your site's appearance,
            behavior,
            and more to suit your needs.
        </p>
        <div class="row g-4">

            <!-- General Settings Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <!-- Faded Icon Background in the Top-Left Corner -->
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-settings" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                General Settings
                            </h5>
                            <p class="card-text text-muted small">
                                Manage the general settings of the site, including site title, description, and more.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.general') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-settings me-1"></i> Explore General Settings
                        </a>
                    </div>
                </div>
            </div>


            <!-- Site Configurations Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-shield-lock" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Site Configurations
                            </h5>
                            <p class="card-text text-muted small">
                                Manage essential site configurations such as security and system behaviors.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.configuration') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-shield-lock me-1"></i> Manage Configurations
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <!-- Icon Background -->
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-photo" style="font-size: 8rem;"></i>
                    </div>

                    <!-- Card Content -->
                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Logo & Favicon Settings
                            </h5>
                            <p class="card-text text-muted small">
                                Update your application's branding by managing the logo and favicon settings.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.logo-favicon') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-photo me-1"></i> Manage Logo & Favicon
                        </a>
                    </div>
                </div>
            </div>

            @isModule('Users')
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-brand-facebook" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Social Logins
                            </h5>
                            <p class="card-text text-muted small">
                                Manage social login settings for providers like Google, Facebook, Twitter, and GitHub.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.social-logins') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-brand-facebook me-1"></i> Manage Social Logins
                        </a>
                    </div>
                </div>
            </div>

            @endisModule
            <!-- Email Settings Card (Only if Email Module is Active) -->
            @isModule('Email')
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-mail" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Email Settings
                            </h5>
                            <p class="card-text text-muted small">
                                Configure email templates, providers, and notifications for your application.
                            </p>
                        </div>
                        <a href="{{ route('admin.email.settings') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-mail me-1"></i> Manage Email Settings
                        </a>
                    </div>
                </div>
            </div>
            @endisModule

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-map" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Sitemap XML
                            </h5>
                            <p class="card-text text-muted small">
                                Edit and manage your <code>sitemap.xml</code> file for better search engine indexing.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.sitemap-xml') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-map me-1"></i> Manage Sitemap XML
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-code" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Custom Code
                            </h5>
                            <p class="card-text text-muted small">
                                Add custom header and footer code for your application. Use this to include additional CSS, JS, or meta tags.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.custom-code') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-code me-1"></i> Manage Custom Code
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-file-text" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Robots.txt
                            </h5>
                            <p class="card-text text-muted small">
                                Manage your site's robots.txt file to control how web crawlers interact with your website.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.robots-txt') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-file-text me-1"></i> Manage Robots.txt
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center mb-3 shadow-sm position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 opacity-25 text-primary"
                        style="font-size: 10rem; z-index: 0; transform: translate(-30%, -45%);">
                        <i class="ti ti-alert-circle" style="font-size: 8rem;"></i>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between position-relative"
                        style="z-index: 1;">
                        <div class="mb-3">
                            <h5 class="card-title mb-2">
                                Maintenance Mode
                            </h5>
                            <p class="card-text text-muted small">
                                Configure maintenance mode settings, including a custom message, image, and an access code for bypassing the mode.
                            </p>
                        </div>
                        <a href="{{ route('admin.settings.maintenance-mode') }}"
                            class="btn btn-primary mt-auto btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-alert-circle me-1"></i> Manage Maintenance Mode
                        </a>
                    </div>
                </div>
            </div>




        </div>
    </div>
</x-layouts.app>
