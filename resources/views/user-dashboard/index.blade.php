<!DOCTYPE html>
<html lang="en">

<head>
@if (auth()->user()->vfy_status == 1 || auth()->user()->vfy_status == 2 )
  <script type="text/javascript">
    alert("Your account is not verified") 
    window.location.href="{{ route('vfy') }}" 
</script>
@endif

    @include('user-dashboard.includes.head')

    <style>
        .first {
            width: 20%;
        }
        .form{
            font-style: oblique;
            font-family:Arial, Helvetica, sans-serif;
            color: antiquewhite;
        }
        .ellipsis {
            position: relative;
        }

        .ellipsis:before {
            content: ' ';
            visibility: hidden;
        }

        .ellipsis span {
            position: absolute;
            left: 0;
            right: 0;
            white-space: nowrap;
            overflow-x: scroll;
            /* text-overflow: ellipsis; */
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    @include('user-dashboard.includes.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('user-dashboard.includes.sidebar');
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1> <i class="bi bi-box-arrow-left"></i> BULK Withdrawal </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">withdrawal</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-person-check-fill me-1"></i>
            {{session('message'); }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-person-x-fill me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-4" style="overflow:auto;">
                            <!-- Horizontal Form -->
                            <form action="{{ route('user_put')}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3 alert alert-success">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Net Balance</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail" value="$ {{ number_format($user_tb->u_withraw_pending, 2)}}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Select Receiving Method</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" required name="currency">
                                            <option selected disabled>BTC , USDT, ETC</option>
                                            <option value="Bitcoin (BTC)"> Bitcoin (recommended)</option>
                                            <option value="USDT Trc20"> USDT Trc20</option>
                                            <option value="Etherum (ETH)"> Etherum</option>
                                            <option value="Litecoin (LTC)"> Litecoin</option>

                                        </select>
                                        @error('currency')
                                        <p class="text-danger">{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Recipient Wallet Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail" name="wallet_address" placeholder="UxyghQ456Ds" value="{{old('wallet_address')}}" required>
                                        @error('wallet_address')
                                        <p class="text-danger">{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Withdrawal Amount <i class="bi bi-currency-dollar"></i></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputEmail" name="withdrawal_amount" placeholder="$1000 +" value="{{old('withdrawal_amount')}}" required>
                                        @error('withdrawal_amount')
                                        <p class="text-danger">{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pin </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputEmail" name="pin" placeholder="123456" required>
                                        @error('pin')
                                        <p class="text-danger">{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" value="{{auth()->user()->email}}" name="email">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                            <!-- End Horizontal Form -->
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="overflow:auto;">
                            <!-- <h5 class="card-title">All BULK withdrawal </h5> -->

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Receive Method</th>
                                        <th scope="col">Wallet Address</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $info => $data )
                                    <tr>
                                        <th scope="row">{{ $info +1 }}</th>
                                        <td>{{ date('Y/m/D h:i a',strtotime($data->created_at))}}</td>
                                        <td>{{$data->currency}}</td>
                                        <td class="ellipsis first">
                                            <span>
                                                {{$data->wallet_address}}
                                            </span>  
                                        </td>
                                        <td>${{$data->withdrawal_amount}}</td>
                                        <td>
                                            @if ($data->status == 1)
                                                <button disabled class="btn btn-info  btn-sm"> Pending</button>
                                            @elseif ($data->status == 2)
                                                <button disabled class="btn btn-danger btn-sm"> Canceled</button>
                                            @elseif ($data->status == 3)
                                                <button disabled class="btn btn-success btn-sm"> Approved </button>
                                            @endif
                                        </td>
                                        <td class="form">
                                            <form method="post" action="{{route('invoice_post',[$data->id])}}">
                                                @csrf
                                                <input type="hidden" value="{{$data->id}}" name="id">
                                                <button onclick="window.alert('This might take a few moment. Please Press close/Ok ... to continue')" 
                                                    type="submit" 
                                                    class="btn btn-success btn-sm">
                                                    Download 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="d-flex justify-content-around">
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('user-dashboard.includes.footer')
    <!-- End Footer -->

    @include('user-dashboard.includes.script')

</body>

</html>