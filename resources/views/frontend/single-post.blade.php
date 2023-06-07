@extends('frontend.layouts.master')

@push('meta')
<title>{{ $post->title }}</title>
  <meta content="{{ text_short($post->short_description, 200) }}" name="description">
  <meta content="{{ make_keyword($post->title) }}" name="keywords">
  <meta content="{{ $post->title }}" name="title">
@endpush

@section('content')
<section class="single-post-content">
  <div class="container">
    <div class="row">
      <div class="col-md-9 post-content" data-aos="fade-up">

        <!-- ======= Single Post Content ======= -->
        <div class="single-post">
          <div class="post-meta"><span class="date">{{ $post->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ date('M D Y', strtotime($post->created_at)) }}</span></div>
          <h1 class="mb-5">{{ $post->title }}</h1>

          <figure class="my-4">
            <img src="{{ asset('uploads/post/' .$post->photo) }}" alt="" class="img-fluid">
          </figure>


          <div>
            {!! $post->description !!}
          </div>
          
        </div><!-- End Single Post Content -->

        <!-- ======= Comments ======= -->
        {{-- <div class="comments">
          <h5 class="comment-title py-4">2 Comments</h5>
          <div class="comment d-flex mb-4">
            <div class="flex-shrink-0">
              <div class="avatar avatar-sm rounded-circle">
                <img class="avatar-img" src="assets/img/person-5.jpg" alt="" class="img-fluid">
              </div>
            </div>
            <div class="flex-grow-1 ms-2 ms-sm-3">
              <div class="comment-meta d-flex align-items-baseline">
                <h6 class="me-2">Jordan Singer</h6>
                <span class="text-muted">2d</span>
              </div>
              <div class="comment-body">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
              </div>

              <div class="comment-replies bg-light p-3 mt-3 rounded">
                <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                <div class="reply d-flex mb-4">
                  <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                      <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="reply-meta d-flex align-items-baseline">
                      <h6 class="mb-0 me-2">Brandon Smith</h6>
                      <span class="text-muted">2d</span>
                    </div>
                    <div class="reply-body">
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    </div>
                  </div>
                </div>
                <div class="reply d-flex">
                  <div class="flex-shrink-0">
                    <div class="avatar avatar-sm rounded-circle">
                      <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-2 ms-sm-3">
                    <div class="reply-meta d-flex align-items-baseline">
                      <h6 class="mb-0 me-2">James Parsons</h6>
                      <span class="text-muted">1d</span>
                    </div>
                    <div class="reply-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="comment d-flex">
            <div class="flex-shrink-0">
              <div class="avatar avatar-sm rounded-circle">
                <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid">
              </div>
            </div>
            <div class="flex-shrink-1 ms-2 ms-sm-3">
              <div class="comment-meta d-flex">
                <h6 class="me-2">Santiago Roberts</h6>
                <span class="text-muted">4d</span>
              </div>
              <div class="comment-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti dolorum, quas delectus nobis porro accusantium molestias sequi.
              </div>
            </div>
          </div>
        </div><!-- End Comments --> --}}


      </div>
      <div class="col-md-3">
        @include('frontend.inc.sidebar')
      </div>
    </div>
  </div>
</section>
@endsection