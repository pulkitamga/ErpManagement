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
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection