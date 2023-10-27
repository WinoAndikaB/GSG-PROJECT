@extends('Main.layout.homeStyle')

<title>Landing Page - GSG Project</title>

<body>
<div class="page-heading">
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="/">Home</a></li>
                          <li class="scroll-to-section"><a href="#trends">Trending</a></li>
                          <li class="scroll-to-section"><a href="#about">Artikel</a></li>
                          <li class="scroll-to-section"><a href="/landingPageVideo" class="active">Video</a></li>
                          <li class="scroll-to-section"><a href="/ulasanLandingPage" class="text-center">Ulasan</a></li>
                          <li class="scroll-to-section"><a href="/abouts">Tentang</a></li>
                          <li>
                            <form action="{{ route('landingPageVideo') }}" method="GET" class="input-group">
                              <input type="text" name="search" class="form-control" placeholder="Cari Video..." aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ request('search') }}">
                              <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                          </form>
                          </li>
                          <li><a href="/login">Login</a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                  </nav>
              </div>
          </div>
      </div>
  </header>
</div>
  <div class="banner-area banner-inner-1 bg-black" id="banner">
    <div class="banner-inner pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumb after-left-top">
                        <img src="assets/img/banner/1.png" alt="img">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-details mt-4 mt-lg-0">
                        <div class="post-meta-single">
                            <ul>
                                <li><a class="tag-base tag-blue" href="#">GSG PROJECT</a></li>
                                <li class="date"><i class="fa fa-clock-o"></i>{{$todayDate}}</li>
                            </ul>
                        </div>
                        <h2>Provide you a qualified articles and informative articles from a lot sources.</h2>
                        <p></p>
                        <a class="btn btn-blue" href="/abouts">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


  <div class="post-area pd-top-75 pd-bottom-50" id="trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="section-title">
                    <h6 class="title">Trending Video</h6>
                </div>
                @foreach ($trendingVideo as $item)
                <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="trending-post">
                              <div class="single-post-wrap style-overlay">
                                <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                                  <div class="details">
                                      <div class="post-meta-single">
                                          <p><i class="fa fa-clock-o"></i>
                                            @php
                                            $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                                            $sekarang = \Carbon\Carbon::now();
                                            $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
                          
                                            if ($selisihWaktu < 60) {
                                              echo $selisihWaktu . ' Menit Lalu';
                                            } elseif ($selisihWaktu < 1440) {
                                              echo floor($selisihWaktu / 60) . ' Jam Lalu';
                                            } elseif ($selisihWaktu < 10080) {
                                              echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                                            } elseif ($selisihWaktu < 43200) {
                                              echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                                            } else {
                                              echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                                            }
                                          @endphp
                                        </p>
                                      </div>
                                      <h6 class="title"><a href="/login">{{$item->judulVideo}}</a></h6>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
              @endforeach                        
            </div>

          
          <div class="col-lg-3 col-md-6">
            <div class="section-title">
                <h6 class="title">What’s new</h6>
            </div>
            <div class="post-slider owl-carousel">
                @foreach ($whatsNewVideo as $item)
                    <div class="item">
                        <div class="single-post-wrap">
                          <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                            <div class="details">
                                <div class="post-meta-single mb-4 pt-1">
                                    <ul>
                                        <li><a class="tag-base tag-blue" href="/login">{{$item->uploader}}</a></li>
                                        <li><i class="fa fa-clock-o"></i>
                                            @php
                                            $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                                            $sekarang = \Carbon\Carbon::now();
                                            $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
                          
                                            if ($selisihWaktu < 60) {
                                              echo $selisihWaktu . ' Menit Lalu';
                                            } elseif ($selisihWaktu < 1440) {
                                              echo floor($selisihWaktu / 60) . ' Jam Lalu';
                                            } elseif ($selisihWaktu < 10080) {
                                              echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                                            } elseif ($selisihWaktu < 43200) {
                                              echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                                            } else {
                                              echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                                            }
                                          @endphp
                                        </li>
                                    </ul>
                                </div>
                                <h6 class="title"><a href="/login">{{$item->judulVideo}}</a></h6>
                                <p>{{ \Illuminate\Support\Str::limit($item->deskripsiVideo, 600) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="section-title">
              <h6 class="title">Terbaru</h6>
          </div>
          @foreach ($trendingVideo as $item)
          <div class="post-slider owl-carousel">
                <div class="item">
                    <div class="trending-post">
                        <div class="single-post-wrap style-overlay">
                          <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>
                                      @php
                                      $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                                      $sekarang = \Carbon\Carbon::now();
                                      $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
                    
                                      if ($selisihWaktu < 60) {
                                        echo $selisihWaktu . ' Menit Lalu';
                                      } elseif ($selisihWaktu < 1440) {
                                        echo floor($selisihWaktu / 60) . ' Jam Lalu';
                                      } elseif ($selisihWaktu < 10080) {
                                        echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                                      } elseif ($selisihWaktu < 43200) {
                                        echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                                      } else {
                                        echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                                      }
                                    @endphp
                                  </p>
                                </div>
                                <h6 class="title"><a href="/login">{{$item->judulVideo}}</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach                        
      </div>
            <div class="col-lg-3 col-md-6">
                <div class="section-title">
                    <h6 class="title">Join With Us</h6>
                </div>
                <div class="social-area-list mb-4">
                    <ul>
                        <li><a class="facebook" href="/login"><i class="fa fa-facebook social-icon"></i><span>12,300</span><span>Like</span> <i class="fa fa-plus"></i></a></li>
                        <li><a class="twitter" href="/login"><i class="fa fa-twitter social-icon"></i><span>12,600</span><span>Followers</span> <i class="fa fa-plus"></i></a></li>
                        <li><a class="youtube" href="/login"><i class="fa fa-youtube-play social-icon"></i><span>1,300</span><span>Subscribers</span> <i class="fa fa-plus"></i></a></li>
                        <li><a class="instagram" href="/login"><i class="fa fa-instagram social-icon"></i><span>52,400</span><span>Followers</span> <i class="fa fa-plus"></i></a></li>
                        <li><a class="google-plus" href="/login"><i class="fa fa-google social-icon"></i><span>19,101</span><span>Subscribers</span> <i class="fa fa-plus"></i></a></li>
                    </ul>
                </div>
                <div class="add-area">
                    <a href="#"><img class="w-100" src="assets/img/add/6.png" alt="img"></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-sky pd-top-80 pd-bottom-50" id="latest">
  <div class="container">
      <div class="row">
          <div class="col-lg-3 col-sm-6">
              <div class="single-post-wrap style-overlay-bg">
                  <div class="thumb">
                      <img src="assets/img/post/9.png" alt="img">
                  </div>
                  <div class="details">
                      <div class="post-meta-single mb-3">
                          <ul>
                              <li><a class="tag-base tag-blue" href="cat-fashion.html">fashion</a></li>
                              <li><p><i class="fa fa-clock-o"></i>08.22.2020</p></li>
                          </ul>
                      </div>
                      <h6 class="title"><a href="#">A Comparison of the Sony FE 85mm f/1.4 GM and Sigma</a></h6>
                  </div>
              </div>
          </div>

          @foreach ($boxVideo2 as $item)
          <div class="col-lg-3 col-sm-6">
              <div class="single-post-wrap">
                  <div class="thumb">
                    <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title"><a href="#">{{$item->judulVideo}}</a></h6>
                  </div>
              </div>
              <div class="single-post-wrap">
                  <div class="thumb">
                    <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                      <p class="btn-date"><i class="fa fa-clock-o"></i>{{$item->created_at}}</p>
                  </div>
                  <div class="details">
                      <h6 class="title"><a href="#">{{$item->judulVideo}}</a></h6>
                  </div>
              </div>
          </div>
          @endforeach

          <div class="col-lg-3 col-sm-6">
              <div class="trending-post style-box">
                  <div class="section-title">
                      <h6 class="title">Trending News</h6>
                  </div>
                  @foreach ($boxVideo3 as $item)
                  <div class="post-slider owl-carousel">
                      <div class="item">
                          <div class="single-post-list-wrap">
                              <div class="media">
                                  <div class="media-left">
                                    <iframe width="100" height="100" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                                  </div>
                                  <div class="media-body">
                                      <div class="details">
                                          <div class="post-meta-single">
                                              <ul>
                                                  <li><i class="fa fa-clock-o"></i>{{$item->created_at}}</li>
                                              </ul>
                                          </div>
                                          <h6 class="title"><a href="#">{{$item->judulVideo}}</a></h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>  

  <section class="about-us" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Video</h6>
            <h4>Daftar Video</h4>
          </div>
        </div>
        <div>
          @foreach ($semuaVideo as $item)
              <div class="row" style="text-align: justify">
                  <div class="col-lg-3 col-md-4 col-sm-12" data-aos="fade-right" data-aos-delay="200">
                    <iframe width="560" height="200" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div class="col-lg-9 col-md-8 col-sm-12" data-aos="fade-left" data-aos-delay="200">
                      <h4 style="text-align: left" >{{ $item->judulVideo }} </h4>
                      <span class="d-flex"><b>{{ $item->uploader }}</b></span>
                      <p>{!! substr(strip_tags($item->deskripsiVideo), 0, 400) . (strlen(strip_tags($item->content)) > 400 ? '...' : '') !!}</p>
                  </div>
                  <span style="text-align: right; color: rgba(165, 165, 165, 1);"><p>
                    @php
                    $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                    $sekarang = \Carbon\Carbon::now();
                    $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
  
                    if ($selisihWaktu < 60) {
                      echo $selisihWaktu . ' Menit Lalu';
                    } elseif ($selisihWaktu < 1440) {
                      echo floor($selisihWaktu / 60) . ' Jam Lalu';
                    } elseif ($selisihWaktu < 10080) {
                      echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                    } elseif ($selisihWaktu < 43200) {
                      echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                    } else {
                      echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                    }
                  @endphp
                  | 
                      <a href="/login" style="color: rgba(242, 100, 25, 1)">Selengkapnya >></a></p></span>
              </div>
              <hr>
              @endforeach
          </div>
      </div>
    </div>
  </section>

  <div class="pd-top-80 pd-bottom-50" id="grid">
    <div class="container">
      <div class="col-lg-6 offset-lg-3">
        <div class="section-heading">
          <h6>Selengkapnya</h6>
          <h4>Selengkapnya</h4>
        </div>
      </div>
        <div class="row">
            @foreach ($boxVideo as $item)
            <div class="col-lg-3 col-sm-6">
                <div class="single-post-wrap style-overlay">
                    <div class="thumb">
                      <iframe width="600" height="300" src="{{$item->linkVideo}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="details">
                        <div class="post-meta-single">
                            <p><i class="fa fa-clock-o"></i>
                                @php
                                $ulasanCreatedAt = \Carbon\Carbon::parse($item['created_at']);
                                $sekarang = \Carbon\Carbon::now();
                                $selisihWaktu = $sekarang->diffInMinutes($ulasanCreatedAt);
              
                                if ($selisihWaktu < 60) {
                                  echo $selisihWaktu . ' Menit Lalu';
                                } elseif ($selisihWaktu < 1440) {
                                  echo floor($selisihWaktu / 60) . ' Jam Lalu';
                                } elseif ($selisihWaktu < 10080) {
                                  echo floor($selisihWaktu / 1440) . ' Hari Lalu';
                                } elseif ($selisihWaktu < 43200) {
                                  echo floor($selisihWaktu / 10080) . ' Minggu Lalu';
                                } else {
                                  echo floor($selisihWaktu / 43200) . ' Bulan Lalu';
                                }
                              @endphp
                            </p>
                        </div>
                        <h6 class="title"><a href="/login">{{ $item->judulVideo }}</a></h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>