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
                    <h4>Филтрирай по катерогия:</h4>
                    <ul class="category-list">
                        <li>
                            <input type="checkbox" id="category-all" class="category-input" data-category="all">
                            <label for="category-all">All</label>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <input type="checkbox" id="category-{{ $category->id }}" class="category-input" data-category="{{ $category->id }}">
                                <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="price-filter-section">
                    <h4>Филтрирай по цена:</h4>
                    <ul class="price-range-list">
                        <li>
                            <input type="radio" id="price-range-1" name="price-range" class="price-range-input">
                            <label for="price-range-1">0 лв - 50 лв</label>
                        </li>
                        <li>
                            <input type="radio" id="price-range-2" name="price-range" class="price-range-input">
                            <label for="price-range-2">50 лв - 100 лв</label>
                        </li>
                        <li>
                            <input type="radio" id="price-range-3" name="price-range" class="price-range-input">
                            <label for="price-range-3">100 лв - 200 лв</label>
                        </li>
                        <li>
                            <input type="radio" id="price-range-4" name="price-range" class="price-range-input">
                            <label for="price-range-4">200+ лв</label>
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
