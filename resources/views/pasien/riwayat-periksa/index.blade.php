<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Riwayat Periksa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm-sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Riwayat Janji Periksa
                        </h2>
                    </header>

                    <!-- Table -->
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
                            @if(!is_null($janjiPeriksa->periksa))
                            <tr>
                                <th scope="row" class="align-middle text-start">{{$i++}}</th>
                                <td class="align-middle text-start">{{$janjiPeriksa->jadwalPeriksa->dokter->poli}} </td>
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
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
