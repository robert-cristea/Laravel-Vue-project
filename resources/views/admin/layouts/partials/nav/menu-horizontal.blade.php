@php
    $auth_role = Auth::user()->role;
@endphp
<ul class="header-nav onemore">
    @foreach(config('menu.horizontal') as $menu)
        @if (($auth_role == 'auditor' || $auth_role == 'concessionaire') && $menu['title'] != 'Assessment' && $menu['title'] != 'Settings')
            @continue
        @endif
        <li class="{{set_active($menu['active'],'active')}}  @if(isset($menu['children'])) has-child @endif">
            <a href="{{url($menu['link'])}}" @if(isset($menu['children'])) data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif><i class="{{$menu['icon']}}"></i> 
                @if(trim($menu['title']) == 'Auditors')
                    Assessor
                @else 
                    {{$menu['title']}}
                @endif
            </a>
            @if(isset($menu['children']))
                <div class="dropdown-menu">
                    @foreach($menu['children'] as $child)
                        @if (($auth_role == 'auditor' || $auth_role == 'concessionaire') && $child['title'] != 'Logout')
                            @continue
                        @endif
                        <div class="@if(isset($child['children']))dropdown-submenu @endif">
                            <a class="dropdown-item  @if(isset($child['children'])) dropdown-subitem @endif" href="{{url($child['link'])}}">{{$child['title']}}</a>
                            @if(isset($child['children']))
                                <div class="dropdown-menu">
                                    @foreach($child['children'] as $subchild)
                                        <a class="dropdown-item" href="{{url($subchild['link'])}}">{{$subchild['title']}}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </li>
    @endforeach
</ul>

<ul class="header-nav-right">
    <li>
        @if (Auth::user()) 
        {{ ucfirst(Auth::user()->role.' | '.Auth::user()->name) }}
        @endif
    </li>
</ul>
<div class="clearfix"></div>