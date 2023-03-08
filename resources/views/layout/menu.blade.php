<div class="container-fluid">
    <div class="menu-container row">
        <div class="col-4">
            @if(App\Models\Settings\Settings::get('default.logo') !== "")
                <img src="{{env("APP_URL")."/storage/".App\Models\Settings\Settings::get('default.logo')}}" class="img-fluid" style="max-height: 160px" />
            @endif
        </div>
        <div class="col-8">
            <nav class="navbar float-end">
                <ul id="site-top-menu" class="sf-menu sf-js-enabled sf-arrows">
                    @each('layout.menu_item', $menu, 'item')
                </ul>
            </nav>
        </div>
    </div>
</div>


