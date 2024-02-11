@extends('layouts.contacts.layout')

@section('title', 'Контакти')

@section('content')

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-push-1" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0">
                    <div class="fh5co-contact-info">
                        <h3>Контакти с нас</h3>
                        <ul>
                            <a href="https://www.google.com/maps/search/?api=1&query=Северен, ул. „Брезовска“ 36, 4003 Пловдив" target="_blank">
                                <li class="address">
                                    <i class="fas fa-map-marker-alt"></i> Северен, ул. „Брезовска“ 36, 4003 Пловдив
                                </li>
                            </a>
                            <li class="phone"><i class="fas fa-phone"></i> <a href="tel://0888707691">088 870 7691</a></li>
                            <li class="email"><i class="fas fa-envelope"></i> <a href="mailto:jeronimostore1@gmail.com">jeronimostore1@gmail.com</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0">
                    <h3>Свържете се с нас</h3>
                    <form id="contactForm">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Вашето име" autocomplete="name">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Вашият e-mail" autocomplete="email">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Тема" autocomplete="on">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Съобщение"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Изпрати" class="btn btn-primary" onclick="sendEmail(event)">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Запитването е изпратено успешно!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Благодарим Ви, че се свързахте с нас. Ще Ви отговорим възможно най-скоро!
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Затвори</button>
            </div>
        </div>
        </div>
    </div>


    <div class="container" data-aos="zoom-in" data-aos-duration="1000">
        <div class="row">
            <div class="col-12 py-3 d-flex justify-content-center">
                <div class="google-maps-custom"> <!-- You can adjust 800px to your preferred width -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d189505.8622275022!2d24.66819153969921!3d42.08542609723215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14acd18527aa4bfb%3A0xa64afcc18d5a65d4!2z0JzQsNCz0LDQt9C40L0g0LfQsCDQs9Cw0LfQvtCy0Lgg0YPRgNC10LTQuCBHZXJvbmltbw!5e0!3m2!1sbg!2sbg!4v1706964707831!5m2!1sbg!2sbg" width="100%" height="600" frameborder="0" style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
