@extends('admin.layout.main')

@php
	$year = (int) date('Y');
	// dd($year);
@endphp

@section('content')
	<div class="card">
		<form action="{{route('admin.vehicle.save')}}" enctype="multipart/form-data" method="POST">
			@csrf
			<input type="hidden" name="id" value="{{$vehicle?$vehicle->id:''}}">
			<div class="row card-body col-md-12">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Tipe Kendaraan</label>
						<select class="form-control select2" name="type_id" id="type_id">
							@foreach(convert_master_to_object_2(config('master.type')) as $v)
								@if(!empty($vehicle) && $v->value['id'] == $vehicle->type_id)
									<option value="{{$v->value['id']}}" selected>{{$v->value['name']}}</option>
								@endif
								<option value="{{$v->value['id']}}">{{$v->value['name']}}</option>
							@endforeach
						</select>
						@error('type_id')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Manufaktur</label>
						<select class="form-control select2" name="brand_id" id="brand_id">
							@foreach(convert_master_to_object_2(config('master.brand')) as $v)
								@if(!empty($vehicle) && $v->value['id'] == $vehicle->brand_id)
									<option value="{{$v->value['id']}}" selected>{{$v->value['name']}}</option>
								@endif
								<option value="{{$v->value['id']}}">{{$v->value['name']}}</option>
							@endforeach
						</select>
						@error('brand_id')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Kode Kendaraan</label>
						<input type="text" name="code" id="code" class="form-control" value="{{$vehicle?$vehicle->code:''}}">
						@error('code')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Nama Kendaraan</label>
						<input type="text" name="name" id="name" class="form-control" value="{{$vehicle?$vehicle->name:''}}">
						@error('name')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Harga Terbaru</label>
						<input type="number" name="price" id="price" class="form-control" value="{{$vehicle?$vehicle->price:''}}">
						@error('price')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Model</label>
						<input type="text" name="model" id="model" class="form-control" value="{{$vehicle?$vehicle->model:''}}">
						@error('model')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Tahun</label>
						<select class="form-control select2" name="year" id="year">
							@for($i = $year; $i > $year - 20; $i-- )
								@if(!empty($vehicle) && $i == $vehicle->year)
									<option value="{{$i}}" selected>{{$i}}</option>
								@endif
								<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
						@error('year')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Warna</label>
						<input type="text" name="color" id="color" class="form-control" value="{{$vehicle?$vehicle->color:''}}">
						@error('color')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Ukuran Silinder (CC)</label>
						<input type="number" name="cylinder" id="cylinder" class="form-control" value="{{$vehicle?$vehicle->cylinder:''}}">
						@error('cylinder')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="form-group">
						<label for="">Ukuran Silinder (CC)</label>
						<input type="file" name="image" id="" class="form-control">
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
		})
	</script>
@endpush