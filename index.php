<?php
require_once __DIR__.'/lib/helpers.php';

function render_head($title='Vyojin'){ ?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=h($title)?> — VYOJIN</title>
<meta name="description" content="Vyojin premium Indian fashion — sarees, salwar kameez, lehengas and contemporary occasionwear.">
<link rel="stylesheet" href="/css/site.css">
</head><body>
<?php include __DIR__.'/header.php'; ?>
<?php }
function render_foot(){ ?>
<div class="toast" id="toast"></div>
<script src="/js/product.js"></script><script src="/js/site.js"></script>
<script>
(function(){
  if(!('IntersectionObserver' in window)) return;
  var els=document.querySelectorAll('.section-heading,.category-card,.product-card,.editorial-card');
  var io=new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); }
    });
  },{threshold:.12});
  els.forEach(function(el){
    var idx=Array.prototype.indexOf.call(el.parentNode.children,el);
    el.style.setProperty('--i',idx%6);
    el.classList.add('vj-reveal');
    io.observe(el);
  });
})();
</script>
<?php include __DIR__.'/footer.php'; ?>
</body></html>
<?php }

function product_card($p){ ?>
<article class="product-card" data-product="<?=h($p['id'])?>">
  <a href="/product/<?=h($p['slug'])?>" aria-label="<?=h($p['name'])?>">
    <div class="product-image">
      <img class="first" src="<?=h($p['images'][0])?>" alt="<?=h($p['name'])?>" loading="lazy">
      <img class="second" src="<?=h($p['images'][1])?>" alt="" loading="lazy">
      <button class="wishlist-btn" type="button" data-wishlist="<?=h($p['id'])?>" aria-label="Add to wishlist"><svg viewBox="0 0 24 24"><path d="M20.5 8.5c0 5-8.5 10-8.5 10S3.5 13.5 3.5 8.5A4.5 4.5 0 0 1 12 6.3a4.5 4.5 0 0 1 8.5 2.2Z"></path></svg></button>
      <div class="quick-sizes">
        <?php foreach(['XS','S','M','L','XL'] as $s): ?><button type="button" data-quick-add="<?=h($p['id'])?>" data-size="<?=$s?>"><?=$s?></button><?php endforeach; ?>
      </div>
    </div>
    <div class="product-info">
      <div class="product-name"><?=h($p['name'])?></div>
      <div class="product-price"><?=money($p['price'])?><?php if($p['compare_at']): ?><del><?=money($p['compare_at'])?></del><span class="sale-tag">SALE</span><?php endif; ?></div>
      <span class="product-link">View product</span>
    </div>
  </a>
</article>
<?php }

function render_home(){
 render_head('Vyojin — Premium Indian Fashion'); ?>
<main>
<section class="hero" data-hero>
 <div class="hero-track">
  <?php foreach([['hero-1.jpeg','Festive dressing, reimagined.','Explore Diwali Luxe','/diwali'],['hero-2.jpeg','The celebration edit.','Shop Festive','/festive'],['hero-3.jpeg','New season. New silhouettes.','New Arrivals','/new']] as $i=>$s): ?>
<article class="hero-slide"><img src="/assets/hero/<?=$s[0]?>" alt="<?=h($s[1])?>" loading="<?=$i?'lazy':'eager'?>"><div class="hero-copy"><h1 class="sr-only"><?=h($s[1])?></h1><a href="<?=$s[3]?>"><?=$s[2]?> ↗</a></div></article>  <?php endforeach; ?>
 </div>
 <button class="hero-arrow hero-prev" type="button" aria-label="Previous">‹</button><button class="hero-arrow hero-next" type="button" aria-label="Next">›</button>
 <div class="hero-dots"><?php for($i=0;$i<3;$i++): ?><button class="<?=$i===0?'active':''?>" data-hero-dot="<?=$i?>" type="button"></button><?php endfor; ?></div>
</section>
<div class="announcement"><span>Designed for celebrations. Made for the modern Indian wardrobe. </span><a href="/new">SHOP NEW</a></div>
<section class="vj-trust" aria-label="Our promises">
 <?php
 $trust=[
  ['24-Hour Dispatch','Fast & carefully packed','<path d="M3 6h11v10H3zM14 9h4l3 3v4h-7"/><circle cx="7.5" cy="17.5" r="1.8"/><circle cx="17.5" cy="17.5" r="1.8"/>'],
  ['Easy Returns','Simple & stress-free','<path d="M4 12a8 8 0 0 1 14-5.3L20 9M20 4v5h-5M20 12a8 8 0 0 1-14 5.3L4 15M4 20v-5h5"/>'],
  ['Personal Styling','Assistance when you need it','<circle cx="12" cy="8" r="3.5"/><path d="M5 20c1.2-4 3.6-6 7-6s5.8 2 7 6M19 3v3M17.5 4.5h3"/>'],
  ['Secure Checkout','Safe and simple shopping','<path d="M12 3 5 6v5c0 4.5 3 8 7 10 4-2 7-5.5 7-10V6z"/><path d="m9 12 2.2 2.2L15.5 10"/>'],
 ];
 foreach($trust as $i=>$t): ?>
 <div class="vj-trust-item" style="--d:<?=$i*0.12?>s">
  <span class="vj-trust-icon"><svg viewBox="0 0 24 24"><?=$t[2]?></svg></span>
  <div class="vj-trust-text"><strong><?=h($t[0])?></strong><small><?=h($t[1])?></small></div>
 </div>
 <?php endforeach; ?>
</section>

<section class="home-section">
 <div class="section-heading"><span class="eyebrow">Shop by mood</span><h2>Curated For You</h2><p>Discover the silhouettes that define the Vyojin wardrobe, from everyday elegance to the season's biggest celebrations.</p></div>
 <div class="category-grid">
 <?php
 $cats=[['sarees','Sarees','assets/sections/products/green-floral/1.webp'],['salwar-kameez','Salwar Kameez','assets/sections/products/emerald-green/1.webp'],['lehenga','Lehenga','assets/sections/products/red-and-white-printed-festive-lehenga/1.webp'],['indo-western','Indo Western','assets/sections/products/black-multicolour/1.webp'],['wedding','Wedding','assets/sections/products/navy-blue-multicolour-mirror-work-lehenga/1.webp'],['diwali','Diwali Luxe','assets/hero/hero-2.jpeg']];
 foreach($cats as $c): ?><a class="category-card" href="/<?=$c[0]?>"><img src="/<?=$c[2]?>" alt="<?=$c[1]?>"><div><strong><?=$c[1]?></strong><span>Shop now ↗</span></div></a><?php endforeach; ?>
 </div>
</section>

<?php
$sections=[['new','New Arrivals'],['best-sellers','Best Sellers'],['sale','Sale Edit']];
foreach($sections as [$key,$label]):
 $ps=array_slice(category_products($key),0,4);
 if(!$ps) continue;
?>
<section class="home-section">
 <div class="section-heading"><span class="eyebrow">VYOJIN / <?=strtoupper($label)?></span><h2><?=h($label)?></h2></div>
 <div class="product-strip"><?php foreach($ps as $p) product_card($p); ?></div>
</section>
<?php endforeach; ?>

<section class="home-section">
 <div class="editorial">
<a class="editorial-card" href="/wedding">
  <video src="/assets/sections/videos/product-video.mp4"
         autoplay muted loop playsinline preload="metadata"
         aria-label="Wedding edit"></video>
  <div>
    <span class="eyebrow">THE OCCASION EDIT</span>
    <h3>The Festive Edit</h3>
    <span>Discover festival dressing ↗</span>
  </div>
</a>  
<a class="editorial-card" href="/ready-to-ship"><img src="/assets/sections/products/black-white/1.webp" alt="Ready to ship"><div><span class="eyebrow">FAST DISPATCH</span><h3>Ready to Ship</h3><span>Shop ready styles ↗</span></div></a>
 </div>
</section>

<section class="home-section">
 <div class="section-heading"><span class="eyebrow">Explore Vyojin</span><h2>Dress the Occasion</h2></div>
 <div class="category-grid">
 <?php foreach([['chaniya-choli','Chaniya Choli','assets/sections/products/teal-blue-festive-chaniya-choli/1.webp'],['festive','Festive','assets/hero/hero-1.jpeg'],['new','New Arrivals','assets/hero/hero-3.jpeg'],['best-sellers','Best Sellers','assets/sections/products/royal-blue/1.webp'],['ready-to-ship','Ready to Ship','assets/sections/products/black-white/1.webp'],['sale','Sale','assets/sections/products/pink-multicolour-festive-lehenga/1.webp']] as $c): ?><a class="category-card" href="/<?=$c[0]?>"><img src="/<?=$c[2]?>" alt="<?=h($c[1])?>"><div><strong><?=h($c[1])?></strong><span>Explore ↗</span></div></a><?php endforeach; ?>
 </div>
</section>
</main>
<?php render_foot(); }

