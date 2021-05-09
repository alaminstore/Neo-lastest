@extends('backend.home')
@section('title','Weights')
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
            Weight Create
          </div>
          <div class="card-body">
            <form id="weight-add-form" action="{{route('admin.productweights.store')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number"  name="weight" id="weight" class="form-control" value="{{old('weight')}}"  placeholder="Weight" step="0.01" required>
              </div>
              <div class="form-group">
                <label for="weight-unit">Weight Unit</label>
                <input type="text"  name="weight_unit" id="weight-unit" class="form-control" value="{{old('weight_unit')}}"  placeholder="Weight Unit" required>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div id="reload-weight">
        <div class="card">
          <div class="card-header">
              Weights List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign"  width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Weight</th>
                      <th>Weight Unit</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="weight-body">
                    @foreach($weights as $weight)
                      <tr class="weight-row-{{$weight->product_weight_id}}">
                        <td>{{$weight->product_weight_id}}</td>
                        <td class="weight-column-name-{{$weight->product_weight_id}}">{{$weight->weight}}</td>
                        <td class="weight-column-name-{{$weight->product_weight_id}}">{{$weight->weight_unit}}</td>
                        <td >
                          <button class="btn btn-outline-primary btn-sm weight-edit"  data-id="{{$weight->product_weight_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                          <button class="btn btn-outline-danger btn-sm weight-delete"   onclick="deleteData({{$weight->product_weight_id}})" title="Delete"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$weight->product_weight_id}}" method="post" action="{{route('admin.productweights.destroy', $weight->product_weight_id)}}" style="display: none">
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
    <div class="modal fade" id="weight-modal" tabindex="-1" role="dialog" aria-labelledby="weight-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Weight Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="weight-edit-form" action="{{route('admin.productweights.updated')}}" method="post">
              @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="weight-edit">Weight</label>
                <input type="number"  name="weight" id="weight-edit" class="form-control"  placeholder="Weight" step="0.01" required>
                <input type="hidden"  name="product_weight_id" id="weight-edit-id" class="form-control"   >
              </div>

                <div class="form-group">
                <label for="weight-unit-edit">Weight Unit</label>
                <input type="text"  name="weight_unit" id="weight-unit-edit" class="form-control"  placeholder="Weight Unit" required>

              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Update</button>
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
          $('#reload-weight').on('click', '.weight-edit' , function () {
              let weight =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admin/productweights')}}/"+weight+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $('#weight-edit-form').find('#weight-edit').val(data.weight).focus();
                      $('#weight-edit-form').find('#weight-unit-edit').val(data.weight_unit);
                      $('#weight-edit-form').find('#weight-edit-id').val(data.product_weight_id);
                      $('#weight-modal').modal('show');
                  },
                  error: function (error) {
                      if(error.status == 404){
                          toastr.error('Not found!');
                      }
                  }
              });
          });

      });

  </script>
@endsection