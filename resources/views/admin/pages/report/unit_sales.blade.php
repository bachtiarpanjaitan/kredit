@extends('admin.layout.main')

@section('title', 'Laporan Penjualan Unit Bulan '.date("F", strtotime(Request::get('month')." months")))

@section('content')
    <div class="card mt-2">
        <div class="row card-body">
            <div class="table-responsive">
            <form action="{{route('admin.report.unit_sales')}}" method="GET">
                <div class="row">
               
                    @csrf
                    <div class="col-3">
                        <div class="form-group">
                            <select name="month" class="form-control" id="">
                                @for ($i = 0; $i < 12; $i++)
                                    @if (Request::get('month') == $i)
                                        <option selected value="{{$i}}">{{date("F", strtotime($i." months"))}} {{date('Y')}}</option>
                                    @else
                                        <option value="{{$i}}">{{date("F", strtotime($i." months"))}} {{date('Y')}}</option>
                                    @endif
                                @endfor
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
                    <th>Sepeda Motor</th>
                    <th width="20px">Jumlah (Unit)</th>
                    <th class="text-right">Total DP</th>
                </thead>
                <tbody>
                    @php
                        $total_dp = 0;
                        $total_unit = 0;
                    @endphp
                    @foreach ($sales as $k => $item)
                        @php
                            $total_dp += $item->dp_total;
                            $total_unit += $item->vehicle_total;
                        @endphp
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->vehicle_total}}</td>
                            <td class="text-right">{{number_format($item->dp_total,2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p class="h5">Total Unit: <b>{{number_format($total_unit,0)}}</b> Unit</p>
            <p class="h5">Total DP: <b>Rp.{{number_format($total_dp,2)}}</b></p>
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