        <?php  
$date = new DateTime();
$week = $date->format("W");?>

<!DOCTYPE html>
<html>
<head>
    <title>
        
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="    sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        @if(Illuminate\Support\Facades\Auth::user()->hasRole("root"))
            <a href="/dashboard" style="">Rootpage</a>
            <a href="/cursussen" style="">cursussen</a>
            <a href="/planningen" style="">planning</a>
            <a href="/studenten" style="">Studenten</a>
            <a href="/klassen" style="">Klassen</a>
            <a href="/voortgang" style="">voortgang</a>
        @elseif(Illuminate\Support\Facades\Auth::user()->hasRole("admin"))
            <a href="/dashboard" style="">Adminpage</a>
            <a href="/cursussen" style="">cursussen</a>
            <a href="/planningen" style="">planning</a>
            <a href="/klassen" style="">Klassen</a>
            <a href="/voortgang" style="">voortgang</a>
        @elseif(Illuminate\Support\Facades\Auth::user()->hasRole("docent"))
            <a href="/dashboard">Docentpage</a>
            <a href="/cursussen" style="">cursussen</a>
            <a href="/planningen" style="">planning</a>
            <a href="/klassen" style="">Klassen</a>
            <a href="/voortgang" style="">voortgang</a>
        @elseif(Illuminate\Support\Facades\Auth::user()->hasRole("student"))
            <a href="/dashboard">Studentenpage</a>
            <a href="/cursussen" style="">cursussen</a>
            <a href="/planningen" style="">planning</a>
        @endif
        <a href="" class="fixed-bottom">{{Auth::user()->name}} - <i class="fas fa-user"></i></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log out') }}
            </x-dropdown-link>
        </form>
    </div>
    
    <div style="margin-left: 8px; font-size: 200%;">
        <span onclick="openNav()"><i class="fas fa-bars"></i></span>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 offset-md-2">
            <div class="container-fluid content-background d-flex flex-column">
                <div class="row">
                    <div class="col-md-12">
                       @yield('content')
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function loadNav() {
    $(".sidenav").css("transition", "0.0s")
    if($(".sidenav").css("width") == "0px") {
        $(".sidenav").css("width", "250px");
        setTimeout(
            function(){
                $(".sidenav").css("transition", "0.5s")
            }, 500);
    }
}
</script>

<script type="text/javascript">
    $(".card").hover(function() {
        $(this).css("box-shadow", "0px 0px 5px 2px #000000");
    }, function() {
        $(this).css("box-shadow", "none");
    })

</script>
</body>
</html>