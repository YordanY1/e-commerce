<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Опции за филтриране</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Category Filters for Modal -->
                <div class="category-filter-section">
                    <h4>Филтрирай по категория:</h4>
                    <ul class="category-list">
                        @foreach ($categories as $category)
                            @if (is_null($category->parent_id))
                                <li>
                                    <input type="checkbox" id="modal-category-{{ $category->slug }}" class="modal-category-input modal-checkbox" data-category="{{ $category->slug }}">
                                    <label for="modal-category-{{ $category->slug }}">{{ $category->name }}</label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- Manufacturer Filters for Modal -->
                <div class="manufacturer-filter-section">
                    <h4>Филтър по производители:</h4>
                    <ul class="manufacturer-list">
                        @foreach ($manufacturers as $manufacturer)
                            <li>
                                <input type="checkbox" id="modal-manufacturer-{{ $manufacturer->id }}" class="modal-manufacturer-input modal-checkbox" data-manufacturer="{{ $manufacturer->id }}">
                                <label for="modal-manufacturer-{{ $manufacturer->id }}">{{ $manufacturer->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Price Filters for Modal -->
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
                            <input type="checkbox" id="modal-price-range-3" name="price-range" class="modal-price-range-input modal-checkbox">
                            <label for="modal-price-range-3">100 лв. - 200 лв.</label>
                        </li>
                        <li>
                            <input type="checkbox" id="modal-price-range-4" name="price-range" class="modal-price-range-input modal-checkbox">
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
