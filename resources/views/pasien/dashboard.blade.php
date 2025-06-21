<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Poliklinik</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Antrian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($janjiPeriksas as $janjiPeriksa)
                        <?php $i = 0;?>
                        @if(is_null($janjiPeriksa->periksa))
                        <tr>
                            <th scope="row" class="align-middle text-start">{{++$i}}</th>
                            <td class="align-middle text-start">{{$janjiPeriksa->jadwalPeriksa->dokter->polis->nama}} </td>
                            <td class="align-middle text-start">{{$janjiPeriksa->jadwalPeriksa->dokter->nama}}</td>
                            <td class="align-middle text-start">{{$janjiPeriksa->jadwalPeriksa->hari}}</td>
                            <td class="align-middle text-start">{{\Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i')}}</td>
                            <td class="align-middle text-start">{{\Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i')}}</td>
                            <td class="align-middle text-start">{{$janjiPeriksa->no_antrian}}</td>
                            <td class="align-middle text-start">
                                <span @class([
                                    'badge badge-pill',
                                    'badge-warning'=>is_null($janjiPeriksa->periksa),
                                    'badge-success'=>!is_null($janjiPeriksa->periksa)
                                    ])>{{$janjiPeriksa->periksa ? 'Sudah Diperiksa':'Belum Diperiksa'}}</span>
                            </td>
                            <td class="align-middle text-start">
                                @if(is_null($janjiPeriksa->periksa))
                                    <a href="{{route('pasien.riwayat-periksa.detail', $janjiPeriksa->id)}} " class="btn btn-primary">Detail</a>
                                @else
                                    <a href="{{route('pasien.riwayat-periksa.riwayat', $janjiPeriksa->id)}} " class="btn btn-secondary">Riwayat</a>
                                @endif

                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        <!-- Dummy Row 1 -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
