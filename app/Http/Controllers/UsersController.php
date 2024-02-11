<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    
    protected $userService;
    protected $UserServiceInterface;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
       
        if(!empty($validatedData['photo'])){
            $imageName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'), $imageName);
            $validatedData['photo'] = $imageName;
        }

        $validatedData['password'] = $this->userService->hash($request->password);
        
        // Create a new user using the UserService
        $user = $this->userService->store($validatedData);

        return redirect('/user');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id',$id)->first();
        return view('users.show')->with('user',$user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id',$id)->first();
        return view('users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $validatedData = $request->validated();

        if(!empty($validatedData['photo'])){
            $imageName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'), $imageName);
            $validatedData['photo'] = $imageName;
        }
        $validatedData['password'] = $this->userService->hash($request->password);
       
        // Update the user using the UserService
        $this->userService->update($id, $validatedData);

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Update the user using the UserService
        $this->userService->destroy($id);

        return redirect('/user');
    }

    public function trashed(string $id)
    {
        $this->userService->delete($id);
        return redirect('/user');
    }

    public function restore(string $id)
    {
        User::where('id',$id)->restore();
        return redirect('/user');
    }
}
