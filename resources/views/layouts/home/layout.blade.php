<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Сигурност и ефективност с нашите сертифицирани продукти.">
    <meta name="keywords" content="газови уреди, газови системи, домакински газови уреди, промишлени газови системи, безопасни газови уреди">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Джеронимо">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Висококачествени Газови Уреди | Джеронимо">
    <meta property="og:description" content="Открийте висококачествени газови уреди за отопление, готвене и индустриални нужди. Надеждност и иновация с нашите сертифицирани продукти.">
    <meta property="og:image" content="{{ asset('images/jeronimo-logo-color.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="bg_BG">

    <!-- General Meta Tags -->
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="format-detection" content="telephone=no">
    <meta name="application-name" content="Джеронимо">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">

    <!-- Favicon and Apple Touch Icons -->
    <link rel="icon" type="image/png" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('images/jeronimo-logo-color.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/jeronimo-logo-color.png') }}" type="image/png">

    <title>Джеронимо | Газови Уреди</title>

    <!-- Vite CSS for Laravel Mix -->
    @vite(['resources/scss/frontend/app.scss'])

</head>
<body class="antialiased">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content Area -->
    <div class="page-content">
        @yield('content')
    </div>

      <!-- Cookie Banner -->
    <div class="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #fff; color: #333; padding: 15px; text-align: center; box-shadow: 0 -2px 5px rgba(0,0,0,0.1);">
        <p>Грижим се за Вашите данни и използваме бисквитки, за да подобрим Вашето изживяване. <a href="{{ url('/terms') }}" style="color: #106EE8; text-decoration: underline;">Прочетете нашата политика за бисквитките.</a></p>
        <button onclick="acceptCookies();" style="background-color: #106EE8; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Приемам</button>
        <button onclick="declineCookies();" style="background-color: #e3342f; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">Отказвам</button>
    </div>

    <div id="chatbotContainer">
        <div id="chatHeader" style="background-color: #007bff; color: white; padding: 10px; border-top-left-radius: 15px; border-top-right-radius: 15px; cursor: pointer;">
            <strong>Помощ</strong>
            <span class="close-btn" style="float: right; cursor: pointer; color: white;">X</span>
        </div>
        <div id="chatArea" style="height: 430px; overflow-y: auto; padding: 10px; background-color: #f0f0f0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
            <!-- Questions and responses will appear here -->
        </div>
    </div>

    <button id="chatIcon">
        <i class="fa-solid fa-headset" style="color: white; font-size: 20px;"></i>
    </button>


    <!-- Footer Component -->
    <x-footer />

    <!-- Vite JS for Laravel Mix -->
    @vite(['resources/js/app.js'])

    @stack('scripts')

<script>
document.getElementById('chatIcon').addEventListener('click', function() {
    var chatContainer = document.getElementById('chatbotContainer');
    var chatArea = document.getElementById('chatArea');

    function displayQuestions(excludeQuestion = null) {
        fetch('/catbot/questions')
        .then(response => response.json())
        .then(questions => {
            let questionArea = document.createElement('div');
            questionArea.id = 'questionArea';
            chatArea.appendChild(questionArea); // Append questions area if not already present

            questions.forEach(question => {
                if (question !== excludeQuestion) {
                    let questionDiv = document.createElement('div');
                    questionDiv.textContent = question;
                    questionDiv.className = 'question';
                    questionDiv.style.padding = '5px';
                    questionDiv.style.cursor = 'pointer';
                    questionArea.appendChild(questionDiv); // Append to the question area

                    questionDiv.addEventListener('click', function() {
                        fetch('/catbot/respond', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ question: question })
                        })
                        .then(response => response.json())
                        .then(data => {
                            chatArea.innerHTML = ''; // Clear chat area before displaying response
                            let responseDiv = document.createElement('div');
                            responseDiv.className = 'response';
                            responseDiv.innerHTML = `<strong>Q:</strong> ${question}<br><strong>A:</strong> ${data.message}`;
                            chatArea.appendChild(responseDiv); // Append response

                            // Display questions again, excluding the one just asked
                            displayQuestions(question);
                        });
                    });
                }
            });
        })
        .catch(error => console.error('Error:', error));
    }

    if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
        chatArea.innerHTML = ''; // Clear previous content
        displayQuestions(); // Load questions initially
    }

    chatContainer.style.display = 'block';
});

document.querySelector('.close-btn').addEventListener('click', function() {
    var chatContainer = document.getElementById('chatbotContainer');
    chatContainer.style.display = 'none';
});


function acceptCookies() {
    localStorage.setItem('cookieConsent', 'true');
    document.querySelector('.cookie-banner').style.display = 'none';
}

function declineCookies() {
    localStorage.setItem('cookieConsent', 'false');
    document.querySelector('.cookie-banner').style.display = 'none';
    alert('Вие отказахте използването на бисквитки. Някои функции на сайта може да не работят коректно.');
}

document.addEventListener('DOMContentLoaded', function () {
    var cookieConsent = localStorage.getItem('cookieConsent');
    if (cookieConsent === 'true') {
        document.querySelector('.cookie-banner').style.display = 'none';
    } else if (cookieConsent === 'false') {
    } else {
        document.querySelector('.cookie-banner').style.display = 'block';
    }
});


document.addEventListener('DOMContentLoaded', () => {
        function logToServer(message) {
            fetch('/log', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });
        }

        function clearLocalStorage() {
            const currentTime = new Date().toISOString();
            console.log('Clearing cart from localStorage at', currentTime);
            logToServer('Clearing cart from localStorage at ' + currentTime);
            localStorage.removeItem('cart');
        }

        function sendDeleteSessionRequest() {
            let formData = new FormData();
            formData.append('sessionId', '{{ session()->getId() }}');
            formData.append('_token', '{{ csrf_token() }}');

            const currentTime = new Date().toISOString();
            console.log('Sending session delete request for session at', currentTime, 'session:', '{{ session()->getId() }}');
            logToServer('Sending session delete request for session at ' + currentTime + ' session: {{ session()->getId() }}');
            const success = navigator.sendBeacon('/delete-session', formData);
            console.log('sendBeacon success:', success);
            logToServer('sendBeacon success: ' + success);
        }

        function checkAndClear() {
            const lastVisit = localStorage.getItem('lastVisit');
            const currentTime = new Date().toISOString();
            const currentTimeStamp = Date.now();
            if (lastVisit && currentTimeStamp - lastVisit > 10000) { // 10 секунди в милисекунди
                console.log('Last visit was more than 10 seconds ago, clearing localStorage and sending delete session request at', currentTime);
                logToServer('Last visit was more than 10 seconds ago, clearing localStorage and sending delete session request at ' + currentTime);
                clearLocalStorage();
                sendDeleteSessionRequest();
            } else {
                console.log('Last visit was less than 10 seconds ago, not clearing localStorage at', currentTime);
                logToServer('Last visit was less than 10 seconds ago, not clearing localStorage at ' + currentTime);
            }
        }

        // Записване на времето на последното посещение при затваряне на страницата или промяна на видимостта
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                const lastVisitTime = Date.now();
                localStorage.setItem('lastVisit', lastVisitTime);
                const currentTime = new Date().toISOString();
                console.log('Recorded last visit time (visibilitychange):', currentTime, 'Timestamp:', lastVisitTime);
                logToServer('Recorded last visit time (visibilitychange): ' + currentTime + ' Timestamp: ' + lastVisitTime);
            } else {
                checkAndClear();
            }
        });

        // Първоначална проверка при зареждане на страницата
        checkAndClear();
    });
</script>

</body>
</html>

