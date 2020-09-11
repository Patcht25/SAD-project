@extends('layouts.app')

@push('scripts')
{{-- JQuery Import for Javascript --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" src="{{asset('createSystem.css')}}">
@endpush

@section('content')

	{{-- Code If Errors are found in the validation of the data --}}
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<h1>Assign System to {{$computer->pc_name}}</h1>

	<form id="assignSystemForm" action="/computers/assign_system/{{$computer->id}}" method="POST">
		@csrf
		<select name="motherboard_id" class="custom-select" required>
			<option  value="">Select Motherboard...</option>
			@foreach( $motherboards as $motherboard )
				<option  value="{{$motherboard->id}}">{{$motherboard->component_name}}</option>
			@endforeach
		</select>

		<select name="processor_id" class="custom-select" required>
			<option value="">Select Processor...</option>
			@foreach( $cpus as $cpu )
				<option value="{{$cpu->id}}">{{$cpu->component_name}}</option>
			@endforeach
		</select>

		<select name="gpu_id" class="custom-select" required>
			<option value="">Select Graphics Card...</option>
			@foreach( $gpus as $gpu )
				<option value="{{$gpu->id}}">{{$gpu->component_name}}</option>
			@endforeach
		</select>

		<select name="operating_system_id" class="custom-select" required>
			<option value="">Select Operating System...</option>
			@foreach( $operatingSystems as $os )
				<option value="{{$os->id}}">{{$os->name}}</option>
			@endforeach
		</select>

		<div id="ramDiv" class="d-flex">
			<select name="ram_id" class="custom-select" required>
				<option value="">Select RAM...</option>
				@foreach( $rams as $ram )
					<option value="{{$ram->id}}">{{$ram->component_name}}</option>
				@endforeach
			</select>
		</div>

		<div id="storageDiv" class="d-flex">
			<select name="storage_id" class="custom-select" required>
				<option value="">Select Storage...</option>
				@foreach( $storages as $storage )
					<option value="{{$storage->id}}">{{$storage->component_name}}</option>
				@endforeach
			</select>
		</div>

		<input type="hidden" name="additionalRAM" value="" id="additionalRAM" value="">
		<input type="hidden" name="additionalStorage" value="" id="additionalStorage" value="">

		<a href="/computers" class="btn btn-danger">Back</a>
		<button type="submit" class="btn btn-primary">Assign System</button>
	</form>

	{{-- Add script to handle the new department thing --}}
	<script src="{{asset('js/createSystem.js')}}"></script>

@endsection