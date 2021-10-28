@extends('auth/main')
@section('lauth')
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form action="/register/add" method="POST" enctype="multipart/form-data" class="md-float-material form-material">
                    <div class="text-center">
                        <img height="100px" width="350px" src="/assets/img/logoartikel.png" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    @if(session('fullname'))
                                        <h5 class="text-center text-success mb-3">Berhasil mendaftar, silahkan login.</h5>
                                    @endif
                                    <h3 class="text-center">Daftar</h3>
                                </div>
                            </div>
                            @csrf
                            <div class="form-group form-primary">
                                <input type="text" name="fullname" class="form-control" required="" placeholder="Nama Lengkap">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="pekerjaan" class="form-control" required="" placeholder="Pekerjaan">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="email" name="email" class="form-control" required="" placeholder="Email">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control" required="" placeholder="Kata Sandi">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="file" name="foto" class="form-control" required="" placeholder="Foto">
                                <span class="form-bar"></span>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Daftar Sekarang</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-inverse text-left m-b-0">Sudah punya akun Artikel?</p>
                                    <p class="text-inverse text-left"><a href="/login"><b class="f-w-600">Masuk sekarang</b></a></p>
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