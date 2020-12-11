<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser;
use DB;
use App\Models\UserJob;

Class UserController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){
        $users = DB::connection('mysql')
        ->select("Select * from tbluser");
        return response()->json($users, 200);
    }

    public function index(){
        $users = DB::connection('mysql')
        ->select("Select * from tbluser");

        return $this->successResponse($users);
    }

    public function add(Request $request){
        $rules = [
            'username'=>'required',
            'password'=>'required',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);
        $userjob =UserJob::findOrFail($request->jobid);
        $input = User::create($request->all());
        return $this->successResponse($input, RESPONSE::HTTP_CREATED);
    }

    public function search($id){
        $user = User::where('id', $id)->first();
        if($user){
            return $this->successResponse($user);
        }
        else{
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id){
        $rules = [
            'username' => 'max:10',
            'password' => 'max:10',
            'jobid' => 'required|numeric|min:1|not_in:0',
            ];
    
        $this->validate($request, $rules);
        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::findOrFail($id);
            
        $user->fill($request->all());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);
    }

    public function delete($id){
        $users  = User::find($id);
        $users->delete();
   
        return response()->json('Removed successfully.');
    }  
}