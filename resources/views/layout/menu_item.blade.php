@if($item['roles'] && \Illuminate\Support\Facades\Auth::user())
    @if(\Illuminate\Support\Facades\Auth::user()->hasRoleIds(collect($item['roles'])->pluck("id")->toArray()))
        @if(!isset($item['children']))
            <li class="sf-li">
                <a href="{{ url($item['uri']) }}">
                    <span class="menu-title-text">{{ $item['title'] }}</span>
                    <span class="underline"></span>
                </a>
            </li>
        @else
            <li class="sf-li parent">
                <a href="{{ url($item['uri']) }}" class="sf-with-ul">
                    <span class="menu-title-text">{{ $item['title'] }}</span>
                    <span class="sf-sub-indicator"><i class="fa-solid fa-angle-down"></i></span>
                    <span class="underline"></span>
                </a>

                <ul class="sub-menu" style="display: none;">
                    @foreach($item['children'] as $item)
                        @include('layout.menu_item', $item)
                    @endforeach
                </ul>
            </li>
        @endif
    @endif
@elseif($item['roles'] && !\Illuminate\Support\Facades\Auth::user())
    @if(in_array(\App\Models\Settings\Settings::get('default.public_user_role'), collect($item['roles'])->pluck("id")->toArray()))
        @if(!isset($item['children']))
            <li class="sf-li">
                <a href="{{ url($item['uri']) }}">
                    <span class="menu-title-text">{{ $item['title'] }}</span>
                    <span class="underline"></span>
                </a>
            </li>
        @else
            <li class="sf-li parent">
                <a href="{{ url($item['uri']) }}" class="sf-with-ul">
                    <span class="menu-title-text">{{ $item['title'] }}</span>
                    <span class="sf-sub-indicator"><i class="fa-solid fa-angle-down"></i></span>
                    <span class="underline"></span>
                </a>

                <ul class="sub-menu" style="display: none;">
                    @foreach($item['children'] as $item)
                        @include('layout.menu_item', $item)
                    @endforeach
                </ul>
            </li>
        @endif
    @endif
@else
    @if(!isset($item['children']))
        <li class="sf-li">
            <a href="{{ url($item['uri']) }}">
                <span class="menu-title-text">{{ $item['title'] }}</span>
                <span class="underline"></span>
            </a>
        </li>
    @else
        <li class="sf-li parent">
            <a href="{{ url($item['uri']) }}" class="sf-with-ul">
                <span class="menu-title-text">{{ $item['title'] }}</span>
                <span class="sf-sub-indicator"><i class="fa-solid fa-angle-down"></i></span>
                <span class="underline"></span>
            </a>

            <ul class="sub-menu" style="display: none;">
                @foreach($item['children'] as $item)
                    @include('layout.menu_item', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif

