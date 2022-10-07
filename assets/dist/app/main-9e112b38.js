/*!
 * 
 * wooocommerceCat
 * 
 * @author 
 * @version 0.1.0
 * @link UNLICENSED
 * @license UNLICENSED
 * 
 * Copyright (c) 2022 
 * 
 * This software is released under the UNLICENSED License
 * https://opensource.org/licenses/UNLICENSED
 * 
 * Compiled with the help of https://wpack.io
 * A zero setup Webpack Bundler Script for WordPress
 */
(window.wpackiowooocommerceCatappJsonp=window.wpackiowooocommerceCatappJsonp||[]).push([[0],{21:function(t,n,o){"use strict";o.r(n);o(6);var c=function(t,n){return{nonce:n,qty:0,routeCart:t+"/wp-json/wc/store/v1/cart",routeChecout:t+"/wp-json/wc/store/v1/checkout",init:function(){this.getJSON(this.routeCart)},increaseQty:function(){this.qty++},decreaseQty:function(){this.qty--},removeItem:function(){alert("ddd")},addToCart:function(t){this.reqJSON("".concat(this.routeCart,"/add-item"),"POST",{id:t,quantity:1})},getCart:function(){},getJSON:function(t){var n=this;fetch(t).then((function(t){return t.json()})).then((function(t){n.qty=t.items_count,console.log(t)})).catch((function(t){console.log("Error: ".concat(t))}))},reqJSON:function(t,n,o){var c=this;fetch(t,{method:n,headers:{"Content-Type":"application/json",Accept:"application/json",Nonce:this.nonce},body:JSON.stringify(o)}).then((function(t){return t.json()})).then((function(t){c.qty=t.items_count})).catch((function(t){console.log("Error: ".concat(t))}))}}};document.addEventListener("alpine:init",(function(){Alpine.data("cart",c)}))},4:function(t,n,o){o(5),t.exports=o(21)}},[[4,1,2]]]);
//# sourceMappingURL=main-9e112b38.js.map