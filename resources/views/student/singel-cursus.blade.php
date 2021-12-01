@extends('layouts.basic')
@section('content')
<div class="row">
    <div class="col-md-10 text-center">
        <h1>Cursus: {{$info["name"]}}</h1>
    </div>
    <div class="col-md-2">
        <a href="/planningen"><h1>terug</h1></a>
    </div>
</div>
<hr>
<div class="card mx-auto mt-5" style="max-height: 25rem; min-height: 21rem; max-width: 28rem;">
   <div class="card-header">
       <h4>{{$info["name"]}}</h4>
   </div>
   <div class="card-body overflow-y">
        <table style="width: 100%;" border="1">
            <tbody>
              <tr>//
                <td width="10%"></td>
                <td width="20%" style="color: white"><b>Opdrachten</b></td>
                <td style="color: white"><b>Info</b></td>
              </tr>
              @for($i=1;$i<7;$i++)
              <tr>
                <td style="color: black"><b>{{$list[$i]}}</b></td>
                <td>{{$info["num$i"]}}</td>
                <td>{{$info["info$i"]}}</td>
              </tr>
              @endfor
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <h4>Week: {{$info['week']}}</h4>
    </div>
</div>
@endsection
