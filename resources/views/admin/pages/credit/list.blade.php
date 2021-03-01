@extends('admin.layout.main')

@section('content')
	<div class="col-md-12">
		<div class="btn-group">
	        <a href="{{route('admin.credit.add')}}"><button type="button" class="btn btn-success">Tambah</button></a>
	        <button type="button" class="btn btn-danger btn-delete" data-url="{{route('admin.credit.delete')}}">Hapus</button>
	  	</div>
	</div>
	<div class="card mt-2">
  		<div class="row card-body">
  			<div class="table-responsive">
        		<table id="data" class="table table-bordered table-hover">
        			<thead>
		        		<th width="10px">#</th>
		        		<th>Nama Pelanggan</th>
		        		<th>Kendaraan</th>
		        		<th>Tipe Angsuran</th>
		        		<th>DP</th>
		        		<th>Tenor</th>
		        		<th>Harga</th>
		        		<th>Status</th>
		        		<th>Detail</th>
		        	</thead>
		        	<tbody>
		        		@foreach($credits as $key => $v)
		        			<tr>
		        				<td><input type="checkbox" name="" class="ck-data" data-id="{{$v->id}}"></td>
		        				<td><a href="{{route('admin.credit.edit',$v->id)}}">{{$v->customer->first_name}} {{$v->customer->last_name}}</a></td>
		        				<td>{{$v->vehicle->name}}</td>
		        				<td>{!!convert_master_to_object_2(config('master.interest_type'))[$v->interest_type]->value['name']!!}</td>
		        				<td>{{number_format($v->down_payment),2,'.',','}}</td>
		        				<td>{{$v->tenor}} Bulan</td>
		        				<td>{{number_format($v->price),2,'.',','}}</td>
		        				<td>{!!convert_master_to_object_2(config('master.credit_status'))[$v->status]->value['name']!!}</td>
		        				<td><a href="#">Detail Angsuran</a></td>
		        			</tr>
		        		@endforeach
		        	</tbody>
        		</table>
        	</div>
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