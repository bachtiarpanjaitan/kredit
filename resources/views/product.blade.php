@extends('layout')
@section('content')
<div>
	<section class="featured-services">
		<div class="container" data-aos="fade-up">
	        <div class="row">
	        	@foreach($vehicles as $key=>$v)
        		 	<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
			            <div class="icon-box" data-aos="fade-up" data-aos-delay="100" style="padding:5px !important">
			            	<img src="{{asset('img/vehicles/'.$v->image)}}" alt="" class="" width="240px" height="150px">
			              <div class="mt-2">
			              	<h4 class="title text-center"><a href="">{!!convert_master_to_object_2(config('master.brand'))[$v->brand_id]->value['name']!!} {{$v->name}}</a></h4>
			              </div><br>
			              <p class="description">
			              	<a href="{{route('product.detail',$v->id)}}"><button class="btn btn-block btn-primary">Detail</button></a>
			              </p>
			            </div>
		          	</div>
	        	@endforeach
	      </div>
	  </div>
	</section>
</div>
@endsection