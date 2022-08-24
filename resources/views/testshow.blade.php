@foreach ($tests as $test)
<h1>"{{ $test->name }}</h1>
<p>{{ $test->comment}}</p>
@endforeach