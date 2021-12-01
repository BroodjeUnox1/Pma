@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h1>Planningen</h1>
	</div>
</div>
<hr>

<div class="row mt-5">
	<div class="col-md-6 offset-md-3">
		<!-- check voor of die niet een student is laat andere dingen zien -->
		@if(!Illuminate\Support\Facades\Auth::user()->hasRole("student"))
		<form method="POST" action="planningen">
			@csrf
			<div class="row">
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
		@else
		<!-- als hij of zij een student is laar alleen periode selector zien -->
		<form method="POST" action="planningen">
			@csrf
			<div class="row">
				<div class="col-md-10">
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
				<div class="col-md-2">
					<div class="form-group">
						<label>­</label>
						<button type="submit" class="btn btn-block btn-success" name="submit">Search</button>
					</div>
				</div>
			</div>
			
			
		</form>

		@endif 
	</div>
</div>

<!-- check of data niet leeg is is die leeg laat niks zien -->
@if(!empty($data))
<div class="row mt-3">
	<div class="col-md-12">
		<table width="100%" border="1" class="table table-striped" id="table">
			<thead>
				<tr>
					<td class="text-white"><b>Klas</b></td>
					<td class="text-white"><b>Vak</b></td>
					<td class="text-white"><b>Onderwerp</b></td>
					<td class="text-white"><b>Periode</b></td>
					<td class="text-white"><b>Leerjaar</b></td>
					<td class="text-white"><b>Opdracht</b></td>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $row)
				<tr class="{{$row['id']}}">
					<td>{{$row['klas']}}</td>
					<td><a href="planningen/{{$row['id']}}">{{$row['vak']}}</a></td>
					<td>{{$row['onderwerp']}}</td>
					<td>{{$row['periode']}}</td>
					<td>{{$row['leerjaar']}}</td>
					<td>{{$row['opdrachten']}}</td>
				</tr>	
				@endforeach
			</tbody>
			
		</table> 
	</div>
</div>
@endif
@if(Illuminate\Support\Facades\Auth::user()->hasRole("student"))
<textarea class="form-control mt-5" placeholder="{{empty($feedback) ? 'nog geen feedback' : $feedback['feedback']}}" disabled=""></textarea>
@endif

<script>
	$(document).ready(function(){
        $('#table').DataTable()        
    })
</script>
@endsection

