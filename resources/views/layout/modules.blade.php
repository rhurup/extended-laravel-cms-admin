@if($modules->count())
    <div class="container-fluid position-{{$position}}">
        <div class="@if((int)\App\Models\Settings\Settings::get("design.".$position."_container_fluid"))container-fluid @else container @endif position-{{$position}}">
            <div class="modules row position-{{$position}}">
                @foreach($modules as $module)
                    @include("layout.module_".$module->layout, ['module' => $module])
                @endforeach
            </div>
        </div>
    </div>
@endif

