<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Sauces') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('sauces.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                        Ajouter une nouvelle sauce
                    </a>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($sauces as $sauce)
                            <div class="border rounded-lg p-4 shadow-md">
                                <h2 class="text-xl font-bold mb-2">{{ $sauce->name }}</h2>

                                @if($sauce->imageUrl)
                                    <img src="{{ $sauce->imageUrl }}" alt="{{ $sauce->name }}" class="w-full h-48 object-cover rounded mb-4">
                                @endif

                                <p><strong>Fabricant :</strong> {{ $sauce->manufacturer }}</p>
                                <p><strong>Description :</strong> {{ $sauce->description }}</p>
                                <p><strong>Niveau de piment :</strong> {{ $sauce->heat }}/10</p>

                                <div class="flex justify-between items-center mt-4">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('sauces.like', $sauce) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded flex items-center">
                                                👍 {{ $sauce->likes }}
                                            </button>
                                        </form>
                                        <form action="{{ route('sauces.dislike', $sauce) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded flex items-center">
                                                👎 {{ $sauce->dislikes }}
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('sauces.edit', $sauce) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">
                                            Modifier
                                        </a>

                                        <form action="{{ route('sauces.destroy', $sauce) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>