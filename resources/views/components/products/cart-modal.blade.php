<!-- Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Продуктът е добавен в количката</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="product-details d-flex align-items-center">
                <img id="modal-product-image" src="" alt="Product Image" class="me-3 rounded" style="width: 100px; height: auto;">
                <div>
                    <h5 id="modal-product-name" class="mb-0"></h5>
                    <p id="modal-product-price" class="mb-0"></p>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/cart') }}'">виж количката</button>

        </div>
      </div>
    </div>
</div>
