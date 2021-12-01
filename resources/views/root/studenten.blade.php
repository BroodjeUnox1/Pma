@extends('layouts.basic')
@section('content')
<div class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <a onclick="$('.modal').toggle()"><i class="far fa-window-close"></i></a>
            </div>
            <form action="studenten" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="option" value="1">
                        <div class="col-md-6 form-group">
                            <label>Id:</label>
                            <input type="text" name="id" id="edit-id" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Name:</label>
                            <input type="text" name="name" id="edit-name" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Klas:</label>
                            <input type="text" name="klas" id="edit-klas" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Leerjaar: </label>
                            <input type="text" name="leerjaar" id="edit-leerjaar" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Role: </label>
                            <select class="form-control" name="role">
                                <option value="4">Student</option>
                                <option value="3">Docent</option>
                                <option value="2">Admin</option>
                                <option value="1">Root</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" onclick="$('.modal').toggle()">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <h1>Beheer studenten</h1>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <table border="1" class="table table-striped" id="table" style="width: 100% !important;">
        <thead>
            <tr>
                <td style="color: white;"><b>Id</b></td>
                <td style="color: white;"><b>Naam</b></td>
                <td style="color: white;"><b>Klas</b></td>
                <td style="color: white;"><b>Leerjaar</b></td>
                <td width="10%" style="color: white;"><b>Update</b></td>
                <td width="10%" style="color: white;"><b>Delete</b></td>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{$row['id']}}</td>
            <td>{{$row['name']}}</td>
            <td>{{$row['klas']}}</td>
            <td>{{$row['leerjaar']}}</td>
            <td width="10%">
                <button 
                    class="btn btn-info btn-block" 
                    data-id="{{$row['id']}}"
                    data-naam="{{$row['name']}}"
                    data-klas="{{$row['klas']}}"
                    data-leerjaar="{{$row['leerjaar']}}" onclick="test(this)">   
                    Update
                </button>
            </td>
            <td width="10%">
                <form action="studenten" method="POST">
                    @csrf
                    <input type="hidden" name="option" value="0">
                    <input type="hidden" name="id" value="{{$row['id']}}">
                    <button class="btn btn-danger btn-block" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>    
        @endforeach
        </tbody>
    </table>
    </div>
<!--     @foreach($data as $row)
    <div class="col-md-3">
        <div class="card mt-3">
            <div class="card-header">
                <h1>{{$row["id"]}}</h1>
            </div>
            <div class="card-body">
                <h1>{{$row["name"]}}</h1>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-info"><a href="/update-studenten/{{$row['id']}}" class="text-white">update</a>
                </button>
            </div>
        </div>
    </div>
    @endforeach -->
</div>

<script type="text/javascript">
    function test(data) {
        $('#edit-id').attr('value',data.getAttribute("data-id"))
        $('#edit-name').attr('value',data.getAttribute("data-naam"))
        $('#edit-klas').attr('value',data.getAttribute("data-klas"))
        $('#edit-leerjaar').attr('value',data.getAttribute("data-leerjaar"))
        $(".modal").toggle()
    }

    $(document).ready(function(){
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ]
        })        
    });
 </script>
    
@endsection
