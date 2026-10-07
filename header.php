<?php
require_once __DIR__.'/lib/helpers.php';
$rp=route_path();
$nav=[
 ['Ready To Ship','/ready-to-ship','ready-to-ship'],
 ['Diwali','/diwali','diwali'],
 ['Sarees','/sarees','sarees'],
 ['Salwar Kameez','/salwar-kameez','salwar-kameez'],
 ['Lehenga','/lehenga','lehenga'],
 ['Indo Western','/indo-western','indo-western'],
 ['Best Sellers','/best-sellers','best-sellers'],
 ['New','/new','new'],
 ['Wedding','/wedding','wedding'],
 ['Collection','/collection','collection'],
 ['Sale','/sale','sale'],
];
$disabled=array_column($nav,2); // saglya menu items band; ek-ek chalu karaychi asel tar he list lihaa, udaharan ['sale']function activeNav($key,$rp){ return ($rp==='/'.$key || ($key==='collection' && $rp==='/collection')) ? ' active' : ''; }
?>
<header class="site-header">
  <div class="header-top">
    <div class="header-side header-side-left">
      <a class="top-pill active" href="/collection">WOMEN</a>
      <a href="/wedding">MEN</a>
      <a href="/collection?filter=luxe">LUXE</a>
    </div>
    <a class="brand" href="/" aria-label="Vyojin home"><img src="/assets/logo/vyojin-logo.png" alt="Vyojin"></a>
    <div class="header-actions">
      <form class="header-search" action="/search" method="get">
        <input name="q" aria-label="Search" placeholder="Search" autocomplete="off">
        <button type="submit" aria-label="Search"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"></circle><path d="m16.2 16.2 4.3 4.3"></path></svg></button>
      </form>
      <a class="icon-link desktop-only" href="/contact?channel=visual-search" aria-label="Visual search"><svg viewBox="0 0 24 24"><rect x="4" y="5" width="13" height="14" rx="2"></rect><path d="M8 5V3h8v2M15 15h6M18 12v6"></path></svg></a>
      <a class="icon-link desktop-only" href="/contact?channel=whatsapp" aria-label="WhatsApp"><svg viewBox="0 0 24 24"><path d="M20 11.6a8.2 8.2 0 0 1-12.2 7L4 20l1.5-3.8A8.2 8.2 0 1 1 20 11.6Z"></path><path d="M8.4 8.3c.2 2.2 3.1 5.1 5.3 5.3"></path></svg></a>
      <a class="icon-link" href="/account" aria-label="Account"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20c1.4-4 4-6 7-6s5.6 2 7 6"></path><circle cx="12" cy="12" r="9"></circle></svg></a>
      <a class="icon-link" href="/wishlist" aria-label="Wishlist"><svg viewBox="0 0 24 24"><path d="M20.5 8.5c0 5-8.5 10-8.5 10S3.5 13.5 3.5 8.5A4.5 4.5 0 0 1 12 6.3a4.5 4.5 0 0 1 8.5 2.2Z"></path></svg></a>
      <a class="icon-link cart-link" href="/cart" aria-label="Shopping bag"><svg viewBox="0 0 24 24"><path d="M5 8h14l1 12H4L5 8Z"></path><path d="M9 9V6a3 3 0 0 1 6 0v3"></path></svg><span class="cart-count" id="cartCount">0</span></a>
      <button class="mobile-menu-toggle" type="button" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
  <nav class="main-nav" aria-label="Main navigation">
    <?php foreach($nav as [$label,$href,$key]): ?>
      <?php if(in_array($key,$disabled,true)): ?>
        <span class="nav-link is-disabled" aria-disabled="true" title="Coming soon"><?=$label?></span>
      <?php else: ?>
        <a class="nav-link<?=activeNav($key,$rp)?>" href="<?=$href?>"><?=$label?></a>
      <?php endif; ?>
    <?php endforeach; ?>
  </nav>
  <div class="mobile-drawer" aria-hidden="true">
    <div class="mobile-drawer-head"><strong>SHOP</strong><button class="mobile-menu-close" type="button" aria-label="Close menu">×</button></div>
    <div class="mobile-links">
      <?php foreach($nav as [$label,$href,$key]): ?>
        <?php if(in_array($key,$disabled,true)): ?>
          <span class="is-disabled" aria-disabled="true"><?=$label?></span>
        <?php else: ?>
          <a class="<?=activeNav($key,$rp)?>" href="<?=$href?>"><?=$label?></a>
        <?php endif; ?>
      <?php endforeach; ?>
      <a href="/search">Search</a><a href="/account">Account</a><a href="/wishlist">Wishlist</a><a href="/cart">Bag</a>
    </div>
  </div>
  <div class="mobile-backdrop"></div>
</header>