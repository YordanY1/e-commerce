@extends('layouts.contacts.layout')

@section('title', 'Contacts')

@section('content')

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-push-1" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0">
                    <div class="fh5co-contact-info">
                        <h3>Контакти с нас</h3>
                        <ul>
                            <li class="address"><i class="fas fa-map-marker-alt"></i> 198 West 21th Street, <br> Suite 721 New York NY 10016</li>
                            <li class="phone"><i class="fas fa-phone"></i> <a href="tel://1234567920">+ 1235 2355 98</a></li>
                            <li class="email"><i class="fas fa-envelope"></i> <a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0">
                    <h3>Свържете се с нас</h3>
                    <form action="#">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" id="fullname" class="form-control" placeholder="Вашето име">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" id="email" class="form-control" placeholder="Вашият e-mail">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Съобщение"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Изпрати" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container" data-aos="zoom-in" data-aos-duration="1000">
        <div class="row">
            <div class="col-12 py-3 d-flex justify-content-center">
                <div class="google-maps-custom"> <!-- You can adjust 800px to your preferred width -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2965.0471957347427!2d24.871350475201865!3d41.99926265782086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14acd8cf286788b7%3A0xa27802ec1c9b58df!2z0YPQuy4g4oCe0JzQtdGB0YLQsOKAnCAxLCA0MjMwINC60LIuINCh0LLQtdGC0Lgg0JPQtdC-0YDQs9C4LCDQkNGB0LXQvdC-0LLQs9GA0LDQtA!5e0!3m2!1sbg!2sbg!4v1702191083660!5m2!1sbg!2sbg" width="100%" height="600" frameborder="0" style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