function render_collection($key){
 $defs=category_defs(); $d=$defs[$key]??$defs['collection']; $items=category_products($key);
 $filters=$_GET;
 // functional filters
 if(!empty($filters['size'])) $items=array_values(array_filter($items,fn($p)=>in_array($filters['size'],$p['sizes'],true)));
 if(!empty($filters['color'])) $items=array_values(array_filter($items,fn($p)=>strcasecmp($p['color'],$filters['color'])===0));
 if(!empty($filters['fabric'])) $items=array_values(array_filter($items,fn($p)=>strcasecmp($p['fabric'],$filters['fabric'])===0));
 if(!empty($filters['availability']) && $filters['availability']==='ready') $items=array_values(array_filter($items,fn($p)=>$p['ready']));
 if(!empty($filters['price'])){
   $range=$filters['price']; $items=array_values(array_filter($items,function($p)use($range){$v=$p['price']; return $range==='under-2000'?$v<2000:($range==='2000-5000'?$v>=2000&&$v<=5000:($range==='5000-10000'?$v>5000&&$v<=10000:$v>10000));}));
 }
 $sort=$_GET['sort']??'featured';
 usort($items,function($a,$b)use($sort){
   if($sort==='price-low') return $a['price']<=>$b['price'];
   if($sort==='price-high') return $b['price']<=>$a['price'];
   if($sort==='newest') return $b['new']<=>$a['new'];
   if($sort==='best') return $b['best']<=>$a['best'];
   return 0;
 });
 $per=12; $page=max(1,(int)($_GET['page']??1)); $pages=max(1,(int)ceil(count($items)/$per)); $slice=array_slice($items,($page-1)*$per,$per);
 render_head($d['title']); ?>
<div class="breadcrumb"><a href="/">Home</a><span>/</span><a href="/collection">Collection</a><span>/</span><b><?=h($d['label'])?></b></div>
<section class="category-hero"><img src="<?=h($d['hero'])?>" alt="<?=h($d['title'])?>"><div class="category-hero-content"><span class="eyebrow">VYOJIN / <?=strtoupper(h($d['label']))?></span><h1><?=h($d['title'])?></h1><p><?=h($d['desc'])?></p></div></section>
<div class="collection-layout">
 <aside class="filters" id="filters">
  <h3>FILTERS</h3>
  <?php
  $groups=[
   ['Size','size',['XS','S','M','L','XL','XXL'],''],
   ['Price','price',['under-2000','2000-5000','5000-10000','10000-plus'],''],
   ['Color','color',['Black','Red','Green','Blue','Pink','Ivory','Yellow','Maroon'],''],
   ['Fabric','fabric',['Silk','Georgette','Chinon','Organza','Crepe','Chanderi'],''],
   ['Occasion','occasion',['Wedding','Festive','Celebration'],''],
   ['Availability','availability',['ready'],''],
  ];
  foreach($groups as $g): ?>
  <div class="filter-group open"><button class="filter-summary" type="button"><span><?=h($g[0])?></span><b>−</b></button><div class="filter-content">
   <?php foreach($g[2] as $v): $label=$v==='10000-plus'?'₹10,000+':($v==='under-2000'?'Under ₹2,000':str_replace('-', '–', $v)); ?>
   <label><input type="checkbox" name="<?=strtolower($g[0])?>" value="<?=h($v)?>" <?=isset($_GET[strtolower($g[0])])&&$_GET[strtolower($g[0])] === $v?'checked':''?>> <?=h($label)?></label>
   <?php endforeach; ?>
  </div></div>
  <?php endforeach; ?>
  <button class="filter-clear" type="button" id="clearFilters">Clear Filters</button>
 </aside>
 <section>
  <div class="listing-head"><div><h2><?=h($d['title'])?></h2><p><?=count($items)?> styles</p></div><div class="sort-wrap"><button class="mobile-filter-btn" type="button" id="mobileFilterBtn">Filters</button><span>Sort by</span><select id="sortSelect"><option value="featured" <?=$sort==='featured'?'selected':''?>>Featured</option><option value="newest" <?=$sort==='newest'?'selected':''?>>Newest</option><option value="best" <?=$sort==='best'?'selected':''?>>Best Selling</option><option value="price-low" <?=$sort==='price-low'?'selected':''?>>Price Low to High</option><option value="price-high" <?=$sort==='price-high'?'selected':''?>>Price High to Low</option></select></div></div>
  <div class="product-grid"><?php foreach($slice as $p) product_card($p); ?></div>
  <?php if($pages>1): ?><div class="pagination"><?php for($n=1;$n<=$pages;$n++): $q=$_GET;$q['page']=$n;$href='/'.$key.'?'.http_build_query($q); ?><a class="<?=$n===$page?'active':''?>" href="<?=$href?>"><?=$n?></a><?php endfor; ?></div><?php endif; ?>
 </section>
</div>
<?php render_foot(); }

