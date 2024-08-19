<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
  
    public function register(RegistroRequest $request) {
        // Validar el registro
        $data = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();

        // Revisar el password
        if(!Auth::attempt($data)) {
            return response([
                'errors' => ['El email o el password son incorrectos']
            ], 422);
        }

        // Autenticar al usuario
        $user = Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null
        ];
    }


    public function changePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['La contraseña actual es incorrecta.']], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Contraseña cambiada con éxito.']);
    }

   // En UserController.php

   public function uploadImage(Request $request)
   {
       // Verifica si el usuario está autenticado
       if (!Auth::check()) {
           return response()->json(['error' => 'User not authenticated'], 401);
       }
   
       // Valida el archivo de imagen
       $request->validate([
           'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);
   
       // Maneja la imagen cargada
       if ($request->hasFile('image')) {
           $user = Auth::user();
   
           // Borra la imagen anterior si existe
           if ($user->image) {
               Storage::disk('public')->delete($user->image);
           }
   
           $image = $request->file('image');
           $imagePath = $image->store('images', 'public');
   
           // Actualiza el campo de la imagen del usuario
           $user->image = $imagePath;
           $user->save();
   
           // Devuelve la ruta de la imagen almacenada
           return response()->json(['image' => $imagePath], 200);
       }
   
       // Maneja el caso en que no se ha cargado ningún archivo
       return response()->json(['error' => 'No image uploaded'], 400);
   }
   

    // public function updateImage(Request $request)
    // {
    //     $user = Auth::user();

    //     // Valida la ruta de la imagen
    //     $request->validate([
    //         'image' => 'required|string'
    //     ]);

    //     // Actualiza el campo de la imagen del usuario
    //     $user->image = $request->input('image');
    //     $user->save();

    //     return response()->json(['message' => 'Image updated successfully'], 200);
    // }
   


}
