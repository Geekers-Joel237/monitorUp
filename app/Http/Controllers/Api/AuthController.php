<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    //this method adds new users
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'noms' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'telephone' => 'required|string|unique:users,telephone',
            'password' => 'required|string|min:6|',
            'matricule' => 'sometimes|string|max:7|',
            'address' => 'required|string|max:700',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $user = User::create([
            'noms' => $request->noms,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => hash('sha256',$request->password),
            'matricule' => $request->matricule,
        ]);
        $token = $user->createToken('tokens')->plainTextToken;
        $user->remember_token = $token;
        $user->save();
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

     //use this method to signin users
     public function login(Request $request)
     {
        $password = hash('sha256', $request->password);
        // $request->password = hash('sha256',$request->password);
        //  $attr = $request->validate([
        //      'email' => 'required|string|email|',
        //      'password' => 'required|string|min:6'
        //  ]);
         $attr = [
            'email'=>"'$request->email'",
            'password'=>"'$password'"];

         var_dump($password);
        // $attr['password'] = hash('sha256',$attr['password'] ) ;
         if (!Auth::attempt($attr)) {
            // Authentication not passed...
             return response()->json('Credentials not match', 401);
         }

         return response()->json([
             'token' => auth()->user()->createToken('API Token')->plainTextToken
         ]);
     }

     // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function updatepassword(Request $request, $id)
    {
        $utilisateur = User::findOrFail($id);
        $oldpwd=$request->oldpwd;
        $newpwd=$request->newpwd;

        if (hash('sha256', $oldpwd) == $utilisateur->password) {
            $utilisateur->password=$newpwd;
            $utilisateur->password =  hash('sha256', $utilisateur->password);
            $utilisateur->save();

            return  response()->json(compact('utilisateur'));
        }
        else{
            return response()->json(['error' => 'Ancien mot de passe incorrect'], 401);
        }
    }

    public function sendmail(Request $request){
        $to = $request->to;
        $from = $request->from;
        $nomfrom = $request->nomfrom;
        $message = $request->message;
        $subject = $request->sujet;

        $headers = 'From: '.$nomfrom.' <'.$from.''."\r\n";

        $headers .= 'Mime-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $headers .= "\r\n";

        // Sending email
        if(mail($to, $subject, $message, $headers)){
            return response()->json(['success' => 'Votre mail a bien été envoyé'], 200);
        }
        else{
            return response()->json(['error' => 'Problème de connexion lors de l\'envoi du mail'], 401);
        }
    }


}
