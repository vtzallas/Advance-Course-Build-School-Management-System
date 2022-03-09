@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <a href="{{route ('home.about')}}"> <button type="submit" class="btn btn-primary btn-default">All About</button></a>
        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
          

        </div>
        <div class="card-body">
            <form action="{{ route('store.about')}}" method="POST" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="Enter Title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short Description</label>
                    <textarea class="form-control" name="short_dis" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('short_dis')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long Description</label>
                    <textarea class="form-control" name="long_dis" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('long_dis')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection