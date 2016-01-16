@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Submit invoice</div>
                <div class="panel-body">
                    {!! Form::model($invoice = new App\Invoice ,['url' => 'admin']) !!}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Username:') !!}
                            {!! Form::input('text', 'username', $invoice->name, ['class' => 'form-control', 'value' => old('username')]) !!}
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>

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
                        <div class="panel panel-default">
                <div class="panel-heading">Last Invoices</div>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                            <tbody>
                            @foreach ($invoices as $invoice_record)
                                <tr>
                                    <td>{{$invoice_record->name}}</td>
                                    <td>{{$invoice_record->amount}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection