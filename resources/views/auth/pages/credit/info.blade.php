@extends('auth.layout.main')
@section('content')
<div class="pt-5">
	<section class="featured-services">
	</section>
	<section class="featured-services">
		<div class="container" data-aos="fade-up">
			<div class="alert alert-danger">Jatuh tempo pembayaran angsuran adalah tanggal 15 setiap bulannya.</div>
	        <div id="accordion">
			  @foreach($credits as $key => $v)
				  <div class="card">
				    <div class="card-header" id="heading-{{$key}}">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
				          {{$key+1}}. {!!convert_master_to_object_2(config('master.brand'))[$v->vehicle->brand_id]->value['name']!!} {{$v->vehicle->name}}
				        </button>
				      </h5>
				    </div>
				    <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordion">
				      <div class="card-body">
				        <div class="table-responsive">
				        	<table class="table table-hover table-striped table-bordered">
				        		<thead>
				        			<th width="10">Ke.</th>
				        			<th class="text-right">Jumlah (IDR)</th>
				        			<th  class="text-center">Bulan</th>
				        			<th class="text-center">Status</th>
				        			<th>Tanggal Pembayaran</th>
				        			<th></th>
				        		</thead>
				        		<tbody>
				        			@foreach($v->details as $k => $d)
					        			<tr>
					        				<td>{{$d->installment}}</td>
					        				<td class="text-right">Rp. {{number_format($d->installment_value),2,'.',','}}</td>
					        				<td class="text-center">{{date('M', strtotime('+'.$k.' month',strtotime($v->created_at)))}}</td>
					        				<td class="text-center text-{{$d->status == 2?'success':'danger'}}">{!!convert_master_to_object_2(config('master.installment_status'))[$d->status]->value['name']!!}</td>
					        				<td>{{$d->paid_date?date('d F Y',strtotime($d->paid_date)):'-'}}</td>
					        				<td></td>
					        			</tr>
				        			@endforeach
				        		</tbody>
				        	</table>
				        </div>
				      </div>
				    </div>
				  </div>
			  @endforeach
			</div>
	    </div>
	</section>
</div>
@endsection