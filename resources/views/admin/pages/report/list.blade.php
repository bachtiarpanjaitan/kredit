@extends('admin.layout.main')

@section('content')
	<div class="col-md-12">
        <table class="table table-sm table-bordered">
            <thead>
                <th>Nama</th>
                <th>Detail Laporan</th>
                <th>View</th>
            </thead>
            <tbody>
                <tr>
                    <td>Laporan Penjualan</td>
                    <td>Laporan penjualan sepeda motor perbulan</td>
                    <td><a href="{{route('admin.report.unit_sales')}}"><button class="btn btn-success">Lihat</button></a></td>
                </tr>
                <tr>
                    <td>Laporan Penjualan Tahunan</td>
                    <td>Laporan penjualan sepeda motor pertahun</td>
                    <td><a href="{{route('admin.report.unit_year_sales')}}"><button class="btn btn-success">Lihat</button></a></td>
                </tr>
                <tr>
                    <td>Laporan Penerimaan Angsuran</td>
                    <td>Laporan Penerimaan Angsuran perbulan</td>
                    <td><a href="{{route('admin.report.credit_details')}}"><button class="btn btn-success">Lihat</button></a></td>
                </tr>
               
                <tr>
                    <td>Laporan Penerimaan Angsuran Tahunan</td>
                    <td>Laporan Penerimaan Angsuran pertahun</td>
                    <td><a href="{{route('admin.report.credit_year_details')}}"><button class="btn btn-success">Lihat</button></a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection