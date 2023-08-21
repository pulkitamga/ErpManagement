@extends('admin.layouts.layout')
@section('content')
 <div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between m-4">
         <div class="p-2">
         <h1><i class="fa fa-th-large fa-sm mr-2" aria-hidden="true"></i>Designation</h1>
        </div>
         <div class="p-2">
            <button type="button" class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addDesignation">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>Add Designation</button>
            <!--Modal-->
            <div class="modal fade" id="addDesignation" tabindex="-1" aria-labelledby="addDesignationLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDesignationLabel">Designation Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                           <form action="{{route('designation.store')}}" method="Post">
                            @csrf
                            <div class="mb-3">
                            <label for="" class="form-label">Designation Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Designation Type">
                            
                        </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                              <select name="status" id="" class="form-control">
                               <option value="1">Active</option>
                               <option value="0">Inactive</option>
                            </select>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary">Close</button>
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                        </div>
                       
                    </form>
                    </div>
                </div>
            </div>
            <!--end model-->
            
         </div>
         </div>
         
    </div>
   <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Sno</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($designations as $key=>$designation)
                                <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$designation->name}}</td>
                                   <td> {{ $designation->status == 1 ? 'Active' : 'InActive' }}</td>
                                   <td>
                                    <button class="btn btn-sm btn-primary editbtn mr-2" value="{{$designation->id}}"><i class="fas fa-paint-brush"></i></button>
                                    <a href="javascript:void(0)" id="delete-designation" style="color: white" class="btn btn-sm btn-primary"
                                   data-url="{{ route('designation.delete', $designation->id) }}"><i class="fa fa-trash"></i></a>
                                </td>
                               <td></td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
  </div>
  <div class="p-2">
    
    <!--Edit Modal-->
    <div class="modal fade" id="editDesignation" tabindex="-1" aria-labelledby="editDesignationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDesignationLabel">Edit Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                   <form action="{{route('designation.update')}}" method="Post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="designation_id" name="designation_id" value="">
                   
                    <div class="mb-3">
                    <label for="" class="form-label">Designation Name</label>
                    <input type="text"  name="name" id="name" class="form-control"
                    value="{{$designation->name}}">
                    @if ($errors->has('name'))
                    <span class="text-white">{{$errors->first('name')}}</span>
                    @endif
                </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary">Close</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                </div>
               
            </form>
            </div>
        </div>
    </div>
    <!--Edit end model-->
    
 </div>
 </div>
@endsection
@section('scripts')
<script type="text/javascript">
      
    $(document).ready(function () {
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        $('body').on('click', '#delete-designation', function () {
  
          var userURL = $(this).data('url');
          var trObj = $(this);
  
          if(confirm("Are you sure you want to remove this Designation?") == true){
                $.ajax({
                    url:userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        alert(data.success);
                        trObj.parents("tr").remove();
                    }
                });
          }
  
       });
        
    });
    
    $(document).ready(function()
    {
        $(document).on('click','.editbtn',function(){
              var designation=$(this).val();
              //alert (designation);
              $('#editDesignation').modal('show');
              $.ajax({
                type:"GET",
                url:"/admin/designation/edit/"+designation,
                success:function(response){
                    //console.log(response);
                    //console.log(response.designation.name);
                    $('#name').val(response.designation.name);
                    $('#status').val(response.designation.status);
                    $('#designation_id').val(response.designation.id);
                }
              });
            });
    });
</script>
@endsection