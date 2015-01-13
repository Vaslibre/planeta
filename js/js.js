(function(e){"use strict";var b=function(a,d,c){return 1===arguments.length?b.get(a):b.set(a,d,c)};b._document=document;b._navigator=navigator;b.defaults={path:"/"};b.get=function(a){b._cachedDocumentCookie!==b._document.cookie&&b._renewCache();return b._cache[a]};b.set=function(a,d,c){c=b._getExtendedOptions(c);c.expires=b._getExpiresDate(d===e?-1:c.expires);b._document.cookie=b._generateCookieString(a,d,c);return b};b.expire=function(a,d){return b.set(a,e,d)};b._getExtendedOptions=function(a){return{path:a&&a.path||b.defaults.path,domain:a&&a.domain||b.defaults.domain,expires:a&&a.expires||b.defaults.expires,secure:a&&a.secure!==e?a.secure:b.defaults.secure}};b._isValidDate=function(a){return"[object Date]"===Object.prototype.toString.call(a)&&!isNaN(a.getTime())};b._getExpiresDate=function(a,d){d=d||new Date;switch(typeof a){case"number":a=new Date(d.getTime()+1E3*a);break;case"string":a=new Date(a)}if(a&&!b._isValidDate(a))throw Error("`expires` parameter cannot be converted to a valid Date instance");return a};b._generateCookieString=function(a,b,c){a=a.replace(/[^#$&+\^`|]/g,encodeURIComponent);a=a.replace(/\(/g,"%28").replace(/\)/g,"%29");b=(b+"").replace(/[^!#$&-+\--:<-\[\]-~]/g,encodeURIComponent);c=c||{};a=a+"="+b+(c.path?";path="+c.path:"");a+=c.domain?";domain="+c.domain:"";a+=c.expires?";expires="+c.expires.toUTCString():"";return a+=c.secure?";secure":""};b._getCookieObjectFromString=function(a){var d={};a=a?a.split("; "):[];for(var c=0;c<a.length;c++){var f=b._getKeyValuePairFromCookieString(a[c]);d[f.key]===e&&(d[f.key]=f.value)}return d};b._getKeyValuePairFromCookieString=function(a){var b=a.indexOf("="),b=0>b?a.length:b;return{key:decodeURIComponent(a.substr(0,b)),value:decodeURIComponent(a.substr(b+1))}};b._renewCache=function(){b._cache=b._getCookieObjectFromString(b._document.cookie);b._cachedDocumentCookie=b._document.cookie};b._areEnabled=function(){var a="1"===b.set("js.js",1).get("js.js");b.expire("js.js");return a};b.enabled=b._areEnabled();"function"===typeof define&&define.amd?define(function(){return b}):"undefined"!==typeof exports?("undefined"!==typeof module&&module.exports&&(exports=module.exports=b),exports.Cookies=b):window.Cookies=b})();(function($,w){$.extend({jsMalditasCookies:function(opciones){var configuracion={cookie:"aceptocookies",classContenedorAviso:"contcookies",mensaje:"Este sitio, como la mayorí­a, usa cookies. Si sigues navegando entendemos que acepta las polí­tica de uso.",mensajeAceptar:"Aceptar",esperaScroll:15000,expires:3600*24*365*3}
if(!Cookies.enabled){configuracion.mensaje="Este sitio usa Cookies y en tu navegador están desactivadas. Actívalas por favor...";}
jQuery.extend(configuracion,opciones);if(Cookies.get(configuracion.cookie)!="aceptadas"){setTimeout(function(){w.on("scroll",manejadorScroll);},configuracion.esperaScroll);function manejadorScroll(e){console.log("scroll: ",w.scrollTop());cerrarAviso();}
function cerrarAviso(){contAviso.slideUp(1000);w.off("scroll",manejadorScroll);} var contAviso=$("<div>").addClass(configuracion.classContenedorAviso).html(configuracion.mensaje+" <a href=\"#\" class=\"cookiesaceptar\">"+configuracion.mensajeAceptar+"</a>").appendTo("body");var enlace=contAviso.find("a.cookiesaceptar").on("click",function(e){e.preventDefault();cerrarAviso();Cookies.set(configuracion.cookie,'aceptadas',{expires:configuracion.expires});});}
return this;}});})(jQuery,jQuery(window));$(function(){jQuery.jsMalditasCookies();});function GetUser(){var arroba,str,ruta=document.form1,error="";var regexp=/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
if(ruta.inputEmail.value=="") {error+="Debe ingresar su email \n";} if(ruta.inputEmail.value!=""){str=ruta.inputEmail.value;if(!str.match(/^[\w]{1}[\w\.\-_]*@[\w]{1}[\w\-_\.]*\.[\w]{2,6}$/i)){error+="Formato email invalido\n";}} if(ruta.url.value=="") {error+="Debe ingresar una URL del FEED \n";}
if(regexp.test(ruta.url.value)){}else {error+="Formato de url del Feed invalido\n";} if(error!=""){alert("Lista de Errores encontrados:\n\n"+error);return false;} var resultado=$.ajax({type:"POST",data:$("#form1").serialize(),url:'include/new_feed.php',dataType:'text',async:false}).responseText;document.getElementById("myWatch").innerHTML=resultado;} 
function GetUserContac(){var arroba,str,ruta=document.form1,error=""; if(ruta.Email.value=="") {error+="Debe ingresar su email \n";} if(ruta.Email.value!=""){str=ruta.Email.value;if(!str.match(/^[\w]{1}[\w\.\-_]*@[\w]{1}[\w\-_\.]*\.[\w]{2,6}$/i)){error+="Formato email invalido\n";}} if(ruta.mensaje.value=="") {error+="Debe colocar un mensaje \n";} if(error!=""){alert("Lista de Errores encontrados:\n\n"+error);return false;} var resultado=$.ajax({type:"POST",data:$("#form2").serialize(),url:'include/contacto.php',dataType:'text',async:false}).responseText;document.getElementById("myWatchContac").innerHTML=resultado;}
