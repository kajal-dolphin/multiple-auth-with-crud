<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Detail Page</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">
</head>

<body class="pt-5 pb-5">
    <div class="container col-4">
        <div class="card card-widget widget-user">
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ $userDetail->name }}</h3>
                <h5 class="widget-user-desc">{{ $userDetail->email }}</h5>
            </div>
            <div class="widget-user-image">
                @foreach($userDetail->images as $key => $img)
                    @if($loop->first)
                    <img src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}"
                        class="img-fluid img-circle border border-2" style="width: 100px; height: 100px;">
                    @endif
                @endforeach
            </div>
            <div class="card-footer">
                <h4 class="card-title w-100 pb-2">
                    <strong class="d-block w-100 p-3" data-toggle="collapse"><i
                            class="fa fa-home fa-fw ps-2"></i> Addresses :- </strong>
                </h4>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="callout callout-info">
                        @foreach($userDetail->addresses as $key => $address)
                            <li class="p-1"> {{ $address->address }}</li>
                        @endforeach
                    </div>
                </div>
                <div class="row pt-2">
                    <h4 class="card-title w-100 pb-2">
                        <strong class="d-block w-100" data-toggle="collapse"><i
                                class="fa fa-image"></i> Photoes </strong>
                    </h4>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="callout callout-info">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                        class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($userDetail->images as $key => $img)
                                        @if($loop->first)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100"
                                                src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}"
                                                    alt="Second slide">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100"
                                                src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}"
                                                    alt="Second slide">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                    role="button" data-slide="prev">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                        <i class="fa fa-chevron-left"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators"
                                    role="button" data-slide="next">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{ asset('dist/js/adminlte.js')}}"></script>
</body>

</html>