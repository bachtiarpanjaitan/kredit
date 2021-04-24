@extends('auth.layout.main')
@php
	$otr = $vehicle->otr == 0?$vehicle->price + $vehicle->otr:config('master.default_otr');
@endphp
@section('content')
<div class="container">
	<table class="table table-sm table-bordered">
		<thead>
			<th class="text-center" width="250px">Spesifikasi</th>
			<th class="text-center">Deskripsi</th>
		</thead>
		<tbody>
			<tr>
				<td class="font-weight-bold">Gambar</td>
				<td><img class="rounded mx-auto d-block" width="500px" height="350px" src="{{ Storage::url('img/vehicles/') }}{{$vehicle->image}}" alt=""></td>
			</tr>
			<tr>
				<td class="font-weight-bold">Nama</td>
				<td class="h4">{{$vehicle->name}}</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Warna</td>
				<td>{{strtoupper($vehicle->color)}}</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Kapasitas Silinder</td>
				<td>{{strtoupper($vehicle->cylinder)}} CC</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Tahun Keluaran</td>
				<td>{{strtoupper($vehicle->year)}}</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Manufaktur/Merk</td>
				<td>{!!convert_master_to_object_2(config('master.brand'))[$vehicle->brand_id]->value['name']!!}</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Tipe Motor</td>
				<td>{!!convert_master_to_object_2(config('master.type'))[$vehicle->type_id]->value['name']!!}</td>
			</tr>
			<tr>
				<td class="font-weight-bold">Tenor Angsuran</td>
				<td>
					@foreach(config('master.tenor') as $t)
						<span class="badge badge-primary">{{$t}} Bulan </span>
					@endforeach
				</td>
			</tr>
			<tr>
				<td class="font-weight-bold">OTR</td>
				<td>Rp. {{number_format($otr,2,'.',',')}}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered">
		<legend>Angsuran Flat</legend>
		<thead>
			<th class="text-center">Uang Muka</th>
			@foreach(config('master.tenor') as $t)
				<th class="text-center">{{$t}} Bulan </th>
			@endforeach
		</thead>
		<tbody>
			@foreach(config('master.downpayment') as $d)
				<tr>
					<td>Rp. {{number_format($d,2,'.',',')}}</td>
					@foreach(config('master.tenor') as $x)
						@php
							$total_angsuran = 0;
							$sisa = $otr - $d;
                			$pokok = $sisa / $x;
                			$total_angsuran = $pokok + config('master.default_interest');
						@endphp

						<td >Rp. {{number_format(floor($total_angsuran),0,'.',',')}}</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection