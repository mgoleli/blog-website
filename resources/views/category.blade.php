@extends('frontlayout')
@section('content')
		<div class="row">
			<div class="col-md-8">
				<div class="row mb-5"> 
					@if(count($posts)>0)
						@foreach($posts as $post)
						<div class="col-md-4">
							<div class="card">
							  <a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}"><img src="{{ asset('imgs/full').'/'.$post->full_img }}" class="card-img-top" alt="{{$post->title}}" /></a>
							  <div class="card-body">
							    <h5 class="card-title"><a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">{{$post->title}}</a></h5>
							  </div>
							</div>
						</div>
						@endforeach
					@else
					<p class="alert alert-danger">Kategoride yazı bulunamadı</p>
					@endif
				</div>
				<!-- Pagination -->
				{{$posts->links()}}
			</div>
		</div>
@endsection('content')