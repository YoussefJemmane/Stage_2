@extends('../layouts/' . $layout)
@section('subhead')
@if(Auth::user()->poste === "CEO")

<title>List des frais </title>
@else
<title>List des frais de {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</title>
@endif

@endsection

@section("header1","Liste des Frais")


@section('subcontent')


<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between m-3 space-x-4">
                    @if(Auth::user()->poste === "CEO")
                    <div class="container px-4 mx-auto">
                        <form action="{{ route('frais.search') }}" method="GET" class="flex flex-col md:flex-row md:space-x-4 whitespace-nowrap">
                            <x-base.form-input type="week" id="week" name="week" value="{{ old('week',$week) }}" class="w-full md:w-[400px] border-gray-400" />

                            <x-base.form-select name="employee" id="employee" class="w-full md:w-[200px] border-gray-400" onchange="this.form.submit()">
                                <option value="">Select a worker</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if($employee->id == $employee_id) selected @endif>{{ $employee->nom }} {{ $employee->prenom }}</ option>

                                    @endforeach
                            </x-base.form-select>

                        </form>
                    </div>

                    @endif
                    @if(in_array(Auth::user()->poste, ["Operateur", "Directeur Technique"]))

                    <a href="{{ route('frais.create') }}">
                        <x-base.button type="submit" class="float-right p-3 mr-2 bg-green-500 border rounded-md">Ajouter Un Frais</x-base.button>

                    </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <x-base.table.index class="w-full text-sm text-gray-500">
                        <x-base.table.thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <x-base.table.tr>
                                <x-base.table.th scope="col" class="px-6 py-3">User</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Description</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Region</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Shift</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Montant</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Date</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Validation de DT</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Validation de PM</x-base.table.th>
                                <x-base.table.th scope="col" class="px-6 py-3">Paiement</x-base.table.th>
                                @if(Auth::user()->poste === 'Operateur' )

                                <x-base.table.th scope="col" class="px-6 py-3">Actions</x-base.table.th>

                                @endif
                            </x-base.table.tr>
                        </x-base.table.thead>
                        <x-base.table.tbody>
                            @foreach($frais as $expense)
                            <x-base.table.tr class="bg-white border-b">
                                <x-base.table.td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $expense->user->nom }} {{ $expense->user->prenom }}
                                </x-base.table.td>
                                <x-base.table.td class="px-6 py-4">{{ $expense->description }}</x-base.table.td>
                                <x-base.table.td class="px-6 py-4">{{ $expense->region }}</x-base.table.td>
                                <x-base.table.td class="px-6 py-4">{{ $expense->shift }}</x-base.table.td>
                                <x-base.table.td class="px-6 py-4">{{ $expense->montant }}</x-base.table.td>
                                <x-base.table.td class="px-6 py-4">{{ $expense->date }}</x-base.table.td>

                                <!-- Validation de DT column -->
                                <x-base.table.td class="px-6 py-4">

                                    @if($expense->status_DT === null)
                                    <span class="text-yellow-600">Pending</span>
                                    @elseif ($expense->status_DT === "Valider")
                                    <span class="text-green-600">Valider</span>
                                    @else
                                    <span class="text-red-600">Non Valider</span>
                                    @endif
                                    @if(Auth::user()->poste === "Directeur Technique")


                                    <form action="{{ route('frais.changeStatusFraisDT', $expense->id) }}" method="POST" class="p-4 border rounded-md shadow-md">
                                        @method('PUT')
                                        @csrf

                                        <label for="status_DT" class="block mb-2 font-semibold">Validation</label>
                                        <div class="flex items-center mb-2 space-x-2">
                                            <input type="radio" name="status_DT" value="Valider" id="statusValider" class="form-radio">
                                            <label for="statusValider">Valider</label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="status_DT" value="Non Valider" id="statusNonValider" class="form-radio">
                                            <label for="statusNonValider">Non Valider</label>
                                        </div>
                                        <button class="px-4 py-2 mt-4 font-semibold text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600">
                                            Valider
                                        </button>
                                    </form>

                                    @endif
                                </x-base.table.td>

                                <!-- Validation de PM column -->
                                <x-base.table.td class="px-6 py-4">
                                    @if($expense->status_PM === null)
                                    <span class="text-yellow-600">Pending</span>
                                    @elseif($expense->status_PM === "Valider")
                                    <span class="text-green-600">Valider</span>
                                    @else
                                    <span class="text-red-600">Non Valider</span>
                                    @endif
                                    @if(Auth::user()->poste === "Project Manager")
                                    <form action="{{ route('frais.changeStatusFraisPM', $expense->id) }}" method="POST" class="p-4 border rounded-md shadow-md">
                                        @method('PUT')
                                        @csrf
                                        <label for="status_PM" class="block mb-2 font-semibold">Validation</label>
                                        <div class="flex items-center mb-2 space-x-2">
                                            <input type="radio" name="status_PM" value="Valider" id="statusValider" class="form-radio">
                                            <label for="statusValider">Valider</label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="status_PM" value="Non Valider" id="statusNonValider" class="form-radio">
                                            <label for="statusNonValider">Non Valider</label>
                                        </div>
                                        <button class="px-4 py-2 mt-4 font-semibold text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600">
                                            Valider
                                        </button>
                                    </form>

                                    @endif
                                </x-base.table.td>

                                <!-- ... (status_RA display logic) ... -->
                                <x-base.table.td class="px-6 py-4">
                                    @if($expense->status_PM === "Valider" && $expense->status_DT === "Valider")
                                    @if($expense->status_RA === null)
                                    <span class="text-yellow-600">Pending</span>
                                    @elseif($expense->status_RA === "Paie")
                                    <span class="text-green-600">Paye</span>
                                    @else
                                    <span class="text-red-600">Non Paye</span>
                                    @endif
                                    @if(Auth::user()->poste === "Responsable Admin")
                                    <form action="{{ route('frais.changeStatusFraisRA', $expense->id) }}" method="POST" class="p-4 border rounded-md shadow-md">
                                        @method('PUT')
                                        @csrf


                                        <label for="status_RA" class="block mb-2 font-semibold">Validation</label>
                                        <div class="flex items-center mb-2 space-x-2">
                                            <input type="radio" name="status_RA" value="Paie" id="statusRAPaie" class="form-radio">
                                            <label for="statusRAPaie">Paye</label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" name="status_RA" value="Non Paie" id="statusRANonPaie" class="form-radio">
                                            <label for="statusRANonPaie">Non Paye</label>
                                        </div>
                                        <button class="px-4 py-2 mt-4 font-semibold text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600">
                                            Valider
                                        </button>
                                    </form>
                                    @endif
                                    @endif

                                </x-base.table.td>

                                @if($expense->user->nom === Auth::user()->nom )
                                <x-base.table.td class="px-6 py-4">
                                    <div class="flex space-x-4">

                                        <a href="{{ route('frais.edit', $expense->id) }}" class="text-blue-500 hover:text-blue-700">
                                            <svg fill="blue" width="16px" height="16px" version="1.1" id="edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                                <path d="M492.7,99.3L412.7,19.3c-18.8-18.8-49.2-18.8-68,0l-35.5,35.5l96,96l35.5-35.5C511.5,148.5,511.5,118.1,492.7,99.3z" />
                                                <polygon points="0,403.1 0,512 108.9,512 403.1,217.8 294.2,108.9" />
                                            </svg>
                                        </a>

                                    </div>
                                </x-base.table.td>
                                @endif
                            </x-base.table.tr>
                            @endforeach
                        </x-base.table.tbody>
                    </x-base.table.index>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@once
@push('scripts')
@vite('resources/js/pages/login/index.js')
@endpush
@endonce
