<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembuatan Proposal') }}
        </h2>
    </x-slot>
    <x-sidebar />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Proposal</h3>
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p class="mb-4">
                        Nama: {{ auth()->user()->name }}
                    </p>
                    <p class="mb-4">
                        NIM: {{ auth()->user()->nim }}
                    </p>
                    <p class="mb-4">
                        Tanggal: {{ \Carbon\Carbon::now()->format('d F') }}
                    </p>
                    
                    

                    <form method="POST" action="{{ route('proposals.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Judul
                            </label>
                            <input type="text" name="title" id="title" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                                Isi
                            </label>
                            <textarea name="content" id="content" rows="6"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('content') }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <x-primary-button>
                                {{ __('kirim') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if(auth()->user()->hasRole('admin') && isset($proposal))
                        <div class="mt-8 pt-8 border-t">
                            <h4 class="font-semibold text-lg mb-4">Update Status (Admin Only)</h4>
                            <form method="POST" action="{{ route('proposals.update-status', $proposal->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                        Status
                                    </label>
                                    <select name="status" id="status" 
                                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="draft" {{ $proposal->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="terkirim" {{ $proposal->status === 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                                        <option value="di-ACC" {{ $proposal->status === 'di-ACC' ? 'selected' : '' }}>Di-ACC</option>
                                        <option value="ditolak" {{ $proposal->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @role('mahasiswa')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-6">
                    <h2 class="text-lg font-medium text-gray-900 px-6 py-4">Daftar Tanggal Submisi</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tanggal Akhir</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($submissionDates as $submissionDate)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5">{{ \Carbon\Carbon::parse($submissionDate->start_date)->format('d F') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5">{{ \Carbon\Carbon::parse($submissionDate->end_date)->format('d F') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5">{{ $submissionDate->is_active ? 'Aktif' : 'Tidak Aktif' }}</div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endrole
</x-app-layout>