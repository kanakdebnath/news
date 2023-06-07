@extends('admin.layouts.master')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endpush
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
            <h5 class="card-title">Search Product</h5>

            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Search Product</label>
                <select class="form-control" id="search" name="user_id"></select>
              </div>



            {{-- Search Data Append --}}
                <div class="col-md-12">
                    <table class="table" id="append-data">
                        <tr>
                            <th>Title</th>
                            <th>status</th>
                        </tr>
                    </table>
                </div>
              </div>


          </div>
        </div>

      </div>
    </div>
  </section>



@endsection

@push('script')
<script type="text/javascript">
    var url = "{{ route('select.search-autocomplete') }}";
  
    $('#search').select2({
        placeholder: 'Select Product',
        ajax: {
          url: url,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.title,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });


      $(document).on('change', '#search', function(event) {
        event.preventDefault();

        var url = "{{ route('select.search-dataappend') }}";
        var id = $(this).val();

        $.ajax({
            url:url, 
            dataType: 'html', 
            data: {id: id},
            success:function(data){
                $("#append-data").append(data); 
               

            }
        });
        

    });
  
</script>
@endpush