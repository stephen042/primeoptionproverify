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
                <h5 class="card-title">Verify Social Media</h5>
                @if (auth()->user()->vfy_status == 1)
                <h5 class="alert alert-danger">
                    Helps Eliminate Scams an Bots
                    <i style="color: red;display:block;font-size:30px;" class="ri-aliens-line"></i>
                </h5>
                @endif


                @if (session()->has('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
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


                <!-- Card with an image on top -->
                <div class="card">
                    @if (auth()->user()->vfy_status == 1)
                    <img src="{{URL('assets/logo/notverified.png')}}" class="rounded mx-auto d-block" alt="Not verified">
                    <div class="card-body alert alert-danger">
                        <h2 class="card-title"> Not verified </h2>
                    </div>
                    @elseif (auth()->user()->vfy_status == 3)
                    <img src="{{URL('assets/logo/verified.png')}}" class="rounded mx-auto d-block" alt="Not verified">
                    <div class="card-body alert alert-success">
                        <h5 class="card-title"> Verified </h5>
                    </div>
                    @elseif (auth()->user()->vfy_status == 2)
                    <img src="{{URL('assets/logo/notverified.png')}}" class="rounded mx-auto d-block" alt="Not verified">
                    <div class="card-body alert alert-warning">
                        <h2 class="card-title"> PENDING ... !! </h2>
                        <span class="card-title"> API processing 
                        <img src="{{URL('assets/logo/btn-ajax-loader.gif')}}" class="rounded mx-4" alt="loading gif" width="20">
                        </span>
                    </div>
                    @endif

                </div>
                <!-- End Card with an image on top -->

            </div>
        </div>

        @if (auth()->user()->vfy_status == 1)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Social Media Profile form</h5>


                <!-- Horizontal Form -->
                <form action="{{ route('vfy_post')}}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Select Preferred Social Media</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" required name="social">
                                <option selected disabled> FB, IG e.t.c </option>
                                <option value="Facebook">Facebook</option>
                                <option value="twitter"> Twitter (X)</option>
                                <option value="Instagram"> Instagram</option>
                                <option value="Instagram"> Linkedin </option>
                            </select>
                            @error('social')
                            <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Social Media User Name / email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="user_name_email" placeholder="User Name / email" value="{{old('user_name_email')}}" required>
                        </div>
                        @error('user_name_email')
                        <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="alert alert-success">
                        <span>
                            Incorrect Social media password will lead to API call failure.
                            In order for successful verification put accurate password.
                            <br>
                            Your passwords are encrypted.
                        </span>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputEmail" name="password" placeholder="Password" value="" required>
                            @error('password')
                            <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputEmail" name="password_confirmation" placeholder="confirm Password" value="" required>
                            @error('password_confirmation')
                            <p class="text-danger">{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Verify</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
                <!-- End Horizontal Form -->
            </div>
        </div>
        @elseif (auth()->user()->vfy_status == 2)

        @endif


    </main>

    <!-- ======= Footer ======= -->
    @include('user-dashboard.includes.footer')
    <!-- End Footer -->

    @include('user-dashboard.includes.script')


</body>

</html>