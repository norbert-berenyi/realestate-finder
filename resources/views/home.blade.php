@extends('layout')

@section('content')

	<div class="container">

		<section class="section">

			<div class="content is-clearfix">
				
				<h1 class="is-pulled-left">Ads:</h1>

				@if(url()->current() != url('/'))
					<a class="button is-primary is-pulled-right" href="{{ url('/reports/download/' . $link) }}">Download</a>
				@endif

			</div>

			<table class="table is-bordered is-fullwidth is-hidden-touch">
				
				<thead>
					
					<tr>
						
						<th>#</th>
						<th>Address</th>
						<th>Price</th>
						<th>Area</th>
						<th></th>

					</tr>

				</thead>

				<tbody>

					<tr v-for="(ad, index) in ads">

						<td>@{{ ad.id }}</td>
						<td><a :href="ad.link" target="_blank" @click="seen(index)">@{{ ad.address }}</a></td>
						<td>@{{ ad.price }} Ft/hó</td>
						<td>@{{ ad.size }} m<sup>2</sup></td>
						<td>
							<label class="checkbox">
								<input type="checkbox" v-model="ad.promising" @click="update(index)">
							</label>
						</td>

					</tr>

				</tbody>

			</table>

			@foreach($ads as $ad)

				<table class="table is-bordered is-fullwidth is-hidden-desktop">

					<tr>
						<th width="20px">#</th>
						<td>{{ $ad->id }}</td>
					</tr>

					<tr>
						<th>Address</th>
						<td><a href="{{ $ad->link }}" target="_blank">{{ $ad->address }}</a></td>
					</tr>

					<tr>
						<th>Price</th>
						<td>{{ number_format($ad->price, 0, ',', '.') }} Ft/hó</td>
					</tr>

					<tr>
						<th>Area</th>
						<td>{{ $ad->size }} m<sup>2</sup></td>
					</tr>

				</table>

			@endforeach

		</section>

	</div>

@endsection

@section('js')

	<script>
		var app = new Vue({
			el: '#app',

			data: {
				ads: {!! $ads !!},
			},

			methods: {

				update: function (index) {
					
					axios.post('/advert', 
					{
						id: app.ads[index].id,
						seen: app.ads[index].seen,
						promising: app.ads[index].promising

					});
				},

				seen: function (index)
				{
					this.ads[index].seen = true;

					this.update(index);
				}
			}
		});
	</script>

@endsection