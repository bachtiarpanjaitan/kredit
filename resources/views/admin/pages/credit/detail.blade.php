@extends('admin.layout.main')

@section('content')
	<div class="row card-body">
		<div class="table-responsive">
    		<table id="data" class="table table-bordered table-hover">
    			<thead>
	        		<th width="10px">Ke#</th>
	        		<th>Jumlah Angsuran</th>
	        		<th class="text-center">Status</th>
	        		<th>Dibayar Tanggal</th>
	        		<th>Pembayaran</th>
	        	</thead>
	        	<tbody>
	        		@foreach($credit->details as $key => $v)
	        			<tr>
	        				<td>{{$v->installment}}</td>
	        				<td>Rp.{{number_format($v->installment_value),2,'.',','}}</td>
	        				<td class="text-center">{!!convert_master_to_object_2(config('master.installment_status'))[$v->status]->value['name']!!}</td>
	        				<td>{{$v->paid_date}}</td>
	        				<td>
	        					<button class="btn btn-{{$v->status != config('master.installment_status.open.id')?'danger':'success'}} btn-paid" data-id="{{$v->id}}" {{$v->status != config('master.installment_status.open.id')?'disabled':''}}>{{$v->status != config('master.installment_status.open.id')?'Terbayar':'Bayar'}}</button>
	        				</td>
	        			</tr>
	        		@endforeach
	        	</tbody>
    		</table>
    	</div>
    	<div>
    		<p class="h3">TOTAL : Rp.{{number_format($credit->total),2,'.',','}}</p>
    	</div>
	</div>
@endsection

@push('script')
	<script>
		const btn_paid = Swal.mixin({
	      customClass: {
	        confirmButton: 'btn btn-success',
	        cancelButton: 'btn btn-danger'
	      },
	      buttonsStyling: false
	    })

		$('.btn-paid').click(function(){
		 	btn_paid.fire({
		      title: 'Persetujuan Pembayaran?',
		      text: "Anda yakin menyetujui pembayaran?",
		      icon: 'warning',
		      showCancelButton: true,
		      confirmButtonText: ' Ya, Setuju!',
		      cancelButtonText: ' Tidak, Terimakasih!',
		      reverseButtons: true
		    }).then((result) => {
		    	if (result.isConfirmed) {
		    		let id =$(this).data('id')
		    		var data = {
		    			 id: id,
		    			 _token: '{{ csrf_token() }}',
		    			 credit_id: '{{$credit->id}}'
		    		}

		    		 $.ajax({
			            type        : 'POST', 
			            url         : '{{route('admin.credit.paid')}}', 
			            data        : data, 
			            dataType    : 'json'
			        }).done(function(data) {
			        	if(data.code == 200){
			        		location.reload();
			        	}else{
			        		swalWithBootstrapButtons.fire(
				                'Gagal Disetujui!',
				                data.message,
				                'error'
			              	)
			        	}
			        })
		    	}
		    })
		})
	</script>
@endpush