<x-layouts.main>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <!-- Sidebar -->
          <x-partials.sidebar />

          <!-- Page Content -->
          <div class="layout-page">
            <!-- Navbar -->
            <x-partials.navbar />

            <!-- Main Content -->
            <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                {{ $slot }}
              </div>

              <!-- Footer -->
              <x-partials.footer />

              <div class="content-backdrop fade"></div>
            </div>
          </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
      </div>
</x-layouts.main>
