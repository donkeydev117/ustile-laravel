@extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php renderProjects($projects); ?>
        </div>
    </div>
</div>

   
@endsection
@section('script')
@endsection