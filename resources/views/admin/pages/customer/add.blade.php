@extends('admin.layout.main')

@section('content')
	<div class="card">
		<form action="{{route('admin.customer.save')}}" enctype="multipart/form-data" method="POST">
			@csrf
			<input type="hidden" name="id" value="{{$customer?$customer->id:''}}">
			<div class="row card-body col-md-12">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kode Pelanggan</label>
						<input type="text" name="code" id="code" class="form-control" value="{{$customer?$customer->code:''}}">
						@error('code')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Nama Depan</label>
						<input type="text" name="first_name" id="first_name" class="form-control" value="{{$customer?$customer->first_name:''}}">
						@error('first_name')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Nama Belakang</label>
						<input type="text" name="last_name" id="last_name" class="form-control" value="{{$customer?$customer->last_name:''}}">
						@error('last_name')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Jenis Kelamin</label>
						<div class="row">
							<div class="form-check m-2">
		                      	<input class="form-check-input" type="radio" value="0" name="gender" {!!$customer?!$customer->gender?'checked':'':''!!}>
		                      	<label class="form-check-label">Perempuan </label>
		                    </div>
		                    <div class="form-check m-2">
		                      	<input class="form-check-input" type="radio" value="1" name="gender" {{$customer?$customer->gender?'checked':'':''}}>
		                      	<label class="form-check-label">Laki-Laki</label>
		                    </div>
						</div>
	                </div>
	                <div class="form-group">
						<label for="">Nomor KK</label>
						<input type="text" name="no_kk" id="no_kk" class="form-control" value="{{$customer?$customer->no_kk:''}}">
						@error('no_kk')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Nomor KTP</label>
						<input type="text" name="no_ktp" id="no_ktp" class="form-control" value="{{$customer?$customer->no_ktp:''}}">
						@error('no_ktp')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" name="email" id="email" class="form-control" value="{{$customer?$customer->email:''}}">
						@error('email')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Tempat Lahir</label>
						<input type="text" name="birth_place" id="birth_place" class="form-control" value="{{$customer?$customer->birth_place:''}}">
						@error('birth_place')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Tanggal Lahir</label>
						<input type="date" name="birth_date" id="birth_date" class="form-control" value="{{$customer?$customer->birth_date:''}}">
						@error('birth_date')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Pekerjaan</label>
						<input type="text" name="profession" id="profession" class="form-control" value="{{$customer?$customer->profession:''}}">
						@error('profession')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Alamat Lengkap</label>
						<textarea name="address" id="address" cols="30" rows="4" class="form-control">{{$customer?$customer->address:''}}</textarea>
						@error('address')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Provinsi</label>
						<select class="form-control select2" name="province_id" id="province_id">
							<option value="">Pilih Provinsi</option>
							@foreach($provinces as $v)
								@if(!empty($customer) && $v->code == $customer->province_id)
									<option value="{{$v->code}}" selected>{{$v->name}}</option>
								@endif
								<option value="{{$v->code}}">{{$v->name}}</option>
							@endforeach
						</select>
						@error('province_id')
	                        <span class="small text-danger">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
					</div>
					<div class="form-group">
						<label for="">Kabupaten</label>
						<select class="form-control select2" name="regency_id" id="regency_id">
							<option value="">Pilih Kabupaten</option>
							@if($regencies)
								{!! combobox($regencies,'code','name',$customer->regency_id)!!}
							@endif
						</select>
						@error('regency_id')
	                        <span class="small text-danger">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
					</div>
					<div class="form-group">
						<label for="">Kecamatan</label>
						<select class="form-control select2" name="district_id" id="district_id">
							<option value="">Pilih Kecamatan</option>
							@if($districts)
								{!! combobox($districts,'code','name',$customer->district_id)!!}
							@endif
						</select>
						@error('district_id')
	                        <span class="small text-danger">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
					</div>
					<div class="form-group">
						<label for="">Kelurahan</label>
						<select class="form-control select2" name="village_id" id="village_id">
							<option value="">Pilih Kelurahan</option>
							@if($villages)
								{!! combobox($villages,'code','name',$customer->village_id)!!}
							@endif
						</select>
						@error('village_id')
	                        <span class="small text-danger">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
					</div>
					<div class="form-group">
						<label for="">NPWP</label>
						<input type="number" name="npwp" id="npwp" class="form-control" value="{{$customer?$customer->npwp:''}}">
						@error('npwp')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Nama Bank</label>
						<select required class="form-control select2" name="bank_id" id="bank_id">
							<option value="">Pilih Bank</option>
							@if($banks)
								{!! combobox($banks,'id','name', $customer?$customer->bank_id:'')!!}
							@endif
						</select>
						@error('bank_id')
	                        <span class="small text-danger">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
					</div>
					<div class="form-group">
						<label for="">No.Rekening</label>
						<input type="number" required name="rekening" id="rekening" class="form-control" value="{{$customer?$customer->rekening:''}}">
						@error('rekening')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Slip Gaji</label>
						<input type="file" required name="slip_gaji" id="" class="form-control">
						@error('slip_gaji')
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

			$('#province_id').change(function(){
				var data = {
	                "id": $(this).val(),
	                '_token': '{{ csrf_token() }}'
	            };

	            // Regency
				$.ajax({
		            type: 'GET',
		            url: '{{route('admin.province.get_regency')}}',
		            data: data,
		            dataType: 'JSON',
		            success: function(response) {
		                if(response.status == 'success'){
		                	$('#regency_id')
		                		.find('option')
		                		.remove()

		                	response.data.forEach(function(v){
		                		$('#regency_id')
		                		.append('<option value='+ v.code +'>'+ v.name+'</option>')
		                	})
		                }
		            },
		            error: function (jqXHR, status) {
		                
		            }
		        });
			})

			$('#regency_id').change(function(){
				var data = {
	                "id": $(this).val(),
	                '_token': '{{ csrf_token() }}'
	            };

	             // District
				$.ajax({
		            type: 'GET',
		            url: '{{route('admin.regency.get_district')}}',
		            data: data,
		            dataType: 'JSON',
		            success: function(response) {
		                if(response.status == 'success'){
		                	$('#district_id')
		                		.find('option')
		                		.remove()

		                	response.data.forEach(function(v){
		                		$('#district_id')
		                		.append('<option value='+ v.code +'>'+ v.name+'</option>')
		                	})
		                }
		            },
		            error: function (jqXHR, status) {
		                
		            }
		        });
	        })

	        $('#district_id').change(function(){
				var data = {
	                "id": $(this).val(),
	                '_token': '{{ csrf_token() }}'
	            };

	             // District
				$.ajax({
		            type: 'GET',
		            url: '{{route('admin.district.get_village')}}',
		            data: data,
		            dataType: 'JSON',
		            success: function(response) {
		                if(response.status == 'success'){
		                	$('#village_id')
		                		.find('option')
		                		.remove()

		                	response.data.forEach(function(v){
		                		$('#village_id')
		                		.append('<option value='+ v.code +'>'+ v.name+'</option>')
		                	})
		                }
		            },
		            error: function (jqXHR, status) {
		                
		            }
		        });
	        })
		})
	</script>
@endpush