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
                                            <div class="cover-profile">
                                                <div class="profile-bg-img">
                                                    <img class="profile-bg-img img-fluid" src="\files\assets\images\user-profile\bg-img1.jpg" alt="bg-img">
                                                    <div class="card-block user-info">
                                                        <div class="col-md-12">
                                                            <div class="media-left">
                                                                <a href="#" class="profile-image">
                                                                    <img width="100px" class="user-img img-radius" src="/assets/img/profile/{{ user()['foto'] }}" alt="user-img">
                                                                </a>
                                                            </div>
                                                            <div class="media-body row">
                                                                <div class="col-lg-12">
                                                                    <div class="user-title">
                                                                        <h2>{{ user()['fullname'] }}</h2>
                                                                        <span class="text-white">{{ user()['pekerjaan'] }}</span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <form action="simpan_artikel" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card bg-white">
                                                    <div class="post-new-contain row card-block">
                                                        <div class="col-md-1 col-xs-3 post-profile">
                                                            <img src="/assets/img/profile/{{ user()['foto'] }}" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="col-md-11 col-xs-9">
                                                            <div class="">
                                                                <input required name="judul" class="form-control post-input" type="text" placeholder="Judul...">
                                                                <hr>
                                                                <textarea required name="deskripsi" id="post-message" class="form-control post-input" rows="2" cols="10" required="" placeholder="Deskripsi..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="post-new-footer b-t-muted p-15">
                                                        
                                                        <span class="image-upload m-r-15" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Photos">
                                                            <label for="file-input" class="file-upload-lbl">
                                                                <i class="icofont icofont-image text-muted"></i>
                                                            </label>
                                                            <input required name="foto" id="file-input" type="file" accept="image/x-png,image/gif,image/jpeg">
                                                        </span>
                                                        <button type="submit" class="btn btn-primary f-right">Bagikan</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @foreach ($artikel as $a)
                                                <div>
                                                    <div class="bg-white p-relative">
                                                        @if($a->id_user == user()['id'])
                                                            <div class="input-group wall-elips">
                                                                <span class="dropdown-toggle addon-btn text-muted f-right wall-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                    <a class="dropdown-item" href="/hapus_artikel?id={{ $a->id }}">Hapus Artikel</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="card-block">
                                                            <div class="media">
                                                                <div class="media-left media-middle friend-box">
                                                                    <a href="#">
                                                                        <img class="media-object img-radius m-r-20" src="/assets/img/profile/{{ $a->fotoprofile }}" alt="">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="chat-header">{{ $a->fullname }}</div>
                                                                    <div class="f-13 text-muted">{{ $a->waktu }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="lightgallery" class="lightgallery-popup">
                                                            <div class="" data-responsive="../files/assets/images/timeline/img1.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="../files/assets/images/timeline/img1.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                                                                <a href="">
                                                                    <img src="/assets/img/artikel/{{ $a->foto }}" class="img-fluid width-100" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div id="b{{ $a->id }}" class="card-block">
                                                            <div class="timeline-details">
                                                                <div class="chat-header">{{ $a->judul }}</div>
                                                                <p class="text-muted">{{ $a->deskripsi }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="card-block b-b-theme b-t-theme social-msg">
                                                            @if($idLike = isLike($a->id))
                                                                <a href="/unlike?id={{ $idLike }}" id="suka">
                                                                    <i class="icofont icofont-heart-alt">

                                                                    </i>
                                                                    <span class="b-r-theme">Suka ({{ jumlahLike($a->id) }})</span>
                                                                </a>
                                                            @else
                                                                <a href="/like?id={{ $a->id }}" id="suka">
                                                                    <i class="icofont icofont-heart-alt text-muted">

                                                                    </i>
                                                                    <span class="b-r-theme">Suka ({{ jumlahLike($a->id) }})</span>
                                                                </a>
                                                            @endif

                                                            <a href="/semua_komentar?id={{ $a->id }}">
                                                                <i class="icofont icofont-comment text-muted">

                                                                </i>
                                                                <span class="b-r-theme">Komentar ({{ jumlahKomentar($a->id) }})</span>
                                                            </a>
                                                        </div>
                                                        <div class="card-block user-box">
                                                            <div class="p-b-20">
                                                                <span class="f-14"><a href="/semua_komentar?id={{ $a->id }}">komentar ({{ jumlahKomentar($a->id) }})</a>
                                                                </span>
                                                                <span class="f-right">
                                                                    <a href="/semua_komentar?id={{ $a->id }}">    
                                                                        lihat semua komentar
                                                                    </a>
                                                                </span>
                                                            </div>
                                                            @foreach(komentar($a->id) as $k)
                                                                <div style="" class="media">
                                                                    <a class="media-left" href="#">
                                                                        <img class="media-object img-radius m-r-20" src="/assets/img/profile/{{ $k['foto'] }}" alt="Generic placeholder image">
                                                                    </a>
                                                                    <div class="media-body b-b-theme social-client-description">
                                                                        <div class="chat-header">{{ $k['fullname'] }} <span class="text-muted">{{ $k['waktu'] }}</span></div>
                                                                        <p class="text-muted">{{ $k['komentar'] }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="media">
                                                                <a class="media-left" href="#">
                                                                    <img class="media-object img-radius m-r-20" src="/assets/img/profile/{{ user()['foto'] }}" alt="Generic placeholder image">
                                                                </a>
                                                                <div class="media-body">
                                                                    <form action="/add_comment_artikel" method="POST" class="">
                                                                        @csrf
                                                                        <div class="">
                                                                            <input type="hidden" name="id_artikel" value="{{ $a->id }}">
                                                                            <textarea name="komentar" class="f-13 form-control msg-send" rows="3" cols="10" required="" placeholder="Komentar....."></textarea>
                                                                            <div class="text-right m-t-20"><button type="submit" class="btn btn-primary waves-effect waves-light">Kirim</button></div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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