@extends('layouts.dashbord.master')

@section('content')
<!------------------------------------ content  -------------------------------------->
         <div class="container">
              <br />
              <br />
              <h2 style="text-align: center; padding: 15px;" >Dynamically Add Attributes</h2>
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <div class="form-group">
                   <form method="POST" action="{{ route('attributes.store') }}" name="add_name" id="add_name">
                    @csrf
                       <div class="table-responsive">
                             <table class="table table-bordered" id="dynamic_field">
                                  <tr>
                                       <td><input type="text" name="name[]" placeholder="Enter your attributes" class="form-control name_list" /></td>
                                       <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>

                                    </tr>
                             </table>
                             {{-- <input type="Submit"  class="btn btn-info" value="Submit" />   --}}
                        </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <input name="category_id" value={{$category_id}} class="btn btn-primary pill px-4 py-2" style="display:none">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-md-12">
                            <input type="submit" value="submit" class="btn btn-primary pill px-4 py-2">
                          </div>
                        </div>
                   </form>
              </div>
         </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
      var i=1;
      $('#add').click(function(){
        console.log(1);
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your attributes" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
  });
  </script>
@endsection
