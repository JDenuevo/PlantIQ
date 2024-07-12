<div class="container">
  <div class="top" style="padding-top: 50px;">
    <div class="d-flex flex-row">
      <div class="dropdown flex-grow-1"></div>
    
          <button type="button" class="btn mt-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="fa-solid fa-arrow-right-from-bracket navbtn fa-2xl"></i>
          </button>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content p-5 rounded-5">
      <div class="text-center fw-bold">
      <i class="fa-solid fa-circle-exclamation mb-3" style="color: #ff0000; font-size: 100px;"></i>
        <br>
        Are you sure you want to logout?
      </div>
      <div class="d-flex justify-content-around mt-3">
        <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Close</button>
        <a href="../pages/components/logout.php" class="btn btn-primary rounded-pill" onclick="logout()">Logout</a>
      </div>
    </div>
  </div>
</div>

<script >
function logout() {
    sessionStorage.clear();
}
</script>