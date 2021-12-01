@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Maak Planningen</h1>
	</div>
	<div class="col-md-2">
		<a href="/planningen"><h1>Terug</h1></a>
	</div>
</div>
<hr>
<div class="row mt-5">
	<div class="col-md-6 offset-md-3">
		<form method="POST" action="create-planning">
			@csrf
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Periode:</label>
						<select class="form-control" name="periode" >
							<option {{$periode == 1 ? 'selected' : 'class'}}>1</option>
							<option {{$periode == 2 ? 'selected' : 'class'}}>2</option>
							<option {{$periode == 3 ? 'selected' : 'class'}}>3</option>
							<option {{$periode == 4 ? 'selected' : 'class'}}>4</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Klas:</label>
						<select class="form-control" name="klas">
							<option {{$klas == 1 ? 'selected' : 'class'}}>1</option>
							<option {{$klas == 2 ? 'selected' : 'class'}}>2</option>
							<option {{$klas == 3 ? 'selected' : 'class'}}>3</option>
							<option {{$klas == 4 ? 'selected' : 'class'}}>4</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Leerjaar</label>
						<select class="form-control" name="leerjaar">
							<option {{$leerjaar == 1 ? 'selected' : 'class'}}>1</option>
							<option {{$leerjaar == 2 ? 'selected' : 'class'}}>2</option>
							<option {{$leerjaar == 3 ? 'selected' : 'class'}}>3</option>
							<option {{$leerjaar == 4 ? 'selected' : 'class'}}>4</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>­</label>
						<button type="submit" class="btn btn-block btn-success" name="submit">Search</button>
					</div>
				</div>
			</div>
			
			
		</form>  
	</div>
</div>
@if(!empty($data[1]))
<div class="row mt-3">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header">
				<h1>Klas: {{$data[1]['klas']}}, Leerjaar: {{$data[1]['leerjaar']}}, Periode: {{$data[1]['periode']}}</h1>
			</div>
			<div class="card-body">
				<table width="100%" border="1">
					<tr>
						<td class="text-white"><b>Klas</b></td>
						<td class="text-white"><b>Vak</b></td>
						<td class="text-white"><b>Onderwerp</b></td>
						<td class="text-white"><b>Periode</b></td>
						<td class="text-white"><b>Leerjaar</b></td>
						<td class="text-white"><b>Opdracht</b></td>
					</tr>
					@foreach($data as $row)
					<tr>
						<td>{{$row['klas']}}</td>
						<td>{{$row['vak']}}</td>
						<td>{{$row['onderwerp']}}</td>
						<td>{{$row['periode']}}</td>
						<td>{{$row['leerjaar']}}</td>
						<td>{{$row['opdrachten']}}</td>
					</tr>
					@endforeach
				</table>
			</div>
			<div class="card-footer">
				<h1>ooit</h1>
			</div>
		</div>
	</div>
		
	
</div>
@endif
@endsection