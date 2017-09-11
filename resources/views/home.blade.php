@extends('layout')

@section('content')

	<div class="container">

		<br>

		<div class="content is-clearfix">
			<h1 class="is-pulled-left">Ads:</h1>


			<a class="button is-primary is-pulled-right" href="{{ url('/reports/download/' . $link) }}">Download</a>
		</div>

		<table class="table is-bordered is-fullwidth">
			
			<thead>
				
				<tr>
					
					<th>#</th>
					<th>Address</th>
					<th>Price</th>
					<th>Area</th>

				</tr>

			</thead>

			<tbody>
				
				@foreach($ads as $key => $ad)

					<tr>

						<td>{{ $key }}</td>
						<td><a href="{{ $ad->link }}" target="_blank">{{ $ad->address }}</a></td>
						<td>{{ $ad->price }}</td>
						<td>{{ $ad->size }}</td>

					</tr>

				@endforeach

			</tbody>

		</table>

	</div>

@endsection