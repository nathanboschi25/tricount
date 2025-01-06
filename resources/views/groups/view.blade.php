<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $group['name'] }}
            </h2>

            <div class="flex items-center gap-6">
                <a href=""
                   class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    members
                </a>

                <a href="{{ route('expenses.create', ['group' => $group['id']]) }}"
                   class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <p>Dette totale: {{ $due_total }} {{$group['currency']}}</p>
                </div>
                <div class="p-6 text-gray-900">
                    @foreach($debts_to_others as $debt)
                        @if($debt['user']['id'] != auth()->user()->id)
                            <p><a href="{{ route('payments.create', [$group, $debt['groupUser']]) }}">{{ $debt['user']['name'] }}</a> - <b>{{ $debt['amount'] }}  {{$group['currency']}}</b></p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @if(count($expenses) > 0)*
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
                                    <b>- {{ $expense['amount'] }}  {{$group['currency']}}</b>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($made_payments) > 0)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
                <b class="text-gray-900">Mes paiements</b>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($made_payments as $madePayment)
                        <div class="p-6">
                            <div class="flex items-center justify-between gap-6">
                                <div style="max-width: 50vw">
                                    {{ $madePayment['receiver']['user']['name'] }}
                                </div>
                                <div>
                                    <b>- {{ $madePayment['amount'] }}  {{$group['currency']}}</b>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($received_payments) > 0)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
                <b class="text-gray-900">Mes remboursements</b>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($received_payments as $receivedPayment)
                            <div class="p-6">
                                <div class="flex items-center justify-between gap-6">
                                    <div style="max-width: 50vw">
                                        {{ $receivedPayment['sender']['user']['name'] }}
                                    </div>
                                    <div>
                                        <b>+ {{ $receivedPayment['amount'] }}  {{$group['currency']}}</b>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(count($user_debts) > 0)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
                <b class="text-gray-900">Mes parts</b>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($user_debts as $debt)
                        <div class="p-6">
                            <div class="flex items-center justify-between gap-6">
                                <div style="max-width: 50vw">
                                    {{ $debt['expense']['description'] }} (- {{ $debt['expense']['amount'] }})
                                </div>
                                <div>
                                    <b>- {{$debt['amount']}}</b>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>

