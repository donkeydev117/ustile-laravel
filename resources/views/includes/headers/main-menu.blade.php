
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://127.0.0.1:8000/shop?category=#">Title Collection</a>
          <div class="dropdown-menu">
            <div class="dropdown-submenu submenu0">
              <a class="dropdown-item" href="http://127.0.0.1:8000/shop?category=1">
                <figure class="category-image">
                  <div class="hex2"></div>
                  <div class="hex">
                      <img src="/gallary/202112104256FOREST_LIANA.jpeg" />
                  </div>
                </figure>
                <div class="category-title">
                  <img src="/images/dropdown-menu-arrow-icon.png" />
                  <h4 class="text-center pt-2">Category 1</h4>
                </div>
              </a>
              <a class="dropdown-item" href="http://127.0.0.1:8000/shop?category=4">
                <figure class="category-image">
                  <div class="hex2"></div>
                  <div class="hex">
                      <img src="/gallary/202112103948ONE_COAL.jpeg" />
                  </div>
                </figure>
                <div class="category-title">
                  <img src="/images/dropdown-menu-arrow-icon.png" />
                  <h4 class="text-center pt-2">Category 2</h4>
                </div>
              </a>
              <a class="dropdown-item" href="http://127.0.0.1:8000/shop?category=2">
                <figure class="category-image">
                  <div class="hex2"></div>
                  <div class="hex">
                    <img src="/gallary/202112104256FOREST_LIANA.jpeg" />
                  </div>
                </figure>
                <div class="category-title">
                  <img src="/images/dropdown-menu-arrow-icon.png" />
                  <h4 class="text-center pt-2">Category 3</h4>
                </div>
              </a>
              <a class="dropdown-item" href="http://127.0.0.1:8000/shop?category=5">
                <figure class="category-image">
                  <div class="hex2"></div>
                  <div class="hex">
                    <img src="/gallary/202112103948ONE_COAL.jpeg" />
                  </div>
                </figure>
                <div class="category-title">
                  <img src="/images/dropdown-menu-arrow-icon.png" />
                  <h4 class="text-center pt-2">Category 4</h4>
                </div>
              </a>
              <a class="dropdown-item" href="http://127.0.0.1:8000/shop?category=5">
                <figure class="category-image">
                  <div class="hex2"></div>
                  <div class="hex">
                    <img src="/gallary/202112103948ONE_COAL.jpeg" />
                  </div>
                </figure>
                <div class="category-title">
                  <img src="/images/dropdown-menu-arrow-icon.png" />
                  <h4 class="text-center pt-2">Category 5</h4>
                </div>
              </a>
            </div>
            <div class="dropdown-all-collection-container">
              <div>
                <a href="#">View All Collections</a>
              </div>
            </div>
          </div>                  
        </li>
        @php  $temp = '0' @endphp
        
        @if(isset($header_menu->menu))
        @php $header_menu = json_decode(($header_menu->menu), true); $menuloop = 0; @endphp
        @foreach($header_menu as $menu[$menuloop])
        @if(count($menu[$menuloop]['children']) == 0)


        @php $link = '#' @endphp
        @if($menu[$menuloop]['type'] == 'exlink')
            @php $link = $menu[$menuloop]['exlink'] @endphp
        @elseif($menu[$menuloop]['type'] == 'product')
            @php $link = url('/product').$menu[$menuloop]['product'] @endphp
        @elseif($menu[$menuloop]['type'] == 'category')
            @php $link = url('/shop').'?category='.$menu[$menuloop]['category'] @endphp
        @elseif($menu[$menuloop]['type'] == 'link')
          @php $link = url('/').$menu[$menuloop]['link'] @endphp
        @elseif($menu[$menuloop]['type'] == 'contentpage')
          @php $link = url('/page/').$menu[$menuloop]['contentpage'] @endphp
        @elseif($menu[$menuloop]['type'] == 'page')
            @php $link = url('/').$menu[$menuloop]['page'] @endphp
        @endif
        
        <li class="nav-item">
          <a class="nav-link " href="{{$link}}">
                <?php $index = 0; ?>
                @if(isset($menu[$menuloop]['language_id']))
                  @php $index = array_search($data['selectedLenguage'],$menu[$menuloop]['language_id']) @endphp
                @endif
                {{$menu[$menuloop]['name'][$index]}}
          </a>
        </li>
        @else

        @php $link = '#' @endphp
        @if($menu[$menuloop]['type'] == 'exlink')
            @php $link = $menu[$menuloop]['exlink'] @endphp
        @elseif($menu[$menuloop]['type'] == 'product')
            @php $link = url('/product').$menu[$menuloop]['product'] @endphp
        @elseif($menu[$menuloop]['type'] == 'category')
            @php $link = url('/shop').'?category='.$menu[$menuloop]['category'] @endphp
        @elseif($menu[$menuloop]['type'] == 'link')
            @php $link = url('/').$menu[$menuloop]['link'] @endphp
        @elseif($menu[$menuloop]['type'] == 'contentpage')
            @php $link = url('/page/').$menu[$menuloop]['contentpage'] @endphp
        @elseif($menu[$menuloop]['type'] == 'page')
            @php $link = url('/').$menu[$menuloop]['page'] @endphp
        @endif
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{$link}}">
                <?php $index = 0; ?>
                @if(isset($menu[$menuloop]['language_id']))
                @php $index = array_search($data['selectedLenguage'],$menu[$menuloop]['language_id']) @endphp
                @endif
                {{$menu[$menuloop]['name'][$index]}}
          </a>
          @if(count($menu[$menuloop]['children']) > 0)
            @include('includes.headers.menu')
          @endif
        </li>
        @endif
        @endforeach
        @endif
      </ul>
  