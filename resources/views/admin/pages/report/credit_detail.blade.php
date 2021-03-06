@extends('admin.layout.main')

@section('title', 'Laporan Penerimaan Angsuran Bulan '.config('master.months')[Request::get('month')?Request::get('month')-1:0])

@section('content')
    <div class="card mt-2">
        <div class="row card-body">
            <div class="table-responsive">
            <form action="{{route('admin.report.credit_details')}}" method="GET">
                <div class="row">
               
                    @csrf
                    <div class="col-3">
                        <div class="form-group">
                            <select name="month" class="form-control" id="">
                                @foreach(config('master.months') as $k => $i)
                                    @if (Request::get('month') == $k+1)
                                        <option selected value="{{$k+1}}">{{$i}} {{date('Y')}}</option>
                                    @else
                                        <option value="{{$k+1}}">{{$i}} {{date('Y')}}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <table id="data" class="table table-sm table-bordered table-hover">
                <thead>
                    <th width="10px">#</th>
                    <th>Nama Pelanggan</th>
                    <th>Kendaraan</th>
                    <th width="20px">Angsuran Ke</th>
                    <th class="text-right">Jumlah Dibayar (IDR)</th>
                    <th>Tanggal</th>
                </thead>
                <tbody>
                    @php
                        $total = 0
                    @endphp
                    @foreach ($details as $k => $item)
                    @php
                        $total += $item->value;
                    @endphp
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$item->customer_first_name}} {{$item->customer_last_name}}</td>
                            <td>{{$item->vehicle_name}}</td>
                            <td>{{$item->angsuran_ke}}</td>
                            <td class="text-right">{{number_format($item->value)}}</td>
                            <td>{{$item->date}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p class="h5">Total Jumlah Bayar: <b>Rp.{{number_format($total,2)}}</b></p>
        </div>
    </div>
@endsection

@push('script')
	<!-- custom -->
	<script>
	  $(function () {
	    $("#data").DataTable({
	      "responsive": true, "lengthChange": false, "autoWidth": false,
	      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	    }).buttons().container().appendTo('#data_wrapper .col-md-6:eq(0)');
	  });
	</script>
@endpush