@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Cursussen</h1>
	</div>
	<div class="col-md-2">
		<!-- check voor of hij niet student is want studenten mogen ze niet aan maken -->
		@if(!Illuminate\Support\Facades\Auth::user()->hasRole("student"))
			<a href="/create-cursus"><h1>Maak</h1></a>
		@endif
	</div>
</div>
<hr>
<form action="cursussen" method="POST">
	@csrf
	<input type="hidden" name="option" value="1">
<div class="row">
	<div class="col-md-2 offset-md-1 form-group">
		<label>Klas</label>
		<select name="klas" id="" class="form-control">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="col-md-2 form-group">
		<label>Periode</label>
		<select name="periode" id="" class="form-control">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="col-md-2 form-group">
		<label>Leerjaar</label>
		<select name="leerjaar" id="" class="form-control">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="col-md-2 form-group">
		<label>­</label>
		<button class="btn btn-block btn-success" type="submit">Zoek</button>
	</div>
	<div class="col-md-2 form-group">
		<label>­</label>
		<a href="/cursussen"><button class="btn btn-block btn-info" type="button">Refresh</button></a>
	</div>
</div>
</form>
<div class="row">

	@foreach($cursussen as $row)
	<!-- check voor studenten zodat ze alleen hun cursusen kunnen zien -->
	@if(Illuminate\Support\Facades\Auth::user()->hasRole("root") || Illuminate\Support\Facades\Auth::user()->hasRole("admin"))
	<div class="col-md-6">
		<div class="card mt-3" style="min-height: 15rem;">
			<div class="card-header"></div>
			<div class="card-body">
				<table border="1" width="100%">
					<tr>
						<td>klas</td>
						<td>vak</td>
						<td>onderwerp</td>
						<td>periode</td>
						<td>leerjaar</td>
						<td>opdrachten</td>
						<td>info</td>
					</tr>
					
					 <tr>
						<td>{{$row["klas"]}}</td>
						<td>{{$row["vak"]}}</td>
						<td>{{$row["onderwerp"]}}</td>
						<td>{{$row["periode"]}}</td>
						<td>{{$row["leerjaar"]}}</td>
						<td>{{$row["opdrachten"]}}</td>
						<td>{{$row["info"]}}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<div class="row text-center">
					<div class="col-md-2 offset-md-1">
						<h6>Leerjaar: {{$row["leerjaar"]}}</h6>
					</div>
					<div class="col-md-2">
						<h6>Periode: {{$row["periode"]}}</h6>
					</div>
					<div class="col-md-2">
						<h6>Klas: {{$row["klas"]}}</h6>
					</div>
					<div class="col-md-2">
						<button class="btn btn-info">
						<a href="update-cursus/{{$row['id']}}" style="color: white" type="button">Edit</a></button>
					</div>
					<div class="col-md-2">
						<form method="POST" action="cursussen">
							@csrf
							<input name="id" type="hidden" value="{{$row['id']}}">
							<input type="hidden" name="option" value="0">
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">delete</button>
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>
	@elseif(Illuminate\Support\Facades\Auth::user()->hasRole("docent"))
	<!-- voor docent zodat hun alles kunnen zien -->
		<div class="col-md-6">
		<div class="card mt-3" style="min-height: 15rem;">
			<div class="card-header"></div>
			<div class="card-body">
				<table border="1" width="100%">
					<tr>
						<td>klas</td>
						<td>vak</td>
						<td>onderwerp</td>
						<td>periode</td>
						<td>leerjaar</td>
						<td>opdrachten</td>
						<td>info</td>
					</tr>
					
					 <tr>
						<td>{{$row["klas"]}}</td>
						<td>{{$row["vak"]}}</td>
						<td>{{$row["onderwerp"]}}</td>
						<td>{{$row["periode"]}}</td>
						<td>{{$row["leerjaar"]}}</td>
						<td>{{$row["opdrachten"]}}</td>
						<td>{{$row["info"]}}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<div class="row text-center">
					<div class="col-md-2 offset-md-1">
						<h6>Leerjaar: {{$row["leerjaar"]}}</h6>
					</div>
					<div class="col-md-2">
						<h6>Periode: {{$row["periode"]}}</h6>
					</div>
					<div class="col-md-2">
						<h6>Klas: {{$row["klas"]}}</h6>
					</div>
					<!-- check voor als de docent hem heeft gemaakt dat ze hem kan aanpassen -->
					@if($row['madeby'] == Illuminate\Support\Facades\Auth::user()['name'])
					<div class="col-md-2">
						<button class="btn btn-info">
							<a href="update-cursus/{{$row['id']}}" style="color: white">Edit</a></button>
					</div>
					<div class="col-md-2">
						<form method="POST" action="cursussen">
							@csrf
							<input name="id" type="hidden" value="{{$row['id']}}">
							<input type="hidden" name="option" value="0">
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">delete</button>
						</form>
					</div>
					@endif
				</div>
			</div>
		</div>	
	</div>
	@elseif(Illuminate\Support\Facades\Auth::user()->hasRole("student"))
		@if($row['klas'] == Illuminate\Support\Facades\Auth::user()['klas'] && $row['leerjaar'] == Illuminate\Support\Facades\Auth::user()['leerjaar'])
		<div class="col-md-6">
		<div class="card mt-3" style="min-height: 15rem;">
			<div class="card-header"></div>
			<div class="card-body">
				<table border="1" width="100%">
					<tr>
						<td>klas</td>
						<td>vak</td>
						<td>onderwerp</td>
						<td>periode</td>
						<td>leerjaar</td>
						<td>opdrachten</td>
						<td>info</td>
					</tr>
					
					 <tr>
						<td>{{$row["klas"]}}</td>
						<td>{{$row["vak"]}}</td>
						<td>{{$row["onderwerp"]}}</td>
						<td>{{$row["periode"]}}</td>
						<td>{{$row["leerjaar"]}}</td>
						<td>{{$row["opdrachten"]}}</td>
						<td>{{$row["info"]}}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<div class="row text-center">
					<div class="col-md-3">
						<h6>Leerjaar: {{$row["leerjaar"]}}</h6>
					</div>
					<div class="col-md-3">
						<h6>Periode: {{$row["periode"]}}</h6>
					</div>
					<div class="col-md-3">
						<h6>Klas: {{$row["klas"]}}</h6>
					</div>
					<!-- check voor als de docent hem heeft gemaakt dat ze hem kan aanpassen -->
					@if($row['madeby'] == Illuminate\Support\Facades\Auth::user()['name'])
					<div class="col-md-3">
						<button class="btn btn-info">
							<a href="update-cursus/{{$row['id']}}" style="color: white">Edit</a></button>
					</div>
					@endif
				</div>
			</div>
		</div>	
	</div>
		@endif

	@endif
	@endforeach
</div>
@endsection


