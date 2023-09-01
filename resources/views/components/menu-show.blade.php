<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        @foreach($menu as $sub_menu)
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="{{ $sub_menu['icon'] }}"></i>
                <span>{{ $sub_menu['title'] }}</span>
            </a>
            <ul class="sub-menu">
                
                @isset($sub_menu['links'])
                    @foreach($sub_menu['links'] as $sub_menu2)                                    
                    <li>
                        @isset($sub_menu2['links'])
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="{{ $sub_menu2['icon'] }}"></i>
                                <span>{{ $sub_menu2['title'] }}</span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($sub_menu2['links'] as $sub_menu3)                                                
                                <li>
                                    <a href="{{ $sub_menu3['url'] }}" class="{{ $sub_menu3['is_active'] ? 'active' : '' }}">
                                        <i class="{{ $sub_menu3['icon'] }}"></i>
                                        <span>{{ $sub_menu3['title'] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endisset
                        @isset($sub_menu2['url'])                                                            
                            <a href="{{ $sub_menu2['url'] }}" class="{{ $sub_menu2['is_active'] ? 'active' : '' }}">
                                <i class="{{ $sub_menu2['icon'] }}"></i>
                                <span>{{ $sub_menu2['title'] }}</span>
                            </a>                            
                        @endisset                            
                                        
                    </li>
                    @endforeach 
                    
                @endisset
                @isset($sub_menu['url'])                    
                    <a href="{{ $sub_menu['url'] }}" class="$sub_menu['is_active'] ? 'active' : '' }}">
                        <i class="{{ $sub_menu['icon'] }}"></i>
                        <span>{{ $sub_menu['title'] }}</span>
                    </a>
                @endisset
                </li>
            </ul>
        </li>
        @endforeach
        <li>        
    </ul>
</div>