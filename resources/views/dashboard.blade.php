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
            <div class="overflow-x-auto bg-white shadow-md rounded">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->contact_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="ml-2 text-green-600 hover:text-green-900">Edit</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to move this contact to trash?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Move to Trash</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
