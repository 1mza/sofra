@extends('layouts.admin-app')
@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin-panel/home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('admin-panel/cities')}}">Cities</a></li>
        </ol>
    </div>
@endsection
@section('page_title')
    Cities
@endsection

@section('small_title')
    <br>
    Index
@endsection
@section('content')
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="nav-icon fa fa-map-marker"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Cities</span>
                <span class="info-box-number">{{$cities->count()}}</span>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container-fluid p-0">
        <div class="card p-0 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="card-header d-flex justify-content-between align-items-center col-12">
                <!-- Title -->
                <h3 class="card-title mb-0 col-4">
                    List of Cities
                </h3>

                <!-- Search Form -->
                <x-forms.form class=" col-4 d-flex align-items-center" action="{{route('cities.index')}}">
                    <div class="input-group">
                        <input class="form-control border rounded-start" value="{{request('search')}}" type="text"
                               name="search" placeholder="Search for a city...">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </x-forms.form>
                {{--                @can('cities-create')--}}
                <div class="col-4 text-end">
                    <a href="{{route('cities.create')}}" class="ml-auto btn btn-primary ms-3">
                        Add New City
                    </a>
                </div>
                {{--                @endcan--}}
            </div>
            {{--            @include('flash::message')--}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body p-0">
                <div class="table-responsive">
                    {{--                    @can('cities-lists')--}}
                    <table class="table table-bordered table-hover w-100 m-0">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                <th><a class="row-link"
                                       href="{{route('cities.show',$city)}}">{{$city->name}}</a></th>
                                <td>
                                    {{--                                        @can('cities-edit')--}}
                                    <a href="{{route('cities.edit',$city)}}"
                                       class="btn btn-warning">Edit</a>
                                    {{--                                        @endcan--}}
                                    {{--                                        @can('cities-delete')--}}
                                    <form action="{{route('cities.destroy',$city)}}" method="post"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger">Delete
                                        </button>
                                    </form>
                                    {{--                                        @endcan--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                    @endcan--}}
                    {{$cities->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- /.card -->

@endsection
