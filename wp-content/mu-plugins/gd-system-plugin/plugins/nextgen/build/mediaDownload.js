window.nextgen=window.nextgen||{},window.nextgen.mediaDownload=function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}return r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=88)}([function(e,t){e.exports=window.wp.element},,,,function(e,t){e.exports=window.wp.data},,function(e,t){e.exports=window.lodash},,function(e,t){e.exports=function(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){var n=r(27),o=r(28),u=r(20),i=r(29);e.exports=function(e,t){return n(e)||o(e,t)||u(e,t)||i()},e.exports.default=e.exports,e.exports.__esModule=!0},,,function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e},e.exports.default=e.exports,e.exports.__esModule=!0},,,function(e,t){e.exports=window.wp.plugins},,function(e,t){e.exports=window.wp.compose},,,function(e,t,r){var n=r(21);e.exports=function(e,t){if(e){if("string"==typeof e)return n(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?n(e,t):void 0}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n},e.exports.default=e.exports,e.exports.__esModule=!0},,,function(e,t){function r(t){return e.exports=r=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},e.exports.default=e.exports,e.exports.__esModule=!0,r(t)}e.exports=r,e.exports.default=e.exports,e.exports.__esModule=!0},,,function(e,t){e.exports=function(e){if(Array.isArray(e))return e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e)){var r=[],_n=!0,n=!1,o=void 0;try{for(var u,i=e[Symbol.iterator]();!(_n=(u=i.next()).done)&&(r.push(u.value),!t||r.length!==t);_n=!0);}catch(e){n=!0,o=e}finally{try{_n||null==i.return||i.return()}finally{if(n)throw o}}return r}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){function r(t){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?(e.exports=r=function(e){return typeof e},e.exports.default=e.exports,e.exports.__esModule=!0):(e.exports=r=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e.exports.default=e.exports,e.exports.__esModule=!0),r(t)}e.exports=r,e.exports.default=e.exports,e.exports.__esModule=!0},,function(e,t,r){var n=r(40),o=r(41),u=r(20),i=r(42);e.exports=function(e){return n(e)||o(e)||u(e)||i()},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){function r(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}e.exports=function(e,t,n){return t&&r(e.prototype,t),n&&r(e,n),e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){var n=r(46);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&n(e,t)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){var n=r(30).default,o=r(12);e.exports=function(e,t){return!t||"object"!==n(t)&&"function"!=typeof t?o(e):t},e.exports.default=e.exports,e.exports.__esModule=!0},,,,function(e,t,r){var n=r(21);e.exports=function(e){if(Array.isArray(e))return n(e)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e))return Array.from(e)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.default=e.exports,e.exports.__esModule=!0},,,,function(e,t){function r(t,n){return e.exports=r=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},e.exports.default=e.exports,e.exports.__esModule=!0,r(t,n)}e.exports=r,e.exports.default=e.exports,e.exports.__esModule=!0},,,,,,,,,,,function(e,t){e.exports=function(e,t,r){if(!t.has(e))throw new TypeError("attempted to "+r+" private field on non-instance");return t.get(e)},e.exports.default=e.exports,e.exports.__esModule=!0},,,,,function(e,t,r){var n=r(90),o=r(57);e.exports=function(e,t,r){var u=o(e,t,"set");return n(e,u,r),r},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){var n=r(91),o=r(57);e.exports=function(e,t){var r=o(e,t,"get");return n(e,r)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=window.wp.blob},,,,,,,,,,,,,,,,,,,,,,,,function(e,t,r){e.exports=r(89)},function(e,t,r){"use strict";r.r(t),r.d(t,"isExternalImage",(function(){return E})),r.d(t,"MediaDownload",(function(){return D}));var n=r(9),o=r.n(n),u=r(32),i=r.n(u),l=r(33),s=r.n(l),c=r(34),a=r.n(c),p=r(12),f=r.n(p),d=r(35),x=r.n(d),b=r(36),m=r.n(b),y=r(24),g=r.n(y),v=r(8),_=r.n(v),w=r(62),h=r.n(w),O=r(63),j=r.n(O),k=r(6),M=r(0),S=r(15),I=r(17),P=r(4),A=r(64);function U(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function B(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?U(Object(r),!0).forEach((function(t){_()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):U(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var E=function(e){return e&&e.includes(nextgenNuxPatterns.nuxApiEndpoint)},T=new WeakMap,D=function(e){x()(u,e);var t,r,n=(t=u,r=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}(),function(){var e,n=g()(t);if(r){var o=g()(this).constructor;e=Reflect.construct(n,arguments,o)}else e=n.apply(this,arguments);return m()(this,e)});function u(){var e;s()(this,u);for(var t=arguments.length,r=new Array(t),l=0;l<t;l++)r[l]=arguments[l];return e=n.call.apply(n,[this].concat(r)),T.set(f()(e),{writable:!0,value:[]}),_()(f()(e),"detectImageBlocks",(function(t){var r=e.props.getBlockAttributes;return t.map((function(e){var t=r(e);switch(!0){case!(null==t||!t.url):return _()({},e,Object(k.pick)(t,["id","url"]));case!(null==t||!t.images):return _()({},e,Object(k.pick)(t,["ids","images"]));case!(null==t||!t.imageUrl):return _()({},e,Object(k.pick)(t,["imageUrl"]));case!(null==t||!t.mediaUrl)&&"image"===(null==t?void 0:t.mediaType):return _()({},e,Object(k.pick)(t,["mediaId","mediaUrl"]));case!(null==t||!t.backgroundImg):return _()({},e,Object(k.pick)(t,["backgroundImg"]));default:return null}}))})),_()(f()(e),"onFileChange",(function(t,r,n,o){var u=e.props,l=u.getBlockAttributes,s=u.updateBlockAttributes;switch(!0){case!(null==o||!o.imageUrl):s(n,{imageUrl:t.url});break;case!(null==o||!o.url):s(n,{id:t.id,url:t.url});break;case!(null==o||!o.mediaUrl):s(n,{mediaId:t.id,mediaUrl:t.url});break;case!(null==o||!o.backgroundImg):s(n,{backgroundImg:t.url});break;case!(null==o||!o.images):var c=l(n),a=i()(c.images);a[r]=B(B({},a[r]),{},{id:t.id,url:t.url}),!Object(A.isBlobURL)(t.url)&&"link"in a[r]&&(a[r].link=t.url),s(n,{ids:a.map((function(e){return e.id||null})),images:a})}})),_()(f()(e),"uploadExternalImages",(function(t,r){var n,u,i=e.props,l=i.createWarningNotice,s=i.mediaUpload,c=e.getUrlsFromBlockAttributes(r);null!==(u=c=null===(n=c)||void 0===n?void 0:n.filter((function(e){return void 0!==e})))&&void 0!==u&&u.length&&c.forEach((function(n,u){window.fetch(n).then((function(e){return e.blob()})).then((function(n){s({filesList:[n],allowedTypes:["image"],onFileChange:function(n){var i=o()(n,1)[0];return e.onFileChange(i,u,t,r)},onError:function(e){return l(e)}})})).catch((function(e){return l(e)}))}))})),e}return a()(u,[{key:"componentDidUpdate",value:function(){var e=this,t=Object(k.difference)(this.props.clientIds,j()(this,T));this.detectImageBlocks(t).filter((function(e){return!!e})).forEach((function(t){var r=o()(Object.entries(t)[0],2),n=r[0],u=r[1];e.uploadExternalImages(n,u)})),h()(this,T,this.props.clientIds)}},{key:"getUrlsFromBlockAttributes",value:function(e){switch(!0){case E(null==e?void 0:e.imageUrl):return[e.imageUrl];case E(null==e?void 0:e.url):return[e.url];case E(null==e?void 0:e.mediaUrl):return[e.mediaUrl];case E(null==e?void 0:e.backgroundImg):return[e.backgroundImg];case!(null==e||!e.images):return e.images.filter((function(e){return E(null==e?void 0:e.url)})).map((function(e){return e.url}))}}},{key:"render",value:function(){return null}}]),u}(M.Component);Object(S.registerPlugin)("nextgen-media-download",{render:Object(I.compose)([Object(P.withSelect)((function(e){var t=e("core/block-editor"),r=t.getBlockAttributes,n=t.getBlockName,o=t.getClientIdsWithDescendants;return{mediaUpload:(0,t.getSettings)().mediaUpload,clientIds:o(),getBlockAttributes:r,getBlockName:n}})),Object(P.withDispatch)((function(e){return{updateBlockAttributes:e("core/block-editor").updateBlockAttributes}}))])(D)})},function(e,t){e.exports=function(e,t,r){if(t.set)t.set.call(e,r);else{if(!t.writable)throw new TypeError("attempted to set read only private field");t.value=r}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){return t.get?t.get.call(e):t.value},e.exports.default=e.exports,e.exports.__esModule=!0}]);