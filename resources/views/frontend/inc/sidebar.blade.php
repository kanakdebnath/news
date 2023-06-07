<!-- ======= Sidebar ======= -->
<div class="aside-block">

    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

      <!-- Popular -->
      <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
        @php
            $posts = App\Models\Post::orderBy('views', 'DESC')->take(6)->get();
        @endphp
        @foreach ($posts as $item)
            
        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">{{ $item->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ format_date($item->created_at) }}</span></div>
          <h2 class="mb-2"><a href="{{ route('single-post',$item->slug) }}">{{ $item->title }}</a></h2>
          <span class="author mb-3 d-block">Jenny Wilson</span>
        </div>
        @endforeach

      </div> <!-- End Popular -->

      

      <!-- Latest -->
      <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">

        @php
              $posts = App\Models\Post::latest()->take(3)->get();
          @endphp
      @foreach ($posts as $item)
                  
      <div class="post-entry-1 border-bottom">
        <div class="post-meta"><span class="date">{{ $item->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ format_date($item->created_at) }}</span></div>
        <h2 class="mb-2"><a href="{{ route('single-post',$item->slug) }}">{{ $item->title }}</a></h2>
        <span class="author mb-3 d-block">Jenny Wilson</span>
      </div>
      @endforeach

      </div> <!-- End Latest -->

    </div>
  </div>

  <div class="aside-block">
    <h3 class="aside-title">Video</h3>
    <div class="video-post">
      <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
        <span class="bi-play-fill"></span>
        <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
      </a>
    </div>
  </div><!-- End Video -->
@php
    $categories = \App\Models\Category::where('status','Active')->latest()->take(8)->get();
@endphp
  <div class="aside-block">
    <h3 class="aside-title">Categories</h3>
    <ul class="aside-links list-unstyled">
        @foreach ($categories as $category)
            <li><a href="{{ route('post_categories',$category->slug) }}"><i class="bi bi-chevron-right"></i> {{ $category->name }}</a></li>
        @endforeach
    </ul>
  </div><!-- End Categories -->

  <div class="aside-block">
    <h3 class="aside-title">Tags</h3>
    <ul class="aside-tags list-unstyled">
      <li><a href="category.html">Business</a></li>
      <li><a href="category.html">Culture</a></li>
      <li><a href="category.html">Sport</a></li>
      <li><a href="category.html">Food</a></li>
      <li><a href="category.html">Politics</a></li>
      <li><a href="category.html">Celebrity</a></li>
      <li><a href="category.html">Startups</a></li>
      <li><a href="category.html">Travel</a></li>
    </ul>
  </div><!-- End Tags -->
