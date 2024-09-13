<!-- Modal Structure -->
<div class="modal fade" style="top:-2%" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">View Image: <div class="d-inline" id="show-image-title"></div> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 
                </button>
            </div>
            <div class="modal-body text-center">
                {{-- <img id="image_modal_img" src="" alt="Image" class="img-fluid"> --}}
                <iframe id="image_modal_img" src="" frameborder="0" style="width: 100%; height: 50rem;"></iframe>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>