@extends('layouts.basic')
@section('content')

<div class="row">
	<div class="col-md-10 text-center">
		<h1>Klassen</h1>
	</div>
	<div class="col-md-2">
		<!-- check voor of die docent is zodat sutdenten geen klassen kunnen maken -->
		@if(!Illuminate\Support\Facades\Auth::user()->hasRole("docent"))
			<a href="/create-klassen"><h1>Maak</h1></a>
		@endif
	</div>
</div>
<hr>
<div class="row">
	<!-- output elke klas -->
	@foreach($klassen as $row)
	<div class="col-md-4">
		<div class="card mt-3">
			<div class="card-header">{{$row["klascode"]}}</div>
			<div class="card-body">
				<table style="width: 100%;" border="1">
					<tbody>
						<tr>
							<td width="10%" style="color: white"><b>klas</b></td>
							<td width="90%" style="color: white"><b>Student</b></td>
						</tr>
						<!-- een static manier om alle klassen te vullen op klas -->
						@for($i=1;$i<6;$i++)
						<tr>
							<td style="color: black">{{$row["klascode"]}}</td>
							<td style="color: black"><b>
							@foreach($users as $row2)
							@if($row2["id"] == $row["leerling$i"])
								{{$row2["name"]}}
							@endif
							@endforeach
							</b></td>
							
						</tr>
						@endfor
						
					</tbody>
				</table>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
	@endforeach
</div>
@endsection

