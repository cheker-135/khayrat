var cacheName = 'hello-pwa-v2';
var filesToCache = [];

/* Clear old caches and install fresh */
self.addEventListener('install', function(e) {
  self.skipWaiting();
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});

/* Clear all old caches on activate */
self.addEventListener('activate', function(e) {
  e.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(name) {
          return caches.delete(name);
        })
      );
    })
  );
});

/* Always fetch from network, never serve from cache */
self.addEventListener('fetch', function(e) {
  e.respondWith(fetch(e.request));
});
