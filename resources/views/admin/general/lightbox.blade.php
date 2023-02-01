
{{--<div class="parent-container">--}}
{{--    <a href="#" id="triggerModal" data-uk-modal="{target:'#modal_lightbox{{$object->id}}'}" class="user_action_image">--}}
{{--        <img class="img-circle width-1"--}}
{{--             src="{{asset($object->thumbnail_path)}}"--}}
{{--             alt=""/>--}}
{{--    </a>--}}
{{--</div>--}}
<a class="example-image-link" href="{{asset($object->image_path)}}" data-lightbox="example-{{$object->id}}" data-title="{{$object->company_name}}">
    <img class="md-user-image" src="{{asset($object->thumbnail_path)}}" alt="{{$object->company_name}}"/>
</a>


{{--<div class="uk-modal" id="modal_lightbox{{$object->slug}}">--}}
{{--    <div class="uk-modal-dialog uk-modal-dialog-lightbox">--}}
{{--        <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>--}}
{{--        <img src="{{asset($object->image_path)}}" alt=""/>--}}
{{--        <div class="uk-modal-caption">{!! $object->description !!}</div>--}}
{{--    </div>--}}
{{--</div>--}}
