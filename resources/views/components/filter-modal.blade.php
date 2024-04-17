<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Опции за филтиране</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="category-filter-section">
                    <h4>Филтрирай по категория:</h4>
                    <ul class="category-list">
                        @foreach ($categories as $category)
                            <li>
                                <input type="checkbox" id="modal-category-{{ $category->id }}" class="modal-category-input modal-checkbox" data-category="{{ $category->id }}">
                                <label for="modal-category-{{ $category->id }}">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="price-filter-section">
                    <h4>Филтриране по цена</h4>
                    <ul class="price-range-list">
                        <li>
                            <input type="checkbox" id="modal-price-range-1" name="price-range" class="modal-price-range-input modal-checkbox">
                            <label for="modal-price-range-1">0 лв. - 50 лв.</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-price-range-2" name="price-range" class="modal-price-range-input modal-checkbox">
                            <label for="modal-price-range-2">50 лв. - 100 лв.</label>
                        </li>
                        <li>
                            <input type of="checkbox" id="modal-price-range-3" name="price-range" class="modal-price-range-input modal-checkbox">
                            <label for="modal-price-range-3">100 лв. - 200 лв.</label>
                        </li>
                        <li>
                            <input type of="checkbox" id="modal-price-range-4" name="price-range" class="modal-price-range-input modal-checkbox">
                            <label for="modal-price-range-4">200+ лв.</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Запази филтрите</button>
            </div>
        </div>
    </div>
</div>
