<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

trait SignUpTrait
{
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'department_id' => 'required',
        ]);

        $user = $this->createUser($request);

        $token = $user->createToken('API Token')->accessToken;
        return response()->json(compact('user','token'), 200);
      

    }



    private function createUser(Request $request){
        return User::create([
            'approver' => $request->approver,
            'department_id' => $request->department_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

}
