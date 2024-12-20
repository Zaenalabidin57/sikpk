<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-sidebar />


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Daftar Proposal</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <t>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tangal Dikirim</th>
                                @role('admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                @endrole
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($proposals as $proposal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($proposal->created_at)->format('d-m') }}</td>
                                    @role('admin')
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proposal->user->nim }}</td>
                                    @endrole
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('proposals.edit', $proposal->id) }}" class="text-blue-600 px-5 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
