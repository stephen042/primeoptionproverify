<!DOCTYPE html>
<html lang="en">

<head>
  @include('user-dashboard.includes.head')
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <!-- <img src="{{ URL('assets/home/fav.png') }}" alt=""> -->
                  <span class="d-none d-lg-block">PrimeOption Pro Verify </span>
                </a>
              </div>
              <!-- End Logo -->

              {{-- for logout popup --}}
              @if (session()->has('message'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-person-x-fill me-1"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <center>
                      <img src="{{ URL('assets/logo/logo.png') }}" class="" width="110px" height="40px" alt="Logo">
                    </center>
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter email & password emailed to you by Admin to login</p>
                  </div>
                  <!-- {{-- for Validation of login --}} -->
                  @if (session()->has('noMatch'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ session('noMatch') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <form class="row g-3 needs-validation" novalidate action="{{ route('login_post')}}" method="POST">
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  <!-- End #main -->


  @include('user-dashboard.includes.script')

</body>

</html>