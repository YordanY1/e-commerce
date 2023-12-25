<div class="row animate-box">
    <div class="col-md-8 mx-auto text-center fh5co-heading">
        <span>Запалване на иновациите в газовите технологии</span>
        <h2>Иновативни и изключителни газови продукти</h2>
        <p>Потопете се в света на Jeronimo, където иновациите срещат практичността. Разгледайте нашата внимателно подбрана селекция от газови продукти, всеки от които е изработен да предлага несравнима ефективност, безопасност и дизайн. От най-новите газови технологии до екологични решения, ние ви предлагаме ексклузивни продукти, които предефинират стандартите на газовото оборудване. Независимо дали сте професионалист в бранша или домашен ентусиаст, нашата гама обещава нещо специално за всяка нужда.
        </p>
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
            <div class="col-md-4 text-center animate-box">
                <div class="product">
                    <div class="product-grid" style="background-image:url('{{ $product->images->first() ? asset('storage/' . $product->images->first()->path) : '/images/default-product.jpg' }}');">
                        <div class="inner">
                            <p>
                                <a href="#" class="icon add-to-cart"><i class="fas fa-shopping-cart"></i></a>
                                <a href="{{ url('/product', $product->id) }}" class="icon"><i class="fas fa-eye"></i></a>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <h3><a href="{{ url('/product', $product->id) }}">{{ $product->name }}</a></h3>
                        <span class="price">${{ optional($product->price)->price ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
