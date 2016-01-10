@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tree</div>

                <div class="panel-body">
                    @foreach ($down_line as $person)
                        {{ $person->name }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
