@extends('auth/main')
@section('lauth')
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->

                <form action="/login/in" method="POST" lass="md-float-material form-material">
                    @csrf
                    <div class="text-center">
                        <img height="100px" width="350px" src="/assets/img/logoartikel.png" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    @if(session('masuk'))
                                        <h5 class="text-danger text-center mb-3">Username/Password salah</h5>
                                    @endif
                                    <h3 class="text-center">Masuk</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="email" name="email" class="form-control" required="" placeholder="Your Email Address">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control" required="" placeholder="Password">
                                <span class="form-bar"></span>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Masuk</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-inverse text-left m-b-0">Belum punya akun Artikel?</p>
                                    <p class="text-inverse text-left"><a href="/register"><b class="f-w-600">Daftar sekarang</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
@endsection