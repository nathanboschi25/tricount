<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $group['name'] }}
            </h2>

            <a href=""
               class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                members
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <p>Dette totale: {{ $due_total }}€</p>
                </div>
            </div>
        </div>
        @if($expenses)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
                <b class="text-gray-900">Mes dépenses</b>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($expenses as $expense)
                        <div class="p-6">
                            <div class="flex items-center justify-between gap-6">
                                <div style="max-width: 50vw">
                                    <b>{{ $expense['description'] }}</b>
                                    <p>{{ date('d-m-Y', strtotime($expense['date'])) }}</p>
                                </div>
                                <div>
                                    <b>- {{ $expense['amount'] }}€</b>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>

