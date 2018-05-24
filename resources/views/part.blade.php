<!doctype html>
<html lang="en">

@include('includes.head')

<body>

	@include('includes.navigation')
	<div class="full-page-wrapper">
		<div class="part-header-wrapper">
			<div class="container">
				<div class="row">
					<div class="twelve columns">

						<h5>{{$title}}</h5>

						<a class="button button-hollow add-to-partlist save-session" data-url="{{ route('session.store', ['name' => $session_name, 'value' => $slug]) }}">Pievienot</a>
					</div>
					<!-- end of twelve columns -->
				</div>
				<!-- end of row -->
			</div>
			<!-- end of container -->
		</div>
		<!-- end of part-header-wrapper -->

		<div class="parts-wrapper">
			<div class="container">
				<div class="row">

					<div class="twelve columns">
						<ul class="tabs">
							<li class="tab-link current" data-tab="tab-1">Specifikācija</li>
							@if (!empty($prices))
							<li class="tab-link" data-tab="tab-2">Tirgotāji</li>
							@endif
						</ul>
					</div>
					<!-- end of twelve columns -->
				</div>
				<!-- end of row -->

				<div class="row">
					<div class="twelve columns">
						<div id="tab-1" class="tab-content current specs">
							<table>
								<tbody>
									<!-- outputs specifications -->
									@foreach ($specs as $desc => $value)
									<tr>
										<td>{{trans('specifications.' . $desc)}}</td>
										<td> {{$value}} </td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>
						<!-- outputs prices -->
						<div id="tab-2" class="tab-content retailers">

							<table>

								<thead>
									<tr>

										<th>Veikals</th>
										<th>Piegāde</th>
										<th>Noliktavā</th>
										<th>Cena</th>
									</tr>
								</thead>

								<tbody>

									@if (!empty($prices)) @foreach ($prices as $price)
									<tr>

										<td>
											<a href="{{$price->url}}">
												<img src="img/{{$price->store}}.jpg" alt="{{$price->alt}}">
											</a>
										</td>
										<td>
											<a href="{{$price->delivery}}">Skatīt</a>
										</td>
										<td> @if($price->stock == 1) Ir @else Nav @endif </td>
										<td>
											<a href="{{$price->url}}">&euro;{{$price->price}}</a>
										</td>
									</tr>
									@endforeach @endif

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end of container  -->
		</div>
		<!-- end of parts wrapper -->
		@include('includes.footer')
	</div>
	<!-- end of full page wrapper -->
</body>

</html>