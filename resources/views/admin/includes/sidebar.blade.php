  <div class="sidebar">
    <div class="logo_details">
        <i class="bi bi-github icon"></i>
      <div class="logo_name">GRSU Project</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <hr>
    <ul class="nav-list">
      <li>
        <a href="{{ route('admin.index') }}">
            <i class="bi bi-house-fill"></i>
            <span class="link_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li>
      <li>
        <a href="{{ route('admin.models.index') }}">
            <i class="bi bi-box-fill"></i>
          <span class="link_name">Spine Models</span>
        </a>
        <span class="tooltip">Spine Models</span>
      </li>
      <li>
        <a href="{{ route('admin.parts.index') }}">
            <i class="bi bi-diagram-3-fill"></i>
          <span class="link_name">Spine Parts</span>
        </a>
        <span class="tooltip">Spine Parts</span>
      </li>
      <li>
        <a href="#">
            <i class="bi bi-file-text-fill"></i>
          <span class="link_name">Posts</span>
        </a>
        <span class="tooltip">Posts</span>
      </li>
    </ul>
  </div>
