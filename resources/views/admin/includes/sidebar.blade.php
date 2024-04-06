  <div class="sidebar">
    <div class="logo_details">
        <i class="bi bi-github icon"></i>
      <div class="logo_name">Vertebra</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <hr>
    <ul class="nav-list">
      <li>
        <a href="{{ route('admin.index') }}">
            <i class="bi bi-house-fill"></i>
            <span class="link_name">Главная страница</span>
        </a>
        <span class="tooltip">Главная страница</span>
      </li>
      <li>
        <a href="{{ route('admin.models.index') }}">
            <i class="bi bi-box-fill"></i>
          <span class="link_name">Модели</span>
        </a>
        <span class="tooltip">Модели</span>
      </li>
      <li>
        <a href="{{ route('admin.parts.index') }}">
            <i class="bi bi-diagram-3-fill"></i>
          <span class="link_name">Детали моделей</span>
        </a>
        <span class="tooltip">Детали моделей</span>
      </li>
      <li>
        <a href="{{ route('admin.posts.index') }}">
            <i class="bi bi-file-text-fill"></i>
          <span class="link_name">Статьи</span>
        </a>
        <span class="tooltip">Статьи</span>
      </li>
    </ul>
  </div>
