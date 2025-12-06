<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
    <form action="{{ $data ? url('users/' . $data->id) : url('register') }}" method="post" class="flex flex-col space-y-6">
        @csrf
        <div class="flex flex-col space-y-2">
            <label for="name" class="text-gray-700 font-medium">Nama: </label>
            <input type="text" name="nama" id="name" value="{{ $data['nama'] ?? $data->nama ?? '' }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="email" class="text-gray-700 font-medium">Email: </label>
            <input type="email" name="email" id="email" value="{{ $data['email'] ?? $data->email ?? '' }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="no_hp" class="text-gray-700 font-medium">No. HP: </label>
            <input type="text" name="no_hp" id="no_hp" value="{{ $data['no_hp'] ?? $data->no_hp ?? '' }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="alamat" class="text-gray-700 font-medium">Alamat: </label>
            <textarea name="alamat" id="alamat" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $data['alamat'] ?? $data->alamat ?? '' }}</textarea>
        </div>

        <div class="flex flex-col space-y-3">
            <label for="jenis_kelamin" class="text-gray-700 font-medium">Jenis Kelamin: </label>
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <input type="radio" name="jenis_kelamin" id="laki-laki" value="laki-laki" {{ (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'laki-laki') || (isset($data->jenis_kelamin) && $data->jenis_kelamin == 'laki-laki') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="laki-laki" class="text-gray-700 cursor-pointer">Laki-Laki</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ (isset($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'perempuan') || (isset($data->jenis_kelamin) && $data->jenis_kelamin == 'perempuan') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="perempuan" class="text-gray-700 cursor-pointer">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="prodi" class="text-gray-700 font-medium">Prodi</label>
            <select name="prodi" id="prodi" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                <option value="informatika" {{ (isset($data['prodi']) && $data['prodi'] == 'informatika') || (isset($data->prodi) && $data->prodi == 'informatika') ? 'selected' : '' }}>Informatika</option>
                <option value="bisnis digital" {{ (isset($data['prodi']) && $data['prodi'] == 'bisnis digital') || (isset($data->prodi) && $data->prodi == 'bisnis digital') ? 'selected' : '' }}>Bisnis Digital</option>
                <option value="rekayasa sistem komputer" {{ (isset($data['prodi']) && $data['prodi'] == 'rekayasa sistem komputer') || (isset($data->prodi) && $data->prodi == 'rekayasa sistem-komputer') ? 'selected' : '' }}>Rekayasa Sistem Komputer</option>
                <option value="desain-komunikasi visual" {{ (isset($data['prodi']) && $data['prodi'] == 'desain komunikasi visual') || (isset($data->prodi) && $data->prodi == 'desain komunikasi visual') ? 'selected' : '' }}>Desain Komunikasi Visual</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white font-medium py-2 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 mt-4">Submit</button>
    </form>
</div>