function render_product($slug){
 $p=product_by_slug($slug); if(!$p){http_response_code(404); render_head('Product Not Found'); echo '<div class="basic-page empty"><h1>Product not found</h1><a class="cta primary" href="/collection">Continue shopping</a></div>'; render_foot(); return;}
 $related=array_values(array_filter(products_all(),fn($x)=>$x['category']===$p['category'] && $x['id']!==$p['id']));
 render_head($p['name']); ?>
<div class="breadcrumb"><a href="/">Home</a><span>/</span><a href="/<?=$p['category']?>"><?=h(category_defs()[$p['category']]['label']??'Collection')?></a><span>/</span><b><?=h($p['name'])?></b></div>
<main class="product-page"><div class="product-layout">
 <section class="gallery"><div class="thumbs"><?php foreach($p['images'] as $i=>$img): ?><button class="thumb <?=$i===0?'active':''?>" type="button" data-thumb="<?=$i?>"><img src="<?=h($img)?>" alt=""></button><?php endforeach; ?></div><div class="main-image"><img id="mainProductImage" src="<?=h($p['images'][0])?>" alt="<?=h($p['name'])?>"></div></section>
 <section class="product-details" data-product-page="<?=h($p['id'])?>">
  <span class="eyebrow"><?=strtoupper(h($p['occasion']))?></span><h1><?=h($p['name'])?></h1>
  <div class="detail-price"><?=money($p['price'])?><?php if($p['compare_at']): ?><del><?=money($p['compare_at'])?></del><?php endif; ?></div>
  <p class="detail-copy"><?=h($p['description'])?></p>
  <div class="detail-block"><h3>Select Size</h3><div class="sizes"><?php foreach($p['sizes'] as $s): ?><button class="size-btn" type="button" data-size="<?=$s?>"><?=$s?></button><?php endforeach; ?></div><div class="size-error" id="sizeError">Please select a size.</div><a href="#size-guide" class="product-link">Size Guide</a></div>
  <div class="detail-block"><h3>Delivery</h3><div class="delivery"><input id="pincode" maxlength="6" inputmode="numeric" placeholder="Enter pincode"><button type="button" id="checkPin">Check</button></div><small id="pinResult"></small></div>
  <div class="product-cta"><button class="cta primary" id="addToCart" type="button">ADD TO CART</button><button class="cta" id="buyNow" type="button">BUY NOW</button></div>
  <div class="accordion open"><button type="button">Product Details <span>−</span></button><div>Fabric: <?=h($p['fabric'])?>. Colour: <?=h($p['color'])?>. Designed in India with a focus on finish, fit and occasion-ready detailing.</div></div>
  <div class="accordion"><button type="button">Style & Fit <span>+</span></button><div>Contemporary Indian fit with an easy, elegant silhouette. Please refer to the size guide before ordering.</div></div>
  <div class="accordion"><button type="button">Shipping & Returns <span>+</span></button><div>Selected ready-to-ship styles dispatch faster. Returns are available according to the Vyojin returns policy.</div></div>
  <div class="accordion"><button type="button">FAQs <span>+</span></button><div>Need styling help? Visit our contact page for customer support and personal assistance.</div></div>
 </section>
 
</div>
<section class="home-section"><div class="section-heading"><span class="eyebrow">YOU MAY ALSO LIKE</span><h2>Similar Products</h2></div><div class="product-strip"><?php foreach(array_slice($related,0,4) as $x) product_card($x); ?></div></section>
</main>
<?php render_foot(); }

