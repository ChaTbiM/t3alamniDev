{{-- @extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Teacher Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Teacher!
                </div>

                <div class="card-body">
                        @role('full-time')
                        You are logged in as Full time Teacher!

                        @endrole

                        @role('part-time')
                        You are logged in as Part time Teacher!
                        @endrole
    
                </div>


            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('teacher.layouts.layout')
@routes

@section('content')


{{-- <schedule-component fixed="{{$fixedSessions }}" simple="{{ $simpleSessions }}" module="{{$modules}}" id="{{$id}}" ></schedule-component> --}}
{{-- <Example></Example>
     --}}

     <div id="teacher">
{{-- <schedule-component></schedule-component> --}}

         <router-view ></router-view>
     </div>

@endsection


<script>

 
</script>