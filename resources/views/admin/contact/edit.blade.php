@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <a href="{{route ('admin.contact')}}"> <button type="submit" class="btn btn-primary btn-default">All Contacts</button></a>
        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
        <div class="card-header card-header-border-bottom">
            <h2>Edit About</h2>
          

        </div>
        <div class="card-body">
            <form action="{{url('contact/update/'.$contact->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" class="form-control"  name="address" placeholder="Enter Address" value="{{$contact->address}}" >
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Email</label>
                    <input type="text" class="form-control"  name="email" placeholder="Enter Email" value="{{$contact->email}}" >

                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Phone</label>
                    <input type="text" class="form-control"  name="phone" placeholder="Enter Phone" value="{{$contact->phone}}" >
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection