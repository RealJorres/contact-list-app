<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Trashed Contacts</h1>
    
        @if($contacts->isEmpty())
            <p class="text-gray-600">No trashed contacts available.</p>
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
                        <p class="text-gray-800 mb-2">{{ $contact->contact_number }}</p>
                        <p class="text-gray-600 mb-2">{{ $contact->address }}</p>
                        <div class="flex justify-between items-center">
                            <form action="{{ route('contacts.restore', $contact->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to restore this contact?');">
                                @csrf
                                @method('GET')
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Restore</button>
                            </form>
                            <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="GET" onsubmit="return confirm('Are you sure you want to permanently delete this contact?');">
                                @csrf
                                @method('GET')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>