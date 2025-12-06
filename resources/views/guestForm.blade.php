<x-layout>

    <body class="block space-y-0 bg-gray-50 min-h-screen">
        @include('components.nav')
    
        <div class="max-w-3xl mx-auto px-6 py-8">
            <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Form Tamu</h2>
                <form action="/guest" method="post" class="space-y-6">
                    @csrf
                    @if(isset($message))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                    @endif
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input required type="text" name="nama" id="nama" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-800">
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <input required type="text" name="alamat" id="alamat" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-800">
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent text-gray-800">
                            <option value="laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Konfirmasi Kehadiran</label>
                        <div class="flex items-center space-x-6">
                            <label for="iya" class="flex items-center cursor-pointer">
                                <input required type="radio" name="konfirmasi_kehadiran" id="iya" value="iya" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-600">
                                <span class="ml-2 text-gray-700">Iya</span>
                            </label>
                            <label for="tidak" class="flex items-center cursor-pointer">
                                <input required type="radio" name="konfirmasi_kehadiran" id="tidak" value="tidak" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-600">
                                <span class="ml-2 text-gray-700">Tidak</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Submit</button>
                </form>
            </div>
        </div>
    </body>
    
    </x-layout>