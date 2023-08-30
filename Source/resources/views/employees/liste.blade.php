@if(Auth::user()->poste == "CEO")



@extends('../layouts/' . $layout)

@section('subhead')
<title>Liste des Employeee </title>
@endsection

@section('header1','List des Employees')

@section('subcontent')

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between m-3 ">
                    <form action="{{ route('employees.search') }}" method="GET" class="flex">
                        <select name="poste" id="poste" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" onchange="return submit()">
                            @foreach($options as $option)
                            <option value="{{ $option->nom }}" @if($poste==$option->nom) selected @endif>{{ $option->nom }}</option>
                            @endforeach
                        </select>

                    </form>
                    <a href="{{ route('employees.create') }}" class="p-3 mr-2 bg-green-500 border rounded-md">Ajouter Un Employe</a>
                </div>
                <div class="relative pt-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Prenom
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>


                                <th scope="col" class="px-6 py-3">
                                    Date de travail
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Poste
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Salaire
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CIN
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employes as $employee)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $employee->nom }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $employee->prenom }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $employee->email }}
                                </td>



                                <td class="px-6 py-4">
                                    {{ $employee->date_travail }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->poste }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->salaire }} DH
                                </td>
                                <td class="">

                                    <a href="{{ asset('storage/'.$employee->cin) }}" data-lightbox="employee-{{ $employee->id }}">
                                        <img src="{{ asset('storage/'.$employee->cin) }}" alt="">
                                    </a>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-between">
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-500 hover:text-blue-700">
                                            <svg fill="blue" version="1.1" id="edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 494.936 494.936" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157 c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21 s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741 c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z" />
                                                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069 c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963 c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692 C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107 l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005 c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg fill="red" width="16px" height="16px" version="1.1" id="delete" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                                                    <g>
                                                        <path d="M240,121.076V90h15c8.284,0,15-6.716,15-15s-6.716-15-15-15h-30h-15V15c0-8.284-6.716-15-15-15H75c-8.284,0-15,6.716-15,15 v45H45H15C6.716,60,0,66.716,0,75s6.716,15,15,15h15v185c0,8.284,6.716,15,15,15h60h37.596c19.246,24.347,49.031,40,82.404,40 c57.897,0,105-47.103,105-105C330,172.195,290.817,128.377,240,121.076z M90,30h90v30h-15h-60H90V30z M105,260H60V90h15h30h60h30 h15v31.076c-50.817,7.301-90,51.119-90,103.924c0,12.268,2.122,24.047,6.006,35H105z M225,300c-41.355,0-75-33.645-75-75 s33.645-75,75-75s75,33.645,75,75S266.355,300,225,300z" />
                                                        <path d="M256.819,193.181c-5.857-5.857-15.355-5.857-21.213,0L225,203.787l-10.606-10.606c-5.857-5.857-15.355-5.857-21.213,0 c-5.858,5.857-5.858,15.355,0,21.213L203.787,225l-10.606,10.606c-5.858,5.857-5.858,15.355,0,21.213 c2.929,2.929,6.768,4.394,10.606,4.394s7.678-1.465,10.606-4.394L225,246.213l10.606,10.606c2.929,2.929,6.768,4.394,10.606,4.394 s7.678-1.465,10.606-4.394c5.858-5.857,5.858-15.355,0-21.213L246.213,225l10.606-10.606 C262.678,208.536,262.678,199.038,256.819,193.181z" />
                                                    </g>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employes->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@else


@section('subcontent')
@include('pages.error-page')
@endsection
@endif
