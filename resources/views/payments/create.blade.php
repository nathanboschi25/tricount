<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('Create a payment')}}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div style="color: gray">
                <a href="{{ route('groups.show', [$group]) }}">< Return to {{$group['name']}} </a>
            </div>

            <br>

            <form action="{{ route('payments.store', [$group, $groupUser]) }}" method="POST"
                  enctype="multipart/form-data"
                  class="space-y-4">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                @endif

                @csrf
                    <input type="hidden" name="group_id" value="{{ $group['id']  }}">
                <div>
                    <label for="paid_to" class="block text-sm font-medium text-gray-700">Group user:</label>
                    <input type="text" id="paid_to" name="paid_to" value="{{ $groupUser->id }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <br>

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount:</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required
                           placeholder="{{ $group['currency']  }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <br>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date:</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <br>


                <button type="submit"
                        class="w-full bg-indigo-600 py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 border bg-gray-50">
                    Pay user
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
