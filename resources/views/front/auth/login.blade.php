@extends('front.layout.app')

@section('content')
<section class="h-60 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-60">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">
                                <form action="{{ route('user.post.login')}}" method="post">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Email</label>
                                        <input type="email" id="form2Example11" class="form-control" name="email"
                                            placeholder="Email address" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22" >Password</label>
                                        <input type="password" id="form2Example22" class="form-control" placeholder="Password" name="password"/>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            type="submit">Log
                                            in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection