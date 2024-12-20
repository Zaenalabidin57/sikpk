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
                @role('admin')
                <div class="px-2 py-2 text-white font-bold border-b border-gray-200">
                <p class="py-2 text-white font-bold underline">
                    ATMINT BOARD
                </p>
                </div>

                <a href="{{route('buat-akun')}}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    buat akun mahasiswa
                </a>

                <a href="{{route('buat-jadwal')}}" class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    buat jadwal
                </a>

                @endrole
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="block px-4 py-2 text-white hover:bg-gray-700 rounded-md">
                    Logout
                </a>
                <br>
                <br>
                <br>
                <div class="text-center text-white text-sm">
                    Dibuat Oleh : <br>
                    Rifqi Fadil Fahrial 1222646 <br>
                    Risky Paulus 1222601 <br>
                    Hadi Rahmat 1222602 <br>


                </div>
            </nav>
        </div>    
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>
