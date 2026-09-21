{{-- resources/views/karyawan/index.blade.php --}}
{{-- Variabel yang diterima dari Controller via compact(): --}}
{{-- $karyawan, $totalGaji, $judulHalaman, $jumlahTotal, $bulanTahun --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judulHalaman }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="max-w-6xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                👥 {{ $judulHalaman }}
            </h1>
            <p class="text-gray-500 mt-1">Periode: {{ $bulanTahun }}</p>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border">
                <div class="text-2xl font-bold text-indigo-600">
                    {{ $jumlahTotal }}
                </div>
                <div class="text-sm text-gray-500">Total Karyawan</div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border">
                <div class="text-2xl font-bold text-emerald-600">
                    Rp {{ number_format($totalGaji, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">Total Penggajian</div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border">
                <div class="text-2xl font-bold text-amber-600">
                    {{ $bulanTahun }}
                </div>
                <div class="text-sm text-gray-500">Periode Aktif</div>
            </div>
        </div>

        {{-- Tabel Karyawan --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <table class="w-full">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Nama Karyawan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">NIP</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Departemen</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold">Status</th>
                        <th class="py-3 px-4 text-right text-sm font-semibold">Gaji Bulan Ini</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- MATERI 10 + 12: Loop Array of Objects di Blade --}}
                    @foreach ($karyawan as $index => $k)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-gray-500 text-sm">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-semibold text-gray-800">
                                {{ $k->getNama() }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $k->getEmail() }}
                            </div>
                        </td>
                        <td class="py-3 px-4 text-sm font-mono text-gray-600">
                            {{ $k->getNip() }}
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-600">
                            {{ $k->getDepartemen() }}
                        </td>
                        <td class="py-3 px-4">
                            @if ($k->getStatus() === 'Tetap')
                                <span class="px-2 py-1 bg-green-100 text-green-700
                                             text-xs font-bold rounded-full">
                                    ✅ Tetap
                                </span>
                            @elseif ($k->getStatus() === 'Kontrak')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700
                                             text-xs font-bold rounded-full">
                                    📋 Kontrak
                                </span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-700
                                             text-xs font-bold rounded-full">
                                    🎓 Magang
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-emerald-600">
                            {{ $k->getGajiFormatted() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="5" class="py-3 px-4 font-bold text-gray-700">
                            TOTAL PENGGAJIAN
                        </td>
                        <td class="py-3 px-4 text-right font-bold text-lg text-indigo-600">
                            Rp {{ number_format($totalGaji, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

</body>
</html>