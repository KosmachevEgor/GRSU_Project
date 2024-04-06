  <div class="sidebar">
    <div class="logo_details">
        <i class="bi bi-github icon"></i>
      <div class="logo_name">Vertebra</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <hr>
    <ul class="nav-list">
      <li>
        <a href="{{ route('index') }}">
            <i class="bi bi-house-fill"></i>
            <span class="link_name">Главная страница</span>
        </a>
        <span class="tooltip">Главная странца</span>
      </li>
      <li>
        <a href="{{ route('models.index') }}">
            <i class="bi bi-box-fill"></i>
          <span class="link_name">Модели</span>
        </a>
        <span class="tooltip">Модели</span>
      </li>
      <li>
        <a href="{{ route('virtualTour.index') }}">
            <i class="bi bi-badge-vr-fill"></i>
          <span class="link_name">Виртуальный тур</span>
        </a>
        <span class="tooltip">Виртуальный тур</span>
      </li>
      <li>
        <a href="{{ route('posts.index') }}">
            <i class="bi bi-file-text-fill"></i>
          <span class="link_name">Статьи</span>
        </a>
        <span class="tooltip">Статьи</span>
      </li>
    </ul>
  </div>
