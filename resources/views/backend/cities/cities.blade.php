@extends('backend.home')
@section('title','Cities')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-5">
      <div id="">
        <div class="card">
          <div class="card-header">
            City Create
          </div>
          <div class="card-body">
            <form id="city-add-form" action="{{route('admin.cities.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="district-name">District</label>
                    <select name="district_id" class="form-control" id="district-name" required>
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                        <label for="city-name">Name</label>
                        <input type="text"  name="name" id="city-name" class="form-control" value="{{old('city_name')}}"  placeholder="City Name" required>
                  </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div id="reload-city">
        <div class="card">
          <div class="card-header">
            Cities List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign" id="city-list" width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>District</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="city-body">
                    @foreach($cities as $city)
                      <tr class="city-row-{{$city->id}}">
                        <td>{{$city->id}}</td>
                          <td class="city-column-name-{{$city->id}}">{{$city->name}}</td>
                          <td class="city-column-name-{{$city->id}}">{{$city->district != null ?$city->district->name : ''}}</td>
                        <td >
                          <button class="btn btn-outline-primary btn-sm city-edit"  data-id="{{$city->id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                          <button class="btn btn-outline-danger btn-sm city-delete"  title="Delete" onclick="deleteData({{$city->id}})"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$city->id}}" method="post" action="{{route('admin.cities.destroy', $city->id)}}" style="display: none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="city-modal" tabindex="-1" role="dialog" aria-labelledby="city-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel-2">City Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="city-edit-form" action="{{route('admin.cities.updated')}}" method="post">
              @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-district-name">District</label><br>
                    <select name="district_id" class="form-control w-100" id="edit-district-name" required style="width:100%;">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                </div>
              <div class="form-group">
                <label for="city-edit-name">Name</label>
                <input type="text"  name="name" id="city-edit-name" class="form-control"  placeholder="City Name" required>
                <input type="hidden"  name="city_id" id="city-edit-id" class="form-control"   >
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- modal --}}
  </div>
@endsection

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#reload-city').on('click', '.city-edit' , function () {
              let city_id =  $(this).attr('data-id');
              $.ajax({
                  url:"{{url('admin/cities')}}/"+city_id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $('#city-edit-form').find('#city-edit-name').val(data.name).focus();
                      $('#city-edit-form').find('#city-edit-id').val(data.id);
                      $('#city-edit-form').find('#edit-district-name').val(data.district_id);
                      $('#city-modal').modal('show');
                  },
              });
          });

      });

  </script>
@endsection