function render_cart(){
 render_head('Shopping Bag'); ?>
<div class="cart-page"><h1 class="page-title">Shopping Bag</h1><div id="cartRoot"></div></div>
<?php render_foot(); }

function render_wishlist(){
 render_head('Wishlist'); ?>
<div class="basic-page"><h1 class="page-title">Wishlist</h1><div id="wishlistRoot" class="product-grid"></div></div>
<?php render_foot(); }

function render_search(){
 $q=trim($_GET['q']??''); $items=products_all();
 if($q!==''){ $needle=strtolower($q); $items=array_values(array_filter($items,fn($p)=>str_contains(strtolower($p['name'].' '.$p['category'].' '.$p['color'].' '.$p['fabric']),$needle))); }
 render_head('Search'); ?>
<div class="basic-page"><h1 class="page-title">Search<?= $q?' — '.h($q):'' ?></h1><?php if(!$items): ?><div class="empty">No products found. Try another search.</div><?php else: ?><div class="search-results"><?php foreach($items as $p) product_card($p); ?></div><?php endif; ?></div>
<?php render_foot(); }

function render_auth($register=false){
 if($_SERVER['REQUEST_METHOD']==='POST'){
   $_SESSION['user']=['name'=>trim($_POST['name']??'Customer'),'email'=>trim($_POST['email']??'')];
   header('Location: /checkout'); exit;
 }
 render_head($register?'Create Account':'Login'); ?>
<div class="basic-page"><div class="auth-box"><h1><?=$register?'Create your account':'Welcome back'?></h1><form method="post"><?php if($register): ?><div class="form-field"><label>Name</label><input required name="name"></div><?php endif; ?><div class="form-field"><label>Email</label><input required type="email" name="email"></div><div class="form-field" style="margin-top:14px"><label>Password</label><input required type="password" name="password"></div><button class="full-btn" type="submit"><?=$register?'REGISTER':'LOGIN'?></button></form><div class="auth-switch"><?=$register?'Already have an account?':'New to Vyojin?'?> <a href="<?=$register?'/login':'/register'?>"><?=$register?'Login':'Create an account'?></a></div></div></div>
<?php render_foot(); }

