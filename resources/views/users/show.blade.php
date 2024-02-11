@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Details</div>

                <div class="card-body">

                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-3">
                            <img src="{{asset('images/'.$user->photo)}}" class="img-thumbnail rounded-circle shadow-4"
                            style="width: 150px; height:150px;">
                        </div>
                    </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="prefixname" disabled class="form-control" value="{{ $user->prefixname }}">
                            </div>

                            <div class="col-md-6">
                                <input id="firstname" disabled class="form-control" value="{{ $user->firstname }}">
                            </div>
                        </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="middlename" disabled class="form-control"  value="{{ $user->middlename }}" >
                            </div>

                            <div class="col-md-6">
                                <input id="lastname" disabled class="form-control"value="{{ $user->lastname }}">
                            </div>
                        </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="suffixname" disabled class="form-control"value="{{ $user->suffixname }}">
                            </div>

                            <div class="col-md-6">
                                <input id="username" disabled class="form-control" value="{{ $user->username }}">
                            </div>
                        </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <input id="type"class="form-control" value="{{ $user->type }}" disabled>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection