@extends('admin.layout.main')

@section('content')
	<div class="col-md-12">
		<div class="btn-group">
	        <button type="button" class="btn btn-success">Tambah</button>
	        <button type="button" class="btn btn-danger">Hapus</button>
	  	</div>
	</div>
  	<div class="row card-body">
        <div class="table-responsive">
        	<table id="data" class="table table-bordered table-hover">
	        	<thead>
	        		<th width="10px">No</th>
	        		<th>Nama</th>
	        		<th>Tipe</th>
	        		<th>Merek</th>
	        		<th>Model</th>
	        		<th>Tahun</th>
	        		<th>warna</th>
	        	</thead>
	        	<tbody>
	        		@foreach($vehicles as $key => $v)
	        			<tr>
		        			<td>{{$key + 1}}</td>
		        			<td>{{$v->name}}</td>
		        			<td>{!!convert_master_to_object_2(config('master.type'))[$v->type_id]->value['name']!!}</td>
		        			<td>{!!convert_master_to_object_2(config('master.brand'))[$v->brand_id]->value['name']!!}</td>
		        			<td>{{$v->model}}</td>
		        			<td>{{$v->year}}</td>
		        			<td>{{$v->color}}</td>
		        		</tr>
	        		@endforeach
	        	</tbody>
	        </table>
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