@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Edit Team</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Edit Team</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form action="{{ route('admin/team-update',$team->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div>
                    <label for="crud-form-1" class="form-label">Name</label>
                    <input id="crud-form-1" type="text" name="name" class="form-control w-full" value="{{ ucwords($team->name) }}" placeholder="Input text">
                    @if ($errors->has('name'))
                    {{ $errors->first('name')}}
                @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Match Played</label>
                    <div class="input-group">
                        <input id="crud-form-3" name="match_played" type="text" class="form-control" value="{{ ucwords($team->match_played) }}" placeholder="Quantity" aria-describedby="input-group-1">
                    </div>
                    @if ($errors->has('match_played'))
                        {{ $errors->first('match_played')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-4" class="form-label">Win</label>
                    <div class="input-group">
                        <input id="crud-form-4" type="text" name="win" class="form-control" value="{{ ucwords($team->win) }}" placeholder="Weight" aria-describedby="input-group-2">
                    </div>
                    @if ($errors->has('win'))
                        {{ $errors->first('win')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-4" class="form-label">Loss</label>
                    <div class="input-group">
                        <input id="crud-form-4" type="text" name="loss" class="form-control" value="{{ ucwords($team->loss) }}" placeholder="Weight" aria-describedby="input-group-2">
                    </div>
                    @if ($errors->has('loss'))
                        {{ $errors->first('loss')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Staus</label>
                    <select data-placeholder="Select any option" name="status" class="tom-select w-full" id="crud-form-2">
                        <option value="active" {{ $team->status == 'active' ? 'selected' :"" }}>Active</option>
                        <option value="inactive" {{ $team->status == 'inactive' ? 'selected' :"" }}>Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                        {{ $errors->first('status')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label>Logo</label>
                    <div class="mt-2">
                      <input type="file" name="logo" id="logo">
                      <br><br>
                      <img src="{{asset('storage/images/team_logo/'.$team->logo)}}" alt="" height="50px" width="100px">
                    </div>
                    @if ($errors->has('logo'))
                        {{ $errors->first('logo')}}
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
