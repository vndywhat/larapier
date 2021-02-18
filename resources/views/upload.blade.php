@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="file" name="document">
                    <button class="btn btn-success" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
