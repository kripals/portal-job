@if(!empty($optional2MenuRoute))
    @if($optional2MenuText == 'resume')
        <a href="{{$optional2MenuRoute}}" target="_blank"><button type="button" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top"
                    data-original-title="Manage"><i class="fa fa-file"></i></button></a>
    @else
        <a href="{{$optional2MenuRoute}}"><button type="button" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top"
                    data-original-title="Manage"><i class="fa fa-cogs"></i></button></a>
    @endif
@endif
@if(!empty($optionalMenuRoute))
    <a href="{{$optionalMenuRoute}}" target="_blank"><button type="button" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top"
                data-original-title="Manage"><i class="fa fa-eye"></i></button></a>
@endif
@if(!empty($editRoute))
    <a href="{{$editRoute}}"><button type="button" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top"
                data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
@endif
@if(!empty($deleteRoute))
    <button type="button" class="btn btn-icon-toggle item-delete" data-toggle="tooltip" data-placement="top"
            data-original-title="Delete row" data-url="{{$deleteRoute}}"><i class="fa fa-trash-o"></i></button>
@endif
