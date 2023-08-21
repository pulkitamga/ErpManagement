@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
    @if(session()->has('message'))
    <div>
        <p>{{session()->get('message')}}</p>
    </div>
    @endif
    <div class="header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                  <h2><i class="fa fa-briefcase fa-sm mr-2" aria-hidden="true"></i>Shift</h2>
                </div>
               {{--add shift start--}}
               <div class="p-2">
                <button type="button" class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addShift">
                    <i class="fa fa-plus mr-1" aria-hidden="true"></i>Add Shift</button>
                  <div class="modal fade" tabindex="-1" id="addShift" aria-labelledby="addShiftLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                  <h5 class="modal-title" id="addShiftLabel">Shift Details</h5>
                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('shift.store')}}" method="Post">
                                    @csrf
                                    <div class="mb-2">
                                    <label for="" class="form-label">Shift Name</label>
                                    <input type="text" class="form-control" name="sname">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Satrting Time</label>
                                        <input type="time" class="form-control" name="shift_start">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Ending Time</label>
                                        <input type="time" class="form-control" name="shift_end">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Late Time</label>
                                        <input type="time" class="form-control" name="shift_late">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Close</button>
                                        <button class="btn btn-secondary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
               {{--end shift--}}
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
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Start time</th>
                                        <th>Ending time</th>
                                        <th>Late time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shift as $key=>$shift)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$shift->name}}</td>
                                        <td>{{$shift->start_time}}</td>
                                        <td>{{$shift->end_time}}</td>
                                        <td>{{$shift->late_time}}</td>
                                        <td>{{$shift->status==1?'Active':'Inactive'}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary editbtn mr-2" value="{{$shift->id}}"><i class="fas fa-paint-brush"></i></button>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="delete-shift"
                                            data-url="{{route('shift.delete',$shift->id)}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Start time</th>
                                        <th>Ending time</th>
                                        <th>Late time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
            {{--edit shift start--}}
            <div class="p-2">
               <div class="modal fade" tabindex="-1" id="editShift" aria-labelledby="editShiftLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                  <h5 class="modal-title" id="editShiftLabel">Edit Shift Details</h5>
                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('shift.update')}}" method="Post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="shift_id" name="shift_id" value="">
                                 <div class="mb-3">
                                <label for="" class="form-label">Shift Name</label>
                                <input type="text" name="sname" id="sname" class="form-control">    
                                </div>  
                                <div class="mb-3">
                                    <label for="" class="form-label">Start time</label>
                                    <input type="text" name="shift_start" id="shift_start" class="form-control">    
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">End time</label>
                                    <input type="text" name="shift_end" id="shift_end" class="form-control">    
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Late Time</label>
                                    <input type="time" class="form-control" name="shift_late" id="shift_late">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Close</button>
                                    <button class="btn btn-secondary">Update</button>
                                </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
               {{--edit shift end--}}
       
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   
   $(document).ready(function()
   {
     $(document).on('click','.editbtn',function(){
        var shift=$(this).val();
    $('#editShift').modal('show');
    $.ajax({
        type:"GET",
        url:'/admin/shift/edit/'+shift,
        success:function(response){
            //console.log(response.shift.name);
            $('#sname').val(response.shift.name);
            $('#shift_start').val(response.shift.start_time);
            $('#shift_end').val(response.shift.end_time);
            $('#shift_late').val(response.shift.late_time);
            $('#status').val(response.shift.status);
            $('#shift_id').val(shift);
        }
    });
     });
});



$(document).ready(function(){
    $.ajaxSetup({
       headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
       }
    });
    $('body').on('click','#delete-shift',function(){
              var userURL=$(this).data('url');
              var trObj=$(this);
              if(confirm('Are You Sure to Delete This')==true){
                $.ajax({
                       url:userURL,
                       type:'DELETE',
                       dataType:'json',
                       success:function(data){
                        alert(data.success);
                        trObj.parents("tr").remove();
                       }
                });
              }
    });
});
</script>
@endsection