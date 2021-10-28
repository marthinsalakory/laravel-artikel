@extends('layouts.main')
@section('container')
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- Main-body start -->
                <div class="main-body" style="margin-top: 17px">
                    <div class="page-wrapper">
                        <!-- Page body start -->
                        <div class="page-body">
                            <!--profile cover start-->
                            <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="bg-white p-relative">
                                                    @if($artikel['id_user'] == user()['id'])
                                                        <div class="input-group wall-elips">
                                                            <span class="dropdown-toggle addon-btn text-muted f-right wall-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                            <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                <a class="dropdown-item" href="/hapus_artikel?i={{ $artikel['id'] }}">Hapus Artikel</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-block">
                                                        <div class="media">
                                                            <div class="media-left media-middle friend-box">
                                                                <a href="#">
                                                                    <img class="media-object img-radius m-r-20" src="/assets/img/profile/{{ $artikel['fotoprofile'] }}" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="chat-header">{{ $artikel['fullname'] }}</div>
                                                                <div class="f-13 text-muted">{{ $artikel['waktu'] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="lightgallery" class="lightgallery-popup">
                                                        <div class="" data-responsive="../files/assets/images/timeline/img1.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="../files/assets/images/timeline/img1.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                            <a href="">
                                                                <img src="/assets/img/artikel/{{ $artikel['foto'] }}" class="img-fluid width-100" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div id="b{{ $artikel['id'] }}" class="card-block">
                                                        <div class="timeline-details">
                                                            <div class="chat-header">{{ $artikel['judul'] }}</div>
                                                            <p class="text-muted">{{ $artikel['deskripsi'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="media card-block b-b-theme b-t-theme social-msg">
                                                        <a class="media-left" href="#">
                                                            <img width="60px" class="media-object img-radius m-r-20" src="/assets/img/profile/{{ user()['foto'] }}" alt="Generic placeholder image">
                                                        </a>
                                                        <div class="media-body">
                                                            <form action="/add_comment_artikel" method="POST" class="">
                                                                @csrf
                                                                <div class="">
                                                                    <input type="hidden" name="id_artikel" value="{{ $artikel['id'] }}">
                                                                    <textarea name="komentar" class="f-13 form-control msg-send" rows="3" cols="10" required="" placeholder="Komentar....."></textarea>
                                                                    {{-- <div class="text-right m-t-20"><a href="/" class="btn btn-danger waves-effect waves-light">Kembali</a></div> --}}
                                                                    <div class="text-right m-t-20"><a href="/" class="btn btn-danger waves-effect waves-light mr-3">Kembali</a><button type="submit" class="btn btn-primary waves-effect waves-light">Kirim</button></div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if($idLike = isLike($artikel['id']))
                                                            <a href="/unlike?id={{ $idLike }}" id="suka">
                                                                <i class="icofont icofont-heart-alt">

                                                                </i>
                                                                <span class="b-r-theme">Suka ({{ jumlahLike($artikel['id']) }})</span>
                                                            </a>
                                                        @else
                                                            <a href="/like?id={{ $artikel['id'] }}" id="suka">
                                                                <i class="icofont icofont-heart-alt text-muted">

                                                                </i>
                                                                <span class="b-r-theme">Suka ({{ jumlahLike($artikel['id']) }})</span>
                                                            </a>
                                                        @endif
                                                    </div>
                                                        @foreach($komentar as $k)
                                                            <div style="" class="media">
                                                                <a class="media-left" href="#">
                                                                    <img width="50px" height="50px" class="media-object img-radius m-r-20" src="/assets/img/profile/{{ $k['foto'] }}" alt="Generic placeholder image">
                                                                </a>
                                                                <div class="media-body b-b-theme social-client-description">
                                                                    <div class="chat-header">{{ $k['fullname'] }} <span class="text-muted">{{ $k['waktu'] }}</span></div>
                                                                    <p class="text-muted">{{ $k['komentar'] }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                            <!--profile cover end-->
                        </div>
                        <!-- Page body end -->
                    </div>
                </div>
                <!-- Main body end -->
                <div id="styleSelector">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection