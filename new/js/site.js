
document.addEventListener("DOMContentLoaded",()=>{
  const toast=(msg)=>{let t=document.getElementById("toast");if(!t)return;t.textContent=msg;t.classList.add("show");clearTimeout(window.__toast);window.__toast=setTimeout(()=>t.classList.remove("show"),1800)};
  const updateCount=()=>{const n=(window.vyojinCart?.items()||[]).reduce((s,x)=>s+x.qty,0);document.querySelectorAll("#cartCount").forEach(x=>x.textContent=n)};
  updateCount();window.addEventListener("vyojin:cart",updateCount);

  // mobile nav
  const toggle=document.querySelector(".mobile-menu-toggle"), drawer=document.querySelector(".mobile-drawer"), close=document.querySelector(".mobile-menu-close"), backdrop=document.querySelector(".mobile-backdrop");
  function openMenu(){drawer?.classList.add("open");backdrop?.classList.add("open");toggle?.setAttribute("aria-expanded","true");drawer?.setAttribute("aria-hidden","false");document.body.style.overflow="hidden"}
  function closeMenu(){drawer?.classList.remove("open");backdrop?.classList.remove("open");toggle?.setAttribute("aria-expanded","false");drawer?.setAttribute("aria-hidden","true");document.body.style.overflow=""}
  toggle?.addEventListener("click",openMenu);close?.addEventListener("click",closeMenu);backdrop?.addEventListener("click",closeMenu);drawer?.querySelectorAll("a").forEach(a=>a.addEventListener("click",closeMenu));

  // hero
  const hero=document.querySelector("[data-hero]"); if(hero){let i=0,track=hero.querySelector(".hero-track"),slides=hero.querySelectorAll(".hero-slide"),dots=hero.querySelectorAll("[data-hero-dot]");const go=n=>{i=(n+slides.length)%slides.length;track.style.transform=`translateX(-${i*100}%)`;dots.forEach((d,k)=>d.classList.toggle("active",k===i))};hero.querySelector(".hero-prev")?.addEventListener("click",()=>go(i-1));hero.querySelector(".hero-next")?.addEventListener("click",()=>go(i+1));dots.forEach((d,k)=>d.addEventListener("click",()=>go(k)));setInterval(()=>go(i+1),6000)}

  // wishlist
  document.querySelectorAll("[data-wishlist]").forEach(btn=>btn.addEventListener("click",e=>{e.preventDefault();e.stopPropagation();const added=window.vyojinWishlist.toggle(btn.dataset.wishlist);btn.classList.toggle("active",added);toast(added?"Added to wishlist":"Removed from wishlist")}));

  // quick add
  document.querySelectorAll("[data-quick-add]").forEach(btn=>btn.addEventListener("click",e=>{e.preventDefault();e.stopPropagation();const p=window.VYOJIN_PRODUCTS.find(x=>x.id===btn.dataset.quickAdd);if(window.vyojinCart.add(p,btn.dataset.size,1)){toast("Added to bag");updateCount()}}));

  // product page gallery and size
  const pp=document.querySelector("[data-product-page]"); if(pp){
    const id=pp.dataset.productPage,p=window.VYOJIN_PRODUCTS.find(x=>x.id===id);let selected="";
    document.querySelectorAll("[data-thumb]").forEach((b,i)=>b.addEventListener("click",()=>{document.querySelectorAll(".thumb").forEach(x=>x.classList.remove("active"));b.classList.add("active");document.getElementById("mainProductImage").src=p.images[i]}));
    document.querySelectorAll(".size-btn").forEach(b=>b.addEventListener("click",()=>{selected=b.dataset.size;document.querySelectorAll(".size-btn").forEach(x=>x.classList.remove("active"));b.classList.add("active");document.getElementById("sizeError").style.display="none"}));
    const add=()=>{if(!selected){document.getElementById("sizeError").style.display="block";return false}window.vyojinCart.add(p,selected,1);toast("Added to bag");return true};
    document.getElementById("addToCart")?.addEventListener("click",add);
    document.getElementById("buyNow")?.addEventListener("click",()=>{if(add()) location.href="/checkout"});
    document.getElementById("checkPin")?.addEventListener("click",()=>{const v=document.getElementById("pincode").value;document.getElementById("pinResult").textContent=/^\d{6}$/.test(v)?"Delivery available to this pincode.":"Enter a valid 6-digit pincode."});
  }

  // accordions
  document.querySelectorAll(".accordion button").forEach(b=>b.addEventListener("click",()=>{const a=b.closest(".accordion");a.classList.toggle("open");b.querySelector("span").textContent=a.classList.contains("open")?"−":"+"}));
  // filters
  document.querySelectorAll(".filter-summary").forEach(b=>b.addEventListener("click",()=>{const g=b.closest(".filter-group");g.classList.toggle("open");b.querySelector("b").textContent=g.classList.contains("open")?"−":"+"}));
  const filters=document.getElementById("filters"), mobileBtn=document.getElementById("mobileFilterBtn"); mobileBtn?.addEventListener("click",()=>filters.classList.add("mobile-open"));
  if(filters){const close=()=>filters.classList.remove("mobile-open");let x=document.createElement("button");x.className="filter-clear mobile-close-filter";x.textContent="Close Filters";x.addEventListener("click",close);filters.insertBefore(x,filters.firstChild)}
  // submit filter when checkbox changes
  document.querySelectorAll(".filter-content input").forEach(inp=>inp.addEventListener("change",()=>{const u=new URL(location.href);document.querySelectorAll(".filter-content input:checked").forEach(x=>u.searchParams.set(x.name,x.value));document.querySelectorAll(".filter-content input:not(:checked)").forEach(x=>{if(u.searchParams.get(x.name)===x.value)u.searchParams.delete(x.name)});u.searchParams.delete("page");location.href=u.toString()}));
  document.getElementById("clearFilters")?.addEventListener("click",()=>{const u=new URL(location.href);["size","price","color","fabric","occasion","availability"].forEach(k=>u.searchParams.delete(k));u.searchParams.delete("page");location.href=u.toString()});
  document.getElementById("sortSelect")?.addEventListener("change",e=>{const u=new URL(location.href);u.searchParams.set("sort",e.target.value);u.searchParams.delete("page");location.href=u.toString()});

  // cart renderer
  const cartRoot=document.getElementById("cartRoot"); if(cartRoot){
    const render=()=>{const items=window.vyojinCart.items();if(!items.length){cartRoot.innerHTML='<div class="empty">Your bag is empty.<br><a class="cta primary" href="/new" style="margin:20px auto 0;max-width:240px">SHOP NEW ARRIVALS</a></div>';return}let sub=items.reduce((s,x)=>s+x.price*x.qty,0);cartRoot.innerHTML=`<div class="cart-layout"><div>${items.map(x=>`<div class="cart-item"><img src="${x.image}" alt=""><div><h3>${x.name}</h3><div class="cart-meta">Size: ${x.size}</div><div class="qty"><button data-qminus="${x.key}">−</button><span>${x.qty}</span><button data-qplus="${x.key}">+</button></div><button class="remove" data-remove="${x.key}">Remove</button></div><strong>₹${(x.price*x.qty).toLocaleString('en-IN')}</strong></div>`).join("")}</div><aside class="summary"><h3>Order Summary</h3><div class="sum-row"><span>Subtotal</span><strong>₹${sub.toLocaleString('en-IN')}</strong></div><div class="sum-row"><span>Shipping</span><strong>Free</strong></div><div class="sum-row sum-total"><span>Total</span><strong>₹${sub.toLocaleString('en-IN')}</strong></div><a class="full-btn" href="/checkout">CHECKOUT</a></aside></div>`;cartRoot.querySelectorAll("[data-remove]").forEach(b=>b.onclick=()=>window.vyojinCart.remove(b.dataset.remove));cartRoot.querySelectorAll("[data-qminus]").forEach(b=>b.onclick=()=>{let x=window.vyojinCart.items().find(i=>i.key===b.dataset.qminus);window.vyojinCart.update(x.key,x.qty-1)});cartRoot.querySelectorAll("[data-qplus]").forEach(b=>b.onclick=()=>{let x=window.vyojinCart.items().find(i=>i.key===b.dataset.qplus);window.vyojinCart.update(x.key,x.qty+1)});};
    render();window.addEventListener("vyojin:cart",render);
  }
  // wishlist page
  const wish=document.getElementById("wishlistRoot"); if(wish){const render=()=>{const ids=window.vyojinWishlist.items();const ps=window.VYOJIN_PRODUCTS.filter(p=>ids.includes(p.id));wish.innerHTML=ps.length?ps.map(p=>`<article class="product-card"><a href="/product/${p.slug}"><div class="product-image"><img class="first" src="${p.images[0]}" alt=""><img class="second" src="${p.images[1]}" alt=""></div><div class="product-info"><div class="product-name">${p.name}</div><div class="product-price">₹${p.price.toLocaleString('en-IN')}</div></div></a></article>`).join(""):'<div class="empty" style="grid-column:1/-1">Your wishlist is empty.</div>'};render();window.addEventListener("vyojin:wishlist",render)}
  // checkout summary
  const cs=document.getElementById("checkoutSummary"); if(cs){const items=window.vyojinCart.items();const total=items.reduce((s,x)=>s+x.price*x.qty,0);cs.innerHTML=items.length?items.map(x=>`<div class="sum-row"><span>${x.name} × ${x.qty}</span><strong>₹${(x.price*x.qty).toLocaleString('en-IN')}</strong></div>`).join("")+`<div class="sum-row sum-total"><span>Total</span><strong>₹${total.toLocaleString('en-IN')}</strong></div>`:"<p>Your bag is empty.</p>"}
});
