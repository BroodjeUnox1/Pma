@extends('layouts.basic')
@section('content')

<!-- check voor selected of die mee gegeven is wat alleen gedaan word bij een search -->
@php
if(!isset($selected)){
	$selected = 1;
}
@endphp

<div class="row">
	<div class="col-md-10 text-center">
		<h1>Voortgang</h1>
	</div>
	<div class="col-md-2">
		<a href="/voortgang"><h1>terug</h1></a>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-8 offset-md-2">
		<form action="/voortgang/{{$id}}" method="POST">
			<input type="hidden" name="option" value="1">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<label>Periode:</label>
					<select name="periode" class="form-control">
						<option value="1" {{$selected == 1 ? 'selected' : 'class'}}>1</option>
						<option value="2" {{$selected == 2 ? 'selected' : 'class'}}>2</option>
						<option value="3" {{$selected == 3 ? 'selected' : 'class'}}>3</option>
						<option value="4" {{$selected == 4 ? 'selected' : 'class'}}>4</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>­</label>
					<button class="btn btn-success btn-block" type="submit">zoek</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- check voor als het niet leeg is dan pas displayen -->
@if(!$cursus->isEmpty())
<div class="row">
	@foreach($cursus as $row)
		@php
			$data = json_decode($row["opdrachtlist"]);
			$i = 1;
		@endphp
		<div class="col-md-12" >
			<div class="row mt-5 rounded mx-2"style="background: #F5F5F5;">
				<div class="col-md-12">
					<h1>{{$row['vak']}}</h1>
				</div>
				<div class="col-md-4 form-group">
					<label>Onderwerp: </label>
					<input class="form-control" value="{{$row['onderwerp']}}" disabled=""></input>
				</div>
				<div class="col-md-4 form-group">
					<label>Opdracht:</label>
					<input class="form-control" value="{{$row['opdrachten']}}" disabled=""></input>
				</div>
				
				<div class="col-md-4 form-group">
					<label>Info: </label>
					<input class="form-control" value="{{$row['info']}}" disabled=""></input>
				</div>
				@foreach($data as $row2)
				<div class="col-md-6 form-group">
					<label>les {{$i}}:</label>
					<input class="form-control" value="{{$row2}}" disabled=""></input>
				</div>
				<div class="col-md-6 form-group">
					<label>voortgang</label>
					<select class="form-control" name="progressie" id="{{$row['id']}}{{$i}}" style="color: red;" disabled="">
						<option value="Niet af" style="color: red;">Niet af</option>
						<option value="Bijna af" style="color: orange;">Bijna af</option>
						<option value="Af" style="color: green;">Af</option>
					</select>
				</div>
				@php
					$i += 1;
				@endphp
				@endforeach
			</div>
		</div>
	@endforeach
</div>

<!-- vul alles in en geef kleuren code -->
@foreach($progress as $row)
<script type="text/javascript">
	$("select#{{$row['crusus_id']}}{{$row['vak_id']}}.form-control option[value='{{$row['beoordeling']}}']").attr('selected', 'selected')
	

	if("{{$row['beoordeling']}}" == 'Af'){
		$("select#{{$row['crusus_id']}}{{$row['vak_id']}}.form-control").css('color', 'green')
	}else if("{{$row['beoordeling']}}" == 'Bijna af'){
		$("select#{{$row['crusus_id']}}{{$row['vak_id']}}.form-control").css('color', 'orange')
	}else {
		$("select#{{$row['crusus_id']}}{{$row['vak_id']}}.form-control").css('color', 'red')
	}
</script>

@endforeach


<div class="row mt-3">
	<div class="col-md-12 text-center">
		<h1>feedback</h1>
	</div>
</div>
<hr>
<form method="POST" action="/voortgang/{{$id}}">
	@csrf
	<input type="hidden" name="option" value="0">
	<input type="hidden" name="user" value="{{$id}}">
	<input type="hidden" name="periode" value="{{$cursus[1]['periode']}}">
	<div class="col-md-8 offset-md-2">
	    <div class="col-md-12">
	    	@php
	    	$user = App\Models\user::find($id)['name'];
	    	@endphp
	    	<!-- {{$feedback['feedback']}} -->
	    	<textarea name="feedback" id="" rows="10" class="form-control" placeholder="{{isset($feedback) ? $feedback['feedback']: 'Geef feedback aan ' . $user}}" required=""></textarea>
	    </div>
	    <div class="col-md-12">
	    	<button class="btn btn-block btn-success" type="submit">Geef feedback</button>
	    </div>
	</div>
</form>
<!-- else voor als er geen data is -->
@else

<div class="alert alert-danger mt-5" role="alert">
  	Geen data gevonden voor deze student, probeer een andere periode.
</div>

@endif
@endsection

