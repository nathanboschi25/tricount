<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach ($groups as $group)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <a href="/groups/{{ $group['id'] }}">
                            <div class="flex items-center">
                                @if($group['picture'])
                                    <img src="<?= $group['picture'] ?>" style="height: 4em; border-radius: 2em">
                                @endif
                                <strong style="padding-left: 2em">{{ $group['name'] }}</strong>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
</x-app-layout>

