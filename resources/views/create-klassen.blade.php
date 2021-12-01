@extends('layouts.basic')
@section('content')

<div class="row">
	<div class="col-md-10 text-center">
		<h1>Maak een klas</h1>
	</div>
	<div class="col-md-2">
		<a href="/klassen"><h1>Terug</h1></a>
	</div>
</div>
<hr>

@php
<!-- check voor de studenten die al in een klas zitten zodat ze niet nog een keer een klas in kunnen -->
$myarray = array();	

foreach($klassen as $row) {
	for($i=1;$i<6;$i++){
		array_push($myarray, $row["leerling$i"]);
	}

}

$geenKlas = array();
foreach($users as $row){
	if(!in_array($row['id'], $myarray)){
		array_push($geenKlas, $row["id"]);
	}


}


@endphp

<div class="row">
	<div class="col-md-6 offset-md-3">
		<h1>Studenten:</h1>
	</div>
	<div class="col-md-6 offset-md-3">
		<form action="create-klassen" method="POST">
			@csrf
			<div class="form-group">
				<label>Leerling 1:</label>
				<select class="form-control" name="leerling1" required="">
					@foreach($geenKlas as $row2)
					<option>{{$row2}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Leerling 2:</label>
				<select class="form-control" name="leerling2" required="">
					@foreach($geenKlas as $row2)
					<option>{{$row2}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Leerling 3:</label>
				<select class="form-control" name="leerling3" required="">
					@foreach($geenKlas as $row2)
					<option>{{$row2}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Leerling 4:</label>
				<select class="form-control" name="leerling4" required="">
					@foreach($geenKlas as $row2)
					<option>{{$row2}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Leerling 5:</label>
				<select class="form-control" name="leerling5" required="">
					@foreach($geenKlas as $row2)
					<option>{{$row2}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<input type="text" name="klas" placeholder="Klas code" class="form-control" required=""> 
			</div>
			<div class="form-group">
				<input type="text" name="leerjaar" placeholder="leerjaar" class="form-control" required="">
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-block btn-success">Maak klas</button>
			</div>
		</form>
	</div>
</div>



<!-- @foreach($klassen as $row)
@for($i=1;$i<6;$i++)
	
	@foreach($users as $user)
		@if($user["id"] == $row["leerling$i"])
			{{$user["id"]}}
		@else 
			k
		@endif
	@endforeach 
@endfor
@endforeach
@endsection -->