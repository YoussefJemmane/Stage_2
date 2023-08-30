<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $poste = DB::table('users')->select('poste')->distinct()->get();
        $options = Poste::all();

        return view('employees.liste', [
            'employes' => User::paginate(4),
            'poste' => $poste,
            'options' => $options
        ]);
    }
    public function create()
    {
        $postes = Poste::all();
        $teams = Team::all();
        return view('employees.create', compact('postes', 'teams'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_travail' => 'required',
            'team' => 'nullable',
            'salaire' => 'required',
            'poste' => 'required',
            'email' => 'required',
            'cin' => 'required',
        ]);
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->poste = $request->poste;
        $user->salaire = $request->salaire;
        $user->date_travail = $request->date_travail;
        $user->email = $request->email;

        if ($request->hasFile('cin')) {
            $imagePath = $request->file('cin')->store('employee_images/cin', 'public');
            $user->cin = $imagePath;
        };
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employee_images/photo', 'public');
            $user->photo = $imagePath;
        };
        $user->save();
        return redirect('employees')->with('success', 'Employee has been added');
    }
    public function search(Request $request)
    {
        $poste = $request->get('poste');
        $employes = User::where('poste', 'like', '%' . $poste . '%')->paginate(4);
        $options = Poste::all();
        return view('employees.liste', compact('poste','employes','options'));
    }
    public function edit($id)
    {
        $employee = User::find($id);
        $postes = Poste::all();
        return view('employees.edit', compact('employee', 'postes'));
    }
    public function editProfile($id)
    {
        $employee = User::find($id);
        $postes = Poste::all();
        return view('employees.editProfile', compact('employee', 'postes'));
    }
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->poste = $request->poste;
        $user->salaire = $request->salaire;
        $user->date_travail = $request->date_travail;
        $user->email = $request->email;

        if ($request->hasFile('cin')) {
            $oldImagePath = $user->cin;
            Storage::disk('public')->delete($oldImagePath);
            $imagePath = $request->file('cin')->store('employee_images/cin', 'public');
            $user->cin = $imagePath;
            // delete the old image from storage
        };
        if ($request->hasFile('photo')) {
            $oldImagePath = $user->photo;
            Storage::disk('public')->delete($oldImagePath);
            $imagePath = $request->file('photo')->store('employee_images/photo', 'public');
            $user->photo = $imagePath;
            // delete the old image from storage
        };


        $user->update();
        return redirect('employees')->with('success', 'Employee has been updated');
    }
    public function updateProfile(Request $request, $id)
    {

        $user = User::find($id);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;

        if ($request->hasFile('cin')) {
            $oldImagePath = $user->cin;
            Storage::disk('public')->delete($oldImagePath);
            $imagePath = $request->file('cin')->store('employee_images/cin', 'public');
            $user->cin = $imagePath;
            // delete the old image from storage
        };
        if ($request->hasFile('photo')) {
            $oldImagePath = $user->photo;
            if($oldImagePath !== '6596121.png'){
                Storage::disk('public')->delete($oldImagePath);
            }
            $imagePath = $request->file('photo')->store('employee_images/photo', 'public');
            $user->photo = $imagePath;
            // delete the old image from storage
        };


        $user->update();
        return redirect('frais')->with('success', 'Employee has been updated');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        // dlete also the image from storage
        $imagePath = $user->cin;
        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
        $user->delete();

        return redirect('employees')->with('success', 'Employee has been deleted');
    }
}
