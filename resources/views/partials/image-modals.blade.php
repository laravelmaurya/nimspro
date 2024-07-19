<!-- Modal Structure -->
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                {{-- <img id="image_modal_img" src="" alt="Image" class="img-fluid"> --}}
                <iframe id="image_modal_img" src="" frameborder="0" style="width: 100%; height: 1000px;"></iframe>
            </div>
        </div>
    </div>
</div>