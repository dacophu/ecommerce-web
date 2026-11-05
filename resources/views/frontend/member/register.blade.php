 @extends('frontend.layout.main')

 @section('content')
 <section id="form"><!--form-->
     <div class="container">
         <div class="row">
             <div class="col-sm-4">
                 <div class="signup-form"><!--sign up form-->
                     <h2>New User Signup!</h2>
                     <form action="{{url('/member/register')}}" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
                         @csrf
                         <div class="form-group">
                             <label class="col-md-12">Full Name</label>
                             <div class="col-md-12">
                                 <input type="text" name="name" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="example-email" class="col-md-12">Email</label>
                             <div class="col-md-12">
                                 <input type="email" name="email" class="form-control form-control-line" name="example-email" id="example-email">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Password</label>
                             <div class="col-md-12">
                                 <input type="password" name="password" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Phone No</label>
                             <div class="col-md-12">
                                 <input type="text" name="phone" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Address</label>
                             <div class="col-md-12">
                                 <input type="text" name="address" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-12">Avatar</label>
                             <div class="col-md-12">
                                 <input type="file" name="avatar" class="form-control form-control-line">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-12">Select Country</label>
                             <div class="col-sm-12">
                                 <select name="id_country" class="form-control form-control-line">
                                     @foreach($countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="form-group">
                             <div class="col-sm-12">
                                 <button type="submit" class="btn btn-success">Sign Up</button>
                             </div>
                         </div>
                     </form>
                     @if(session('success'))
                     <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                         <h4><i class="icon fa fa-check"></i>Thông báo</h4>
                         {{session('success')}}
                     </div>
                     @endif
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
                 </div><!--/sign up form-->
             </div>
         </div>
     </div>
 </section><!--/form-->
 @endsection