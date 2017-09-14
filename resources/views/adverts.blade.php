@extends('layout')

@section('content')

	<div class="container">

		<section class="section">

			<div class="content is-clearfix">
				
				<h1 class="is-pulled-left">Ads:</h1>

				@if(url()->current() == url('promising'))

					<a class="button is-primary is-pulled-right" href="{{ url('/promising/download') }}">Download</a>

				@endif

			</div>

			<table class="table is-bordered is-fullwidth is-hidden-touch">
				
				<thead>
					
					<tr>
						
						<th>#</th>
						<th>Address</th>
						<th>Price</th>
						<th>Area</th>
						<th>Good</th>

					</tr>

				</thead>

				<tbody>

					<tr v-for="(ad, index) in ads" :class="{'is-selected': ad.seen && ad.promising}">

						<td>@{{ ad.id }}</td>
						<td><a :href="ad.link" target="_blank" :class="{'has-text-danger': ad.seen && !ad.promising}" @click="seen(index)">@{{ ad.address }}</a></td>
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

			<table class="table is-bordered is-fullwidth is-hidden-desktop" v-for="(ad, index) in ads">

				<tr :class="{'is-selected': ad.seen && ad.promising}">
					<th width="20px">#</th>
					<td>@{{ ad.id }}</td>
				</tr>

				<tr :class="{'is-selected': ad.seen && ad.promising}">
					<th>Address</th>
					<td><a :href="ad.link" target="_blank" :class="{'has-text-danger': ad.seen && !ad.promising}" @click="seen(index)">@{{ ad.address }}</a></td>
				</tr>

				<tr :class="{'is-selected': ad.seen && ad.promising}">
					<th>Price</th>
					<td>@{{ ad.price }} Ft/hó</td>
				</tr :class="{'is-selected': ad.seen && ad.promising}">

				<tr :class="{'is-selected': ad.seen && ad.promising}">
					<th>Area</th>
					<td>@{{ ad.size }} m<sup>2</sup></td>
				</tr>

				<tr :class="{'is-selected': ad.seen && ad.promising}">
					<th>Good</th>
					<td>
						<label class="checkbox">
							<input type="checkbox" v-model="ad.promising" @click="update(index)">
						</label>
					</td>
				</tr>

			</table>

		</section>

	</div>

@endsection

@section('js')

	<script>
		var app = new Vue({
			el: '#app',

			data: {
				unsortedAds: {!! $ads !!},
			},

			computed: {

				ads: function ()
				{
        			return this.unsortedAds.slice().reverse();
				}
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