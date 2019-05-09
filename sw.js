// При установке воркера мы должны закешировать часть данных (статику).
this.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open('v1').then(function(cache) {
            return cache.addAll([
                '/',
                '/manifest.json',
                '/android-icon-48x48.png',
                '/android-icon-72x72.png',
                '/android-icon-96x96.png',
                '/android-icon-144x144.png',
                '/android-icon-192x192.png',
                '/android-icon-512x512.png',
                '/android-icon-36x36.png',
                '/favicon-32x32.png',
                '/favicon-96x96.png',
                '/favicon-16x16.png',
                '/sw.js',
                '/fonts/AkzidenzGroteskPro-Cn.woff',
                '/img/settings-work-tool.svg',
                '/img/bg.jpg',
                '/img/thanos-fist.png',
                '/img/thanos.png',
                '/img/flags/AUD.png',
                '/img/flags/BGN.png',
                '/img/flags/BRL.png',
                '/img/flags/CAD.png',
                '/img/flags/CHF.png',
                '/img/flags/CNY.png',
                '/img/flags/CZK.png',
                '/img/flags/DKK.png',
                '/img/flags/EUR.png',
                '/img/flags/GBP.png',
                '/img/flags/HKD.png',
                '/img/flags/HRK.png',
                '/img/flags/HUF.png',
                '/img/flags/IDR.png',
                '/img/flags/ILS.png',
                '/img/flags/INR.png',
                '/img/flags/ISK.png',
                '/img/flags/JPY.png',
                '/img/flags/KRW.png',
                '/img/flags/MXN.png',
                '/img/flags/MYR.png',
                '/img/flags/NOK.png',
                '/img/flags/NZD.png',
                '/img/flags/PHP.png',
                '/img/flags/PLN.png',
                '/img/flags/RON.png',
                '/img/flags/RUB.png',
                '/img/flags/SEK.png',
                '/img/flags/SGD.png',
                '/img/flags/THB.png',
                '/img/flags/TRY.png',
                '/img/flags/USD.png',
                '/img/flags/ZAR.png',
                '/img/flags/default.png'
            ]);
        })
    );
});



this.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(resp) {
      return resp || fetch(event.request).then(function(response) {
        return caches.open('v1').then(function(cache) {
          cache.put(event.request, response.clone());
          return response;
        });  
      });
    })
  );
});