<div class="flex">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 min-h-screen p-4">
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    Dashboard
                </a>
                <a href="{{route('proposal')}}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    Pengajuan Proposal
                </a>
                <a href="{{route('jadwal')}}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    Jadwal Pendaftaran
                </a>
                <p class="text-white font-bold">
                    Pengaturan
                </p>
                <a href="{{ route('logout') }}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    Logout
                </a>
            </nav>
        </div>    
</div>