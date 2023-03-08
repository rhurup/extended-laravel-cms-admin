<div class="col-sm-{{$module->sm_col}} col-md-{{$module->md_col}} col-xl-{{$module->xl_col}}">
    <div class="card border-light">
        @if($module->img)
            <img src="{{env("APP_URL")."/storage/".$module->img}}" class="card-img-top" alt="{{$module->title}}">
        @endif
        @if(trim($module->content) != "")
            <div class="card-body">
                {!! $module->content !!}
            </div>
        @endif
    </div>
</div>
