<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResurece;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // constructor to check the middle ware 
    public function __construct(){
        // $this->middleware('log')->only('index');
        $this->middleware('auth:api')->except(["index","show"]); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $limit = $request->input('limit') <= 50? $request->input('limit'):15;
        $users = UserResurece::collection(User::paginate($limit));
        return $users->response()->setStatusCode(200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', User::class); 
        $user = new UserResurece(User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password)
        ]));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = new UserResurece(User::findOrFail($id));
        return $user->response()->setStatusCode(200, "Uesr returned successfuly")->header('Additional Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $idUser = User::findOrFail($id);
        // we will pass the user id that we want to create with this function to access or deny.
        
        $this->authorize('update',$idUser);
        $user = new UserResurece(User::findOrFail($id));
        $user->update($request->all());
        
        return $user->response()->setStatusCode(200, "User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $idUser = User::findOrFail($id);
        $this->authorize('destroy',$idUser);
        User::findOrFail($id)->delete(); 
        return 204;
    }
}
