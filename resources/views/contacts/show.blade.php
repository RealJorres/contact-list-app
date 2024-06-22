<x-app-layout>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-white">{{ $contact->name }}</h1>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <img src="{{ $contact->avatar ? Storage::url($contact->avatar) : asset('images/default-avatar.png') }}" class="h-20 w-20" alt="Avatar">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <p class="text-gray-700">{{ $contact->email }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Contact Number:</label>
            <p class="text-gray-700">{{ $contact->contact_number }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
            <p class="text-gray-700">{{ $contact->address }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Notes:</label>
            <p class="text-gray-700">{{ $contact->notes }}</p>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit Contact</a>
        </div>
    </div>
</div>
</x-app-layout>