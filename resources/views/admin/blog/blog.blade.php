 @extends('admin.layout.main')
 @section('content')
 <div class="page-breadcrumb">
     <div class="row">
         <div class="col-5 align-self-center">
             <h4 class="page-title">Blog</h4>
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
                             Blog
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
                 <th scope="col">#</th>
                 <th scope="col">ID</th>
                 <th scope="col">Title</th>
                 <th scope="col">Image</th>
                 <th scope="col">Description</th>
                 <th scope="col">Action</th>
             </tr>
         </thead>
         <tbody>
             @for($i=0;$i<count($data);$i++)
                 <tr>
                 <td>{{$i+1}}</td>
                 <td>{{$data[$i]->id}}</td>
                 <td>{{$data[$i]->title}}</td>
                 <td>{{$data[$i]->image}}</td>
                 <td>{{$data[$i]->description}}</td>

                 <td style="gap: 10px;">
                     <a href="{{url('admin/blog/edit/'.$data[$i]->id)}}"><i class="m-r-10 mdi mdi-grease-pencil"></i>Edit</a>
                     <a href="{{url('admin/blog/delete/'.$data[$i]->id)}}"><i class="m-r-10 mdi mdi-delete"></i>Delete</a>
                 </td>
                 </tr>

                 @endfor
         </tbody>
     </table>
     <a href="{{url('admin/blog/add')}}">
         <button type="submit" class="btn btn-success">Add Blog</button>
     </a>
 </div>
 @endsection