@extends('layouts.master')
@section('content')
<div>
    <form-component form_id="{{ $form->id }}"></form-component>
</div>
@endsection

@push('scripts-end')
<script>
    $(document).ready(function() {
        // console.log("Hi There");
    });
</script>
@endpush