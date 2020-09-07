const staticDevCoffee = "Customer Indostar Referral Program"
const assets = [
    "/",
    "https://infinitumus.com/cust_referral_system/assets/css/bootstrap.min.css",
    "https://infinitumus.com/cust_referral_system/assets/css/sweetalert.css",
    "https://infinitumus.com/cust_referral_system/assets/js/jquery-3.3.1.min.js",
    "https://infinitumus.com/cust_referral_system/assets/js/bootstrap.min.js",
    "https://infinitumus.com/cust_referral_system/assets/js/jquery.validate.min.js",
    "https://infinitumus.com/cust_referral_system/assets/js/additional-methods.min.js",
    "https://infinitumus.com/cust_referral_system/assets/js/sweetalert.js",
    "https://infinitumus.com/cust_referral_system/assets/js/app.js",
    "https://infinitumus.com/cust_referral_system/assets/css/custom.css",
    "https://infinitumus.com/cust_referral_system/assets/css/responsive.css",
    "https://infinitumus.com/cust_referral_system/assets/css/mystyle.css",
    "https://infinitumus.com/cust_referral_system/assets/css/zebra_datepicker.min.css",
    "https://infinitumus.com/cust_referral_system/assets/css/zebra_datepicker.min.js",
]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(staticDevCoffee).then(cache => {
      cache.addAll(assets)
    })
  )
})

self.addEventListener("fetch", fetchEvent => {
  fetchEvent.respondWith(
    caches.match(fetchEvent.request).then(res => {
      return res || fetch(fetchEvent.request)
    })
  )
})