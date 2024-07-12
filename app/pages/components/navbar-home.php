<style>
  /* Default styles for the sidebar */
.container {
  padding-top: 50px;
}

.sidebar-nav {
  background-color: #f1f1f1;
  width: 100%;
}

.nav-pills .nav-link {
  color: #333;
}

/* Responsive styles for Android large screens (360 x 800 pixels) */
@media only screen and (min-width: 360px) and (max-width: 800px) {
  .container {
    padding-top: 20px; /* Adjust padding for smaller screens */
  }

  .sidebar-nav {
    width: 100%;
  }

  .nav-pills .nav-link {
    font-size: 12px; /* Adjust font size for smaller screens */
  }

  /* Adjust font size for active state */
  .nav-pills .nav-link.active {
    font-size: 9px; /* Example font size for active state */
  }
}
  </style>
<div class="container" style="padding-top: 50px;">
  <nav class= "sidebar-nav">
    <ul id="sidebarnav" class="nav nav-pills nav-tabs  d-flex justify-content-evenly">
      <li class="nav-item sidebar-item">
        <a href="../pages/calendar.php" class="nav-link sidebar-link btn " aria-current="page" aria-expanded="false">
          Calendar
        </a>
      </li>
      <li class="nav-item sidebar-item">
        <a href="../pages/logs.php" class="nav-link sidebar-link btn ms-1" aria-current="page" aria-expanded="false">
          Logs
        </a>
      </li>
      <li class="nav-item sidebar-item">
        <a href="../pages/history.php" class="nav-link sidebar-link btn" aria-current="page" aria-expanded="false">
          History
        </a>
      </li>
    </ul>
  </nav>
</div>