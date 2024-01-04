<!DOCTYPE html>
<html>

<head>
    <title>Show User Detail Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{ asset('dist/js/adminlte.js')}}"></script>
</head>

<body class="">
    <div class="container pt-3 border border-2 rounded">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2" style="background-color: #dbdbdb">
                    <h1 class="p-3">Profile</h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @foreach($userDetail->images as $key => $img)
                                        @if($loop->first)
                                            <img src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}" class="img-fluid img-circle">
                                        @endif
                                    @endforeach
                                </div>
                                <h3 class="profile-username text-center">
                                    <span class="text-primary"> Name :- </span>{{ $userDetail->name }}
                                </h3>
                                <p class="text-muted text-center">
                                    <span class="text-primary"> Email :- </span>{{ $userDetail->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Addresses</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="post">
                                            @foreach($userDetail->addresses as $key => $address)
                                                <p><span class="text-primary"> Address {{ ++$key}} :- </span>{{ $address->address }}</p>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Photoes </a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="post">
                                            @foreach($userDetail->images as $key => $img)
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/images/' . $img->user_id . '/' . $img->image)}}" style="width: 200px; height: 200px;" class="border border-1 rounded">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>