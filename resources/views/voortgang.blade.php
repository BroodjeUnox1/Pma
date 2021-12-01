@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Voortgang</h1>
	</div>
</div>
<hr>

	<div class="row">
	<form method="POST" action="voortgang" class="col-md-12">
		<div class="row">
		@csrf
		<div class="col-md-2 offset-md-1">
			<label>Student</label>
			<input type="text" class="form-control" placeholder="Student" name="student">
		</div>
		<div class="col-md-2">
			<label>Klas:</label>
			<select name="klas" id="" class="form-control">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
		</div>
		<div class="col-md-2">
			<label>leerjaar:</label>
			<select name="leerjaar" id="" class="form-control">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
			</select>
		</div>
		<div class="col-md-2">
			<label>­</label>
			<button class="btn btn-success btn-block" type="submit">Zoek</button>
		</div>
	
		<div class="col-md-2">
			<label>­</label>
			<a href="voortgang"><button class="btn btn-info btn-block" type="button">refresh</button></a>
		</div>
	</div>
	</form>
		
	</div>

<div class="row">
	@foreach($data as $row)
	<div class="col-md-4 mt-3">
		<div class="card">
			<div class="card-header"><h1>{{$row['name']}}</h1></div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h3>klas:{{$row['klas']}}</h3>
						<h3>leerjaar:{{$row['leerjaar']}}</h3>
					</div>
					<div class="col-md-6 text-center">
						<i class="fas fa-user fa-5x" ></i>
					</div>
				</div>
				
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-md-6"><a href="voortgang/{{$row['id']}}"><button class="btn btn-success">Kijk voortgang</button></a></div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

@endsection