<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function Login(Request $request)
    {

        $request->validate([
            'code' => 'required|max:6|numeric',
            'password' => 'required|min:8',
        ]);

        $userLog = Utilisateurs::where('code', $request->code)->first();
        if ($userLog) {
            if (Hash::check($request->password, $userLog->password)) {
                $userRole = Roles::where('id_utilisateurs', $userLog->id_utilisateurs)->first();
                $request->session()->put('code', $userLog->code);
                $request->session()->put('role', $userRole->role);

                return redirect('/' . $userRole->role);
            } else {
                return back()->with('error', ' Mot de passe incorrect !');
            }

        } else {
            return back()->with('error', ' Utilisateur inconnu !');
        }
    }

    function AddingUser(Request $request)
    {

        $request->validate([
            'code' => 'required|max:6',
            'password' => 'required|min:8',
            'matricule' => 'required|max:6',
            'name' => 'required|max:255',
            'phone' => 'required|min:8',
            'poste' => 'required',
            'location' => 'required',
            'role' => 'required',
            'sexe' => 'required'
        ]);
        try {
            //code...

            $Utilisateurs = new Utilisateurs();
            $Utilisateurs->code = $request->code;
            $Utilisateurs->password = Hash::make($request->password);
            $Utilisateurs->mdp = $request->password;
            $Utilisateurs->matricule = $request->matricule;
            $Utilisateurs->name = $request->name;
            $Utilisateurs->sexe = $request->sexe;
            $Utilisateurs->phone = $request->phone;
            $Utilisateurs->poste = $request->poste;
            $Utilisateurs->location = $request->location;
            $saveuser = $Utilisateurs->save();


            $userLog = Utilisateurs::where('code', $request->code)->first();
            $role = new Roles();
            $role->id_utilisateurs = $userLog->id_utilisateurs;
            $role->role = $request->role;
            $saveuserrole = $role->save();

            if ($saveuser) {
                if ($saveuserrole) {

                    return back()->with('success', ' Utilisateur crée avec succès !');
                } else {
                    return back()->with('error', " Une erreur est survenue lors de l'attribution des rôles !");
                }
            } else {
                return back()->with('error', ' Une erreur est survenue lors de la création !');
            }
        } catch (\Throwable $th) {
            return back()->with('error', ' Une erreur est survenue '.$th.' !');
        }

    }

    function Logout()
    {
        if (session()->has('role')) {
            session()->pull('userid');
            session()->pull('role');
            return redirect('/');
        }
        if (session()->has('role')) {
            session()->pull('userid');
            session()->pull('role');
            return redirect('/');
        }
        if (session()->has('role')) {
            session()->pull('userid');
            session()->pull('role');
            return redirect('/');
        }
    }
}
