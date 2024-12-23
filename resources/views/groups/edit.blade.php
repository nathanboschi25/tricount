<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create a group') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div style="color: gray">
                <a href="{{route('groups.index')}}">< Return to groups</a>
            </div>

            <br>

            <form action="{{ route('groups.update', $group->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @method('PUT')
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                @endif

                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Group Name:</label>
                    <input type="text" id="name" name="name" value="{{ $group->name }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <br>

                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700">Currency:</label>
                    <input type="text" id="currency" name="currency" value="{{ $group->currency }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <br>

                <div>
                    <label for="picture" class="block text-sm font-medium text-gray-700">Group Picture:</label>
                    <input type="file" id="picture" name="picture" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <br>

                <button type="submit" class="w-full bg-indigo-600 py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border bg-gray-50">Update Group</button>
            </form>
        </div>
    </div>
</x-app-layout>
