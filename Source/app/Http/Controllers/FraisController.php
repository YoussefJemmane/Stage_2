<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Frais;
use App\Http\Requests\StoreFraisRequest;
use App\Http\Requests\UpdateFraisRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FraisController extends Controller
{
    public function index()
    {
        if(Auth::user()->poste === "CEO" || Auth::user()->poste === "Responsable Admin" || Auth::user()->poste === "Directeur Technique" || Auth::user()->poste === "Project Manager"){

            $week = request('week');
            $employee_id = request('employee');


                return view('frais.liste', [
                    'frais' => Frais::all(),
                    'employees' => User::where('poste','Operateur')->get(),
                    'week' => $week,
                    'employee_id' => $employee_id,
                ]);
        } else {
            return view('frais.liste',[
                'frais' => Frais::where('user_id', Auth::id())->get(),
            ]);
        }
    }

    public function dashboard() {
        if (Auth::user()->poste !== "CEO") {
            return redirect()->route('frais.liste');
        }
        $frais = Frais::sum('montant');
        $paidFrais = Frais::where('status_RA', 'Paie')->sum('montant');
        $pendingFrais = Frais::where('status_RA', null)->sum('montant');
        $unpaidFrais = Frais::where('status_RA', 'Non Paie')->sum('montant');
        $verifiedByDTFrais = Frais::where('status_DT', 'Valider')->sum('montant');
        $unverifiedByDTFrais = Frais::where('status_DT', 'Non Valider')->sum('montant');
        $verifiedByPMFrais = Frais::where('status_PM', 'Valider')->sum('montant');
        if($frais){


            $percenatageOfPaidFrais = $paidFrais / $frais * 100;
            $percenatageOfPendingFrais = $pendingFrais / $frais * 100;
            $percenatageOfUnpaidFrais = $unpaidFrais / $frais * 100;
            $percenatageOfVerifiedByDTFrais = $verifiedByDTFrais / $frais * 100;
            $percenatageOfUnverifiedByDTFrais = $unverifiedByDTFrais / $frais * 100;
            $percenatageOfVerifiedByPMFrais = $verifiedByPMFrais / $frais * 100;

        }else{
            $percenatageOfPaidFrais = 0;
            $percenatageOfPendingFrais = 0;
            $percenatageOfUnpaidFrais = 0;
            $percenatageOfVerifiedByDTFrais = 0;
            $percenatageOfUnverifiedByDTFrais = 0;
            $percenatageOfVerifiedByPMFrais = 0;

        }


        return view('frais.dashboard', compact('frais','paidFrais', 'unpaidFrais', 'verifiedByDTFrais', 'verifiedByPMFrais', 'pendingFrais', 'unverifiedByDTFrais', 'percenatageOfPaidFrais', 'percenatageOfPendingFrais', 'percenatageOfUnpaidFrais', 'percenatageOfVerifiedByDTFrais', 'percenatageOfUnverifiedByDTFrais', 'percenatageOfVerifiedByPMFrais'));
    }
    public function create()
    {
        $descriptions = [
            'Frais de déplacement',
            'Divers',
        ];

        $regions = [
            'Tanger - Tetouan - Al Hoceima',
            'Fes - Meknes',
            'Oriental',
            'Rabat - Sale - Kenitra',
            'Beni Mellal - Khenifra',
            'Casablanca - Settat',
            'Marrakech - Safi',
            'Drâa - Tafilalet',
            'Souss - Massa',
            'Guelmim - Oued Noun',
            'Laayoune - Sakia El Hamra',
            'Dakhla - Oued Ed Dahab'
        ];

        $users = User::where('poste', 'Operateur')->get();

        return view('frais.create', compact('descriptions', 'regions', 'users'));
    }

    public function store(StoreFraisRequest $request)
    {
        $frais = new Frais();
        $frais->description = $request->input('description');

        if ($request->input('description') === 'Frais de déplacement') {
            $frais->region = $request->input('region');
            $frais->shift = $request->input('shift');
        }

        $frais->description .= ' ' . $request->input('des_div');
        $frais->date = $request->input('date');
        $frais->montant = $request->input('montant');
        $frais->user_id = Auth::id();

        if ($frais->user->poste === "Directeur Technique") {
            $frais->user_id = $request->input('user_id');
        }

        $frais->save();

        return redirect()->route('frais.liste');
    }

public function edit($id)
{
    $descriptions = [
        'Frais de déplacement',
        'Divers',
    ];

    $regions = [
        'Tanger - Tetouan - Al Hoceima',
            'Fes - Meknes',
            'Oriental',
            'Rabat - Sale - Kenitra',
            'Beni Mellal - Khenifra',
            'Casablanca - Settat',
            'Marrakech - Safi',
            'Drâa - Tafilalet',
            'Souss - Massa',
            'Guelmim - Oued Noun',
            'Laayoune - Sakia El Hamra',
            'Dakhla - Oued Ed Dahab'
    ];

    $frais = Frais::find($id);
    $descriptionParts = explode(' ', $frais->description, 2);
    $mainDescription = $descriptionParts[0];
    $desDiv = isset($descriptionParts[1]) ? $descriptionParts[1] : '';
    return view('frais.edit', compact('frais', 'descriptions', 'regions', 'mainDescription', 'desDiv'));
}

public function destroy($id)
{
    $frais = Frais::find($id);
    $frais->delete();

    return redirect()->route('frais.liste');
}


public function search()
{
    $employee_id = request('employee');

    $week = request('week');

    $startOfWeek = Carbon::parse($week)->startOfWeek()->format('Y-m-d');
    $endOfWeek = Carbon::parse($week)->endOfWeek()->format('Y-m-d');

    $frais = Frais::where('user_id', $employee_id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();
    $employees = User::where('poste','Operateur')->get();

    return view('frais.liste', compact('frais','employees','startOfWeek','endOfWeek','week','employee_id'));
}



public function changeStatusFraisByRA($id, Request $request)
{
    $frais = Frais::find($id);
    $frais->status_RA = $request->input('status_RA');



    $frais->update();

    return redirect()->route('frais.liste');
}

public function changeStatusFraisByDT($id, Request $request)
{
    $frais = Frais::find($id);
    $frais->status_DT = $request->input('status_DT');

    if ($frais->status_DT === 'Valider' && $frais->status_PM === 'Valider') {
        $frais->status_RA = null;
    }

    $frais->update();

    return redirect()->route('frais.liste');
}

public function changeStatusFraisByPM($id, Request $request)
{
    $frais = Frais::find($id);
    $frais->status_PM = $request->input('status_PM');

    if ($frais->status_PM === 'Valider' && $frais->status_PM === 'Valider') {
        $frais->status_RA = null;
    }

    $frais->update();

    return redirect()->route('frais.liste');
}


    public function update(Request $request, Frais $frais)
    {
        $frais->description = $request->input('description');

        if ($request->input('description') === 'Frais de déplacement') {
            $frais->region = $request->input('region');
            $frais->shift = $request->input('shift');
        }
        $frais->region = null;
        $frais->shift = null;
        $frais->description .= ' ' . $request->input('des_div');
        $frais->date = $request->input('date');
        $frais->montant = $request->input('montant');
        $frais->status_RA = null;
        $frais->status_DT = null;
        $frais->status_PM = null;
        $frais->user_id = Auth::id();


        $frais->update();

        return redirect()->route('frais.liste');
    }

}
