@if($histori->isEmpty())
<div class="alert alert-outline-warning">
<p>Data Kosong</p>
</div>        
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
 <li>
                                <div class="item">
                                @php
                                    $path = Storage::url('uploads/absensi/'.$d->foto_in);
                                @endphp
                                    <img src="{{ url($path) }}" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</b><br>
                                            {{-- <small class="text-muted">{{ $d->jabatan }}</small> --}}
                                        </div>
                                        <span class ="badge {{ $d->jam_in < "06:45" ? "bg-success" : "bg-danger" }}">
                                            {{ $d->jam_in }} 
                                        </span>
                                          <span class ="badge {{ $d->jam_out < "19:00" ? "bg-danger" : "bg-success" }}">
                                            {{  $d->jam_out != null ? $d->jam_out : 'Belum Absen' }} 
                                        </span>
                                    </div>
                                </div>
                            </li>
</ul>
@endforeach