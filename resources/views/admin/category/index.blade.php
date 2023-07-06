@extends('admin.layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      

      <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Categories</h5>


              {{-- @if (\Session::has('message'))
                  <div class="alert alert-success">
                      <ul>
                          <li>{!! \Session::get('message') !!}</li>
                      </ul>
                  </div>
              @endif --}}

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->status }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('category.edit',$model->id) }}">Edit</a>
                        <button data-id="{{ $model->id }}"  class="btn btn-danger deleteRecord" >Delete</button>
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

@push('script')
  <script>

    $(".deleteRecord").click(function(){

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          var id = $(this).data("id");
          $tr= $(this).closest("tr");
          var token = $("meta[name='csrf-token']").attr("content");
          $.ajax(
          {
              url: "{{ route('category.delete') }}",
              type: 'DELETE',
              data: {
                  "id": id,
                  "_token": token,
              },
              success: function (data){
                  if (data.success) {
                    toastr.success(data.success);
                    $tr.remove();
                  }
              }
          });
        }
      })


    
   
});
  </script>
@endpush