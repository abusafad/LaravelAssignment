@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>

                <div class="card-body">
                    <form method="POST" action="{{route('user.update',['user'=>$user->id])}}" enctype=multipart/form-data>
                        @csrf
                        @method('put')
                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="prefixname">
                                    <option value="" selected disabled>Prefix Name</option>
                                    <option value="Mr" @if($user->prefixname == "Mr") selected @endif> Mr</option>    
                                    <option value="Mrs" @if($user->prefixname == "Mrs") selected @endif>Mrs</option>  
                                    <option value="Ms" @if($user->prefixname == "Ms") selected @endif>Ms</option>  
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required placeholder="First Name">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ $user->middlename }}" placeholder="Middle Name">
                            </div>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="row mb-3 col-md-12">
                            <div class="col-md-6">
                                <input id="suffixname" type="text" class="form-control" name="suffixname" value="{{ $user->suffixname }}" placeholder="Suffix Name">
                            </div>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required placeholder="User name">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $user->type }}" placeholder="Type">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="photo"> Photo</label>
                            <div class="col-md-6">
                                <input type="file" name="photo" id="inputphoto" class="form-control" value="{{ $user->photo }}">
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"> update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection