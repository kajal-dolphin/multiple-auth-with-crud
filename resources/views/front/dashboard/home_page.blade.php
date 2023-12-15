@extends('front.layout.app')

@section('content')
    @include('front.layout.header')
    <main id="main">

      <section id="hero" class="hero">

        <img alt="" data-aos="fade-in" src="{{ asset('front/assets/img/hero-bg.jpg')}}">

        <div class="container">
          <div class="row">
            <div class="col-lg-10">
              <h2 data-aos="fade-up" data-aos-delay="100">Welcome to Our Website</h2>
              <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with Bootstrap
              </p>
            </div>
          </div>
        </div>

      </section>

    </main>
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

    <div id="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
@endsection