@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Edit Season</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit Season</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form action="{{ route('season.update',$season->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div>
                    <label for="crud-form-1" class="form-label">Name</label>
                    <input id="crud-form-1" type="text" name="name" class="form-control w-full" value="{{ ucwords($season->season_name) }}" placeholder="Input text">
                    @if ($errors->has('name'))
                    {{ $errors->first('name')}}
                @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Start Date</label>
                    <div class="input-group">
                        <input id="crud-form-3" name="starting" type="date" class="form-control" value="{{ $season->starting }}" placeholder="Quantity" aria-describedby="input-group-1">
                    </div>
                    @if ($errors->has('starting'))
                        {{ $errors->first('starting')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-4" class="form-label">End Date</label>
                    <div class="input-group">
                        <input id="crud-form-4" type="date" name="ending" class="form-control" value="{{ $season->ending }}" placeholder="Weight" aria-describedby="input-group-2">
                    </div>
                    @if ($errors->has('ending'))
                        {{ $errors->first('ending')}}
                    @endif
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-24">Save</button>
                </div>
            </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection
