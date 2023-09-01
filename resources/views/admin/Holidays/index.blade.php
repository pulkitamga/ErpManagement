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
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection