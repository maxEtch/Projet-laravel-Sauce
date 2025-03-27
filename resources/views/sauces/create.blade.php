<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une nouvelle sauce') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('sauces.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de la sauce</label>
                                <input type="text" name="name" id="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="manufacturer" class="block text-sm font-medium text-gray-700 mb-2">Fabricant</label>
                                <input type="text" name="manufacturer" id="manufacturer" 
                                       value="{{ old('manufacturer') }}" 
                                       required 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" 
                                      required 
                                      rows="4" 
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="mainPepper" class="block text-sm font-medium text-gray-700 mb-2">Ingrédient principal épicé</label>
                                <input type="text" name="mainPepper" id="mainPepper" 
                                       value="{{ old('mainPepper') }}" 
                                       required 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="heat" class="block text-sm font-medium text-gray-700 mb-2">Niveau de piment (1-10)</label>
                                <input type="number" name="heat" id="heat" 
                                       min="1" max="10" 
                                       value="{{ old('heat') }}" 
                                       required 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div>
                            <label for="imageUrl" class="block text-sm font-medium text-gray-700 mb-2">Image de la sauce</label>
                            <input type="file" name="imageUrl" id="imageUrl" 
                                   required
                                   class="mt-1 block w-full text-sm text-gray-500 
                                          file:mr-4 file:py-2 file:px-4 
                                          file:rounded-full file:border-0 
                                          file:text-sm file:font-semibold 
                                          file:bg-blue-50 file:text-blue-700 
                                          hover:file:bg-blue-100">
                        </div>
                        
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('sauces.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Créer la sauce
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>