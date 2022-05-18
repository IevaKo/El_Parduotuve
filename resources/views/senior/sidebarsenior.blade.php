<div class="sidenav">
<li class="">
            <span class="nav-link ">Kategorijos</span>
          </li>
          @foreach ($categories as $category)
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('categorysenior',$category->category_id)}}">
              <span class="menu-title">{{$category->name}}</span>
            </a>
          </li>
            @endforeach
            <li class="">
            <span class="nav-link">Subkategorijos</span>
          </li>
            @foreach ($subcategories as $subcategory)
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('subcategorysenior',$subcategory->subcategory_id)}}">
              <span class="menu-title">{{$subcategory->name}}</span>
            </a>
          </li>
            @endforeach
</div>
          
        
      