<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QR Code Scanner</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addModal">
             <i class="fa fa-qrcode mb-2 fa-2xl">MODAL</i>
            </button>
<!-- Add/Scan Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content p-3 rounded-5">
      <div class="text-center fw-bold">
        <h4>Scan the QR Code</h4>
        <br>
        <div class="my-1">
            <video id="preview" width="100%"></video>
        </div>
        <div>
            <button class="btn btn-sm btn-light" onclick="changeCamera('front')">Front Camera</button>
            <button class="btn btn-sm btn-light" onclick="changeCamera('back')">Back Camera</button>
        </div>
      </div>
      <div class="d-flex justify-content-around mt-4">
        <button type="button" class="btn btn-lg btn-dark rounded-pill" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://serratus.github.io/quaggaJS/examples/js/quagga.min.js"></script>
<script src="https://serratus.github.io/quaggaJS/examples/js/vendor/jsQR-3.1.1.min.js"></script>

<script>
$(document).ready(function() {
    $('#addModal').on('shown.bs.modal', function () {
        startScanner();
    });
});

let scanner;

function startScanner(cameraIndex = 0) {
    const videoElement = document.getElementById('preview');
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: videoElement
        },
        decoder: {
            readers: ["code_128_reader"] // Specify the types of codes you want to scan
        }
    }, function(err) {
        if (err) {
            console.error(err);
            alert('Error initializing Quagga: ' + err);
            return;
        }
        Quagga.start();
    });

    Quagga.onDetected(function(result) {
        console.log('Scanned:', result.codeResult.code);
        document.getElementById('text').value = result.codeResult.code;
        $('#addModal').modal('hide');
    });
}

function changeCamera(position) {
    // Quagga doesn't support switching cameras after initialization
    alert('Quagga does not support switching cameras after initialization');
}
</script>

</body>
</html>
