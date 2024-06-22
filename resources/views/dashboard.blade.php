<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white">Contacts</h1>
            <div>
                <a href="{{ route('contacts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Add New Contact</a>
                <a href="{{ route('contacts-trashed') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Trashed Contacts</a>
            </div>
        </div>
        
        @if($contacts->isEmpty())
            <p class="text-gray-600">No contacts available. Add a new contact to get started.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($contacts as $contact)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-4">
                            @if ($contact->avatar)
                                <img src="{{ $contact->avatar ? Storage::url($contact->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="w-16 h-16 rounded-full mr-4">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="w-16 h-16 rounded-full mr-4">
                            @endif
                            <div>
                                <h2 class="text-lg font-bold">{{ $contact->name }}</h2>
                                <p class="text-gray-600 text-sm">{{ $contact->email }}</p>
                            </div>
                        </div>
                        <p class="text-gray-800 mb-2 text-sm">Number: {{ $contact->contact_number }}</p>
                        <p><i>{{ $contact->notes}}</i></p>
                        <div class="flex justify-start items-center">
                            <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="ml-2 text-green-600 hover:text-green-900">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to move this contact to trash?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Move to Trash</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>