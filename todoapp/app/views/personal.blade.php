
<div>

<ul>
<p id="dbb">  </p>
<h3>Today</h3>
<form id="today">
<input type="text" name="task">
<button type="submit">Send</button>
</form>
@foreach($data as $val)

<li>{{ $val->tasks  }} </li>

@endforeach


<h3>Tomorrow</h3>
<button id="add">+++++++</button>
@foreach($data2 as $val)

<li>{{ $val->tasks  }} </li>

@endforeach
<h3>Upcoming</h3>
<button id="add">+++++++</button>
@foreach($data3 as $val)

<li>{{ $val->tasks  }} </li>

@endforeach
<h3>Someday</h3>
<button id="add">+++++++</button>
@foreach($data4 as $val)

<li>{{ $val->tasks  }} </li>

@endforeach

</ul>
<p id="puthere2"></p>
</div>
<script>
$("#today").submit(function(){
var str = $(this).serialize();
$.ajax({
type: "POST",
url: "today",
data: str,
success: function(data){
alert('done');
$('#puthere2').html(data);
window.location.reload(true);
}

});
return false;
});

</script>