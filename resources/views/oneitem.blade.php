@extends('layouts.basic')
@section('content')

@if(!empty($cursus))
<!-- decode de json zodat het bewerk baar is als een array -->
@php
$data = json_decode($cursus["opdrachtlist"]);
@endphp
<div class="row">
	<div class="col-md-10 text-center">
		<h1>Opdrachten</h1>
	</div>
	<div class="col-md-2">
			<a href="/planningen"><h1>Terug</h1></a>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-10 offset-md-1 mt-3">
			<div class="row">
				<div class="col-md-6">	
					<div class="form-group">
						<label>Vak:</label>
						<input type="text" name="vak" required="" class="form-control" value="{{$cursus['vak']}}" disabled="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Onderwerp:</label>
						<input type="text" name="onderwerp" required="" class="form-control" value="{{$cursus['onderwerp']}}" disabled="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Opdrachten:</label>
						<input type="text" name="opdrachten" required="" class="form-control" value="{{$cursus['opdrachten']}}" disabled="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Extra info:</label>
						<input type="text" name="info" required="" class="form-control" value="{{$cursus['info']}}" disabled="">
					</div>
				</div>
				
			</div>
			<div class="row">
			<!-- set de value i zodat ik weet voor welke vak ik hem update -->
			@php
			$i = 1;
			@endphp
			<!-- output elke opdracht voor dit vak -->
			@foreach($data as $row)
			<form action="" method="POST" class="col-md-12">
				@csrf
				<div class="row">
					@if(Illuminate\Support\Facades\Auth::user()->hasRole("student"))
					<div class="col-md-6 form-group">
						<label>Les {{$i}}:</label>
						<input type="txt" name="" value="{{$row}}" class="form-control" disabled="">
					</div>
					
					<div class="col-md-3 form-group">
						<label>Af tot:</label>
						<select class="form-control" name="progressie" id="{{$i}}" style="color: red;">
							<option value="Niet af" style="color: red;">Niet af</option>
							<option value="Bijna af" style="color: orange;">Bijna af</option>
							<option value="Af" style="color: green;">Af</option>
						</select>
					</div>
					<input type="hidden" name="vak_id" value="{{$i}}">
					<div class="col-md-3">
						<label>­</label>
						<button class="btn btn-block btn-success" type="submit" id="{{$i}}">Update</button>
					</div>
					@else
					<div class="col-md-6 form-group">
						<label>Les {{$i}}:</label>
						<input type="txt" name="" value="{{$row}}" class="form-control" disabled="">
					</div>
					@endif
				</div>
			</form>
			<!-- Plus 1 zodat voor elk nieuwe vak een specifiek id heeft -->
			@php
			$i += 1;
			@endphp
			@endforeach	
			</div>
		</div>

</div>

@foreach($progress as $row)
<script type="text/javascript">
	$("select#{{$row['vak_id']}}.form-control option[value='{{$row['beoordeling']}}']").attr('selected', 'selected')
	if("{{$row['beoordeling']}}" == 'Af'){
		$("select#{{$row['vak_id']}}.form-control ").css('color', 'green')
	}else if("{{$row['beoordeling']}}" == 'Bijna af'){
		$("select#{{$row['vak_id']}}.form-control").css('color', 'orange')
	}else {
		$("select#{{$row['vak_id']}}.form-control").css('color', 'red')
	}
</script>

@endforeach
@else
<div class="alert alert-danger mt-5" role="alert">
  	Geen data bij dit ID probeer een andere.
</div>
@endif

@endsection