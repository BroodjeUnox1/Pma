
@extends('layouts.basic')
@section('content')
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Maak cursussen</h1>
	</div>
	<div class="col-md-2">
		<a href="/cursussen"><h1>Terug</h1></a>
	</div>
</div>
<hr>
<!-- title -->
<form method="POST" action="create-cursus">
	@csrf
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="row">
				<div class="col-md-4">	
					<div class="form-group">
						<label>Vak:</label>
						<input type="text" name="vak" required="" placeholder="Vak" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Onderwerp:</label>
						<input type="text" name="onderwerp" required="" placeholder="Onderwerp" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Klas:</label>
						<input type="text" name="klas" required="" placeholder="Klas" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Periode:</label>
						<input type="text" name="periode" required="" placeholder="Periode" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Leerjaar:</label>
						<input type="text" name="leerjaar" required="" placeholder="leerjaar" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Opdracht:</label>
						<input type="text" name="opdrachten" required="" placeholder="Opdracht" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Extra info:</label>
						<input type="text" name="info" required="" placeholder="Extra info" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-block btn-success" type="submit" name="submit">Maak</button>
					</div>
				</div>
				<div class="col-md-12 addopdracht">
					<div class="form-group 1" id="1">
						<label>Les 1:</label>
						<input type="text" name="opdracht1" placeholder="Opdracht" class="form-control" required="">
					</div>
				</div>
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
		var last = $(".addopdracht .form-group").last().attr("id")
		console.log(last)
		last = parseInt(last) + 1
		$(".addopdracht").append("<div class='form-group' id='"+ last +"'><label>les: "+ last + ":</label><input type='text' name='opdracht"+last+"' placeholder='Opdracht' class='form-control' required=''></div>") 
	}

	function remove() {
		var last = $(".addopdracht .form-group").last()
		if(last.attr('id') != 1){
			last.remove();
		}
		
	}
</script>

@endsection
