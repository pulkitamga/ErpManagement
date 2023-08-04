@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
           <form action="">
            @csrf
            
            <label for="">Name</label>
            <input type="text" value="{{$designation->name}}">
           </form>
        </div>
    </div>
</div>
@endsection