@extends('student.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        welcome
                        <br>
                        @role('student')
                        You are logged in as student!

                        @endrole

                        @role('parent')
                        You are logged in as parent!
                        @endrole

                        
    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
