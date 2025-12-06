<x-layout>
    <body class="block space-y-0 bg-gray-50 min-h-screen">
        @include('components.nav')

        <div class="max-w-5xl mx-auto px-6 py-8">
            <div class="bg-white border border-gray-200 shadow-md rounded-lg p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Data Tamu</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Alamat</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Jenis Kelamin</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Konfirmasi Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($guests as $guest)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $guest->nama }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $guest->alamat }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $guest->jenis_kelamin }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $guest->konfirmasi_kehadiran }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</x-layout>