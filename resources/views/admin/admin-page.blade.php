@extends('layouts.basic')
@section('content')
<div class="row mt-5">
	<div class="col-md-10 offset-md-2">
		<small><?php $timestamp = time(); setlocale(LC_ALL, 'nl_NL'); echo strftime('%d %B, %Y', $timestamp);?></small>
	</div>
	<div class="col-md-10 offset-md-2">
		<h1>Welkom: {{Illuminate\Support\Facades\Auth::user()['name']}}</h1>
	</div>
	<div class="col-md-12 text-center mt-5">
		<img src="./images/loginlogo.png">
	</div>
</div>
@endsection