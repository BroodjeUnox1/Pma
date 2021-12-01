@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Update Cursus: {{$info["name"]}}</h1>
	</div>
	<div class="col-md-2">
		<a href="/cursussen"><h1>terug</h1></a>
	</div>
</div>
<hr>

<form method="POST" action="create-cursus">
	@csrf
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="row addopdracht">
				<div class="col-md-4">	
					<div class="form-group">
						<label>Vak:</label>
						<input type="text" name="vak" required="" placeholder="Vakken" class="form-control" value="{{$info['vak']}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Onderwerp:</label>
						<input type="text" name="onderwerp" required="" placeholder="Onderwerp" class="form-control" value="{{$info['onderwerp']}}">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Klas:</label>
						<input type="text" name="klas" required="" placeholder="Klas" class="form-control" value="{{$info['klas']}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Periode:</label>
						<input type="text" name="periode" required="" placeholder="Periode" class="form-control" value="{{$info['periode']}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Leerjaar:</label>
						<input type="text" name="leerjaar" required="" placeholder="leerjaar" class="form-control" value="{{$info['leerjaar']}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Opdrachten:</label>
						<input type="text" name="opdrachten" required="" placeholder="Opdrachten" class="form-control" value="{{$info['opdrachten']}}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Extra info:</label>
						<input type="text" name="info" required="" placeholder="Extra info" class="form-control" value="{{$info['info']}}">
					</div>
				</div>
				<input type="hidden" name="id" value="{{$info['id']}}">
				<div class="col-md-12 mt-3">
					<div class="form-group">
						<button class="btn btn-block btn-success" type="submit" name="submit">Update</button>
					</div>
				</div>
				@php
				$data = json_decode($info['opdrachtlist']);
				$i=1;
				@endphp

				@foreach($data as $row)
				<div class="col-md-12 mt-3" id="{{$i}}">
					<label>Les: {{$i}}</label>
					<input type="text" name="opdracht{{$i}}" value="{{$row}}" class="form-control">
				</div>
				@php
				$i +=1;
				@endphp
				@endforeach
				
			</div>

		</div>
	</div>
	
</form>
<div class="row">
	<div class="col-md-3 offset-md-2">
		<button class="btn btn-block btn-success" onclick="add()">Voeg een les toe</button>
	</div>
	<div class="col-md-3 offset-md-2">
		<button class="btn btn-block btn-danger" onclick="remove()">Verwijder les</button>
	</div>

</div> 

<!-- simpele script voor voor extra opdrachten toe te voegen -->
<script type="text/javascript">
	function add() {
		var last = $(".addopdracht .col-md-12").last().attr("id")
		console.log(last)
		last = parseInt(last) + 1
		$(".addopdracht").append("<div class='col-md-12 mt-3' id='"+ last +"'><label>les: "+ last + ":</label><input type='text' name='opdracht"+last+"' placeholder='Opdracht' class='form-control' required=''></div>") 
	}

	function remove() {
		var last = $(".addopdracht .col-md-12").last()
		if(last.attr('id') != 1){
			last.remove();
		}
		
	}
</script>

@endsection