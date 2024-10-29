<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function edit(User $user)
    {
        return view('users.from',compact('user'));
    }

    public function create()
    {
        return view('users.from');
    }

    public function store(UserRequest $request){

        User::create($request->validated());
        
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function update(UserRequest $request,User $user){

        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
