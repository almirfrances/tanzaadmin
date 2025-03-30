<x-layouts.main>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
        <x-user.navbar />
        <!-- Layout container -->
      <div class="layout-page">
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <x-user.menu />
            <div class="container-xxl flex-grow-1 container-p-y">
                {{ $slot }}
            </div>
                      <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div
                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                <div>
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://almirfrances.com" target="_blank"
                    class="footer-link text-primary fw-medium">Almir Frances</a>
                </div>
                <div class="d-none d-lg-inline-block">


                  <a href="https://pixinvent.ticksy.com/" target="_blank"
                    class="footer-link d-none d-sm-inline-block">Support</a>
                </div>
              </div>
            </div>
          </footer>
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>

        </div>
      </div>
    </div>
  </div>


</x-layouts.main>
