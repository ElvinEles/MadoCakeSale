<li class="active has-sub">
    <a class="js-arrow" href="#">
        <i class="fa fa-home"></i>Əsas Menu</a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
      <li>
          <a href="{{URL::to('/allproducts')}}">Sifarişlər</a>
      </li>
      <li>
          <a href="{{URL::to('/product_order')}}">Sifariş et</a>
      </li>
      <li>
          <a href="{{URL::to('/archieveproducts')}}">Arxivlər</a>
      </li>
    </ul>
</li>

@if(session()->get('user_id')==6)
<li class="active has-sub">
    <a class="js-arrow" href="#">
        <i class="fa fa-cog"></i>Admin Panel</a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
      <li>
          <a href="{{URL::to('/admin_category')}}">Kateqoriyalar</a>
      </li>
      <li>
          <a href="{{URL::to('/admin_message')}}">Xəbərdarlıq</a>
      </li>
      <li>
          <a href="{{URL::to('/admin_statistic')}}">Statistika</a>
      </li>

    </ul>
</li>
@endif
