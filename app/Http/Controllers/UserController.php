<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{   
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        $registerData = $request->only(['name','email','password']);
        $registerUser = $this->userRepository->create($registerData);
        if($registerUser)
        {
            return response()->json([
                'user' => $registerUser,
                'message' => 'User Created Successfully'
            ]);
        }

        return response()->json(['message' => 'User registration failed. Please try again.']);
    }

    public function login(LoginRequest $request)
    {
       $credentials = $request->only(['email','password']);
       if(auth::attempt($credentials))
       {
            $user = auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'user Login successful',
            ]);
       }
       return response()->json(['message' => 'Invalid Credentials']);
    }
     
    public function index()
    {  
        $allUsers = $this->userRepository->getAll();
        return response()->json([
            'users' => $allUsers
        ]);
    }

     /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->show($id);
        return response()->json([
            'user' => $user
        ]);
    }


    /**
     * Remove the specified user.
     */
    public function delete(string $id)
    {
        $deleteUser = $this->userRepository->delete($id);
        if($deleteUser)
        {
            return response()->json([
                'message' => 'User Deleted Successfully'
            ]);
        }

        return response()->json([
            'message' => 'Something Went Wrong'
        ]);
    }

}
