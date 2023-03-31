@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Add Team</title>
@endsection
@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Add Team</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <form action="{{ route('admin/team-create') }}" method="post" id="team-form" enctype="multipart/form-data">
                    @csrf                  
                <div>
                    <label for="crud-form-1" class="form-label">Name</label>
                    <input id="crud-form-1" type="text" name="name" class="form-control w-full" placeholder="Enter Name">
                    @if ($errors->has('name'))
                    {{ $errors->first('name')}}
                @endif
                </div>              
                <div class="mt-3">
                    <label for="crud-form-3" class="form-label">Match Played</label>             
                        <input id="crud-form-3" name="match_played" type="text" class="form-control" placeholder="Match Played" aria-describedby="input-group-1">                       
                  
                    @if ($errors->has('match_played'))
                        {{ $errors->first('match_played')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-4" class="form-label">Win</label>
                   
                        <input id="crud-form-4" type="text" name="win" class="form-control" placeholder="Win" aria-describedby="input-group-2">                       
                   
                    @if ($errors->has('win'))
                        {{ $errors->first('win')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-5" class="form-label">Loss</label>
                   
                        <input id="crud-form-5" type="text" name="loss" class="form-control" placeholder="Loss" aria-describedby="input-group-2">                        
                   
                    @if ($errors->has('loss'))
                        {{ $errors->first('loss')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Staus</label>
                    <select data-placeholder="Select any option" name="status" class="tom-select w-full" id="status">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>                       
                    </select>
                    @if ($errors->has('status'))
                        {{ $errors->first('status')}}
                    @endif
                </div>
                <div class="mt-3">
                    <label>Logo</label>
                    <div class="mt-2">
                      <input type="file" name="logo" id="logo">                      
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

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection