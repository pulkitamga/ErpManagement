@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                    <h2><i class="fas fa-golf-ball fa-sm mr-2"></i>Holidays</h2>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-warning fw-bold"  data-bs-toggle="modal" data-bs-target="#addHoliday">
                        <i class="fa fa-plus mr-1"></i>Add Holiday</button>
                        <div class="modal fade" tabindex="-1" id="addHoliday" aria-labelledby="addHolidayLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addHolidayLabel">Add Holiday</h5>
                                    </div>
                                    <div class="modal-body">
                                        {{--add holiday --}}
                                        <form action="{{route('holiday.store')}}" method="Post">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Holiday From</label>
                                                <input type="date" name="holiday_from" class="form-control">
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Holiday To</label>
                                                <input type="date" name="holiday_to" class="form-control">
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Status</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary">Close</button>
                                                <button class="btn btn-primary" >Save</button>
                                            </div>
                                        </form>
                                         {{--add holiday end --}}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Days</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach($holiday as $key=>$holidays)
                                        <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$holidays->name}}</td>
                                        <td>From {{$holidays->holiday_from}} To {{$holidays->holiday_to}}
                                        <td>{{$holidays->days}}</td>
                                        <td>{{$holidays->status==1?'Active':'Inactive'}}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm editHoliday" value="{{$holidays->id}}"><i class="fa fa-paint-brush"></i></button>
                                            <a type="button" href="javascript:void(0)" class="btn btn-primary btn-sm" id="deleteHoliday"
                                            data-url={{route('holiday.delete',$holidays->id)}}><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                                        @endforeach
                           
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="p-2">
            
                <div class="modal fade" tabindex="-1" id="editHoliday" aria-labelledby="editHolidayLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editHolidayLabel">Edit Holiday</h5>
                            </div>
                            <div class="modal-body">
                                {{--edit holiday --}}
                                <form action="{{route('holiday.update')}}" method="Post">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="holiday_id" id="holiday_id" value=""/>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Holiday From</label>
                                        <input type="date" name="holiday_from" id="holiday_from" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Holiday To</label>
                                        <input type="date" name="holiday_to" id="holiday_to" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary">Close</button>
                                        <button class="btn btn-primary" >Save</button>
                                    </div>
                                </form>
                                 {{--edit holiday end --}}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function(){
    $.ajaxSetup({
        headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
       }
    });
     $('body').on('click','#deleteHoliday',function(){
        var userURL=$(this).data('url');
        var trObj=$(this);

        if(confirm('Are you Sure you want to delete')==true)
        {
            $.ajax({
                url:userURL,
                type:'DELETE',
                datatype:'json',
                success:function(data){
                    alert(data.success);
                    trObj.parents('tr').remove();
                    window.history.back();
                  
                }

            });
        }
     });
   });

   $(document).ready(function(){
    $(document).on('click','.editHoliday',function(){
        var holiday=$(this).val();
        $('#editHoliday').modal('show');
        $.ajax({
            type:"GET",
            url:'/admin/holidays/edit/'+holiday,
            success:function(response)
            {
               //console.log(response);
               //(response.holiday come from controller)
                //console.log(response.holiday.name)
                $('#name').val(response.holiday.name);
                $('#holiday_from').val(response.holiday.holiday_from);
                $('#holiday_to').val(response.holiday.holiday_to);
                $('#status').val(response.holiday.status);
                $('#holiday_id').val(holiday);
            }
        });
    });
   });
</script>
@endsection