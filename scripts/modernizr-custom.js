/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-animation-applicationcache-arrow-backdropfilter-backgroundblendmode-backgroundcliptext-backgroundsize-batteryapi-bgpositionshorthand-bgpositionxy-bgrepeatspace_bgrepeatround-bgsizecover-borderimage-borderradius-boxshadow-boxsizing-canvas-canvastext-checked-contains-contenteditable-contextmenu-cookies-cryptography-cssall-cssanimations-csschunit-csscolumns-cssexunit-cssfilters-cssgrid_cssgridlegacy-cssmask-csspointerevents-csspositionsticky-cssreflections-cssremunit-cssresize-cssscrollbar-csstransforms-csstransforms3d-csstransformslevel2-csstransitions-cssvhunit-customelements-customevent-datauri-dataview-display_runin-displaytable-ellipsis-emoji-es5-es5array-es5date-es5function-es5object-es5string-es5syntax-es5undefined-es6array-es6collections-es6math-es6object-es6string-eventlistener-flexbox-flexboxlegacy-flexboxtweener-flexwrap-focuswithin-forcetouch-fullscreen-gamepads-generatedcontent-generators-geolocation-getrandomvalues-hiddenscroll-hovermq-htmlimports-ie8compat-indexeddbblob-inlinesvg-jpeg2000-jpegxr-json-lowbandwidth-lowbattery-mediaqueries-multiplebgs-notification-nthchild-opacity-overflowscrolling-pointermq-postmessage-preserve3d-proximity-queryselector-regions-requestanimationframe-rgba-scrollsnappoints-shapes-siblinggeneral-sizes-smil-strictmode-subpixelfont-supports-svgclippaths-svgfilters-svgforeignobject-textalignlast-textareamaxlength-textshadow-touchevents-typedarrays-unicode-urlparser-video-webgl-webintents-websqldatabase-setclasses !*/
!function(window,document,undefined){function is(e,t){return typeof e===t}function testRunner(){var e,t,r,n,o,i,d;for(var s in tests)if(tests.hasOwnProperty(s)){if(e=[],t=tests[s],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(r=0;r<t.options.aliases.length;r++)e.push(t.options.aliases[r].toLowerCase());for(n=is(t.fn,"function")?t.fn():t.fn,o=0;o<e.length;o++)i=e[o],d=i.split("."),1===d.length?Modernizr[d[0]]=n:(!Modernizr[d[0]]||Modernizr[d[0]]instanceof Boolean||(Modernizr[d[0]]=new Boolean(Modernizr[d[0]])),Modernizr[d[0]][d[1]]=n),classes.push((n?"":"no-")+d.join("-"))}}function setClasses(e){var t=docElement.className,r=Modernizr._config.classPrefix||"";if(isSVG&&(t=t.baseVal),Modernizr._config.enableJSClass){var n=new RegExp("(^|\\s)"+r+"no-js(\\s|$)");t=t.replace(n,"$1"+r+"js$2")}Modernizr._config.enableClasses&&(t+=" "+r+e.join(" "+r),isSVG?docElement.className.baseVal=t:docElement.className=t)}function createElement(){return"function"!=typeof document.createElement?document.createElement(arguments[0]):isSVG?document.createElementNS.call(document,"http://www.w3.org/2000/svg",arguments[0]):document.createElement.apply(document,arguments)}function computedStyle(e,t,r){var n;if("getComputedStyle"in window){n=getComputedStyle.call(window,e,t);var o=window.console;if(null!==n)r&&(n=n.getPropertyValue(r));else if(o){var i=o.error?"error":"log";o[i].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else n=!t&&e.currentStyle&&e.currentStyle[r];return n}function roundedEquals(e,t){return e-1===t||e===t||e+1===t}function cssToDOM(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,r){return t+r.toUpperCase()}).replace(/^-/,"")}function addTest(e,t){if("object"==typeof e)for(var r in e)hasOwnProp(e,r)&&addTest(r,e[r]);else{e=e.toLowerCase();var n=e.split("."),o=Modernizr[n[0]];if(2==n.length&&(o=o[n[1]]),"undefined"!=typeof o)return Modernizr;t="function"==typeof t?t():t,1==n.length?Modernizr[n[0]]=t:(!Modernizr[n[0]]||Modernizr[n[0]]instanceof Boolean||(Modernizr[n[0]]=new Boolean(Modernizr[n[0]])),Modernizr[n[0]][n[1]]=t),setClasses([(t&&0!=t?"":"no-")+n.join("-")]),Modernizr._trigger(e,t)}return Modernizr}function getBody(){var e=document.body;return e||(e=createElement(isSVG?"svg":"body"),e.fake=!0),e}function injectElementWithStyles(e,t,r,n){var o,i,d,s,a="modernizr",l=createElement("div"),c=getBody();if(parseInt(r,10))for(;r--;)d=createElement("div"),d.id=n?n[r]:a+(r+1),l.appendChild(d);return o=createElement("style"),o.type="text/css",o.id="s"+a,(c.fake?c:l).appendChild(o),c.appendChild(l),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e)),l.id=a,c.fake&&(c.style.background="",c.style.overflow="hidden",s=docElement.style.overflow,docElement.style.overflow="hidden",docElement.appendChild(c)),i=t(l,e),c.fake?(c.parentNode.removeChild(c),docElement.style.overflow=s,docElement.offsetHeight):l.parentNode.removeChild(l),!!i}function contains(e,t){return!!~(""+e).indexOf(t)}function fnBind(e,t){return function(){return e.apply(t,arguments)}}function testDOMProps(e,t,r){var n;for(var o in e)if(e[o]in t)return r===!1?e[o]:(n=t[e[o]],is(n,"function")?fnBind(n,r||t):n);return!1}function domToCSS(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function nativeTestProps(e,t){var r=e.length;if("CSS"in window&&"supports"in window.CSS){for(;r--;)if(window.CSS.supports(domToCSS(e[r]),t))return!0;return!1}if("CSSSupportsRule"in window){for(var n=[];r--;)n.push("("+domToCSS(e[r])+":"+t+")");return n=n.join(" or "),injectElementWithStyles("@supports ("+n+") { #modernizr { position: absolute; } }",function(e){return"absolute"==computedStyle(e,null,"position")})}return undefined}function testProps(e,t,r,n){function o(){d&&(delete mStyle.style,delete mStyle.modElem)}if(n=is(n,"undefined")?!1:n,!is(r,"undefined")){var i=nativeTestProps(e,r);if(!is(i,"undefined"))return i}for(var d,s,a,l,c,u=["modernizr","tspan","samp"];!mStyle.style&&u.length;)d=!0,mStyle.modElem=createElement(u.shift()),mStyle.style=mStyle.modElem.style;for(a=e.length,s=0;a>s;s++)if(l=e[s],c=mStyle.style[l],contains(l,"-")&&(l=cssToDOM(l)),mStyle.style[l]!==undefined){if(n||is(r,"undefined"))return o(),"pfx"==t?l:!0;try{mStyle.style[l]=r}catch(p){}if(mStyle.style[l]!=c)return o(),"pfx"==t?l:!0}return o(),!1}function testPropsAll(e,t,r,n,o){var i=e.charAt(0).toUpperCase()+e.slice(1),d=(e+" "+cssomPrefixes.join(i+" ")+i).split(" ");return is(t,"string")||is(t,"undefined")?testProps(d,t,n,o):(d=(e+" "+domPrefixes.join(i+" ")+i).split(" "),testDOMProps(d,t,r))}function detectDeleteDatabase(e,t){var r=e.deleteDatabase(t);r.onsuccess=function(){addTest("indexeddb.deletedatabase",!0)},r.onerror=function(){addTest("indexeddb.deletedatabase",!1)}}function testAllProps(e,t,r){return testPropsAll(e,undefined,undefined,t,r)}var classes=[],tests=[],ModernizrProto={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var r=this;setTimeout(function(){t(r[e])},0)},addTest:function(e,t,r){tests.push({name:e,fn:t,options:r})},addAsyncTest:function(e){tests.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=ModernizrProto,Modernizr=new Modernizr,Modernizr.addTest("applicationcache","applicationCache"in window),Modernizr.addTest("cookies",function(){try{document.cookie="cookietest=1";var e=-1!=document.cookie.indexOf("cookietest=");return document.cookie="cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT",e}catch(t){return!1}}),Modernizr.addTest("customelements","customElements"in window),Modernizr.addTest("customevent","CustomEvent"in window&&"function"==typeof window.CustomEvent),Modernizr.addTest("dataview","undefined"!=typeof DataView&&"getFloat64"in DataView.prototype),Modernizr.addTest("eventlistener","addEventListener"in window),Modernizr.addTest("geolocation","geolocation"in navigator),Modernizr.addTest("ie8compat",!window.addEventListener&&!!document.documentMode&&7===document.documentMode),Modernizr.addTest("json","JSON"in window&&"parse"in JSON&&"stringify"in JSON),Modernizr.addTest("notification",function(){if(!window.Notification||!window.Notification.requestPermission)return!1;if("granted"===window.Notification.permission)return!0;try{new window.Notification("")}catch(e){if("TypeError"===e.name)return!1}return!0}),Modernizr.addTest("postmessage","postMessage"in window),Modernizr.addTest("queryselector","querySelector"in document&&"querySelectorAll"in document),Modernizr.addTest("typedarrays","ArrayBuffer"in window);var newSyntax="CSS"in window&&"supports"in window.CSS,oldSyntax="supportsCSS"in window;Modernizr.addTest("supports",newSyntax||oldSyntax),Modernizr.addTest("es5array",function(){return!!(Array.prototype&&Array.prototype.every&&Array.prototype.filter&&Array.prototype.forEach&&Array.prototype.indexOf&&Array.prototype.lastIndexOf&&Array.prototype.map&&Array.prototype.some&&Array.prototype.reduce&&Array.prototype.reduceRight&&Array.isArray)}),Modernizr.addTest("es5date",function(){var e="2013-04-12T06:06:37.307Z",t=!1;try{t=!!Date.parse(e)}catch(r){}return!!(Date.now&&Date.prototype&&Date.prototype.toISOString&&Date.prototype.toJSON&&t)}),Modernizr.addTest("es5function",function(){return!(!Function.prototype||!Function.prototype.bind)}),Modernizr.addTest("es5object",function(){return!!(Object.keys&&Object.create&&Object.getPrototypeOf&&Object.getOwnPropertyNames&&Object.isSealed&&Object.isFrozen&&Object.isExtensible&&Object.getOwnPropertyDescriptor&&Object.defineProperty&&Object.defineProperties&&Object.seal&&Object.freeze&&Object.preventExtensions)}),Modernizr.addTest("strictmode",function(){"use strict";return!this}()),Modernizr.addTest("es5string",function(){return!(!String.prototype||!String.prototype.trim)}),Modernizr.addTest("es5syntax",function(){var value,obj,stringAccess,getter,setter,reservedWords,zeroWidthChars;try{return stringAccess=eval('"foobar"[3] === "b"'),getter=eval("({ get x(){ return 1 } }).x === 1"),eval("({ set x(v){ value = v; } }).x = 1"),setter=1===value,eval("obj = ({ if: 1 })"),reservedWords=1===obj["if"],zeroWidthChars=eval("_‌‍ = true"),stringAccess&&getter&&setter&&reservedWords&&zeroWidthChars}catch(ignore){return!1}}),Modernizr.addTest("es5undefined",function(){var e,t;try{t=window.undefined,window.undefined=12345,e="undefined"==typeof window.undefined,window.undefined=t}catch(r){return!1}return e}),Modernizr.addTest("es5",function(){return!!(Modernizr.es5array&&Modernizr.es5date&&Modernizr.es5function&&Modernizr.es5object&&Modernizr.strictmode&&Modernizr.es5string&&Modernizr.json&&Modernizr.es5syntax&&Modernizr.es5undefined)}),Modernizr.addTest("es6array",!!(Array.prototype&&Array.prototype.copyWithin&&Array.prototype.fill&&Array.prototype.find&&Array.prototype.findIndex&&Array.prototype.keys&&Array.prototype.entries&&Array.prototype.values&&Array.from&&Array.of)),Modernizr.addTest("arrow",function(){try{eval("()=>{}")}catch(e){return!1}return!0}),Modernizr.addTest("es6collections",!!(window.Map&&window.Set&&window.WeakMap&&window.WeakSet)),Modernizr.addTest("generators",function(){try{new Function("function* test() {}")()}catch(e){return!1}return!0}),Modernizr.addTest("es6math",!!(Math&&Math.clz32&&Math.cbrt&&Math.imul&&Math.sign&&Math.log10&&Math.log2&&Math.log1p&&Math.expm1&&Math.cosh&&Math.sinh&&Math.tanh&&Math.acosh&&Math.asinh&&Math.atanh&&Math.hypot&&Math.trunc&&Math.fround)),Modernizr.addTest("es6object",!!(Object.assign&&Object.is&&Object.setPrototypeOf)),Modernizr.addTest("es6string",!!(String.fromCodePoint&&String.raw&&String.prototype.codePointAt&&String.prototype.repeat&&String.prototype.startsWith&&String.prototype.endsWith&&String.prototype.includes)),Modernizr.addTest("lowbandwidth",function(){var e=navigator.connection||{type:0};return 3==e.type||4==e.type||/^[23]g$/.test(e.type)}),Modernizr.addTest("websqldatabase","openDatabase"in window),Modernizr.addTest("focuswithin",function(){try{document.querySelector(":focus-within")}catch(e){return!1}return!0}),Modernizr.addTest("svgfilters",function(){var e=!1;try{e="SVGFEColorMatrixElement"in window&&2==SVGFEColorMatrixElement.SVG_FECOLORMATRIX_TYPE_SATURATE}catch(t){}return e}),Modernizr.addTest("urlparser",function(){var e;try{return e=new URL("http://modernizr.com/"),"http://modernizr.com/"===e.href}catch(t){return!1}}),Modernizr.addTest("contains",is(String.prototype.contains,"function"));var docElement=document.documentElement;Modernizr.addTest("contextmenu","contextMenu"in docElement&&"HTMLMenuItemElement"in window),Modernizr.addTest("cssall","all"in docElement.style);var isSVG="svg"===docElement.nodeName.toLowerCase();Modernizr.addTest("canvas",function(){var e=createElement("canvas");return!(!e.getContext||!e.getContext("2d"))}),Modernizr.addTest("canvastext",function(){return Modernizr.canvas===!1?!1:"function"==typeof createElement("canvas").getContext("2d").fillText}),Modernizr.addTest("contenteditable",function(){if("contentEditable"in docElement){var e=createElement("div");return e.contentEditable=!0,"true"===e.contentEditable}}),Modernizr.addTest("emoji",function(){if(!Modernizr.canvastext)return!1;var e=window.devicePixelRatio||1,t=12*e,r=createElement("canvas"),n=r.getContext("2d");return n.fillStyle="#f00",n.textBaseline="top",n.font="32px Arial",n.fillText("🐨",0,0),0!==n.getImageData(t,t,1,1).data[0]}),Modernizr.addTest("video",function(){var e=createElement("video"),t=!1;try{t=!!e.canPlayType,t&&(t=new Boolean(t),t.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),t.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),t.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""),t.vp9=e.canPlayType('video/webm; codecs="vp9"').replace(/^no$/,""),t.hls=e.canPlayType('application/x-mpegURL; codecs="avc1.42E01E"').replace(/^no$/,""))}catch(r){}return t}),Modernizr.addTest("webanimations","animate"in createElement("div")),Modernizr.addTest("webgl",function(){var e=createElement("canvas"),t="probablySupportsContext"in e?"probablySupportsContext":"supportsContext";return t in e?e[t]("webgl")||e[t]("experimental-webgl"):"WebGLRenderingContext"in window}),Modernizr.addTest("preserve3d",function(){var e,t,r=window.CSS,n=!1;return r&&r.supports&&r.supports("(transform-style: preserve-3d)")?!0:(e=createElement("a"),t=createElement("a"),e.style.cssText="display: block; transform-style: preserve-3d; transform-origin: right; transform: rotateY(40deg);",t.style.cssText="display: block; width: 9px; height: 1px; background: #000; transform-origin: right; transform: rotateY(40deg);",e.appendChild(t),docElement.appendChild(e),n=t.getBoundingClientRect(),docElement.removeChild(e),n=n.width&&n.width<4)}),Modernizr.addTest("multiplebgs",function(){var e=createElement("a").style;return e.cssText="background:url(https://),url(https://),red url(https://)",/(url\s*\(.*?){3}/.test(e.background)}),Modernizr.addTest("csspointerevents",function(){var e=createElement("a").style;return e.cssText="pointer-events:auto","auto"===e.pointerEvents}),Modernizr.addTest("cssremunit",function(){var e=createElement("a").style;try{e.fontSize="3rem"}catch(t){}return/rem/.test(e.fontSize)}),Modernizr.addTest("rgba",function(){var e=createElement("a").style;return e.cssText="background-color:rgba(150,255,150,.5)",(""+e.backgroundColor).indexOf("rgba")>-1}),Modernizr.addTest("inlinesvg",function(){var e=createElement("div");return e.innerHTML="<svg/>","http://www.w3.org/2000/svg"==("undefined"!=typeof SVGRect&&e.firstChild&&e.firstChild.namespaceURI)}),Modernizr.addTest("textareamaxlength",!!("maxLength"in createElement("textarea"))),Modernizr.addTest("bgpositionshorthand",function(){var e=createElement("a"),t=e.style,r="right 10px bottom 10px";return t.cssText="background-position: "+r+";",t.backgroundPosition===r});var hasEvent=function(){function e(e,r){var n;return e?(r&&"string"!=typeof r||(r=createElement(r||"div")),e="on"+e,n=e in r,!n&&t&&(r.setAttribute||(r=createElement("div")),r.setAttribute(e,""),n="function"==typeof r[e],r[e]!==undefined&&(r[e]=undefined),r.removeAttribute(e)),n):!1}var t=!("onblur"in document.documentElement);return e}();ModernizrProto.hasEvent=hasEvent;var prefixes=ModernizrProto._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):["",""];ModernizrProto._prefixes=prefixes,Modernizr.addTest("opacity",function(){var e=createElement("a").style;return e.cssText=prefixes.join("opacity:.55;"),/^0.55$/.test(e.opacity)}),Modernizr.addTest("csspositionsticky",function(){var e="position:",t="sticky",r=createElement("a"),n=r.style;return n.cssText=e+prefixes.join(t+";"+e).slice(0,-e.length),-1!==n.position.indexOf(t)});var toStringFn={}.toString;Modernizr.addTest("svgclippaths",function(){return!!document.createElementNS&&/SVGClipPath/.test(toStringFn.call(document.createElementNS("http://www.w3.org/2000/svg","clipPath")))}),Modernizr.addTest("svgforeignobject",function(){return!!document.createElementNS&&/SVGForeignObject/.test(toStringFn.call(document.createElementNS("http://www.w3.org/2000/svg","foreignObject")))}),Modernizr.addTest("smil",function(){return!!document.createElementNS&&/SVGAnimate/.test(toStringFn.call(document.createElementNS("http://www.w3.org/2000/svg","animate")))});var modElem={elem:createElement("modernizr")};Modernizr._q.push(function(){delete modElem.elem}),Modernizr.addTest("cssexunit",function(){var e,t=modElem.elem.style;try{t.fontSize="3ex",e=-1!==t.fontSize.indexOf("ex")}catch(r){e=!1}return e}),Modernizr.addTest("csschunit",function(){var e,t=modElem.elem.style;try{t.fontSize="3ch",e=-1!==t.fontSize.indexOf("ch")}catch(r){e=!1}return e});var hasOwnProp;!function(){var e={}.hasOwnProperty;hasOwnProp=is(e,"undefined")||is(e.call,"undefined")?function(e,t){return t in e&&is(e.constructor.prototype[t],"undefined")}:function(t,r){return e.call(t,r)}}(),ModernizrProto._l={},ModernizrProto.on=function(e,t){this._l[e]||(this._l[e]=[]),this._l[e].push(t),Modernizr.hasOwnProperty(e)&&setTimeout(function(){Modernizr._trigger(e,Modernizr[e])},0)},ModernizrProto._trigger=function(e,t){if(this._l[e]){var r=this._l[e];setTimeout(function(){var e,n;for(e=0;e<r.length;e++)(n=r[e])(t)},0),delete this._l[e]}},Modernizr._q.push(function(){ModernizrProto.addTest=addTest}),addTest("htmlimports","import"in createElement("link")),Modernizr.addAsyncTest(function(){function e(){clearTimeout(t),window.removeEventListener("deviceproximity",e),addTest("proximity",!0)}var t,r=300;"ondeviceproximity"in window&&"onuserproximity"in window?(window.addEventListener("deviceproximity",e),t=setTimeout(function(){window.removeEventListener("deviceproximity",e),addTest("proximity",!1)},r)):addTest("proximity",!1)}),Modernizr.addAsyncTest(function(){var e=new Image;e.onload=e.onerror=function(){addTest("jpeg2000",1==e.width)},e.src="data:image/jp2;base64,/0//UQAyAAAAAAABAAAAAgAAAAAAAAAAAAAABAAAAAQAAAAAAAAAAAAEBwEBBwEBBwEBBwEB/1IADAAAAAEAAAQEAAH/XAAEQED/ZAAlAAFDcmVhdGVkIGJ5IE9wZW5KUEVHIHZlcnNpb24gMi4wLjD/kAAKAAAAAABYAAH/UwAJAQAABAQAAf9dAAUBQED/UwAJAgAABAQAAf9dAAUCQED/UwAJAwAABAQAAf9dAAUDQED/k8+kEAGvz6QQAa/PpBABr994EAk//9k="}),Modernizr.addAsyncTest(function(){var e=new Image;e.onload=e.onerror=function(){addTest("jpegxr",1==e.width,{aliases:["jpeg-xr"]})},e.src="data:image/vnd.ms-photo;base64,SUm8AQgAAAAFAAG8AQAQAAAASgAAAIC8BAABAAAAAQAAAIG8BAABAAAAAQAAAMC8BAABAAAAWgAAAMG8BAABAAAAHwAAAAAAAAAkw91vA07+S7GFPXd2jckNV01QSE9UTwAZAYBxAAAAABP/gAAEb/8AAQAAAQAAAA=="}),Modernizr.addAsyncTest(function(){var e,t,r,n=createElement("img"),o="sizes"in n;!o&&"srcset"in n?(t="data:image/gif;base64,R0lGODlhAgABAPAAAP///wAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw==",e="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==",r=function(){addTest("sizes",2==n.width)},n.onload=r,n.onerror=r,n.setAttribute("sizes","9px"),n.srcset=e+" 1w,"+t+" 8w",n.src=e):addTest("sizes",o)}),Modernizr.addAsyncTest(function(){function e(){var e=new Image;e.onerror=function(){addTest("datauri",!0),Modernizr.datauri=new Boolean(!0),Modernizr.datauri.over32kb=!1},e.onload=function(){addTest("datauri",!0),Modernizr.datauri=new Boolean(!0),Modernizr.datauri.over32kb=1==e.width&&1==e.height};for(var t="R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";t.length<33e3;)t="\r\n"+t;e.src="data:image/gif;base64,"+t}-1!==navigator.userAgent.indexOf("MSIE 7.")&&setTimeout(function(){addTest("datauri",!1)},10);var t=new Image;t.onerror=function(){addTest("datauri",!1)},t.onload=function(){1==t.width&&1==t.height?e():addTest("datauri",!1)},t.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="});var testStyles=ModernizrProto.testStyles=injectElementWithStyles;Modernizr.addTest("hiddenscroll",function(){return testStyles("#modernizr {width:100px;height:100px;overflow:scroll}",function(e){return e.offsetWidth===e.clientWidth})}),Modernizr.addTest("touchevents",function(){var e;if("ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch)e=!0;else{var t=["@media (",prefixes.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");testStyles(t,function(t){e=9===t.offsetTop})}return e}),Modernizr.addTest("unicode",function(){var e,t=createElement("span"),r=createElement("span");return testStyles("#modernizr{font-family:Arial,sans;font-size:300em;}",function(n){t.innerHTML=isSVG?"妇":"&#5987;",r.innerHTML=isSVG?"☆":"&#9734;",n.appendChild(t),n.appendChild(r),e="offsetWidth"in t&&t.offsetWidth!==r.offsetWidth}),e}),testStyles("#modernizr{overflow: scroll; width: 40px; height: 40px; }#"+prefixes.join("scrollbar{width:10px} #modernizr::").split("#").slice(1).join("#")+"scrollbar{width:10px}",function(e){Modernizr.addTest("cssscrollbar","scrollWidth"in e&&30==e.scrollWidth)}),Modernizr.addTest("siblinggeneral",function(){return testStyles("#modernizr div {width:100px} #modernizr div ~ div {width:200px;display:block}",function(e){return 200==e.lastChild.offsetWidth},2)}),testStyles("#modernizr{position: absolute; top: -10em; visibility:hidden; font: normal 10px arial;}#subpixel{float: left; font-size: 33.3333%;}",function(e){var t=e.firstChild;t.innerHTML="This is a text written in Arial",Modernizr.addTest("subpixelfont",window.getComputedStyle?"44px"!==window.getComputedStyle(t,null).getPropertyValue("width"):!1)},1,["subpixel"]),testStyles("#modernizr { height: 50vh; }",function(e){var t=parseInt(window.innerHeight/2,10),r=parseInt(computedStyle(e,null,"height"),10);Modernizr.addTest("cssvhunit",roundedEquals(r,t))}),testStyles("#modernizr{display: table; direction: ltr}#modernizr div{display: table-cell; padding: 10px}",function(e){var t,r=e.childNodes;t=r[0].offsetLeft<r[1].offsetLeft,Modernizr.addTest("displaytable",t,{aliases:["display-table"]})},2),testStyles('#modernizr{font:0/0 a}#modernizr:after{content:":)";visibility:hidden;font:7px/1 a}',function(e){Modernizr.addTest("generatedcontent",e.offsetHeight>=6)}),testStyles("#modernizr div {width:1px} #modernizr div:nth-child(2n) {width:2px;}",function(e){for(var t=e.getElementsByTagName("div"),r=!0,n=0;5>n;n++)r=r&&t[n].offsetWidth===n%2+1;Modernizr.addTest("nthchild",r)},5),Modernizr.addTest("checked",function(){return testStyles("#modernizr {position:absolute} #modernizr input {margin-left:10px} #modernizr :checked {margin-left:20px;display:block}",function(e){var t=createElement("input");return t.setAttribute("type","checkbox"),t.setAttribute("checked","checked"),e.appendChild(t),20===t.offsetLeft})});var mq=function(){var e=window.matchMedia||window.msMatchMedia;return e?function(t){var r=e(t);return r&&r.matches||!1}:function(e){var t=!1;return injectElementWithStyles("@media "+e+" { #modernizr { position: absolute; } }",function(e){t="absolute"==(window.getComputedStyle?window.getComputedStyle(e,null):e.currentStyle).position}),t}}();ModernizrProto.mq=mq,Modernizr.addTest("hovermq",mq("(hover)")),Modernizr.addTest("pointermq",mq("(pointer:coarse),(pointer:fine),(pointer:none)")),Modernizr.addTest("mediaqueries",mq("only all"));var mStyle={style:modElem.elem.style};Modernizr._q.unshift(function(){delete mStyle.style});var omPrefixes="Moz O ms Webkit",cssomPrefixes=ModernizrProto._config.usePrefixes?omPrefixes.split(" "):[];ModernizrProto._cssomPrefixes=cssomPrefixes;var atRule=function(e){var t,r=prefixes.length,n=window.CSSRule;if("undefined"==typeof n)return undefined;if(!e)return!1;if(e=e.replace(/^@/,""),t=e.replace(/-/g,"_").toUpperCase()+"_RULE",t in n)return"@"+e;for(var o=0;r>o;o++){var i=prefixes[o],d=i.toUpperCase()+"_"+t;if(d in n)return"@-"+i.toLowerCase()+"-"+e}return!1};ModernizrProto.atRule=atRule;var domPrefixes=ModernizrProto._config.usePrefixes?omPrefixes.toLowerCase().split(" "):[];ModernizrProto._domPrefixes=domPrefixes;var testProp=ModernizrProto.testProp=function(e,t,r){return testProps([e],undefined,t,r)};Modernizr.addTest("textshadow",testProp("textShadow","1px 1px")),ModernizrProto.testAllProps=testPropsAll;var prefixed=ModernizrProto.prefixed=function(e,t,r){return 0===e.indexOf("@")?atRule(e):(-1!=e.indexOf("-")&&(e=cssToDOM(e)),t?testPropsAll(e,t,r):testPropsAll(e,"pfx"))};Modernizr.addTest("batteryapi",!!prefixed("battery",navigator),{aliases:["battery-api"]});var crypto=prefixed("crypto",window);Modernizr.addTest("crypto",!!prefixed("subtle",crypto)),Modernizr.addTest("forcetouch",function(){return hasEvent(prefixed("mouseforcewillbegin",window,!1),window)?MouseEvent.WEBKIT_FORCE_AT_MOUSE_DOWN&&MouseEvent.WEBKIT_FORCE_AT_FORCE_MOUSE_DOWN:!1}),Modernizr.addTest("fullscreen",!(!prefixed("exitFullscreen",document,!1)&&!prefixed("cancelFullScreen",document,!1))),Modernizr.addTest("gamepads",!!prefixed("getGamepads",navigator)),Modernizr.addTest("requestanimationframe",!!prefixed("requestAnimationFrame",window),{aliases:["raf"]}),Modernizr.addTest("webintents",!!prefixed("startActivity",navigator)),Modernizr.addTest("lowbattery",function(){var e=.2,t=prefixed("battery",navigator);return!!(t&&!t.charging&&t.level<=e)});var crypto=prefixed("crypto",window),supportsGetRandomValues;if(crypto&&"getRandomValues"in crypto&&"Uint32Array"in window){var array=new Uint32Array(10),values=crypto.getRandomValues(array);supportsGetRandomValues=values&&is(values[0],"number")}Modernizr.addTest("getrandomvalues",!!supportsGetRandomValues),Modernizr.addTest("regions",function(){if(isSVG)return!1;var e=prefixed("flowFrom"),t=prefixed("flowInto"),r=!1;if(!e||!t)return r;var n=createElement("iframe"),o=createElement("div"),i=createElement("div"),d=createElement("div"),s="modernizr_flow_for_regions_check";i.innerText="M",o.style.cssText="top: 150px; left: 150px; padding: 0px;",d.style.cssText="width: 50px; height: 50px; padding: 42px;",d.style[e]=s,o.appendChild(i),o.appendChild(d),docElement.appendChild(o);var a,l,c=i.getBoundingClientRect();return i.style[t]=s,a=i.getBoundingClientRect(),l=parseInt(a.left-c.left,10),docElement.removeChild(o),42==l?r=!0:(docElement.appendChild(n),c=n.getBoundingClientRect(),n.style[t]=s,a=n.getBoundingClientRect(),c.height>0&&c.height!==a.height&&0===a.height&&(r=!0)),i=d=o=n=undefined,r}),Modernizr.addTest("backgroundblendmode",prefixed("backgroundBlendMode","text")),Modernizr.addAsyncTest(function(){var e;try{e=prefixed("indexedDB",window)}catch(t){}if(e){var r="modernizr-"+Math.random(),n=e.open(r);n.onerror=function(){n.error&&"InvalidStateError"===n.error.name?addTest("indexeddb",!1):(addTest("indexeddb",!0),detectDeleteDatabase(e,r))},n.onsuccess=function(){addTest("indexeddb",!0),detectDeleteDatabase(e,r)}}else addTest("indexeddb",!1)}),Modernizr.addAsyncTest(function(){var e,t,r,n,o="detect-blob-support",i=!1;try{e=prefixed("indexedDB",window)}catch(d){}if(!Modernizr.indexeddb||!Modernizr.indexeddb.deletedatabase)return!1;try{e.deleteDatabase(o).onsuccess=function(){t=e.open(o,1),t.onupgradeneeded=function(){t.result.createObjectStore("store")},t.onsuccess=function(){r=t.result;try{n=r.transaction("store","readwrite").objectStore("store").put(new Blob,"key"),n.onsuccess=function(){i=!0},n.onerror=function(){i=!1}}catch(d){i=!1}finally{addTest("indexeddbblob",i),r.close(),e.deleteDatabase(o)}}}}catch(d){addTest("indexeddbblob",!1)}}),ModernizrProto.testAllProps=testAllProps,Modernizr.addTest("scrollsnappoints",testAllProps("scrollSnapType")),Modernizr.addTest("shapes",testAllProps("shapeOutside","content-box",!0)),Modernizr.addTest("textalignlast",testAllProps("textAlignLast")),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&testAllProps("transform","scale(1)",!0)}),Modernizr.addTest("csstransforms3d",function(){return!!testAllProps("perspective","1px",!0)}),Modernizr.addTest("csstransformslevel2",function(){return testAllProps("translate","45px",!0)}),Modernizr.addTest("csstransitions",testAllProps("transition","all",!0)),Modernizr.addTest("ellipsis",testAllProps("textOverflow","ellipsis")),Modernizr.addTest("cssfilters",function(){if(Modernizr.supports)return testAllProps("filter","blur(2px)");var e=createElement("a");return e.style.cssText=prefixes.join("filter:blur(2px); "),!!e.style.length&&(document.documentMode===undefined||document.documentMode>9)}),Modernizr.addTest("flexbox",testAllProps("flexBasis","1px",!0)),Modernizr.addTest("flexboxlegacy",testAllProps("boxDirection","reverse",!0)),Modernizr.addTest("flexboxtweener",testAllProps("flexAlign","end",!0)),Modernizr.addTest("flexwrap",testAllProps("flexWrap","wrap",!0)),Modernizr.addTest("cssmask",testAllProps("maskRepeat","repeat-x",!0)),Modernizr.addTest("overflowscrolling",testAllProps("overflowScrolling","touch",!0)),Modernizr.addTest("cssreflections",testAllProps("boxReflect","above",!0)),Modernizr.addTest("cssresize",testAllProps("resize","both",!0)),Modernizr.addTest("cssanimations",testAllProps("animationName","a",!0)),Modernizr.addTest("backdropfilter",testAllProps("backdropFilter")),Modernizr.addTest("backgroundcliptext",function(){return testAllProps("backgroundClip","text")}),Modernizr.addTest("bgpositionxy",function(){return testAllProps("backgroundPositionX","3px",!0)&&testAllProps("backgroundPositionY","5px",!0)}),Modernizr.addTest("bgrepeatround",testAllProps("backgroundRepeat","round")),Modernizr.addTest("bgrepeatspace",testAllProps("backgroundRepeat","space")),Modernizr.addTest("backgroundsize",testAllProps("backgroundSize","100%",!0)),Modernizr.addTest("bgsizecover",testAllProps("backgroundSize","cover")),Modernizr.addTest("borderimage",testAllProps("borderImage","url() 1",!0)),Modernizr.addTest("borderradius",testAllProps("borderRadius","0px",!0)),Modernizr.addTest("boxshadow",testAllProps("boxShadow","1px 1px",!0)),Modernizr.addTest("boxsizing",testAllProps("boxSizing","border-box",!0)&&(document.documentMode===undefined||document.documentMode>7)),function(){Modernizr.addTest("csscolumns",function(){var e=!1,t=testAllProps("columnCount");try{e=!!t,e&&(e=new Boolean(e))}catch(r){}return e});for(var e,t,r=["Width","Span","Fill","Gap","Rule","RuleColor","RuleStyle","RuleWidth","BreakBefore","BreakAfter","BreakInside"],n=0;n<r.length;n++)e=r[n].toLowerCase(),t=testAllProps("column"+r[n]),("breakbefore"===e||"breakafter"===e||"breakinside"==e)&&(t=t||testAllProps(r[n])),Modernizr.addTest("csscolumns."+e,t)}(),Modernizr.addTest("cssgridlegacy",testAllProps("grid-columns","10px",!0)),Modernizr.addTest("cssgrid",testAllProps("grid-template-rows","none",!0)),Modernizr.addTest("displayrunin",testAllProps("display","run-in"),{aliases:["display-runin"]}),testRunner(),setClasses(classes),delete ModernizrProto.addTest,delete ModernizrProto.addAsyncTest;for(var i=0;i<Modernizr._q.length;i++)Modernizr._q[i]();window.Modernizr=Modernizr}(window,document);