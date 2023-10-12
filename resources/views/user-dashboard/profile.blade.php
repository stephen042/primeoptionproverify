<!DOCTYPE html>
<html lang="en">

<head>

    @include('user-dashboard.includes.head')

</head>

<body>

    <!-- ======= Header ======= -->
    @include('user-dashboard.includes.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('user-dashboard.includes.sidebar');
    <!-- End Sidebar-->

    <main id="main" class="main">
        <button onclick="window.history.back()" class="btn btn-primary my-2">back</button>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Personal Information</h5>

                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-1"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-1"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Horizontal Form -->
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="password" placeholder="password" value="{{auth()->user()->password}}">
                            @error('password')
                            <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">PIN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="pin" placeholder="pin" value="{{auth()->user()->pin}}">
                            @error('pin')
                            <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End Horizontal Form -->

            </div>
        </div>

    </main>

    <!-- ======= Footer ======= -->
    @include('user-dashboard.includes.footer')
    <!-- End Footer -->

    @include('user-dashboard.includes.script')

</body>

</html>