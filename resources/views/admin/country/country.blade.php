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
 <div class="table-responsive m-t-20">
     <table class="table table-bordered table-responsive-lg">
         <thead>
             <tr>
                 <th scope="col">ID</th>
                 <th scope="col">Name</th>
                 <th scope="col">Action</th>
             </tr>
         </thead>
         <tbody>
             @foreach($countries as $country)
             <tr>
                 <td>{{$country->id}}</td>
                 <td>{{$country->name}}</td>
                 <td><a href="{{url('admin/country/delete/'.$country->id)}}"><i class="m-r-10 mdi mdi-delete"></i>Delete</a></td>
             </tr>
             @endforeach
         </tbody>
     </table>
     <a href="{{url('admin/country/add')}}">
         <button type="submit" class="btn btn-success">Add Country</button>
     </a>
 </div>
 @endsection