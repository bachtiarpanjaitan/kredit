@extends('admin.layout.main')

@section('content')
	<div class="col-md-12">
		<div class="btn-group">
	        <a href="{{route('admin.customer.add')}}"><button type="button" class="btn btn-success">Tambah</button></a>
	        <button type="button" class="btn btn-danger btn-delete" data-url="{{route('admin.customer.delete')}}">Hapus</button>
	  	</div>
	</div>
  	<div class="card mt-2">
  		<div class="row card-body">
  			<div class="table-responsive">
        		<table id="data" class="table table-bordered table-hover">
        			<thead>
		        		<th width="10px">#</th>
		        		<th>Nama</th>
		        		<th>Alamat</th>
		        		<th>Email</th>
		        		<th>Profesi</th>
		        	</thead>
		        	<tbody>
		        		@foreach($customers as $key => $v)
		        			<tr>
		        				<td><input type="checkbox" name="" class="ck-data" data-id="{{$v->id}}"></td>
		        				<td><a href="{{route('admin.customer.edit',$v->id)}}">{{$v->first_name}} {{$v->last_name}}</a></td>
		        				<td>{{$v->address}}</td>
		        				<td>{{$v->email}}</td>
		        				<td>{{$v->profession}}</td>
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