@extends('layouts.master')

@section('content')
@foreach($ar as $a)
<h3>
    $a->$e_id
</h3>
<br />
<h3>
    $a->$e_pass
</h3>
@endforeach
@endsection
