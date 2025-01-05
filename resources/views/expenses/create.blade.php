<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create an expense') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div style="color: gray">
                <a href="{{ route('groups.show', [$group]) }}">< Return to {{$group['name']}} </a>
            </div>

            <br>

            <form action="{{ route('expenses.store', [$group]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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
                <div class="space-y-1">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <br>

                <div class="space-y-1">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <br>

                <div class="space-y-1">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required placeholder="{{ $group['currency'] }}">
                </div>

                <br>

                <div id="participants" class="space-y-1">
                    <label for="participants" class="block text-sm font-medium text-gray-700">Participants</label>
                    @foreach ($group['groupUsers'] as $index => $groupUser)
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ $groupUser['user']['name'] }}</span>
                            </div>
                            <input type="hidden" name="participants[{{ $index }}][id]" value="{{ $groupUser['id'] }}">
                            <input type="number" class="form-control w-full" name="participants[{{ $index }}][amount]" step="0.01" placeholder="Montant" required>
                        </div>
                    @endforeach
                </div>

                <br>

                <button type="submit" class="w-full bg-indigo-600 py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border bg-gray-50">Create Expense</button>
            </form>
        </div>
    </div>
</x-app-layout>
