
<div class="row" data-aos="fade-up" data-aos-duration="1000">
    <div class="col-md-8 mx-auto text-center fh5co-heading">
        <div class="result-title">
            <h5 id="search-results-title"></h5>
        </div>
        <h5>Намерени резултата: {{ $products->count() }} продукта </h5>
    </div>
</div>


<div class="row" data-aos="fade-up" data-aos-duration="1000">
    <div class="col-md-8 mx-auto text-center fh5co-heading">
        <h2>Иновативни и изключителни газови продукти</h2>
        <span class="mb-4">Запалване на иновациите в газовите технологии</span>
        <p>Потопете се в света на Джеронимо, където иновациите срещат практичността. Разгледайте нашата внимателно подбрана селекция от газови продукти, всеки от които е изработен да предлага несравнима ефективност, безопасност и дизайн. От най-новите газови технологии до екологични решения, ние ви предлагаме ексклузивни продукти, които предефинират стандартите на газовото оборудване. Независимо дали сте професионалист в бранша или домашен ентусиаст, нашата гама обещава нещо специално за всяка нужда.
        </p>
        <p><strong>Моля, имайте предвид:</strong> Това не е пълният ни асортимент. Извиняваме се, но просто нямаме физическата възможност да вкараме всички наши продукти онлайн. За да разгледате всички наши продукти, заповядайте във физическия ни магазин на адрес <a href="https://www.google.com/maps/place/%D0%9A%D1%8A%D1%80%D1%88%D0%B8%D1%8F%D0%BA%D0%B0%D0%A1%D0%B5%D0%B2%D0%B5%D1%80%D0%B5%D0%BD,+%D1%83%D0%BB.+%E2%80%9E%D0%91%D1%80%D0%B5%D0%B7%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%E2%80%9C+36,+4003+%D0%9F%D0%BB%D0%BE%D0%B2%D0%B4%D0%B8%D0%B2/@42.1595765,24.744671,17z/data=!3m1!4b1!4m6!3m5!1s0x14acd1916fbc589b:0xdab4a6ee45e50e2c!8m2!3d42.1595765!4d24.744671!16s%2Fg%2F11c23816cc?entry=ttu" target="_blank" style="text-decoration: none; color: #0275d8;">ул. „Брезовска“ 36, 4003 Пловдив</a>. Там ще откриете още много интересни предложения!</p>
    </div>
</div>


@if($products->isEmpty())
    <div class="row">
        <div class="col text-center">
            <p>Няма намерени продукти в този ценови диапазон.</p>
        </div>
    </div>
@else
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="1000">
                <div class="product">
                    <div class="product-grid" style="background-image:url('{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : asset('/images/default-product.jpg') }}');">
                        <div class="inner">
                            <p>
                                <a href="#" class="icon add-to-cart btn btn-primary square-icon"
                                onclick="scm_addToCart(this, event);" data-product-id="{{ $product->id }}">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                <a href="{{ url('/product', $product->slug) }}" class="icon btn btn-primary square-icon">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="{{ url('/product', $product->slug) }}">{{ $product->name }}</a></h3>
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="fa fa-star{{ $i <= $product->average_rating ? ' checked' : '' }}"></span>
                            @endfor
                        </div>
                        <span class="price">{{ optional($product->price)->price ?? 'N/A' }} лв.</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const lastSearch = localStorage.getItem('lastSearch');

        if (lastSearch) {
            document.getElementById('search-results-title').textContent = `Резултати за "${lastSearch}"`;
        }
    });
</script>
