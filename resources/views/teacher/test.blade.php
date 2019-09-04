@extends('teacher.layouts.layout')

@section('content')
    <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <label for="uploadFile">Upload Your File</label>
        <input type="file" name="filew" id="uploadFile">
        <button type="submit">Upload</button>
    </form>    
@endsection