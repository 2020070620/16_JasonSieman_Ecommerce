/* assets/js/scripts.js - AOS init, Swiper init, quick view, cart, transaksi calc, search/sort */
document.addEventListener('DOMContentLoaded', function(){

  // AOS init (if loaded by Feane)
  if(typeof AOS !== 'undefined') AOS.init();

  // Swiper init (if Swiper included by Feane)
  if(typeof Swiper !== 'undefined'){
    try{
      new Swiper('.mySwiper', { loop:true, pagination:{ el:'.swiper-pagination', clickable:true }, autoplay: { delay: 3000 } });
    }catch(e){ console.warn('Swiper init error', e); }
  }

  // Quick View handling for products page
  document.querySelectorAll('.quickViewBtn').forEach(btn => {
    btn.addEventListener('click', function(){
      var slug = this.getAttribute('data-slug');
      var card = document.querySelector('.product-card[data-slug="'+slug+'"]');
      if(!card) return;
      var title = card.querySelector('.card-title')?.textContent || slug;
      var price = card.getAttribute('data-price') || card.querySelector('.price')?.textContent || '0';
      var img = card.querySelector('img')?.src || '../assets/images/feane-brand.png';
      var desc = card.querySelector('.card-text')?.textContent || '';
      document.getElementById('qv_title').textContent = title;
      document.getElementById('qv_name').textContent = title;
      document.getElementById('qv_price').textContent = 'Rp ' + price;
      document.getElementById('qv_img').src = img;
      document.getElementById('qv_desc').textContent = desc;
      document.querySelectorAll('#quickViewModal .addToCartBtn, #quickViewModal .buyNowBtn, #quickViewModal .copyLinkBtn')
        .forEach(el=>el.setAttribute('data-slug', slug));
      if(typeof bootstrap !== 'undefined'){
        var modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        modal.show();
      } else {
        alert('Quick view: ' + title + ' (price: ' + price + ')');
      }
    });
  });

  // Buy Now: redirect to transaksi.php?produk=slug
  document.querySelectorAll('.buyNowBtn').forEach(b => {
    b.addEventListener('click', function(){
      var slug = this.getAttribute('data-slug');
      if(!slug) return;
      window.location.href = 'transaksi.php?produk=' + encodeURIComponent(slug);
    });
  });

  // Copy link (share)
  document.querySelectorAll('.copyLinkBtn').forEach(b => {
    b.addEventListener('click', function(){
      var slug = this.getAttribute('data-slug');
      if(!slug) return;
      var base = window.location.origin + window.location.pathname.replace(/[^/]*$/,'');
      var url = base + 'product-' + slug + '.html';
      if(navigator.clipboard) navigator.clipboard.writeText(url).then(()=> alert('Link copied: ' + url));
    });
  });

  // Simple cart using sessionStorage
  var CART_KEY = 'garlickoe_cart_v1';
  function getCart(){ try{ return JSON.parse(sessionStorage.getItem(CART_KEY) || '[]'); }catch(e){ return []; } }
  function saveCart(c){ sessionStorage.setItem(CART_KEY, JSON.stringify(c)); }
  window.addToCart = function(slug, name, price, qty){
    var cart = getCart();
    var found = cart.find(i=>i.slug===slug);
    if(found){ found.qty += qty; } else { cart.push({slug, name, price, qty}); }
    saveCart(cart);
    alert('Added to cart: '+name);
  }
  document.querySelectorAll('.addToCartBtn').forEach(b=>{
    b.addEventListener('click', function(){
      var slug = this.getAttribute('data-slug');
      var card = document.querySelector('.product-card[data-slug="'+slug+'"]');
      var name = card?.querySelector('.card-title')?.textContent || slug;
      var price = Number(card?.getAttribute('data-price') || 0);
      addToCart(slug,name,price,1);
    });
  });

  // Products search & sort
  var searchInput = document.getElementById('searchInput');
  var sortSelect = document.getElementById('sortSelect');
  function refreshProducts(){
    var q = searchInput?.value?.toLowerCase()||'';
    var sort = sortSelect?.value||'default';
    var nodes = Array.from(document.querySelectorAll('#productsGrid .product-card'));
    nodes.forEach(n=>{
      var name = n.querySelector('.card-title')?.textContent?.toLowerCase()||'';
      n.style.display = name.indexOf(q) !== -1 ? '' : 'none';
    });
    if(sort !== 'default') {
      var sorted = nodes.sort((a,b)=>{
        var pa = Number(a.getAttribute('data-price')||0);
        var pb = Number(b.getAttribute('data-price')||0);
        var na = a.querySelector('.card-title')?.textContent || '';
        var nb = b.querySelector('.card-title')?.textContent || '';
        if(sort === 'price_asc') return pa-pb;
        if(sort === 'price_desc') return pb-pa;
        if(sort === 'name_asc') return na.localeCompare(nb);
        if(sort === 'name_desc') return nb.localeCompare(na);
        return 0;
      });
      var container = document.getElementById('productsGrid');
      sorted.forEach(s=>container.appendChild(s));
    }
  }
  if(searchInput) searchInput.addEventListener('input', refreshProducts);
  if(sortSelect) sortSelect.addEventListener('change', refreshProducts);

  // Transaksi calculation (on transaksi.php)
  var calcBtn = document.getElementById('calculateBtn');
  if(calcBtn){
    calcBtn.addEventListener('click', function(){
      var jumlah = Number(document.getElementById('tx_jumlah').value) || 0;
      var harga = Number(document.getElementById('tx_harga').value) || 0;
      var total = jumlah * harga;
      document.getElementById('tx_total').textContent = total.toLocaleString('id-ID');
    });
  }

  // Riwayat: populate from sessionStorage if exists
  if(document.getElementById('riwayatBody')){
    var hist = JSON.parse(sessionStorage.getItem('garlickoe_orders')||'[]');
    var tbody = document.getElementById('riwayatBody');
    hist.forEach((h,i)=>{
      var tr = document.createElement('tr');
      tr.innerHTML = '<td>'+(i+1)+'</td><td>'+h.date+'</td><td>'+h.product+'</td><td>'+h.qty+'</td><td>'+h.total+'</td>';
      tbody.appendChild(tr);
    });
  }

  // Hook transaksi form submit to save client-side snapshot then allow server submit
  var txForm = document.getElementById('transaksiForm');
  if(txForm){
    txForm.addEventListener('submit', function(){
      var username = document.getElementById('tx_username').value;
      var produk = document.getElementById('tx_produk').value;
      var jumlah = Number(document.getElementById('tx_jumlah').value)||0;
      var harga = Number(document.getElementById('tx_harga').value)||0;
      var total = jumlah*harga;
      var hist = JSON.parse(sessionStorage.getItem('garlickoe_orders')||'[]');
      hist.unshift({date:new Date().toISOString(), product:produk, qty:jumlah, total: total.toLocaleString('id-ID')});
      sessionStorage.setItem('garlickoe_orders', JSON.stringify(hist));
    });
  }

}); // DOMContentLoaded
