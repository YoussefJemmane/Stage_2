@extends('../layouts/' . $layout)

@section('subhead')
<title>Ajouter Employee </title>
@endsection
@section('header1','List des Employees')

@section('header2','Editer '.$employee->nom .' '. $employee->prenom)

@section('subcontent')
<div class="flex justify-center p-6 bg-white border rounded-md ">


    <form action="{{ route('employees.update',$employee->id) }}" class="w-[1000px]" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ $employee->nom }}">
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700 ">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ $employee->prenom }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 ">Email</label>
            <input type="text" name="email" id="email" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ $employee->email }}">
        </div>

        <div class="mb-4">
            <label for="date_travail" class="block text-sm font-medium text-gray-700">Date de travail</label>
            <input type="date" name="date_travail" id="date_travail" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ $employee->date_travail }}">
        </div>

        <div class="mb-4">
            <label for="poste" class="block text-sm font-medium text-gray-700">Poste</label>
            <div class="flex ">

                <select name="poste" id="poste" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300">
                    @foreach ($postes as $posteOption)
                    <option value="{{ $posteOption->nom }}" {{  $posteOption->nom == $employee->poste ? 'selected' : '' }}>
                        {{ $posteOption->nom }}
                    </option>
                    @endforeach
                </select>
                <a href="{{ route('poste.create') }}" class="flex items-center justify-center w-12 h-12 ml-2 bg-blue-500 rounded-md">
                    <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                        <line x1="15" y1="5" x2="15" y2="25" stroke="black" stroke-width="4" />
                        <line x1="5" y1="15" x2="25" y2="15" stroke="black" stroke-width="4" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mb-4">
            <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
            <input type="number" name="salaire" id="salaire" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ $employee->salaire }}">
        </div>

        <div class="mb-4" x-data="{ fileName: 'Click to upload' }">
            <label for="cin" class="block text-sm font-medium text-gray-700">CIN</label>

            <div class="flex items-center justify-center w-full">
                <label for="cin" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p x-text="fileName" class="mb-2 text-sm text-gray-500"><span class="font-semibold"></span></p>
                        <p class="text-xs text-gray-500">JFIFF, PNG, JPG or GIF</p>
                    </div>
                    <input id="cin" type="file" class="hidden" name="cin" x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Click to upload'" />
                </label>
            </div>
        </div>

        <div class="mb-4" x-data="{ fileName: 'Click to upload' }">
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>

            <div class="flex items-center justify-center w-full">
                <label for="photo" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p x-text="fileName" class="mb-2 text-sm text-gray-500"><span class="font-semibold"></span></p>
                        <p class="text-xs text-gray-500">JFIFF, PNG, JPG or GIF</p>
                    </div>
                    <input id="photo" type="file" class="hidden" name="photo" x-on:change="fileName = $event.target.files[0] ? $event.target.files[0].name : 'Click to upload'" />
                </label>
            </div>

        </div>
        <button type="submit" class="float-right px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Editer</button>
    </form>
</div>




@endsection
