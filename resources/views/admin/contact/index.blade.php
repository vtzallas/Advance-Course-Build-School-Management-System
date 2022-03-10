@extends('admin.admin_master')

@section('admin')
    <div class="py-12">


        <div class="container">
            <a href="{{route('add.contact')}}"><button class="btn btn-info">Add Contact</button></a>

            <div class="row">
                <h4>Contact Page</h4>
                <br>
                <br>
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header"> All Contact Data </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Contact Address</th>
                                    <th scope="col" width="25%">Contact Email</th>
                                    <th scope="col" width="15%">Contact Phone</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php($i=1)
                                @foreach ($contact as $cont)
                                    <tr>
                                        <th scope="row">{{ $i++}}</th>
                                        <td>{{ $cont->address }}</td>
                                        <td>{{ $cont->email }}</td>
                                        <td> {{ $cont->phone }}</td>
                                        

                                        <td>
                                            <a href="{{ url('contact/edit/' . $cont->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('contact/delete/' . $cont->id) }}"
                                                onclick="return confirm('Are you sure to delete?')"
                                                class="btn btn-danger">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>

                </div>

            </div>
        </div>
    @endsection
