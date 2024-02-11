@extends('layouts.app')

@section('content')
<div class="container">
    
    <div>
        <a href="{{route('user.create')}}" data-toggle="tooltip" data-placement="top" title="Add New User">
        <i class="fa fa-plus-square" aria-hidden="true" style="float: right;font-size: 30px;"></i>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table list-user">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                  <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$user->firstname ." ".$user->lastname }}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->photo}}</td>
                    <td>
                      <a href="{{route('user.edit',['user'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Edit"><button class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> 
                        
                      <a href="{{route('user.show',['user'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Details"><button class="btn btn-info"><i class="fa fa-file-text" aria-hidden="true"></i></button></a> 
                       
                      @if(empty($user->deleted_at))
                      <form action="{{ route('user.trashed', [$user->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-warning" title="trash"><i class="fa fa-minus-square-o" aria-hidden="true"></i></button>
                      </form> 
                      @else
                      <form action="{{ route('user.restore', [$user->id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-danger btn-block" title="Restore"><i class="fa fa-reply-all" aria-hidden="true"></i>
                          </button>
                      </form>
                      @endif
                      
                      {{-- <a href="{{route('user.edit',['user'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></a> --}}

                      <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        {{-- <a href="{{route('user.destory',['user'=>$user->id])}}" data-toggle="tooltip" data-placement="top" title="Trash"></a> --}}
                       
                       
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection