<div class="modal fade" id="webCamImageModal" tabindex="-1" aria-labelledby="webCamImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="webCamImageModalLabel">Webcam Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" method="POST" id="webcam_image_form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div id="my_camera"></div>
                            <br />
                            {{-- <input type=button value="Take Snapshot" onClick="take_snapshot()"> --}}
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="col-md-6">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                        <div class="col-md-12 text-center">
                            <br />
                            <button class="btn btn-success" onClick="take_snapshot()">Capture Image</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
