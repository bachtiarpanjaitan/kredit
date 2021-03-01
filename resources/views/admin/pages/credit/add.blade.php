@extends('admin.layout.main')
@php
	$tenor = 6
	// dd($year);
@endphp

@section('content')
	<div class="card">
		<form action="{{route('admin.credit.save')}}" method="POST">
			@csrf
			<input type="hidden" name="id" value="{{$credit?$credit->id:''}}">
			<div class="row card-body col-md-12">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Pelanggan</label>
						<select class="form-control select2" name="customer_id" id="customer_id">
							@foreach($customers as $v)
								@if(!empty($credit))
									<option value="{{$v->id}}" selected>{{$v->first_name}} {{$v->last_name}}</option>
								@endif
								<option value="{{$v->id}}">{{$v->first_name}} {{$v->last_name}}</option>
							@endforeach
						</select>
						@error('customer_id')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Tipe Bunga</label>
						<select class="form-control select2" name="interest_type" id="interest_type">
							@foreach(convert_master_to_object_2(config('master.interest_type')) as $v)
								@if(!empty($credit) && $v->value['id'] == $credit->interest_type)
									<option value="{{$v->value['id']}}" selected>{{$v->value['name']}}</option>
								@endif
								<option value="{{$v->value['id']}}">{{$v->value['name']}}</option>
							@endforeach
						</select>
						@error('interest_type')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Besaran Bunga (%)</label>
						<input type="number" name="interest" id="interest" class="form-control" value="{{$credit?$credit->interest:''}}">
						@error('interest')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">DP (IDR)</label>
						<input type="text" name="down_payment" id="down_payment" class="money form-control" value="{{$credit?$credit->down_payment:''}}">
						@error('down_payment')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Tenor</label>
						<select class="form-control select2" name="tenor" id="tenor">
							@for($i = $tenor; $i <= 36; $i++ )
								@if(!empty($credit) && $i == $credit->tenor)
									<option value="{{$i}}" selected>{{$i}} Bulan</option>
								@endif
								<option value="{{$i}}">{{$i}} Bulan</option>
							@endfor
						</select>
						@error('tenor')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Kendaraan</label>
						<select class="form-control select2" name="vehicle_id" id="vehicle_id">
							<option value="">Pilih Kendaraan</option>
							@foreach($vehicles as $v)
								@if(!empty($credit))
									<option value="{{$v->id}}" selected>{{$v->name}}, th.{{$v->year}}</option>
								@endif
								<option value="{{$v->id}}">{{$v->name}}, th.{{$v->year}}</option>
							@endforeach
						</select>
						@error('vehicle_id')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Harga Total Angsuran</label>
						<input type="text" name="price" id="price" class="money form-control" value="{{$credit?$credit->price:''}}">
						@error('price')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-md-12">
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</div>
		</form>
	</div>
@endsection

@push('script')
	<script>
		$(window).ready(function(){
			$('.select2').select2({
				theme: 'bootstrap4'
			})

			$('#vehicle_id').change(function(){
				var data = {
	                "id": $(this).val(),
	                '_token': '{{ csrf_token() }}'
	            };

	             // Regency
				$.ajax({
		            type: 'GET',
		            url: '{{route('admin.vehicle.get')}}',
		            data: data,
		            dataType: 'JSON',
		            success: function(response) {
		                if(response.status == 'success'){
		                	$('#price').val(response.data.price)
		                }
		            },
		            error: function (jqXHR, status) {
		                
		            }
		        });


	        })
		})
	</script>
@endpush