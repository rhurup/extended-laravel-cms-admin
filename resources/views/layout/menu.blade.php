<div class="container-fluid">
    <div class="menu-container row">
        <div class="col-4">
            @if(App\Models\Settings\Settings::get('default.frontend_logo') !== "")
                <img src="{{env("APP_URL", "/")}}/{{App\Models\Settings\Settings::get('default.frontend_logo')}}" class="img-fluid" />
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