function render_checkout(){
 if(empty($_SESSION['user'])){ render_head('Checkout'); echo '<div class="basic-page"><div class="auth-box"><h1>Checkout</h1><p>Please login or register to continue.</p><a class="full-btn" href="/login">LOGIN</a><a class="cta" style="margin-top:10px" href="/register">CREATE ACCOUNT</a></div></div>'; render_foot(); return; }
 if($_SERVER['REQUEST_METHOD']==='POST'){ $_SESSION['order_no']='VJ'.date('ymdHis').rand(10,99); header('Location: /order-success'); exit; }
 render_head('Checkout'); ?>
<div class="checkout-page"><h1 class="page-title">Checkout</h1><div class="checkout-layout"><form method="post"><div class="checkout-step"><h3>1. Delivery Address</h3><div class="form-grid"><div class="form-field"><label>First name</label><input required name="first"></div><div class="form-field"><label>Last name</label><input required name="last"></div><div class="form-field full"><label>Address</label><input required name="address"></div><div class="form-field"><label>City</label><input required name="city"></div><div class="form-field"><label>PIN</label><input required maxlength="6" name="pin"></div><div class="form-field"><label>Phone</label><input required name="phone"></div></div></div><div class="checkout-step"><h3>2. Delivery Method</h3><div class="radio-list"><label><input type="radio" name="delivery" checked value="standard"> Standard delivery — Free</label><label><input type="radio" name="delivery" value="express"> Express delivery — ₹199</label></div></div><div class="checkout-step"><h3>3. Payment</h3><div class="radio-list"><label><input type="radio" name="payment" checked value="card"> Card / UPI</label><label><input type="radio" name="payment" value="cod"> Cash on Delivery</label></div></div><button class="full-btn" type="submit">PLACE ORDER</button></form><div class="summary"><h3>Order Summary</h3><div id="checkoutSummary">Your selected items will appear here.</div></div></div></div>
<?php render_foot(); }

function render_basic($title,$content){
 render_head($title); echo '<div class="basic-page"><h1 class="page-title">'.h($title).'</h1><div class="detail-copy">'. $content .'</div></div>'; render_foot();
}

$route=route_path();
if($route==='/'||$route==='') render_home();
elseif(str_starts_with($route,'/product/')) render_product(trim(substr($route,9),'/'));
elseif($route==='/cart') render_cart();
elseif($route==='/wishlist') render_wishlist();
elseif($route==='/search') render_search();
elseif($route==='/login') render_auth(false);
elseif($route==='/register') render_auth(true);
elseif($route==='/checkout') render_checkout();
elseif($route==='/order-success'){
  $no=$_SESSION['order_no']??'VJ'.date('ymdHis'); render_head('Order Confirmed'); echo '<div class="basic-page success"><span class="eyebrow">VYOJIN</span><h1>Thank you for your order.</h1><p>Your order <strong>'.h($no).'</strong> has been received. A confirmation will be sent to your account email.</p><a class="cta primary" href="/new">CONTINUE SHOPPING</a></div>'; render_foot();
}
elseif($route==='/about') render_basic('About Vyojin','Vyojin is a contemporary Indian fashion label focused on women’s clothing, occasionwear and modern festive dressing.');
elseif($route==='/contact') render_basic('Contact','For styling, order or delivery support, contact the Vyojin customer care team. We are happy to help with sizing, product details and your shopping journey.');
elseif($route==='/shipping') render_basic('Shipping','Ready-to-ship styles are dispatched on an accelerated schedule. Delivery timelines are shown during checkout based on your address.');
elseif($route==='/returns') render_basic('Returns','Eligible products may be returned according to the Vyojin return policy. Please contact support with your order number for assistance.');
elseif($route==='/faq') render_basic('FAQs','For product sizing, delivery, returns and styling questions, contact customer care.');
elseif($route==='/privacy') render_basic('Privacy Policy','Vyojin respects your privacy and uses customer information only to provide services, process orders and support your account.');
elseif($route==='/terms') render_basic('Terms & Conditions','By shopping with Vyojin you agree to our product, payment, shipping and returns terms.');
elseif($route==='/newsletter'){
  if($_SERVER['REQUEST_METHOD']==='POST') header('Location: /?subscribed=1');
  else header('Location: /');
  exit;
}
else{
  $key=ltrim($route,'/');
  $defs=category_defs();
  if(isset($defs[$key])) render_collection($key);
  else {http_response_code(404); render_basic('Page Not Found','The page you requested could not be found. <a href="/">Return to Vyojin home.</a>');}
}
