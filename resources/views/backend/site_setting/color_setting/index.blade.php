@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Winner</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Color Setting</h2>

    <div class="grid grid-cols-12 gap-6 mt-5 p-5 bg-white">
        
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center whitespace-nowrap">#</th>
                        <th class="text-center whitespace-nowrap">Section</th>
                        <th class="text-center whitespace-nowrap">Header Color</th>
                        <th class="text-center whitespace-nowrap">Text Color</th>
                        <th class="text-center whitespace-nowrap">Button Color</th>
                        <th class="text-center whitespace-nowrap">Background Color</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <p style="display:none;"> {{ $count = 1 }}</p>

                    @foreach ($color_setting as $color)
                        <tr class="intro-x">
                            <td> {{ $count++ }}</td>
                            <td class="text-center whitespace-nowrap">{{ ucfirst($color["section"]) }}</td>
                            <td class="text-center whitespace-nowrap"><span class="showcolor" style="background-color:{{ $color["header_color"] }}; "></span></td>
                            <td class="text-center whitespace-nowrap"><span class="showcolor" style="background-color:{{ $color["text_color"] }}; "></span></td>
                            <td class="text-center whitespace-nowrap"><span class="showcolor" style="background-color:{{ $color["button_color"] }}; "></span></td>
                            <td class="text-center whitespace-nowrap"><span class="showcolor" style="background-color:{{ $color["bg_color"] }}; "></span></td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ url('admin/edit_color/'.$color["id"]) }}">
                                        <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process
                            cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
    <style type="text/css">
    .showcolor {
    width: 20px;
    height: 20px;
    display: flex;
    border-radius: 50%;
    border: 1px solid #c4c4c4;
}
      </style>
@endsection