<?php
namespace App\Services;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function rules($id = null)
    {
        return [
            'prefixname'    =>  'string | max:255',
            'firstname'     =>  'required|string|max:255',
            'middlename'    =>  'string|max:255',
            'lastname'      =>  'string|max:255',
            'suffixname'    =>  'string|max:255',
            'username'      =>  'required|string|max:255',
            'email'         =>  'required|string|max:255',
            'password'      =>  'required_with:password_confirmation|same:password_confirmation|min:8',
            'photo'         =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type'          =>  'string|max:255'
        ];
    }

    public function list($perPage , $page)
    {
        // Retrieve a paginated list of users
        return User::paginate($perPage, ['*'], 'page', $page);
    }

    public function store($userData)
    {
        $user = User::create($userData);
        return $user;
    }

    public function find(int $userId)
    {
        return User::find($userId);
    }

    public function update($user,$newUserData)
    {

        // Find the user by ID
        $user = User::find($user);

        // If the user doesn't exist, return null or throw an exception
        if (!$user) {
            return null; // or throw an exception
        }

        // Update the user data
        $user->update($newUserData);

        return $user;
    }

    public function destroy($userId)
    {
        User::where('id',$userId)->forceDelete();
    }

    public function listTrashed($perPage , $page)
    {
        return User::onlyTrashed()->paginate($perPage, ['*'], 'page', $page);
    }

    public function restore($user)
    {
        $user->restore();
    }

    public function delete($userId)
    {
        User::where('id',$userId)->delete();
    }

    public function hash(string $key)
    {
        // Code goes brrrr.
    }

    
    public function upload(User $user, UploadedFile $photo)
    {
        // Define the directory where the photo will be stored
        $directory = 'images';

        // Generate a unique filename for the photo
        $filename = uniqid() . '.' . $photo->getClientOriginalExtension();

        // Store the photo in the storage directory
        $path = $photo->storeAs($directory, $filename);

        // Update the user's photo path in the database
        $user->photo = $path;
        $user->save();

        return $path;
    }

    public function saveUserDetails(User $user)
    {

    //(empty($user->photo) ? "sss" :  $user->photo);
    $key = array('Full name' , 'Middle Initial','Avatar','Gender');
    $value = array($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname, substr($user->middlename, 0, 1),$user->photo,$user->prefixname);

       for($i=0;$i<4;$i++){
        $details = [
            'key' => $key[$i],
            'value' => $value[$i],
            'status' => 'bio',
            'user_id' => $user->id
        ];

        Detail::create($details);
       } 
    }
}