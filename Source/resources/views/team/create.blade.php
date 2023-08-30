@extends('../layouts/' . $layout)

@section('subhead')
<title>Ajouter Employee </title>
@endsection
@section('header1','Ajouter Employee')
@section('header2','Ajouter Team')

@section('subcontent')
<div class="flex justify-center p-6 bg-white border rounded-md ">


    <form action="{{ route('team.store') }}" class="w-[1000px]" method="post">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:ring focus:ring-blue-300" value="{{ old('nom') }}">
        </div>
        @error('nom')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
        <button type="submit" class="float-right px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Ajouter</button>
    </form>

</div>


@endsection
