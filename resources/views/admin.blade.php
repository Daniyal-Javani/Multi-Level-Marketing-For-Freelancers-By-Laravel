@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Submit invoice</div>
                <div class="panel-body">
                    {!! Form::model($invoice = new App\Invoice ,['url' => 'admin']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::input('text', 'name', $invoice->name, ['class' => 'form-control', 'value' => old('name')]) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            {!! Form::label('amount', 'Amount:') !!}
                            {!! Form::input('text', 'amount', $invoice->amount, ['class' => 'form-control', 'value' => old('amount')]) !!}
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('submit', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection