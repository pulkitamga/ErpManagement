@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
    @if(session()->has('message'))
    <div>
        <p class="">{{session()->get('message')}}</p>
    </div>
    @endif
    <div class="header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                    <h1><i class="fab fa-studiovinari mr-2"></i>Staff</h1>
                </div>
                {{-- add staff start --}}
                <div class="p-2">
                    <button type="button"class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addstaff">
                        <i class="fa fa-plus" aria-hidden="true"></i> Staff</button>
                        <div class="modal fade" id="addstaff" tabindex="-1" aria-labelledby="addStaffLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addStaffLabel">Add Satff</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('staff.store')}}" method="Post">
                                             @csrf
                                           <div class="mb-3">
                                            <label for="" class="form-label">Username</label>
                                            <input type="text" name="uname" class="form-control" placeholder="User Name">
                                            @if($errors->has('uname'))
                                            <span class="text-white">{{$errors->first('uname')}}</span>
                                            @endif
                                           </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">First Name</label>
                                            <input type="text" name="fname" class="form-control" placeholder="First name">
                                            @if($errors->has('fname'))
                                            <span class="text-white">{{$errors->first('fname')}}</span>
                                            @endif
                                            </div>
                                            <label for="" class="form-label">Last Name</label>
                                            <input type="text" name="lname"  class="form-control" placeholder="Last name"/>
                                            @if($errors->has('lname'))
                                            <span class="text-white">{{$errors->first('lname')}}</span>
                                            @endif
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" name="email"  class="form-control" placeholder="Email">
                                            <label for="" class="form-label">Select Shift</label>
                                            <select name="shift"  class="form-control">
                                                <option>---------Select User Shift---------</option>
                                                <option value="0">Morning ( 10:00 AM to 4:03 PM )</option>
                                                <option value="1">Morning ( 11:00 AM to 5:03 PM )</option>
                                            </select>
                                            <label for="" class="from-label">Select Designation</label>
                                           
                                            <select name="designation"class="form-control"> 
                                                @foreach($desigantions as $designation)
                                                <option value="{{$designation->id}}">{{$designation->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                            <label for="" class="form-label">Salary</label>
                                            <input type="text" name="salary" id="" class="form-control" placeholder="$1000"> 
                                            <label for="" class="form-label">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary">Close</button>
                                                <button class="btn btn-primary">Save Changes</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                {{-- add staff end--}}

               
            </div>
        </div>
    </div>
    {{-- staff list start ---}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Shift</th>
                                <th>Designation</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                @foreach($staff as $key=>$staff)
                                <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$staff->first_name." ".$staff->last_name}}</td>
                                <td>{{$staff->email}}</td>
                                <td style="width:180px">{{$staff->shift==1?'Morning ( 11:00 AM to 5:03 PM )':'Morning ( 11:00 AM to 4:03 PM )'}}</td>
                                <td>{{$staff->designation->name}}
                                <td>{{$staff->salary}}</td>
                                <td>{{$staff->status==1?'Active':'Inactive'}}</td>
                                <td ><button class="btn btn-sm btn-primary editStaff" value="{{$staff->id}}"><i class="fa fa-paint-brush"></i></button>
                            
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="staff-delete"
                                    data-url="{{route('staff.delete',$staff->id)}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                                @endforeach
                           
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Shift</th>
                                <th>Designation</th>
                                <th>Salary</th>
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
    {{-- staff list end ---}}

    {{--edit staff start --}}
    <div class="p-2">
            <div class="modal fade" id="editstaff" tabindex="-1" aria-labelledby="editStaffLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStaffLabel">Edit Satff</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        
                            <form action="{{route('staff.update')}}" method="Post">
                                 @csrf
                                @method('PUT')
                                 <input type="hidden" value="" id="staff_id" name="staff_id">
                                 <div class="modal-body">
                                 
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control">
                                </div>
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last name"/>
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                <label for="" class="form-label">Select Shift</label>
                                <select name="shift" id="shift" class="form-control">
                                    <option>---------Select User Shift---------</option>
                                    <option value="0">Morning ( 10:00 AM to 4:03 PM )</option>
                                    <option value="1">Morning ( 11:00 AM to 5:03 PM )</option>
                                </select>
                                <label for="" class="from-label">Select Designation</label>
                               
                                <select name="designation" id="designation" class="form-control"> 
                                    
                                    @foreach($desigantions as $designation)
                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                </select>
                                
                                <label for="" class="form-label">Salary</label>
                                <input type="text" name="salary" id="salary" class="form-control" placeholder="$1000"> 
                                <label for="" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary">Close</button>
                                    <button class="btn btn-primary">Update</button>

                                </div>
                            </div>
                            </form>
                        
                    </div>
                </div>
            </div>
    </div>
    {{--edit staff end --}}

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function()
    {
        $(document).on('click','.editStaff',function(){
            var staff=$(this).val();
            $('#editstaff').modal('show');
            $.ajax({
                type:"GET",
                url:"/admin/staff/edit/"+staff,
                success:function(response){
                    //console.log(response);
                    //console.log(response.staff.first_name);
                    //console.log(response.staff.designation_id);
                    $('#fname').val(response.staff.first_name);
                    $('#lname').val(response.staff.last_name);
                    $('#email').val(response.staff.email);
                    $('#salary').val(response.staff.salary);
                    $('#shift').val(response.staff.shift);
                    $('#designation').val(response.staff.designation_id);
                    $('#status').val(response.staff.status);
                    $('#staff_id').val(staff);
                   
                  
                    
                }
            });
        });
    });

    $(document).ready(function()
    {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
           
        });
   

    $('body').on('click','#staff-delete',function()
    {
        var userURL=$(this).data('url');
        var trObj=$(this);
        if(confirm("Are Sure You Want To Delete It?")==true)
        {
            $.ajax({
                url:userURL,
                type: 'DELETE',
                dataType: 'json',
                success:function(data)
                {
                    alert(data.success);
                    trObj.parents("tr").remove();
                }
            });
        }
    });
});
</script>
@endsection