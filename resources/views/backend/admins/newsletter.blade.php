@extends('backend.home')
@section('title','Newsletter')
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
             Newsletter Discount Amount
          </div>
          <div class="card-body">
            <form id="category-add-form" action="{{route('admin.newsletter.customer.store')}}" method="post">
                @csrf
                <?php
                $banner = \App\Models\NewsletterContent::all();
                if ($banner->isEmpty()) {?>
              <div class="form-group">
                <label for="category-name"> % Percentage</label>
                <input type="number"  name="discount_amount" id="discount_amount" class="form-control" value="{{old('discount_amount')}}"  placeholder="% here" required>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <?php }else echo "You can edit the newsletter percentage" ?>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div id="reload-category">
        <div class="card">
          <div class="card-header">
            Categories List
          </div>
          <div class="card-body">
            <div class="">
              <table class="table table-bordered"  width="100%">
                <thead>
                    <tr></tr>
                      <th class="text-center">Amount</th>
                      <th class="text-center">Action</th>
                    </tr>
                </thead>
                {{-- $subs->newsletter_content_id --}}
                <tbody id="category-body">
                    @foreach($subscribtion as $subs)
                      <tr class="category-row-{{$subs->id}}">

                        <td class="category-column-name-{{$subs->id}} text-center">{{$subs->discount_amount}} %</td>
                        <td class="text-center">
                            <button class="btn btn-outline-primary btn-sm category-edit"
                                                    data-id="{{$subs->id}}" title=" Edit
                                            "><i class="ti-pencil"></i> Edit</button>
                            <button class="btn btn-outline-danger btn-sm" title="Delete"
                                    onclick="deleteData({{$subs->id}})"><i class="ti-trash"></i>
                                Delete
                            </button>
                            <form id="delete-form-{{$subs->id}}" method="post"
                                  action="{{route('admin.newsletter.customer.delete',$subs->id)}}"
                                  style="display: none">
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
    <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Category Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="category-edit-form" action="{{route('admin.newsletter.customer.udpate')}}" method="post" enctype="multipart/form-data">
             @csrf
             @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="category-edit-name">Percentage</label>
                <input type="number"  name="discount_amount" id="category-edit-name" class="form-control" required>
                <input type="hidden"  name="id" id="category-edit-id" class="form-control">
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
          $('#reload-category').on('click', '.category-edit' , function () {
              let id =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admin/newsletter-discount')}}/"+id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $('#category-edit-form').find('#category-edit-name').val(data.discount_amount).focus();
                      $('#category-edit-form').find('#category-edit-id').val(data.id);
                      $('#category-modal').modal('show');
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
