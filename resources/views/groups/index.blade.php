<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Groups') }}
            </h2>

            <a href="{{ route('groups.create') }}" class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        @foreach ($groups as $group)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex items-center justify-between">
                        <a href="/groups/{{ $group['id'] }}">
                            <div class="flex items-center">
                                @if($group['picture'])
                                    <img src="<?= $group['picture'] ?>" style="height: 4em; border-radius: 2em">
                                @endif
                                <strong style="margin-left: 2em">{{ $group['name'] }}</strong>

                            </div>
                        </a>
                        <div>
                            <a href="{{ route('groups.edit', $group['id']) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('groups.destroy', $group['id']) }}" method="POST" class="inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
</x-app-layout>

