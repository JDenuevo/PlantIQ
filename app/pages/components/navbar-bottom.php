<nav class="navbar navbar-expand-lg bg-light fixed-bottom sidebar-nav" id="mobile-navbar">
  <ul id="sidebarnav" class="nav nav-pills w-100 mx-2">
    <li class="nav-item sidebar-item text-center my-auto">
      <a class="nav-link sidebar-link text-decoration-none" href="./home.php" aria-expanded="false">
        <i class="fa-solid fa-house"></i>
        <div><label class="fw-semibold" style="font-size: 11px;">Home</label></div>
      </a>
    </li>
    <li class="nav-item sidebar-item text-center my-auto">
      <a class="nav-link sidebar-link text-decoration-none" href="./findplant.php" aria-expanded="false">
        <i class="fa-solid fa-seedling"></i>
        <div><label class="fw-semibold" style="font-size: 11px;">Find Plants</label></div>
      </a>
    </li>
    <li class="nav-item sidebar-item text-center my-auto">
      <a class="nav-link sidebar-link text-decoration-none" href="./adddevice.php" aria-expanded="false">
        <i class="fa-solid fa-circle-plus"></i>
        <div><label class="fw-semibold" style="font-size: 11px;">Add Device</label></div>
      </a>
    </li>
    <li class="nav-item sidebar-item text-center my-auto">
      <a class="nav-link sidebar-link text-decoration-none" href="./profile.php" aria-expanded="false">
        <i class="fa-solid fa-user"></i>
        <div><label class="fw-semibold" style="font-size: 11px;">Profile</label></div>
      </a>
    </li>
    <li class="nav-item sidebar-item text-center my-auto">
      <a class="nav-link sidebar-link text-decoration-none" href="./settings.php" aria-expanded="false">
        <i class="fa-solid fa-gear"></i>
        <div><label class="fw-semibold" style="font-size: 11px;">Settings</label></div>
      </a>
    </li>
  </ul>
</nav>

<style scoped>
  li{
    width: 20%;
    height: auto;
  }

  .sidebar-nav ul .sidebar-item .sidebar-link {
    color: #000;
  }

  .sidebar-nav ul .sidebar-item .first-level .sidebar-item .sidebar-link.active {
    background-color: transparent!important;
    color: #26DB23!important
  }

  .sidebar-nav ul .sidebar-item.selected>.sidebar-link,.sidebar-nav ul .sidebar-item.selected>.sidebar-link.active,.sidebar-nav ul .sidebar-item>.sidebar-link.active {
    background-color: #fff;
    font-weight: bold;
    color: #26DB23
  }

</style>
