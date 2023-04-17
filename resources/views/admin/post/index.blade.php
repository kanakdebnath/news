@extends('admin.layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Post</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Post</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      

      <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Posts</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $model->title }}</td>
                    <td>{{ $model->category->name }}</td>
                    <td>
                      <img src="{{ asset('uploads/post/' . $model->photo) }}" width="120" height="80" alt="">
                      
                    </td>
                    <td>{{ $model->status }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('posts.edit',$model->id) }}">Edit</a>
                        <a onclick=" return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" href="{{ route('posts.delete',$model->id) }}">Delete</a>
                    </td>
                  </tr>
                  
                  @endforeach
                  
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

      </div>
    </div>
  </section>



@endsection