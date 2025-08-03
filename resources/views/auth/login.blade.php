<!doctype html>

<html
  lang="en"
  class="layout-wide customizer-hide"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Note Taking - Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-heading fw-bold">Note Taking</span>
                </a>
              </div>

              @if (session('success'))
              <div>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
              </div>
              @endif
              @if(session('invalid'))
              <div>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <span>{{ session('invalid') }}</span>
                </div>
              </div>
              @endif

              <form id="formAuthentication" class="mb-6" action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-6">
                  <label for="email" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Enter your username"
                    autofocus />
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                  </div>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>

              <p class="text-center">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    <!-- Core JS -->

    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
