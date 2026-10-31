@extends('admin.layout.main')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Add Country</h4>
        </div>
        <div class="col-7 align-self-center">
            <div
                class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li
                            class="breadcrumb-item active"
                            aria-current="page">
                            Country
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{url('/admin/country/add')}}" method="POST" class="form-horizontal form-material">
            @csrf
            <div class="form-group">
                <label class="col-md-12">Country</label>
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control form-control-line">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success">Add Country</button>
                </div>
            </div>
        </form>
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h4><i class="icon fa fa-check"></i>Thông báo</h4>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection