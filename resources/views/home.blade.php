@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tree</div>

                <div class="panel-body">
                    <ul style="list-style-type:disc">
                        <li>
                            {{$root->name}}
                            <ul>
                                @if (! empty($root->childs))
                                    @foreach ($root->childs as $person1)
                                        <li>
                                            {{ $person1->name }}
                                        </li>

                                         <ul style="list-style-type:square">
                                             @if (! empty($person1->childs))
                                                @foreach ($person1->childs as $person2)
                                                    <li>
                                                        {{ $person2->name }}
                                                    </li>
                                                @endforeach
                                             @endif
                                        </ul>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
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
