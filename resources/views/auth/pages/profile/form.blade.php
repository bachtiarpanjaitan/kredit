@extends('auth.layout.main')
@section('content')
<section class="featured-services">
    <div class="card">
        <form action="{{route('profile.save')}}" method="POST">
            @csrf
            <div class="row card-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <label for="" class="form-control">{{$user->customer->first_name}} {{$user->customer->last_name}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <label for="" class="form-control">{{$user->customer->email}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">NO.KTP</label>
                        <label for="" class="form-control">{{$user->customer->no_ktp}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">NO.KK</label>
                        <label for="" class="form-control">{{$user->customer->no_kk}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <label for="" class="form-control">{{$user->customer->address}}</label>
                    </div>
                    
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tempat Lahir</label>
                        <label for="" class="form-control">{{$user->customer->birth_place}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <label for="" class="form-control">{{$user->customer->birth_date}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">Profesi</label>
                        <label for="" class="form-control">{{$user->customer->profession}}</label>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label> <span class="text-warning">kosongkan apabila tidak mengganti password</span>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <span class="small text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmasi Password</label> <span class="text-warning"></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        @error('upassword')
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
</section>
@endsection