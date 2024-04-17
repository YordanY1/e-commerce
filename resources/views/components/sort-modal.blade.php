<!-- Sort Modal -->
<div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sortModalLabel">Опции за сортиране</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Sorting Options as List -->
                <div class="sorting-options">
                    <h6>Подреди:</h6>
                    <ul>
                        <li>
                            <input type="checkbox" id="modal-sort-popular" name="sorting-option" value="popular" class="modal-sorting-option modal-checkbox">
                            <label for="modal-sort-popular">Най-популярни</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-sort-expensive" name="sorting-option" value="expensive" class="modal-sorting-option modal-checkbox">
                            <label for="modal-sort-expensive">Най-скъпи</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-sort-low-price" name="sorting-option" value="low-price" class="modal-sorting-option modal-checkbox">
                            <label for="modal-sort-low-price">Ниска цена</label>
                        </li>
                    </ul>
                </div>
                <!-- Pagination Options as List -->
                <div class="pagination-options">
                    <h6>Продукти на страница:</h6>
                    <ul>
                        <li>
                            <input type="checkbox" id="modal-pagination-all" name="pagination-option" value="all" class="modal-pagination-option modal-checkbox" checked>
                            <label for="modal-pagination-all">Всички</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-pagination-10" name="pagination-option" value="10" class="modal-pagination-option modal-checkbox">
                            <label for="modal-pagination-10">10</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-pagination-20" name="pagination-option" value="20" class="modal-pagination-option modal-checkbox">
                            <label for="modal-pagination-20">20</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-pagination-30" name="pagination-option" value="30" class="modal-pagination-option modal-checkbox">
                            <label for="modal-pagination-30">30</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Запази</button>
            </div>
        </div>
    </div>
</div>
