@extends('../layouts/' . $layout)
@section('subhead')
@if(Auth::user()->poste === "CEO")

<title>List des frais </title>
@else
<title>List des frais de {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</title>
@endif

@endsection

@section("header1","Liste des Frais")
@section("header2","Ajouter Frais")


@section('subcontent')

<div class="flex justify-center p-6 bg-white border rounded-md ">
    <form action="{{ route('frais.store') }}" class="w-[1000px]" x-data="{
                frais: '',
                region: '',
                shift: '',
                getMontant(){
                    if(this.region === 'Rabat - Sale - Kenitra' && this.shift === 'Jour'){
                        return 30;
                    }
                    if(this.shift === 'Jour'){
                        return 70;
                    }
                    if(this.shift === 'Nuit'){
                        return 80;
                    }
                    if(this.shift === 'Jour + Nuit'){
                        return 150;
                    }
                    if(this.frais === 'Divers'){
                        return 0;
                    }
                }
            }" method="POST">
        @csrf
        @if(Auth::user()->poste === 'Directeur Technique')

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
            <select x-model='user_id' name="user_id" id="user_id" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ old('user_id') }}">
                <option value="">-- Choisir un Utilisateur --</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                @endforeach
            </select>

        </div>
        @endif

        <div class="mb-4">
            <label for="frais" class="block text-sm font-medium text-gray-700">Description</label>
            <select x-model='frais' name="description" id="frais" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ old('description') }}">
                <option value="">-- Choisir un frais --</option>
                @foreach ($descriptions as $description)
                <option value="{{ $description }}">{{ $description }}</option>
                @endforeach
            </select>

        </div>
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Date de Frais</label>

            <input type="date" name="date" id="date" value="{{ old('date') }}" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4" x-show="frais === 'Frais de déplacement'">
            <label for="" class="block text-sm font-medium text-gray-700">Region</label>
            <select x-model="region" name="region" id="" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ old('region') }}">
                <option value="">-- Choisir un Region --</option>
                @foreach ($regions as $region)
                <option value="{{ $region }}">{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4" x-show="region && frais === 'Frais de déplacement'">
            <label for="" class="block text-sm font-medium text-gray-700">Shift</label>
            <select x-model="shift" name="shift" id="" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ old('shift') }}">
                <option value="">-- Choisir un Shift --</option>

                {{-- when Region is Rabat sale kneitra the options will hidden except jour --}}
                <option value="Jour">Jour</option>
                <option value="Nuit" x-show="region !== 'Rabat - Sale - Kenitra'">Nuit</option>
                <option value="Jour + Nuit" x-show="region !== 'Rabat - Sale - Kenitra'">Jour + Nuit</option>

            </select>
        </div>
        <div class="mb-4" x-show="shift && frais === 'Frais de déplacement'">
            <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
            <input type="text" name="montant" id="" :value="getMontant()" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" readonly>
        </div>

        <div class="mb-4" x-show="frais === 'Divers'">
            <label for="des_div" class="block text-sm font-medium text-gray-700">Description de divers</label>
            <input type="text" name="des_div" id="" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" x-bind:disabled="description !== 'Divers'" value="{{ old('des_div') }}">
        </div>
        <div class="mb-4" x-show="frais === 'Divers'">
            <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
            <input type="text" name="montant" id="" :value="getMontant()" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" x-bind:disabled="description !== 'Divers'" value="{{ old('montant') }}">
        </div>


        <button type="submit" class="float-right px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Ajouter</button>

    </form>
</div>

@endsection

@once
@push('scripts')
@vite('resources/js/app.js')
@endpush
@endonce
