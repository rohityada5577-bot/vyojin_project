<?php
session_start();
$PRODUCTS = require __DIR__ . '/../data/products.php';

function products_all(){ global $PRODUCTS; return $PRODUCTS; }
function product_by_slug($slug){ foreach(products_all() as $p){ if($p['slug']===$slug || $p['id']===$slug) return $p; } return null; }
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function money($v){ return '₹'.number_format((float)$v,0); }

function route_path(){
  $path=parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
  $base=rtrim(str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
  if($base && $base!=='/' && str_starts_with($path,$base)) $path=substr($path,strlen($base));
  return '/'.trim($path,'/');
}
function url($path){ return $path===''?'/':$path; }

function category_defs(){
 return [
  'sarees'=>['label'=>'Sarees','title'=>'Timeless Sarees','desc'=>'Elegant drapes, modern colour stories and occasion-ready sarees designed for the contemporary woman.','hero'=>'/assets/sections/products/green-floral/1.webp'],
  'salwar-kameez'=>['label'=>'Salwar Kameez','title'=>'Elegant Salwar Kameez','desc'=>'Polished anarkalis, kurta sets and refined silhouettes for festive days and intimate celebrations.','hero'=>'/assets/sections/products/emerald-green/1.webp'],
  'lehenga'=>['label'=>'Lehenga','title'=>'Lehenga Edit','desc'=>'Statement lehengas with colour, craft and movement for every celebration on your calendar.','hero'=>'/assets/sections/products/red-and-white-printed-festive-lehenga/1.webp'],
  'indo-western'=>['label'=>'Indo Western','title'=>'Modern Indian','desc'=>'Contemporary silhouettes that blend Indian craft with an effortless modern wardrobe.','hero'=>'/assets/sections/products/black-multicolour/1.webp'],
  'chaniya-choli'=>['label'=>'Chaniya Choli','title'=>'Chaniya Choli Edit','desc'=>'Festive colour, mirror work and joyful movement designed for celebratory dressing.','hero'=>'/assets/sections/products/ivory-black-floral-printed-chaniya-choli/1.webp'],
  'wedding'=>['label'=>'Wedding','title'=>'The Wedding Edit','desc'=>'Curated wedding looks for brides, bridesmaids and every unforgettable guest moment.','hero'=>'/assets/sections/products/navy-blue-multicolour-mirror-work-lehenga/1.webp'],
  'festive'=>['label'=>'Festive','title'=>'Festive Dressing','desc'=>'Celebration-ready styles designed around colour, craft and effortless elegance.','hero'=>'/assets/hero/hero-2.jpeg'],
  'new'=>['label'=>'New Arrivals','title'=>'New Arrivals','desc'=>'The latest Vyojin silhouettes, fresh colours and new-season occasion dressing.','hero'=>'/assets/hero/hero-3.jpeg'],
  'best-sellers'=>['label'=>'Best Sellers','title'=>'Best Sellers','desc'=>'The Vyojin pieces customers keep coming back to—signature silhouettes with proven appeal.','hero'=>'/assets/sections/products/royal-blue/1.webp'],
  'sale'=>['label'=>'Sale','title'=>'Season Sale','desc'=>'Limited-time edits and considered prices across selected Vyojin occasionwear.','hero'=>'/assets/sections/products/pink-multicolour-festive-lehenga/1.webp'],
  'ready-to-ship'=>['label'=>'Ready to Ship','title'=>'Ready to Ship','desc'=>'Selected styles prepared for faster dispatch, without compromising on the Vyojin finish.','hero'=>'/assets/sections/products/black-white/1.webp'],
  'diwali'=>['label'=>'Diwali Luxe','title'=>'Diwali Luxe','desc'=>'Luminous festive dressing made for evenings filled with light, colour and celebration.','hero'=>'/assets/hero/hero-1.jpeg'],
  'collection'=>['label'=>'Collection','title'=>'Vyojin Collections','desc'=>'Explore the full edit across sarees, suits, lehengas and contemporary Indian silhouettes.','hero'=>'/assets/hero/hero-1.jpeg'],
 ];
}

function category_products($key){
  $all=products_all();
  if($key==='collection') return $all;
  if($key==='sarees'||$key==='salwar-kameez'||$key==='lehenga'||$key==='indo-western'||$key==='chaniya-choli') return array_values(array_filter($all,fn($p)=>$p['category']===$key));
  if($key==='wedding') return array_values(array_filter($all,fn($p)=>$p['wedding']));
  if($key==='festive') return array_values(array_filter($all,fn($p)=>$p['diwali']));
  if($key==='new') return array_values(array_filter($all,fn($p)=>$p['new']));
  if($key==='best-sellers') return array_values(array_filter($all,fn($p)=>$p['best']));
  if($key==='sale') return array_values(array_filter($all,fn($p)=>$p['sale']));
  if($key==='ready-to-ship') return array_values(array_filter($all,fn($p)=>$p['ready']));
  if($key==='diwali') return array_values(array_filter($all,fn($p)=>$p['diwali']));
  return $all;
}
