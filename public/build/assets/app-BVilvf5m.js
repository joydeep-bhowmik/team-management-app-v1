function qt(e,t){return function(){return e.apply(t,arguments)}}const{toString:Xn}=Object.prototype,{getPrototypeOf:Ge}=Object,de=(e=>t=>{const n=Xn.call(t);return e[n]||(e[n]=n.slice(8,-1).toLowerCase())})(Object.create(null)),C=e=>(e=e.toLowerCase(),t=>de(t)===e),he=e=>t=>typeof t===e,{isArray:J}=Array,Q=he("undefined");function Yn(e){return e!==null&&!Q(e)&&e.constructor!==null&&!Q(e.constructor)&&v(e.constructor.isBuffer)&&e.constructor.isBuffer(e)}const Vt=C("ArrayBuffer");function Qn(e){let t;return typeof ArrayBuffer<"u"&&ArrayBuffer.isView?t=ArrayBuffer.isView(e):t=e&&e.buffer&&Vt(e.buffer),t}const Zn=he("string"),v=he("function"),zt=he("number"),pe=e=>e!==null&&typeof e=="object",er=e=>e===!0||e===!1,oe=e=>{if(de(e)!=="object")return!1;const t=Ge(e);return(t===null||t===Object.prototype||Object.getPrototypeOf(t)===null)&&!(Symbol.toStringTag in e)&&!(Symbol.iterator in e)},tr=C("Date"),nr=C("File"),rr=C("Blob"),sr=C("FileList"),or=e=>pe(e)&&v(e.pipe),ir=e=>{let t;return e&&(typeof FormData=="function"&&e instanceof FormData||v(e.append)&&((t=de(e))==="formdata"||t==="object"&&v(e.toString)&&e.toString()==="[object FormData]"))},ar=C("URLSearchParams"),[cr,ur,lr,fr]=["ReadableStream","Request","Response","Headers"].map(C),dr=e=>e.trim?e.trim():e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"");function ne(e,t,{allOwnKeys:n=!1}={}){if(e===null||typeof e>"u")return;let r,s;if(typeof e!="object"&&(e=[e]),J(e))for(r=0,s=e.length;r<s;r++)t.call(null,e[r],r,e);else{const o=n?Object.getOwnPropertyNames(e):Object.keys(e),i=o.length;let a;for(r=0;r<i;r++)a=o[r],t.call(null,e[a],a,e)}}function Kt(e,t){t=t.toLowerCase();const n=Object.keys(e);let r=n.length,s;for(;r-- >0;)if(s=n[r],t===s.toLowerCase())return s;return null}const H=typeof globalThis<"u"?globalThis:typeof self<"u"?self:typeof window<"u"?window:global,Wt=e=>!Q(e)&&e!==H;function Fe(){const{caseless:e}=Wt(this)&&this||{},t={},n=(r,s)=>{const o=e&&Kt(t,s)||s;oe(t[o])&&oe(r)?t[o]=Fe(t[o],r):oe(r)?t[o]=Fe({},r):J(r)?t[o]=r.slice():t[o]=r};for(let r=0,s=arguments.length;r<s;r++)arguments[r]&&ne(arguments[r],n);return t}const hr=(e,t,n,{allOwnKeys:r}={})=>(ne(t,(s,o)=>{n&&v(s)?e[o]=qt(s,n):e[o]=s},{allOwnKeys:r}),e),pr=e=>(e.charCodeAt(0)===65279&&(e=e.slice(1)),e),mr=(e,t,n,r)=>{e.prototype=Object.create(t.prototype,r),e.prototype.constructor=e,Object.defineProperty(e,"super",{value:t.prototype}),n&&Object.assign(e.prototype,n)},gr=(e,t,n,r)=>{let s,o,i;const a={};if(t=t||{},e==null)return t;do{for(s=Object.getOwnPropertyNames(e),o=s.length;o-- >0;)i=s[o],(!r||r(i,e,t))&&!a[i]&&(t[i]=e[i],a[i]=!0);e=n!==!1&&Ge(e)}while(e&&(!n||n(e,t))&&e!==Object.prototype);return t},br=(e,t,n)=>{e=String(e),(n===void 0||n>e.length)&&(n=e.length),n-=t.length;const r=e.indexOf(t,n);return r!==-1&&r===n},wr=e=>{if(!e)return null;if(J(e))return e;let t=e.length;if(!zt(t))return null;const n=new Array(t);for(;t-- >0;)n[t]=e[t];return n},yr=(e=>t=>e&&t instanceof e)(typeof Uint8Array<"u"&&Ge(Uint8Array)),Er=(e,t)=>{const r=(e&&e[Symbol.iterator]).call(e);let s;for(;(s=r.next())&&!s.done;){const o=s.value;t.call(e,o[0],o[1])}},Sr=(e,t)=>{let n;const r=[];for(;(n=e.exec(t))!==null;)r.push(n);return r},Tr=C("HTMLFormElement"),Ar=e=>e.toLowerCase().replace(/[-_\s]([a-z\d])(\w*)/g,function(n,r,s){return r.toUpperCase()+s}),lt=(({hasOwnProperty:e})=>(t,n)=>e.call(t,n))(Object.prototype),_r=C("RegExp"),Jt=(e,t)=>{const n=Object.getOwnPropertyDescriptors(e),r={};ne(n,(s,o)=>{let i;(i=t(s,o,e))!==!1&&(r[o]=i||s)}),Object.defineProperties(e,r)},Ir=e=>{Jt(e,(t,n)=>{if(v(e)&&["arguments","caller","callee"].indexOf(n)!==-1)return!1;const r=e[n];if(v(r)){if(t.enumerable=!1,"writable"in t){t.writable=!1;return}t.set||(t.set=()=>{throw Error("Can not rewrite read-only method '"+n+"'")})}})},Or=(e,t)=>{const n={},r=s=>{s.forEach(o=>{n[o]=!0})};return J(e)?r(e):r(String(e).split(t)),n},Rr=()=>{},vr=(e,t)=>e!=null&&Number.isFinite(e=+e)?e:t,Te="abcdefghijklmnopqrstuvwxyz",ft="0123456789",Gt={DIGIT:ft,ALPHA:Te,ALPHA_DIGIT:Te+Te.toUpperCase()+ft},Cr=(e=16,t=Gt.ALPHA_DIGIT)=>{let n="";const{length:r}=t;for(;e--;)n+=t[Math.random()*r|0];return n};function Dr(e){return!!(e&&v(e.append)&&e[Symbol.toStringTag]==="FormData"&&e[Symbol.iterator])}const kr=e=>{const t=new Array(10),n=(r,s)=>{if(pe(r)){if(t.indexOf(r)>=0)return;if(!("toJSON"in r)){t[s]=r;const o=J(r)?[]:{};return ne(r,(i,a)=>{const f=n(i,s+1);!Q(f)&&(o[a]=f)}),t[s]=void 0,o}}return r};return n(e,0)},Nr=C("AsyncFunction"),Pr=e=>e&&(pe(e)||v(e))&&v(e.then)&&v(e.catch),Xt=((e,t)=>e?setImmediate:t?((n,r)=>(H.addEventListener("message",({source:s,data:o})=>{s===H&&o===n&&r.length&&r.shift()()},!1),s=>{r.push(s),H.postMessage(n,"*")}))(`axios@${Math.random()}`,[]):n=>setTimeout(n))(typeof setImmediate=="function",v(H.postMessage)),Br=typeof queueMicrotask<"u"?queueMicrotask.bind(H):typeof process<"u"&&process.nextTick||Xt,c={isArray:J,isArrayBuffer:Vt,isBuffer:Yn,isFormData:ir,isArrayBufferView:Qn,isString:Zn,isNumber:zt,isBoolean:er,isObject:pe,isPlainObject:oe,isReadableStream:cr,isRequest:ur,isResponse:lr,isHeaders:fr,isUndefined:Q,isDate:tr,isFile:nr,isBlob:rr,isRegExp:_r,isFunction:v,isStream:or,isURLSearchParams:ar,isTypedArray:yr,isFileList:sr,forEach:ne,merge:Fe,extend:hr,trim:dr,stripBOM:pr,inherits:mr,toFlatObject:gr,kindOf:de,kindOfTest:C,endsWith:br,toArray:wr,forEachEntry:Er,matchAll:Sr,isHTMLForm:Tr,hasOwnProperty:lt,hasOwnProp:lt,reduceDescriptors:Jt,freezeMethods:Ir,toObjectSet:Or,toCamelCase:Ar,noop:Rr,toFiniteNumber:vr,findKey:Kt,global:H,isContextDefined:Wt,ALPHABET:Gt,generateString:Cr,isSpecCompliantForm:Dr,toJSONObject:kr,isAsyncFn:Nr,isThenable:Pr,setImmediate:Xt,asap:Br};function m(e,t,n,r,s){Error.call(this),Error.captureStackTrace?Error.captureStackTrace(this,this.constructor):this.stack=new Error().stack,this.message=e,this.name="AxiosError",t&&(this.code=t),n&&(this.config=n),r&&(this.request=r),s&&(this.response=s,this.status=s.status?s.status:null)}c.inherits(m,Error,{toJSON:function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:c.toJSONObject(this.config),code:this.code,status:this.status}}});const Yt=m.prototype,Qt={};["ERR_BAD_OPTION_VALUE","ERR_BAD_OPTION","ECONNABORTED","ETIMEDOUT","ERR_NETWORK","ERR_FR_TOO_MANY_REDIRECTS","ERR_DEPRECATED","ERR_BAD_RESPONSE","ERR_BAD_REQUEST","ERR_CANCELED","ERR_NOT_SUPPORT","ERR_INVALID_URL"].forEach(e=>{Qt[e]={value:e}});Object.defineProperties(m,Qt);Object.defineProperty(Yt,"isAxiosError",{value:!0});m.from=(e,t,n,r,s,o)=>{const i=Object.create(Yt);return c.toFlatObject(e,i,function(f){return f!==Error.prototype},a=>a!=="isAxiosError"),m.call(i,e.message,t,n,r,s),i.cause=e,i.name=e.name,o&&Object.assign(i,o),i};const xr=null;function Le(e){return c.isPlainObject(e)||c.isArray(e)}function Zt(e){return c.endsWith(e,"[]")?e.slice(0,-2):e}function dt(e,t,n){return e?e.concat(t).map(function(s,o){return s=Zt(s),!n&&o?"["+s+"]":s}).join(n?".":""):t}function Fr(e){return c.isArray(e)&&!e.some(Le)}const Lr=c.toFlatObject(c,{},null,function(t){return/^is[A-Z]/.test(t)});function me(e,t,n){if(!c.isObject(e))throw new TypeError("target must be an object");t=t||new FormData,n=c.toFlatObject(n,{metaTokens:!0,dots:!1,indexes:!1},!1,function(g,p){return!c.isUndefined(p[g])});const r=n.metaTokens,s=n.visitor||l,o=n.dots,i=n.indexes,f=(n.Blob||typeof Blob<"u"&&Blob)&&c.isSpecCompliantForm(t);if(!c.isFunction(s))throw new TypeError("visitor must be a function");function u(h){if(h===null)return"";if(c.isDate(h))return h.toISOString();if(!f&&c.isBlob(h))throw new m("Blob is not supported. Use a Buffer instead.");return c.isArrayBuffer(h)||c.isTypedArray(h)?f&&typeof Blob=="function"?new Blob([h]):Buffer.from(h):h}function l(h,g,p){let E=h;if(h&&!p&&typeof h=="object"){if(c.endsWith(g,"{}"))g=r?g:g.slice(0,-2),h=JSON.stringify(h);else if(c.isArray(h)&&Fr(h)||(c.isFileList(h)||c.endsWith(g,"[]"))&&(E=c.toArray(h)))return g=Zt(g),E.forEach(function(A,k){!(c.isUndefined(A)||A===null)&&t.append(i===!0?dt([g],k,o):i===null?g:g+"[]",u(A))}),!1}return Le(h)?!0:(t.append(dt(p,g,o),u(h)),!1)}const d=[],b=Object.assign(Lr,{defaultVisitor:l,convertValue:u,isVisitable:Le});function y(h,g){if(!c.isUndefined(h)){if(d.indexOf(h)!==-1)throw Error("Circular reference detected in "+g.join("."));d.push(h),c.forEach(h,function(E,T){(!(c.isUndefined(E)||E===null)&&s.call(t,E,c.isString(T)?T.trim():T,g,b))===!0&&y(E,g?g.concat(T):[T])}),d.pop()}}if(!c.isObject(e))throw new TypeError("data must be an object");return y(e),t}function ht(e){const t={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+","%00":"\0"};return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g,function(r){return t[r]})}function Xe(e,t){this._pairs=[],e&&me(e,this,t)}const en=Xe.prototype;en.append=function(t,n){this._pairs.push([t,n])};en.toString=function(t){const n=t?function(r){return t.call(this,r,ht)}:ht;return this._pairs.map(function(s){return n(s[0])+"="+n(s[1])},"").join("&")};function Mr(e){return encodeURIComponent(e).replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}function tn(e,t,n){if(!t)return e;const r=n&&n.encode||Mr;c.isFunction(n)&&(n={serialize:n});const s=n&&n.serialize;let o;if(s?o=s(t,n):o=c.isURLSearchParams(t)?t.toString():new Xe(t,n).toString(r),o){const i=e.indexOf("#");i!==-1&&(e=e.slice(0,i)),e+=(e.indexOf("?")===-1?"?":"&")+o}return e}class pt{constructor(){this.handlers=[]}use(t,n,r){return this.handlers.push({fulfilled:t,rejected:n,synchronous:r?r.synchronous:!1,runWhen:r?r.runWhen:null}),this.handlers.length-1}eject(t){this.handlers[t]&&(this.handlers[t]=null)}clear(){this.handlers&&(this.handlers=[])}forEach(t){c.forEach(this.handlers,function(r){r!==null&&t(r)})}}const nn={silentJSONParsing:!0,forcedJSONParsing:!0,clarifyTimeoutError:!1},jr=typeof URLSearchParams<"u"?URLSearchParams:Xe,$r=typeof FormData<"u"?FormData:null,Hr=typeof Blob<"u"?Blob:null,Ur={isBrowser:!0,classes:{URLSearchParams:jr,FormData:$r,Blob:Hr},protocols:["http","https","file","blob","url","data"]},Ye=typeof window<"u"&&typeof document<"u",Me=typeof navigator=="object"&&navigator||void 0,qr=Ye&&(!Me||["ReactNative","NativeScript","NS"].indexOf(Me.product)<0),Vr=typeof WorkerGlobalScope<"u"&&self instanceof WorkerGlobalScope&&typeof self.importScripts=="function",zr=Ye&&window.location.href||"http://localhost",Kr=Object.freeze(Object.defineProperty({__proto__:null,hasBrowserEnv:Ye,hasStandardBrowserEnv:qr,hasStandardBrowserWebWorkerEnv:Vr,navigator:Me,origin:zr},Symbol.toStringTag,{value:"Module"})),_={...Kr,...Ur};function Wr(e,t){return me(e,new _.classes.URLSearchParams,Object.assign({visitor:function(n,r,s,o){return _.isNode&&c.isBuffer(n)?(this.append(r,n.toString("base64")),!1):o.defaultVisitor.apply(this,arguments)}},t))}function Jr(e){return c.matchAll(/\w+|\[(\w*)]/g,e).map(t=>t[0]==="[]"?"":t[1]||t[0])}function Gr(e){const t={},n=Object.keys(e);let r;const s=n.length;let o;for(r=0;r<s;r++)o=n[r],t[o]=e[o];return t}function rn(e){function t(n,r,s,o){let i=n[o++];if(i==="__proto__")return!0;const a=Number.isFinite(+i),f=o>=n.length;return i=!i&&c.isArray(s)?s.length:i,f?(c.hasOwnProp(s,i)?s[i]=[s[i],r]:s[i]=r,!a):((!s[i]||!c.isObject(s[i]))&&(s[i]=[]),t(n,r,s[i],o)&&c.isArray(s[i])&&(s[i]=Gr(s[i])),!a)}if(c.isFormData(e)&&c.isFunction(e.entries)){const n={};return c.forEachEntry(e,(r,s)=>{t(Jr(r),s,n,0)}),n}return null}function Xr(e,t,n){if(c.isString(e))try{return(t||JSON.parse)(e),c.trim(e)}catch(r){if(r.name!=="SyntaxError")throw r}return(0,JSON.stringify)(e)}const re={transitional:nn,adapter:["xhr","http","fetch"],transformRequest:[function(t,n){const r=n.getContentType()||"",s=r.indexOf("application/json")>-1,o=c.isObject(t);if(o&&c.isHTMLForm(t)&&(t=new FormData(t)),c.isFormData(t))return s?JSON.stringify(rn(t)):t;if(c.isArrayBuffer(t)||c.isBuffer(t)||c.isStream(t)||c.isFile(t)||c.isBlob(t)||c.isReadableStream(t))return t;if(c.isArrayBufferView(t))return t.buffer;if(c.isURLSearchParams(t))return n.setContentType("application/x-www-form-urlencoded;charset=utf-8",!1),t.toString();let a;if(o){if(r.indexOf("application/x-www-form-urlencoded")>-1)return Wr(t,this.formSerializer).toString();if((a=c.isFileList(t))||r.indexOf("multipart/form-data")>-1){const f=this.env&&this.env.FormData;return me(a?{"files[]":t}:t,f&&new f,this.formSerializer)}}return o||s?(n.setContentType("application/json",!1),Xr(t)):t}],transformResponse:[function(t){const n=this.transitional||re.transitional,r=n&&n.forcedJSONParsing,s=this.responseType==="json";if(c.isResponse(t)||c.isReadableStream(t))return t;if(t&&c.isString(t)&&(r&&!this.responseType||s)){const i=!(n&&n.silentJSONParsing)&&s;try{return JSON.parse(t)}catch(a){if(i)throw a.name==="SyntaxError"?m.from(a,m.ERR_BAD_RESPONSE,this,null,this.response):a}}return t}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,maxBodyLength:-1,env:{FormData:_.classes.FormData,Blob:_.classes.Blob},validateStatus:function(t){return t>=200&&t<300},headers:{common:{Accept:"application/json, text/plain, */*","Content-Type":void 0}}};c.forEach(["delete","get","head","post","put","patch"],e=>{re.headers[e]={}});const Yr=c.toObjectSet(["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"]),Qr=e=>{const t={};let n,r,s;return e&&e.split(`
`).forEach(function(i){s=i.indexOf(":"),n=i.substring(0,s).trim().toLowerCase(),r=i.substring(s+1).trim(),!(!n||t[n]&&Yr[n])&&(n==="set-cookie"?t[n]?t[n].push(r):t[n]=[r]:t[n]=t[n]?t[n]+", "+r:r)}),t},mt=Symbol("internals");function Y(e){return e&&String(e).trim().toLowerCase()}function ie(e){return e===!1||e==null?e:c.isArray(e)?e.map(ie):String(e)}function Zr(e){const t=Object.create(null),n=/([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;let r;for(;r=n.exec(e);)t[r[1]]=r[2];return t}const es=e=>/^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());function Ae(e,t,n,r,s){if(c.isFunction(r))return r.call(this,t,n);if(s&&(t=n),!!c.isString(t)){if(c.isString(r))return t.indexOf(r)!==-1;if(c.isRegExp(r))return r.test(t)}}function ts(e){return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g,(t,n,r)=>n.toUpperCase()+r)}function ns(e,t){const n=c.toCamelCase(" "+t);["get","set","has"].forEach(r=>{Object.defineProperty(e,r+n,{value:function(s,o,i){return this[r].call(this,t,s,o,i)},configurable:!0})})}class R{constructor(t){t&&this.set(t)}set(t,n,r){const s=this;function o(a,f,u){const l=Y(f);if(!l)throw new Error("header name must be a non-empty string");const d=c.findKey(s,l);(!d||s[d]===void 0||u===!0||u===void 0&&s[d]!==!1)&&(s[d||f]=ie(a))}const i=(a,f)=>c.forEach(a,(u,l)=>o(u,l,f));if(c.isPlainObject(t)||t instanceof this.constructor)i(t,n);else if(c.isString(t)&&(t=t.trim())&&!es(t))i(Qr(t),n);else if(c.isHeaders(t))for(const[a,f]of t.entries())o(f,a,r);else t!=null&&o(n,t,r);return this}get(t,n){if(t=Y(t),t){const r=c.findKey(this,t);if(r){const s=this[r];if(!n)return s;if(n===!0)return Zr(s);if(c.isFunction(n))return n.call(this,s,r);if(c.isRegExp(n))return n.exec(s);throw new TypeError("parser must be boolean|regexp|function")}}}has(t,n){if(t=Y(t),t){const r=c.findKey(this,t);return!!(r&&this[r]!==void 0&&(!n||Ae(this,this[r],r,n)))}return!1}delete(t,n){const r=this;let s=!1;function o(i){if(i=Y(i),i){const a=c.findKey(r,i);a&&(!n||Ae(r,r[a],a,n))&&(delete r[a],s=!0)}}return c.isArray(t)?t.forEach(o):o(t),s}clear(t){const n=Object.keys(this);let r=n.length,s=!1;for(;r--;){const o=n[r];(!t||Ae(this,this[o],o,t,!0))&&(delete this[o],s=!0)}return s}normalize(t){const n=this,r={};return c.forEach(this,(s,o)=>{const i=c.findKey(r,o);if(i){n[i]=ie(s),delete n[o];return}const a=t?ts(o):String(o).trim();a!==o&&delete n[o],n[a]=ie(s),r[a]=!0}),this}concat(...t){return this.constructor.concat(this,...t)}toJSON(t){const n=Object.create(null);return c.forEach(this,(r,s)=>{r!=null&&r!==!1&&(n[s]=t&&c.isArray(r)?r.join(", "):r)}),n}[Symbol.iterator](){return Object.entries(this.toJSON())[Symbol.iterator]()}toString(){return Object.entries(this.toJSON()).map(([t,n])=>t+": "+n).join(`
`)}get[Symbol.toStringTag](){return"AxiosHeaders"}static from(t){return t instanceof this?t:new this(t)}static concat(t,...n){const r=new this(t);return n.forEach(s=>r.set(s)),r}static accessor(t){const r=(this[mt]=this[mt]={accessors:{}}).accessors,s=this.prototype;function o(i){const a=Y(i);r[a]||(ns(s,i),r[a]=!0)}return c.isArray(t)?t.forEach(o):o(t),this}}R.accessor(["Content-Type","Content-Length","Accept","Accept-Encoding","User-Agent","Authorization"]);c.reduceDescriptors(R.prototype,({value:e},t)=>{let n=t[0].toUpperCase()+t.slice(1);return{get:()=>e,set(r){this[n]=r}}});c.freezeMethods(R);function _e(e,t){const n=this||re,r=t||n,s=R.from(r.headers);let o=r.data;return c.forEach(e,function(a){o=a.call(n,o,s.normalize(),t?t.status:void 0)}),s.normalize(),o}function sn(e){return!!(e&&e.__CANCEL__)}function G(e,t,n){m.call(this,e??"canceled",m.ERR_CANCELED,t,n),this.name="CanceledError"}c.inherits(G,m,{__CANCEL__:!0});function on(e,t,n){const r=n.config.validateStatus;!n.status||!r||r(n.status)?e(n):t(new m("Request failed with status code "+n.status,[m.ERR_BAD_REQUEST,m.ERR_BAD_RESPONSE][Math.floor(n.status/100)-4],n.config,n.request,n))}function rs(e){const t=/^([-+\w]{1,25})(:?\/\/|:)/.exec(e);return t&&t[1]||""}function ss(e,t){e=e||10;const n=new Array(e),r=new Array(e);let s=0,o=0,i;return t=t!==void 0?t:1e3,function(f){const u=Date.now(),l=r[o];i||(i=u),n[s]=f,r[s]=u;let d=o,b=0;for(;d!==s;)b+=n[d++],d=d%e;if(s=(s+1)%e,s===o&&(o=(o+1)%e),u-i<t)return;const y=l&&u-l;return y?Math.round(b*1e3/y):void 0}}function os(e,t){let n=0,r=1e3/t,s,o;const i=(u,l=Date.now())=>{n=l,s=null,o&&(clearTimeout(o),o=null),e.apply(null,u)};return[(...u)=>{const l=Date.now(),d=l-n;d>=r?i(u,l):(s=u,o||(o=setTimeout(()=>{o=null,i(s)},r-d)))},()=>s&&i(s)]}const ce=(e,t,n=3)=>{let r=0;const s=ss(50,250);return os(o=>{const i=o.loaded,a=o.lengthComputable?o.total:void 0,f=i-r,u=s(f),l=i<=a;r=i;const d={loaded:i,total:a,progress:a?i/a:void 0,bytes:f,rate:u||void 0,estimated:u&&a&&l?(a-i)/u:void 0,event:o,lengthComputable:a!=null,[t?"download":"upload"]:!0};e(d)},n)},gt=(e,t)=>{const n=e!=null;return[r=>t[0]({lengthComputable:n,total:e,loaded:r}),t[1]]},bt=e=>(...t)=>c.asap(()=>e(...t)),is=_.hasStandardBrowserEnv?((e,t)=>n=>(n=new URL(n,_.origin),e.protocol===n.protocol&&e.host===n.host&&(t||e.port===n.port)))(new URL(_.origin),_.navigator&&/(msie|trident)/i.test(_.navigator.userAgent)):()=>!0,as=_.hasStandardBrowserEnv?{write(e,t,n,r,s,o){const i=[e+"="+encodeURIComponent(t)];c.isNumber(n)&&i.push("expires="+new Date(n).toGMTString()),c.isString(r)&&i.push("path="+r),c.isString(s)&&i.push("domain="+s),o===!0&&i.push("secure"),document.cookie=i.join("; ")},read(e){const t=document.cookie.match(new RegExp("(^|;\\s*)("+e+")=([^;]*)"));return t?decodeURIComponent(t[3]):null},remove(e){this.write(e,"",Date.now()-864e5)}}:{write(){},read(){return null},remove(){}};function cs(e){return/^([a-z][a-z\d+\-.]*:)?\/\//i.test(e)}function us(e,t){return t?e.replace(/\/?\/$/,"")+"/"+t.replace(/^\/+/,""):e}function an(e,t){return e&&!cs(t)?us(e,t):t}const wt=e=>e instanceof R?{...e}:e;function V(e,t){t=t||{};const n={};function r(u,l,d,b){return c.isPlainObject(u)&&c.isPlainObject(l)?c.merge.call({caseless:b},u,l):c.isPlainObject(l)?c.merge({},l):c.isArray(l)?l.slice():l}function s(u,l,d,b){if(c.isUndefined(l)){if(!c.isUndefined(u))return r(void 0,u,d,b)}else return r(u,l,d,b)}function o(u,l){if(!c.isUndefined(l))return r(void 0,l)}function i(u,l){if(c.isUndefined(l)){if(!c.isUndefined(u))return r(void 0,u)}else return r(void 0,l)}function a(u,l,d){if(d in t)return r(u,l);if(d in e)return r(void 0,u)}const f={url:o,method:o,data:o,baseURL:i,transformRequest:i,transformResponse:i,paramsSerializer:i,timeout:i,timeoutMessage:i,withCredentials:i,withXSRFToken:i,adapter:i,responseType:i,xsrfCookieName:i,xsrfHeaderName:i,onUploadProgress:i,onDownloadProgress:i,decompress:i,maxContentLength:i,maxBodyLength:i,beforeRedirect:i,transport:i,httpAgent:i,httpsAgent:i,cancelToken:i,socketPath:i,responseEncoding:i,validateStatus:a,headers:(u,l,d)=>s(wt(u),wt(l),d,!0)};return c.forEach(Object.keys(Object.assign({},e,t)),function(l){const d=f[l]||s,b=d(e[l],t[l],l);c.isUndefined(b)&&d!==a||(n[l]=b)}),n}const cn=e=>{const t=V({},e);let{data:n,withXSRFToken:r,xsrfHeaderName:s,xsrfCookieName:o,headers:i,auth:a}=t;t.headers=i=R.from(i),t.url=tn(an(t.baseURL,t.url),e.params,e.paramsSerializer),a&&i.set("Authorization","Basic "+btoa((a.username||"")+":"+(a.password?unescape(encodeURIComponent(a.password)):"")));let f;if(c.isFormData(n)){if(_.hasStandardBrowserEnv||_.hasStandardBrowserWebWorkerEnv)i.setContentType(void 0);else if((f=i.getContentType())!==!1){const[u,...l]=f?f.split(";").map(d=>d.trim()).filter(Boolean):[];i.setContentType([u||"multipart/form-data",...l].join("; "))}}if(_.hasStandardBrowserEnv&&(r&&c.isFunction(r)&&(r=r(t)),r||r!==!1&&is(t.url))){const u=s&&o&&as.read(o);u&&i.set(s,u)}return t},ls=typeof XMLHttpRequest<"u",fs=ls&&function(e){return new Promise(function(n,r){const s=cn(e);let o=s.data;const i=R.from(s.headers).normalize();let{responseType:a,onUploadProgress:f,onDownloadProgress:u}=s,l,d,b,y,h;function g(){y&&y(),h&&h(),s.cancelToken&&s.cancelToken.unsubscribe(l),s.signal&&s.signal.removeEventListener("abort",l)}let p=new XMLHttpRequest;p.open(s.method.toUpperCase(),s.url,!0),p.timeout=s.timeout;function E(){if(!p)return;const A=R.from("getAllResponseHeaders"in p&&p.getAllResponseHeaders()),O={data:!a||a==="text"||a==="json"?p.responseText:p.response,status:p.status,statusText:p.statusText,headers:A,config:e,request:p};on(function(j){n(j),g()},function(j){r(j),g()},O),p=null}"onloadend"in p?p.onloadend=E:p.onreadystatechange=function(){!p||p.readyState!==4||p.status===0&&!(p.responseURL&&p.responseURL.indexOf("file:")===0)||setTimeout(E)},p.onabort=function(){p&&(r(new m("Request aborted",m.ECONNABORTED,e,p)),p=null)},p.onerror=function(){r(new m("Network Error",m.ERR_NETWORK,e,p)),p=null},p.ontimeout=function(){let k=s.timeout?"timeout of "+s.timeout+"ms exceeded":"timeout exceeded";const O=s.transitional||nn;s.timeoutErrorMessage&&(k=s.timeoutErrorMessage),r(new m(k,O.clarifyTimeoutError?m.ETIMEDOUT:m.ECONNABORTED,e,p)),p=null},o===void 0&&i.setContentType(null),"setRequestHeader"in p&&c.forEach(i.toJSON(),function(k,O){p.setRequestHeader(O,k)}),c.isUndefined(s.withCredentials)||(p.withCredentials=!!s.withCredentials),a&&a!=="json"&&(p.responseType=s.responseType),u&&([b,h]=ce(u,!0),p.addEventListener("progress",b)),f&&p.upload&&([d,y]=ce(f),p.upload.addEventListener("progress",d),p.upload.addEventListener("loadend",y)),(s.cancelToken||s.signal)&&(l=A=>{p&&(r(!A||A.type?new G(null,e,p):A),p.abort(),p=null)},s.cancelToken&&s.cancelToken.subscribe(l),s.signal&&(s.signal.aborted?l():s.signal.addEventListener("abort",l)));const T=rs(s.url);if(T&&_.protocols.indexOf(T)===-1){r(new m("Unsupported protocol "+T+":",m.ERR_BAD_REQUEST,e));return}p.send(o||null)})},ds=(e,t)=>{const{length:n}=e=e?e.filter(Boolean):[];if(t||n){let r=new AbortController,s;const o=function(u){if(!s){s=!0,a();const l=u instanceof Error?u:this.reason;r.abort(l instanceof m?l:new G(l instanceof Error?l.message:l))}};let i=t&&setTimeout(()=>{i=null,o(new m(`timeout ${t} of ms exceeded`,m.ETIMEDOUT))},t);const a=()=>{e&&(i&&clearTimeout(i),i=null,e.forEach(u=>{u.unsubscribe?u.unsubscribe(o):u.removeEventListener("abort",o)}),e=null)};e.forEach(u=>u.addEventListener("abort",o));const{signal:f}=r;return f.unsubscribe=()=>c.asap(a),f}},hs=function*(e,t){let n=e.byteLength;if(n<t){yield e;return}let r=0,s;for(;r<n;)s=r+t,yield e.slice(r,s),r=s},ps=async function*(e,t){for await(const n of ms(e))yield*hs(n,t)},ms=async function*(e){if(e[Symbol.asyncIterator]){yield*e;return}const t=e.getReader();try{for(;;){const{done:n,value:r}=await t.read();if(n)break;yield r}}finally{await t.cancel()}},yt=(e,t,n,r)=>{const s=ps(e,t);let o=0,i,a=f=>{i||(i=!0,r&&r(f))};return new ReadableStream({async pull(f){try{const{done:u,value:l}=await s.next();if(u){a(),f.close();return}let d=l.byteLength;if(n){let b=o+=d;n(b)}f.enqueue(new Uint8Array(l))}catch(u){throw a(u),u}},cancel(f){return a(f),s.return()}},{highWaterMark:2})},ge=typeof fetch=="function"&&typeof Request=="function"&&typeof Response=="function",un=ge&&typeof ReadableStream=="function",gs=ge&&(typeof TextEncoder=="function"?(e=>t=>e.encode(t))(new TextEncoder):async e=>new Uint8Array(await new Response(e).arrayBuffer())),ln=(e,...t)=>{try{return!!e(...t)}catch{return!1}},bs=un&&ln(()=>{let e=!1;const t=new Request(_.origin,{body:new ReadableStream,method:"POST",get duplex(){return e=!0,"half"}}).headers.has("Content-Type");return e&&!t}),Et=64*1024,je=un&&ln(()=>c.isReadableStream(new Response("").body)),ue={stream:je&&(e=>e.body)};ge&&(e=>{["text","arrayBuffer","blob","formData","stream"].forEach(t=>{!ue[t]&&(ue[t]=c.isFunction(e[t])?n=>n[t]():(n,r)=>{throw new m(`Response type '${t}' is not supported`,m.ERR_NOT_SUPPORT,r)})})})(new Response);const ws=async e=>{if(e==null)return 0;if(c.isBlob(e))return e.size;if(c.isSpecCompliantForm(e))return(await new Request(_.origin,{method:"POST",body:e}).arrayBuffer()).byteLength;if(c.isArrayBufferView(e)||c.isArrayBuffer(e))return e.byteLength;if(c.isURLSearchParams(e)&&(e=e+""),c.isString(e))return(await gs(e)).byteLength},ys=async(e,t)=>{const n=c.toFiniteNumber(e.getContentLength());return n??ws(t)},Es=ge&&(async e=>{let{url:t,method:n,data:r,signal:s,cancelToken:o,timeout:i,onDownloadProgress:a,onUploadProgress:f,responseType:u,headers:l,withCredentials:d="same-origin",fetchOptions:b}=cn(e);u=u?(u+"").toLowerCase():"text";let y=ds([s,o&&o.toAbortSignal()],i),h;const g=y&&y.unsubscribe&&(()=>{y.unsubscribe()});let p;try{if(f&&bs&&n!=="get"&&n!=="head"&&(p=await ys(l,r))!==0){let O=new Request(t,{method:"POST",body:r,duplex:"half"}),x;if(c.isFormData(r)&&(x=O.headers.get("content-type"))&&l.setContentType(x),O.body){const[j,se]=gt(p,ce(bt(f)));r=yt(O.body,Et,j,se)}}c.isString(d)||(d=d?"include":"omit");const E="credentials"in Request.prototype;h=new Request(t,{...b,signal:y,method:n.toUpperCase(),headers:l.normalize().toJSON(),body:r,duplex:"half",credentials:E?d:void 0});let T=await fetch(h);const A=je&&(u==="stream"||u==="response");if(je&&(a||A&&g)){const O={};["status","statusText","headers"].forEach(ut=>{O[ut]=T[ut]});const x=c.toFiniteNumber(T.headers.get("content-length")),[j,se]=a&&gt(x,ce(bt(a),!0))||[];T=new Response(yt(T.body,Et,j,()=>{se&&se(),g&&g()}),O)}u=u||"text";let k=await ue[c.findKey(ue,u)||"text"](T,e);return!A&&g&&g(),await new Promise((O,x)=>{on(O,x,{data:k,headers:R.from(T.headers),status:T.status,statusText:T.statusText,config:e,request:h})})}catch(E){throw g&&g(),E&&E.name==="TypeError"&&/fetch/i.test(E.message)?Object.assign(new m("Network Error",m.ERR_NETWORK,e,h),{cause:E.cause||E}):m.from(E,E&&E.code,e,h)}}),$e={http:xr,xhr:fs,fetch:Es};c.forEach($e,(e,t)=>{if(e){try{Object.defineProperty(e,"name",{value:t})}catch{}Object.defineProperty(e,"adapterName",{value:t})}});const St=e=>`- ${e}`,Ss=e=>c.isFunction(e)||e===null||e===!1,fn={getAdapter:e=>{e=c.isArray(e)?e:[e];const{length:t}=e;let n,r;const s={};for(let o=0;o<t;o++){n=e[o];let i;if(r=n,!Ss(n)&&(r=$e[(i=String(n)).toLowerCase()],r===void 0))throw new m(`Unknown adapter '${i}'`);if(r)break;s[i||"#"+o]=r}if(!r){const o=Object.entries(s).map(([a,f])=>`adapter ${a} `+(f===!1?"is not supported by the environment":"is not available in the build"));let i=t?o.length>1?`since :
`+o.map(St).join(`
`):" "+St(o[0]):"as no adapter specified";throw new m("There is no suitable adapter to dispatch the request "+i,"ERR_NOT_SUPPORT")}return r},adapters:$e};function Ie(e){if(e.cancelToken&&e.cancelToken.throwIfRequested(),e.signal&&e.signal.aborted)throw new G(null,e)}function Tt(e){return Ie(e),e.headers=R.from(e.headers),e.data=_e.call(e,e.transformRequest),["post","put","patch"].indexOf(e.method)!==-1&&e.headers.setContentType("application/x-www-form-urlencoded",!1),fn.getAdapter(e.adapter||re.adapter)(e).then(function(r){return Ie(e),r.data=_e.call(e,e.transformResponse,r),r.headers=R.from(r.headers),r},function(r){return sn(r)||(Ie(e),r&&r.response&&(r.response.data=_e.call(e,e.transformResponse,r.response),r.response.headers=R.from(r.response.headers))),Promise.reject(r)})}const dn="1.7.9",be={};["object","boolean","number","function","string","symbol"].forEach((e,t)=>{be[e]=function(r){return typeof r===e||"a"+(t<1?"n ":" ")+e}});const At={};be.transitional=function(t,n,r){function s(o,i){return"[Axios v"+dn+"] Transitional option '"+o+"'"+i+(r?". "+r:"")}return(o,i,a)=>{if(t===!1)throw new m(s(i," has been removed"+(n?" in "+n:"")),m.ERR_DEPRECATED);return n&&!At[i]&&(At[i]=!0,console.warn(s(i," has been deprecated since v"+n+" and will be removed in the near future"))),t?t(o,i,a):!0}};be.spelling=function(t){return(n,r)=>(console.warn(`${r} is likely a misspelling of ${t}`),!0)};function Ts(e,t,n){if(typeof e!="object")throw new m("options must be an object",m.ERR_BAD_OPTION_VALUE);const r=Object.keys(e);let s=r.length;for(;s-- >0;){const o=r[s],i=t[o];if(i){const a=e[o],f=a===void 0||i(a,o,e);if(f!==!0)throw new m("option "+o+" must be "+f,m.ERR_BAD_OPTION_VALUE);continue}if(n!==!0)throw new m("Unknown option "+o,m.ERR_BAD_OPTION)}}const ae={assertOptions:Ts,validators:be},D=ae.validators;class q{constructor(t){this.defaults=t,this.interceptors={request:new pt,response:new pt}}async request(t,n){try{return await this._request(t,n)}catch(r){if(r instanceof Error){let s={};Error.captureStackTrace?Error.captureStackTrace(s):s=new Error;const o=s.stack?s.stack.replace(/^.+\n/,""):"";try{r.stack?o&&!String(r.stack).endsWith(o.replace(/^.+\n.+\n/,""))&&(r.stack+=`
`+o):r.stack=o}catch{}}throw r}}_request(t,n){typeof t=="string"?(n=n||{},n.url=t):n=t||{},n=V(this.defaults,n);const{transitional:r,paramsSerializer:s,headers:o}=n;r!==void 0&&ae.assertOptions(r,{silentJSONParsing:D.transitional(D.boolean),forcedJSONParsing:D.transitional(D.boolean),clarifyTimeoutError:D.transitional(D.boolean)},!1),s!=null&&(c.isFunction(s)?n.paramsSerializer={serialize:s}:ae.assertOptions(s,{encode:D.function,serialize:D.function},!0)),ae.assertOptions(n,{baseUrl:D.spelling("baseURL"),withXsrfToken:D.spelling("withXSRFToken")},!0),n.method=(n.method||this.defaults.method||"get").toLowerCase();let i=o&&c.merge(o.common,o[n.method]);o&&c.forEach(["delete","get","head","post","put","patch","common"],h=>{delete o[h]}),n.headers=R.concat(i,o);const a=[];let f=!0;this.interceptors.request.forEach(function(g){typeof g.runWhen=="function"&&g.runWhen(n)===!1||(f=f&&g.synchronous,a.unshift(g.fulfilled,g.rejected))});const u=[];this.interceptors.response.forEach(function(g){u.push(g.fulfilled,g.rejected)});let l,d=0,b;if(!f){const h=[Tt.bind(this),void 0];for(h.unshift.apply(h,a),h.push.apply(h,u),b=h.length,l=Promise.resolve(n);d<b;)l=l.then(h[d++],h[d++]);return l}b=a.length;let y=n;for(d=0;d<b;){const h=a[d++],g=a[d++];try{y=h(y)}catch(p){g.call(this,p);break}}try{l=Tt.call(this,y)}catch(h){return Promise.reject(h)}for(d=0,b=u.length;d<b;)l=l.then(u[d++],u[d++]);return l}getUri(t){t=V(this.defaults,t);const n=an(t.baseURL,t.url);return tn(n,t.params,t.paramsSerializer)}}c.forEach(["delete","get","head","options"],function(t){q.prototype[t]=function(n,r){return this.request(V(r||{},{method:t,url:n,data:(r||{}).data}))}});c.forEach(["post","put","patch"],function(t){function n(r){return function(o,i,a){return this.request(V(a||{},{method:t,headers:r?{"Content-Type":"multipart/form-data"}:{},url:o,data:i}))}}q.prototype[t]=n(),q.prototype[t+"Form"]=n(!0)});class Qe{constructor(t){if(typeof t!="function")throw new TypeError("executor must be a function.");let n;this.promise=new Promise(function(o){n=o});const r=this;this.promise.then(s=>{if(!r._listeners)return;let o=r._listeners.length;for(;o-- >0;)r._listeners[o](s);r._listeners=null}),this.promise.then=s=>{let o;const i=new Promise(a=>{r.subscribe(a),o=a}).then(s);return i.cancel=function(){r.unsubscribe(o)},i},t(function(o,i,a){r.reason||(r.reason=new G(o,i,a),n(r.reason))})}throwIfRequested(){if(this.reason)throw this.reason}subscribe(t){if(this.reason){t(this.reason);return}this._listeners?this._listeners.push(t):this._listeners=[t]}unsubscribe(t){if(!this._listeners)return;const n=this._listeners.indexOf(t);n!==-1&&this._listeners.splice(n,1)}toAbortSignal(){const t=new AbortController,n=r=>{t.abort(r)};return this.subscribe(n),t.signal.unsubscribe=()=>this.unsubscribe(n),t.signal}static source(){let t;return{token:new Qe(function(s){t=s}),cancel:t}}}function As(e){return function(n){return e.apply(null,n)}}function _s(e){return c.isObject(e)&&e.isAxiosError===!0}const He={Continue:100,SwitchingProtocols:101,Processing:102,EarlyHints:103,Ok:200,Created:201,Accepted:202,NonAuthoritativeInformation:203,NoContent:204,ResetContent:205,PartialContent:206,MultiStatus:207,AlreadyReported:208,ImUsed:226,MultipleChoices:300,MovedPermanently:301,Found:302,SeeOther:303,NotModified:304,UseProxy:305,Unused:306,TemporaryRedirect:307,PermanentRedirect:308,BadRequest:400,Unauthorized:401,PaymentRequired:402,Forbidden:403,NotFound:404,MethodNotAllowed:405,NotAcceptable:406,ProxyAuthenticationRequired:407,RequestTimeout:408,Conflict:409,Gone:410,LengthRequired:411,PreconditionFailed:412,PayloadTooLarge:413,UriTooLong:414,UnsupportedMediaType:415,RangeNotSatisfiable:416,ExpectationFailed:417,ImATeapot:418,MisdirectedRequest:421,UnprocessableEntity:422,Locked:423,FailedDependency:424,TooEarly:425,UpgradeRequired:426,PreconditionRequired:428,TooManyRequests:429,RequestHeaderFieldsTooLarge:431,UnavailableForLegalReasons:451,InternalServerError:500,NotImplemented:501,BadGateway:502,ServiceUnavailable:503,GatewayTimeout:504,HttpVersionNotSupported:505,VariantAlsoNegotiates:506,InsufficientStorage:507,LoopDetected:508,NotExtended:510,NetworkAuthenticationRequired:511};Object.entries(He).forEach(([e,t])=>{He[t]=e});function hn(e){const t=new q(e),n=qt(q.prototype.request,t);return c.extend(n,q.prototype,t,{allOwnKeys:!0}),c.extend(n,t,null,{allOwnKeys:!0}),n.create=function(s){return hn(V(e,s))},n}const S=hn(re);S.Axios=q;S.CanceledError=G;S.CancelToken=Qe;S.isCancel=sn;S.VERSION=dn;S.toFormData=me;S.AxiosError=m;S.Cancel=S.CanceledError;S.all=function(t){return Promise.all(t)};S.spread=As;S.isAxiosError=_s;S.mergeConfig=V;S.AxiosHeaders=R;S.formToJSON=e=>rn(c.isHTMLForm(e)?new FormData(e):e);S.getAdapter=fn.getAdapter;S.HttpStatusCode=He;S.default=S;window.axios=S;window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";var _t={};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const pn=function(e){const t=[];let n=0;for(let r=0;r<e.length;r++){let s=e.charCodeAt(r);s<128?t[n++]=s:s<2048?(t[n++]=s>>6|192,t[n++]=s&63|128):(s&64512)===55296&&r+1<e.length&&(e.charCodeAt(r+1)&64512)===56320?(s=65536+((s&1023)<<10)+(e.charCodeAt(++r)&1023),t[n++]=s>>18|240,t[n++]=s>>12&63|128,t[n++]=s>>6&63|128,t[n++]=s&63|128):(t[n++]=s>>12|224,t[n++]=s>>6&63|128,t[n++]=s&63|128)}return t},Is=function(e){const t=[];let n=0,r=0;for(;n<e.length;){const s=e[n++];if(s<128)t[r++]=String.fromCharCode(s);else if(s>191&&s<224){const o=e[n++];t[r++]=String.fromCharCode((s&31)<<6|o&63)}else if(s>239&&s<365){const o=e[n++],i=e[n++],a=e[n++],f=((s&7)<<18|(o&63)<<12|(i&63)<<6|a&63)-65536;t[r++]=String.fromCharCode(55296+(f>>10)),t[r++]=String.fromCharCode(56320+(f&1023))}else{const o=e[n++],i=e[n++];t[r++]=String.fromCharCode((s&15)<<12|(o&63)<<6|i&63)}}return t.join("")},mn={byteToCharMap_:null,charToByteMap_:null,byteToCharMapWebSafe_:null,charToByteMapWebSafe_:null,ENCODED_VALS_BASE:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",get ENCODED_VALS(){return this.ENCODED_VALS_BASE+"+/="},get ENCODED_VALS_WEBSAFE(){return this.ENCODED_VALS_BASE+"-_."},HAS_NATIVE_SUPPORT:typeof atob=="function",encodeByteArray(e,t){if(!Array.isArray(e))throw Error("encodeByteArray takes an array as a parameter");this.init_();const n=t?this.byteToCharMapWebSafe_:this.byteToCharMap_,r=[];for(let s=0;s<e.length;s+=3){const o=e[s],i=s+1<e.length,a=i?e[s+1]:0,f=s+2<e.length,u=f?e[s+2]:0,l=o>>2,d=(o&3)<<4|a>>4;let b=(a&15)<<2|u>>6,y=u&63;f||(y=64,i||(b=64)),r.push(n[l],n[d],n[b],n[y])}return r.join("")},encodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?btoa(e):this.encodeByteArray(pn(e),t)},decodeString(e,t){return this.HAS_NATIVE_SUPPORT&&!t?atob(e):Is(this.decodeStringToByteArray(e,t))},decodeStringToByteArray(e,t){this.init_();const n=t?this.charToByteMapWebSafe_:this.charToByteMap_,r=[];for(let s=0;s<e.length;){const o=n[e.charAt(s++)],a=s<e.length?n[e.charAt(s)]:0;++s;const u=s<e.length?n[e.charAt(s)]:64;++s;const d=s<e.length?n[e.charAt(s)]:64;if(++s,o==null||a==null||u==null||d==null)throw new Os;const b=o<<2|a>>4;if(r.push(b),u!==64){const y=a<<4&240|u>>2;if(r.push(y),d!==64){const h=u<<6&192|d;r.push(h)}}}return r},init_(){if(!this.byteToCharMap_){this.byteToCharMap_={},this.charToByteMap_={},this.byteToCharMapWebSafe_={},this.charToByteMapWebSafe_={};for(let e=0;e<this.ENCODED_VALS.length;e++)this.byteToCharMap_[e]=this.ENCODED_VALS.charAt(e),this.charToByteMap_[this.byteToCharMap_[e]]=e,this.byteToCharMapWebSafe_[e]=this.ENCODED_VALS_WEBSAFE.charAt(e),this.charToByteMapWebSafe_[this.byteToCharMapWebSafe_[e]]=e,e>=this.ENCODED_VALS_BASE.length&&(this.charToByteMap_[this.ENCODED_VALS_WEBSAFE.charAt(e)]=e,this.charToByteMapWebSafe_[this.ENCODED_VALS.charAt(e)]=e)}}};class Os extends Error{constructor(){super(...arguments),this.name="DecodeBase64StringError"}}const Rs=function(e){const t=pn(e);return mn.encodeByteArray(t,!0)},gn=function(e){return Rs(e).replace(/\./g,"")},vs=function(e){try{return mn.decodeString(e,!0)}catch(t){console.error("base64Decode failed: ",t)}return null};/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Cs(){if(typeof self<"u")return self;if(typeof window<"u")return window;if(typeof global<"u")return global;throw new Error("Unable to locate global object.")}/**
 * @license
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ds=()=>Cs().__FIREBASE_DEFAULTS__,ks=()=>{if(typeof process>"u"||typeof _t>"u")return;const e=_t.__FIREBASE_DEFAULTS__;if(e)return JSON.parse(e)},Ns=()=>{if(typeof document>"u")return;let e;try{e=document.cookie.match(/__FIREBASE_DEFAULTS__=([^;]+)/)}catch{return}const t=e&&vs(e[1]);return t&&JSON.parse(t)},Ps=()=>{try{return Ds()||ks()||Ns()}catch(e){console.info(`Unable to get __FIREBASE_DEFAULTS__ due to: ${e}`);return}},bn=()=>{var e;return(e=Ps())===null||e===void 0?void 0:e.config};/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Bs{constructor(){this.reject=()=>{},this.resolve=()=>{},this.promise=new Promise((t,n)=>{this.resolve=t,this.reject=n})}wrapCallback(t){return(n,r)=>{n?this.reject(n):this.resolve(r),typeof t=="function"&&(this.promise.catch(()=>{}),t.length===1?t(n):t(n,r))}}}function wn(){try{return typeof indexedDB=="object"}catch{return!1}}function yn(){return new Promise((e,t)=>{try{let n=!0;const r="validate-browser-context-for-indexeddb-analytics-module",s=self.indexedDB.open(r);s.onsuccess=()=>{s.result.close(),n||self.indexedDB.deleteDatabase(r),e(!0)},s.onupgradeneeded=()=>{n=!1},s.onerror=()=>{var o;t(((o=s.error)===null||o===void 0?void 0:o.message)||"")}}catch(n){t(n)}})}function xs(){return!(typeof navigator>"u"||!navigator.cookieEnabled)}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Fs="FirebaseError";class X extends Error{constructor(t,n,r){super(n),this.code=t,this.customData=r,this.name=Fs,Object.setPrototypeOf(this,X.prototype),Error.captureStackTrace&&Error.captureStackTrace(this,we.prototype.create)}}class we{constructor(t,n,r){this.service=t,this.serviceName=n,this.errors=r}create(t,...n){const r=n[0]||{},s=`${this.service}/${t}`,o=this.errors[t],i=o?Ls(o,r):"Error",a=`${this.serviceName}: ${i} (${s}).`;return new X(s,a,r)}}function Ls(e,t){return e.replace(Ms,(n,r)=>{const s=t[r];return s!=null?String(s):`<${r}?>`})}const Ms=/\{\$([^}]+)}/g;function Ue(e,t){if(e===t)return!0;const n=Object.keys(e),r=Object.keys(t);for(const s of n){if(!r.includes(s))return!1;const o=e[s],i=t[s];if(It(o)&&It(i)){if(!Ue(o,i))return!1}else if(o!==i)return!1}for(const s of r)if(!n.includes(s))return!1;return!0}function It(e){return e!==null&&typeof e=="object"}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ze(e){return e&&e._delegate?e._delegate:e}class M{constructor(t,n,r){this.name=t,this.instanceFactory=n,this.type=r,this.multipleInstances=!1,this.serviceProps={},this.instantiationMode="LAZY",this.onInstanceCreated=null}setInstantiationMode(t){return this.instantiationMode=t,this}setMultipleInstances(t){return this.multipleInstances=t,this}setServiceProps(t){return this.serviceProps=t,this}setInstanceCreatedCallback(t){return this.onInstanceCreated=t,this}}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const $="[DEFAULT]";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class js{constructor(t,n){this.name=t,this.container=n,this.component=null,this.instances=new Map,this.instancesDeferred=new Map,this.instancesOptions=new Map,this.onInitCallbacks=new Map}get(t){const n=this.normalizeInstanceIdentifier(t);if(!this.instancesDeferred.has(n)){const r=new Bs;if(this.instancesDeferred.set(n,r),this.isInitialized(n)||this.shouldAutoInitialize())try{const s=this.getOrInitializeService({instanceIdentifier:n});s&&r.resolve(s)}catch{}}return this.instancesDeferred.get(n).promise}getImmediate(t){var n;const r=this.normalizeInstanceIdentifier(t==null?void 0:t.identifier),s=(n=t==null?void 0:t.optional)!==null&&n!==void 0?n:!1;if(this.isInitialized(r)||this.shouldAutoInitialize())try{return this.getOrInitializeService({instanceIdentifier:r})}catch(o){if(s)return null;throw o}else{if(s)return null;throw Error(`Service ${this.name} is not available`)}}getComponent(){return this.component}setComponent(t){if(t.name!==this.name)throw Error(`Mismatching Component ${t.name} for Provider ${this.name}.`);if(this.component)throw Error(`Component for ${this.name} has already been provided`);if(this.component=t,!!this.shouldAutoInitialize()){if(Hs(t))try{this.getOrInitializeService({instanceIdentifier:$})}catch{}for(const[n,r]of this.instancesDeferred.entries()){const s=this.normalizeInstanceIdentifier(n);try{const o=this.getOrInitializeService({instanceIdentifier:s});r.resolve(o)}catch{}}}}clearInstance(t=$){this.instancesDeferred.delete(t),this.instancesOptions.delete(t),this.instances.delete(t)}async delete(){const t=Array.from(this.instances.values());await Promise.all([...t.filter(n=>"INTERNAL"in n).map(n=>n.INTERNAL.delete()),...t.filter(n=>"_delete"in n).map(n=>n._delete())])}isComponentSet(){return this.component!=null}isInitialized(t=$){return this.instances.has(t)}getOptions(t=$){return this.instancesOptions.get(t)||{}}initialize(t={}){const{options:n={}}=t,r=this.normalizeInstanceIdentifier(t.instanceIdentifier);if(this.isInitialized(r))throw Error(`${this.name}(${r}) has already been initialized`);if(!this.isComponentSet())throw Error(`Component ${this.name} has not been registered yet`);const s=this.getOrInitializeService({instanceIdentifier:r,options:n});for(const[o,i]of this.instancesDeferred.entries()){const a=this.normalizeInstanceIdentifier(o);r===a&&i.resolve(s)}return s}onInit(t,n){var r;const s=this.normalizeInstanceIdentifier(n),o=(r=this.onInitCallbacks.get(s))!==null&&r!==void 0?r:new Set;o.add(t),this.onInitCallbacks.set(s,o);const i=this.instances.get(s);return i&&t(i,s),()=>{o.delete(t)}}invokeOnInitCallbacks(t,n){const r=this.onInitCallbacks.get(n);if(r)for(const s of r)try{s(t,n)}catch{}}getOrInitializeService({instanceIdentifier:t,options:n={}}){let r=this.instances.get(t);if(!r&&this.component&&(r=this.component.instanceFactory(this.container,{instanceIdentifier:$s(t),options:n}),this.instances.set(t,r),this.instancesOptions.set(t,n),this.invokeOnInitCallbacks(r,t),this.component.onInstanceCreated))try{this.component.onInstanceCreated(this.container,t,r)}catch{}return r||null}normalizeInstanceIdentifier(t=$){return this.component?this.component.multipleInstances?t:$:t}shouldAutoInitialize(){return!!this.component&&this.component.instantiationMode!=="EXPLICIT"}}function $s(e){return e===$?void 0:e}function Hs(e){return e.instantiationMode==="EAGER"}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Us{constructor(t){this.name=t,this.providers=new Map}addComponent(t){const n=this.getProvider(t.name);if(n.isComponentSet())throw new Error(`Component ${t.name} has already been registered with ${this.name}`);n.setComponent(t)}addOrOverwriteComponent(t){this.getProvider(t.name).isComponentSet()&&this.providers.delete(t.name),this.addComponent(t)}getProvider(t){if(this.providers.has(t))return this.providers.get(t);const n=new js(t,this);return this.providers.set(t,n),n}getProviders(){return Array.from(this.providers.values())}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */var w;(function(e){e[e.DEBUG=0]="DEBUG",e[e.VERBOSE=1]="VERBOSE",e[e.INFO=2]="INFO",e[e.WARN=3]="WARN",e[e.ERROR=4]="ERROR",e[e.SILENT=5]="SILENT"})(w||(w={}));const qs={debug:w.DEBUG,verbose:w.VERBOSE,info:w.INFO,warn:w.WARN,error:w.ERROR,silent:w.SILENT},Vs=w.INFO,zs={[w.DEBUG]:"log",[w.VERBOSE]:"log",[w.INFO]:"info",[w.WARN]:"warn",[w.ERROR]:"error"},Ks=(e,t,...n)=>{if(t<e.logLevel)return;const r=new Date().toISOString(),s=zs[t];if(s)console[s](`[${r}]  ${e.name}:`,...n);else throw new Error(`Attempted to log a message with an invalid logType (value: ${t})`)};class Ws{constructor(t){this.name=t,this._logLevel=Vs,this._logHandler=Ks,this._userLogHandler=null}get logLevel(){return this._logLevel}set logLevel(t){if(!(t in w))throw new TypeError(`Invalid value "${t}" assigned to \`logLevel\``);this._logLevel=t}setLogLevel(t){this._logLevel=typeof t=="string"?qs[t]:t}get logHandler(){return this._logHandler}set logHandler(t){if(typeof t!="function")throw new TypeError("Value assigned to `logHandler` must be a function");this._logHandler=t}get userLogHandler(){return this._userLogHandler}set userLogHandler(t){this._userLogHandler=t}debug(...t){this._userLogHandler&&this._userLogHandler(this,w.DEBUG,...t),this._logHandler(this,w.DEBUG,...t)}log(...t){this._userLogHandler&&this._userLogHandler(this,w.VERBOSE,...t),this._logHandler(this,w.VERBOSE,...t)}info(...t){this._userLogHandler&&this._userLogHandler(this,w.INFO,...t),this._logHandler(this,w.INFO,...t)}warn(...t){this._userLogHandler&&this._userLogHandler(this,w.WARN,...t),this._logHandler(this,w.WARN,...t)}error(...t){this._userLogHandler&&this._userLogHandler(this,w.ERROR,...t),this._logHandler(this,w.ERROR,...t)}}const Js=(e,t)=>t.some(n=>e instanceof n);let Ot,Rt;function Gs(){return Ot||(Ot=[IDBDatabase,IDBObjectStore,IDBIndex,IDBCursor,IDBTransaction])}function Xs(){return Rt||(Rt=[IDBCursor.prototype.advance,IDBCursor.prototype.continue,IDBCursor.prototype.continuePrimaryKey])}const En=new WeakMap,qe=new WeakMap,Sn=new WeakMap,Oe=new WeakMap,et=new WeakMap;function Ys(e){const t=new Promise((n,r)=>{const s=()=>{e.removeEventListener("success",o),e.removeEventListener("error",i)},o=()=>{n(P(e.result)),s()},i=()=>{r(e.error),s()};e.addEventListener("success",o),e.addEventListener("error",i)});return t.then(n=>{n instanceof IDBCursor&&En.set(n,e)}).catch(()=>{}),et.set(t,e),t}function Qs(e){if(qe.has(e))return;const t=new Promise((n,r)=>{const s=()=>{e.removeEventListener("complete",o),e.removeEventListener("error",i),e.removeEventListener("abort",i)},o=()=>{n(),s()},i=()=>{r(e.error||new DOMException("AbortError","AbortError")),s()};e.addEventListener("complete",o),e.addEventListener("error",i),e.addEventListener("abort",i)});qe.set(e,t)}let Ve={get(e,t,n){if(e instanceof IDBTransaction){if(t==="done")return qe.get(e);if(t==="objectStoreNames")return e.objectStoreNames||Sn.get(e);if(t==="store")return n.objectStoreNames[1]?void 0:n.objectStore(n.objectStoreNames[0])}return P(e[t])},set(e,t,n){return e[t]=n,!0},has(e,t){return e instanceof IDBTransaction&&(t==="done"||t==="store")?!0:t in e}};function Zs(e){Ve=e(Ve)}function eo(e){return e===IDBDatabase.prototype.transaction&&!("objectStoreNames"in IDBTransaction.prototype)?function(t,...n){const r=e.call(Re(this),t,...n);return Sn.set(r,t.sort?t.sort():[t]),P(r)}:Xs().includes(e)?function(...t){return e.apply(Re(this),t),P(En.get(this))}:function(...t){return P(e.apply(Re(this),t))}}function to(e){return typeof e=="function"?eo(e):(e instanceof IDBTransaction&&Qs(e),Js(e,Gs())?new Proxy(e,Ve):e)}function P(e){if(e instanceof IDBRequest)return Ys(e);if(Oe.has(e))return Oe.get(e);const t=to(e);return t!==e&&(Oe.set(e,t),et.set(t,e)),t}const Re=e=>et.get(e);function ye(e,t,{blocked:n,upgrade:r,blocking:s,terminated:o}={}){const i=indexedDB.open(e,t),a=P(i);return r&&i.addEventListener("upgradeneeded",f=>{r(P(i.result),f.oldVersion,f.newVersion,P(i.transaction),f)}),n&&i.addEventListener("blocked",f=>n(f.oldVersion,f.newVersion,f)),a.then(f=>{o&&f.addEventListener("close",()=>o()),s&&f.addEventListener("versionchange",u=>s(u.oldVersion,u.newVersion,u))}).catch(()=>{}),a}function ve(e,{blocked:t}={}){const n=indexedDB.deleteDatabase(e);return t&&n.addEventListener("blocked",r=>t(r.oldVersion,r)),P(n).then(()=>{})}const no=["get","getKey","getAll","getAllKeys","count"],ro=["put","add","delete","clear"],Ce=new Map;function vt(e,t){if(!(e instanceof IDBDatabase&&!(t in e)&&typeof t=="string"))return;if(Ce.get(t))return Ce.get(t);const n=t.replace(/FromIndex$/,""),r=t!==n,s=ro.includes(n);if(!(n in(r?IDBIndex:IDBObjectStore).prototype)||!(s||no.includes(n)))return;const o=async function(i,...a){const f=this.transaction(i,s?"readwrite":"readonly");let u=f.store;return r&&(u=u.index(a.shift())),(await Promise.all([u[n](...a),s&&f.done]))[0]};return Ce.set(t,o),o}Zs(e=>({...e,get:(t,n,r)=>vt(t,n)||e.get(t,n,r),has:(t,n)=>!!vt(t,n)||e.has(t,n)}));/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class so{constructor(t){this.container=t}getPlatformInfoString(){return this.container.getProviders().map(n=>{if(oo(n)){const r=n.getImmediate();return`${r.library}/${r.version}`}else return null}).filter(n=>n).join(" ")}}function oo(e){const t=e.getComponent();return(t==null?void 0:t.type)==="VERSION"}const ze="@firebase/app",Ct="0.10.17";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const B=new Ws("@firebase/app"),io="@firebase/app-compat",ao="@firebase/analytics-compat",co="@firebase/analytics",uo="@firebase/app-check-compat",lo="@firebase/app-check",fo="@firebase/auth",ho="@firebase/auth-compat",po="@firebase/database",mo="@firebase/data-connect",go="@firebase/database-compat",bo="@firebase/functions",wo="@firebase/functions-compat",yo="@firebase/installations",Eo="@firebase/installations-compat",So="@firebase/messaging",To="@firebase/messaging-compat",Ao="@firebase/performance",_o="@firebase/performance-compat",Io="@firebase/remote-config",Oo="@firebase/remote-config-compat",Ro="@firebase/storage",vo="@firebase/storage-compat",Co="@firebase/firestore",Do="@firebase/vertexai",ko="@firebase/firestore-compat",No="firebase";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ke="[DEFAULT]",Po={[ze]:"fire-core",[io]:"fire-core-compat",[co]:"fire-analytics",[ao]:"fire-analytics-compat",[lo]:"fire-app-check",[uo]:"fire-app-check-compat",[fo]:"fire-auth",[ho]:"fire-auth-compat",[po]:"fire-rtdb",[mo]:"fire-data-connect",[go]:"fire-rtdb-compat",[bo]:"fire-fn",[wo]:"fire-fn-compat",[yo]:"fire-iid",[Eo]:"fire-iid-compat",[So]:"fire-fcm",[To]:"fire-fcm-compat",[Ao]:"fire-perf",[_o]:"fire-perf-compat",[Io]:"fire-rc",[Oo]:"fire-rc-compat",[Ro]:"fire-gcs",[vo]:"fire-gcs-compat",[Co]:"fire-fst",[ko]:"fire-fst-compat",[Do]:"fire-vertex","fire-js":"fire-js",[No]:"fire-js-all"};/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const le=new Map,Bo=new Map,We=new Map;function Dt(e,t){try{e.container.addComponent(t)}catch(n){B.debug(`Component ${t.name} failed to register with FirebaseApp ${e.name}`,n)}}function z(e){const t=e.name;if(We.has(t))return B.debug(`There were multiple attempts to register component ${t}.`),!1;We.set(t,e);for(const n of le.values())Dt(n,e);for(const n of Bo.values())Dt(n,e);return!0}function tt(e,t){const n=e.container.getProvider("heartbeat").getImmediate({optional:!0});return n&&n.triggerHeartbeat(),e.container.getProvider(t)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const xo={"no-app":"No Firebase App '{$appName}' has been created - call initializeApp() first","bad-app-name":"Illegal App name: '{$appName}'","duplicate-app":"Firebase App named '{$appName}' already exists with different options or config","app-deleted":"Firebase App named '{$appName}' already deleted","server-app-deleted":"Firebase Server App has been deleted","no-options":"Need to provide options, when not being deployed to hosting via source.","invalid-app-argument":"firebase.{$appName}() takes either no argument or a Firebase App instance.","invalid-log-argument":"First argument to `onLog` must be null or a function.","idb-open":"Error thrown when opening IndexedDB. Original error: {$originalErrorMessage}.","idb-get":"Error thrown when reading from IndexedDB. Original error: {$originalErrorMessage}.","idb-set":"Error thrown when writing to IndexedDB. Original error: {$originalErrorMessage}.","idb-delete":"Error thrown when deleting from IndexedDB. Original error: {$originalErrorMessage}.","finalization-registry-not-supported":"FirebaseServerApp deleteOnDeref field defined but the JS runtime does not support FinalizationRegistry.","invalid-server-app-environment":"FirebaseServerApp is not for use in browser environments."},F=new we("app","Firebase",xo);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class Fo{constructor(t,n,r){this._isDeleted=!1,this._options=Object.assign({},t),this._config=Object.assign({},n),this._name=n.name,this._automaticDataCollectionEnabled=n.automaticDataCollectionEnabled,this._container=r,this.container.addComponent(new M("app",()=>this,"PUBLIC"))}get automaticDataCollectionEnabled(){return this.checkDestroyed(),this._automaticDataCollectionEnabled}set automaticDataCollectionEnabled(t){this.checkDestroyed(),this._automaticDataCollectionEnabled=t}get name(){return this.checkDestroyed(),this._name}get options(){return this.checkDestroyed(),this._options}get config(){return this.checkDestroyed(),this._config}get container(){return this._container}get isDeleted(){return this._isDeleted}set isDeleted(t){this._isDeleted=t}checkDestroyed(){if(this.isDeleted)throw F.create("app-deleted",{appName:this._name})}}function Tn(e,t={}){let n=e;typeof t!="object"&&(t={name:t});const r=Object.assign({name:Ke,automaticDataCollectionEnabled:!1},t),s=r.name;if(typeof s!="string"||!s)throw F.create("bad-app-name",{appName:String(s)});if(n||(n=bn()),!n)throw F.create("no-options");const o=le.get(s);if(o){if(Ue(n,o.options)&&Ue(r,o.config))return o;throw F.create("duplicate-app",{appName:s})}const i=new Us(s);for(const f of We.values())i.addComponent(f);const a=new Fo(n,r,i);return le.set(s,a),a}function Lo(e=Ke){const t=le.get(e);if(!t&&e===Ke&&bn())return Tn();if(!t)throw F.create("no-app",{appName:e});return t}function L(e,t,n){var r;let s=(r=Po[e])!==null&&r!==void 0?r:e;n&&(s+=`-${n}`);const o=s.match(/\s|\//),i=t.match(/\s|\//);if(o||i){const a=[`Unable to register library "${s}" with version "${t}":`];o&&a.push(`library name "${s}" contains illegal characters (whitespace or "/")`),o&&i&&a.push("and"),i&&a.push(`version name "${t}" contains illegal characters (whitespace or "/")`),B.warn(a.join(" "));return}z(new M(`${s}-version`,()=>({library:s,version:t}),"VERSION"))}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Mo="firebase-heartbeat-database",jo=1,Z="firebase-heartbeat-store";let De=null;function An(){return De||(De=ye(Mo,jo,{upgrade:(e,t)=>{switch(t){case 0:try{e.createObjectStore(Z)}catch(n){console.warn(n)}}}}).catch(e=>{throw F.create("idb-open",{originalErrorMessage:e.message})})),De}async function $o(e){try{const n=(await An()).transaction(Z),r=await n.objectStore(Z).get(_n(e));return await n.done,r}catch(t){if(t instanceof X)B.warn(t.message);else{const n=F.create("idb-get",{originalErrorMessage:t==null?void 0:t.message});B.warn(n.message)}}}async function kt(e,t){try{const r=(await An()).transaction(Z,"readwrite");await r.objectStore(Z).put(t,_n(e)),await r.done}catch(n){if(n instanceof X)B.warn(n.message);else{const r=F.create("idb-set",{originalErrorMessage:n==null?void 0:n.message});B.warn(r.message)}}}function _n(e){return`${e.name}!${e.options.appId}`}/**
 * @license
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Ho=1024,Uo=30*24*60*60*1e3;class qo{constructor(t){this.container=t,this._heartbeatsCache=null;const n=this.container.getProvider("app").getImmediate();this._storage=new zo(n),this._heartbeatsCachePromise=this._storage.read().then(r=>(this._heartbeatsCache=r,r))}async triggerHeartbeat(){var t,n;try{const s=this.container.getProvider("platform-logger").getImmediate().getPlatformInfoString(),o=Nt();return((t=this._heartbeatsCache)===null||t===void 0?void 0:t.heartbeats)==null&&(this._heartbeatsCache=await this._heartbeatsCachePromise,((n=this._heartbeatsCache)===null||n===void 0?void 0:n.heartbeats)==null)||this._heartbeatsCache.lastSentHeartbeatDate===o||this._heartbeatsCache.heartbeats.some(i=>i.date===o)?void 0:(this._heartbeatsCache.heartbeats.push({date:o,agent:s}),this._heartbeatsCache.heartbeats=this._heartbeatsCache.heartbeats.filter(i=>{const a=new Date(i.date).valueOf();return Date.now()-a<=Uo}),this._storage.overwrite(this._heartbeatsCache))}catch(r){B.warn(r)}}async getHeartbeatsHeader(){var t;try{if(this._heartbeatsCache===null&&await this._heartbeatsCachePromise,((t=this._heartbeatsCache)===null||t===void 0?void 0:t.heartbeats)==null||this._heartbeatsCache.heartbeats.length===0)return"";const n=Nt(),{heartbeatsToSend:r,unsentEntries:s}=Vo(this._heartbeatsCache.heartbeats),o=gn(JSON.stringify({version:2,heartbeats:r}));return this._heartbeatsCache.lastSentHeartbeatDate=n,s.length>0?(this._heartbeatsCache.heartbeats=s,await this._storage.overwrite(this._heartbeatsCache)):(this._heartbeatsCache.heartbeats=[],this._storage.overwrite(this._heartbeatsCache)),o}catch(n){return B.warn(n),""}}}function Nt(){return new Date().toISOString().substring(0,10)}function Vo(e,t=Ho){const n=[];let r=e.slice();for(const s of e){const o=n.find(i=>i.agent===s.agent);if(o){if(o.dates.push(s.date),Pt(n)>t){o.dates.pop();break}}else if(n.push({agent:s.agent,dates:[s.date]}),Pt(n)>t){n.pop();break}r=r.slice(1)}return{heartbeatsToSend:n,unsentEntries:r}}class zo{constructor(t){this.app=t,this._canUseIndexedDBPromise=this.runIndexedDBEnvironmentCheck()}async runIndexedDBEnvironmentCheck(){return wn()?yn().then(()=>!0).catch(()=>!1):!1}async read(){if(await this._canUseIndexedDBPromise){const n=await $o(this.app);return n!=null&&n.heartbeats?n:{heartbeats:[]}}else return{heartbeats:[]}}async overwrite(t){var n;if(await this._canUseIndexedDBPromise){const s=await this.read();return kt(this.app,{lastSentHeartbeatDate:(n=t.lastSentHeartbeatDate)!==null&&n!==void 0?n:s.lastSentHeartbeatDate,heartbeats:t.heartbeats})}else return}async add(t){var n;if(await this._canUseIndexedDBPromise){const s=await this.read();return kt(this.app,{lastSentHeartbeatDate:(n=t.lastSentHeartbeatDate)!==null&&n!==void 0?n:s.lastSentHeartbeatDate,heartbeats:[...s.heartbeats,...t.heartbeats]})}else return}}function Pt(e){return gn(JSON.stringify({version:2,heartbeats:e})).length}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ko(e){z(new M("platform-logger",t=>new so(t),"PRIVATE")),z(new M("heartbeat",t=>new qo(t),"PRIVATE")),L(ze,Ct,e),L(ze,Ct,"esm2017"),L("fire-js","")}Ko("");var Wo="firebase",Jo="11.1.0";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */L(Wo,Jo,"app");const In="@firebase/installations",nt="0.6.11";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const On=1e4,Rn=`w:${nt}`,vn="FIS_v2",Go="https://firebaseinstallations.googleapis.com/v1",Xo=60*60*1e3,Yo="installations",Qo="Installations";/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Zo={"missing-app-config-values":'Missing App configuration value: "{$valueName}"',"not-registered":"Firebase Installation is not registered.","installation-not-found":"Firebase Installation not found.","request-failed":'{$requestName} request failed with error "{$serverCode} {$serverStatus}: {$serverMessage}"',"app-offline":"Could not process request. Application offline.","delete-pending-registration":"Can't delete installation while there is a pending registration request."},K=new we(Yo,Qo,Zo);function Cn(e){return e instanceof X&&e.code.includes("request-failed")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Dn({projectId:e}){return`${Go}/projects/${e}/installations`}function kn(e){return{token:e.token,requestStatus:2,expiresIn:ti(e.expiresIn),creationTime:Date.now()}}async function Nn(e,t){const r=(await t.json()).error;return K.create("request-failed",{requestName:e,serverCode:r.code,serverMessage:r.message,serverStatus:r.status})}function Pn({apiKey:e}){return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e})}function ei(e,{refreshToken:t}){const n=Pn(e);return n.append("Authorization",ni(t)),n}async function Bn(e){const t=await e();return t.status>=500&&t.status<600?e():t}function ti(e){return Number(e.replace("s","000"))}function ni(e){return`${vn} ${e}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ri({appConfig:e,heartbeatServiceProvider:t},{fid:n}){const r=Dn(e),s=Pn(e),o=t.getImmediate({optional:!0});if(o){const u=await o.getHeartbeatsHeader();u&&s.append("x-firebase-client",u)}const i={fid:n,authVersion:vn,appId:e.appId,sdkVersion:Rn},a={method:"POST",headers:s,body:JSON.stringify(i)},f=await Bn(()=>fetch(r,a));if(f.ok){const u=await f.json();return{fid:u.fid||n,registrationStatus:2,refreshToken:u.refreshToken,authToken:kn(u.authToken)}}else throw await Nn("Create Installation",f)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function xn(e){return new Promise(t=>{setTimeout(t,e)})}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function si(e){return btoa(String.fromCharCode(...e)).replace(/\+/g,"-").replace(/\//g,"_")}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const oi=/^[cdef][\w-]{21}$/,Je="";function ii(){try{const e=new Uint8Array(17);(self.crypto||self.msCrypto).getRandomValues(e),e[0]=112+e[0]%16;const n=ai(e);return oi.test(n)?n:Je}catch{return Je}}function ai(e){return si(e).substr(0,22)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ee(e){return`${e.appName}!${e.appId}`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Fn=new Map;function Ln(e,t){const n=Ee(e);Mn(n,t),ci(n,t)}function Mn(e,t){const n=Fn.get(e);if(n)for(const r of n)r(t)}function ci(e,t){const n=ui();n&&n.postMessage({key:e,fid:t}),li()}let U=null;function ui(){return!U&&"BroadcastChannel"in self&&(U=new BroadcastChannel("[Firebase] FID Change"),U.onmessage=e=>{Mn(e.data.key,e.data.fid)}),U}function li(){Fn.size===0&&U&&(U.close(),U=null)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const fi="firebase-installations-database",di=1,W="firebase-installations-store";let ke=null;function rt(){return ke||(ke=ye(fi,di,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(W)}}})),ke}async function fe(e,t){const n=Ee(e),s=(await rt()).transaction(W,"readwrite"),o=s.objectStore(W),i=await o.get(n);return await o.put(t,n),await s.done,(!i||i.fid!==t.fid)&&Ln(e,t.fid),t}async function jn(e){const t=Ee(e),r=(await rt()).transaction(W,"readwrite");await r.objectStore(W).delete(t),await r.done}async function Se(e,t){const n=Ee(e),s=(await rt()).transaction(W,"readwrite"),o=s.objectStore(W),i=await o.get(n),a=t(i);return a===void 0?await o.delete(n):await o.put(a,n),await s.done,a&&(!i||i.fid!==a.fid)&&Ln(e,a.fid),a}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function st(e){let t;const n=await Se(e.appConfig,r=>{const s=hi(r),o=pi(e,s);return t=o.registrationPromise,o.installationEntry});return n.fid===Je?{installationEntry:await t}:{installationEntry:n,registrationPromise:t}}function hi(e){const t=e||{fid:ii(),registrationStatus:0};return $n(t)}function pi(e,t){if(t.registrationStatus===0){if(!navigator.onLine){const s=Promise.reject(K.create("app-offline"));return{installationEntry:t,registrationPromise:s}}const n={fid:t.fid,registrationStatus:1,registrationTime:Date.now()},r=mi(e,n);return{installationEntry:n,registrationPromise:r}}else return t.registrationStatus===1?{installationEntry:t,registrationPromise:gi(e)}:{installationEntry:t}}async function mi(e,t){try{const n=await ri(e,t);return fe(e.appConfig,n)}catch(n){throw Cn(n)&&n.customData.serverCode===409?await jn(e.appConfig):await fe(e.appConfig,{fid:t.fid,registrationStatus:0}),n}}async function gi(e){let t=await Bt(e.appConfig);for(;t.registrationStatus===1;)await xn(100),t=await Bt(e.appConfig);if(t.registrationStatus===0){const{installationEntry:n,registrationPromise:r}=await st(e);return r||n}return t}function Bt(e){return Se(e,t=>{if(!t)throw K.create("installation-not-found");return $n(t)})}function $n(e){return bi(e)?{fid:e.fid,registrationStatus:0}:e}function bi(e){return e.registrationStatus===1&&e.registrationTime+On<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function wi({appConfig:e,heartbeatServiceProvider:t},n){const r=yi(e,n),s=ei(e,n),o=t.getImmediate({optional:!0});if(o){const u=await o.getHeartbeatsHeader();u&&s.append("x-firebase-client",u)}const i={installation:{sdkVersion:Rn,appId:e.appId}},a={method:"POST",headers:s,body:JSON.stringify(i)},f=await Bn(()=>fetch(r,a));if(f.ok){const u=await f.json();return kn(u)}else throw await Nn("Generate Auth Token",f)}function yi(e,{fid:t}){return`${Dn(e)}/${t}/authTokens:generate`}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ot(e,t=!1){let n;const r=await Se(e.appConfig,o=>{if(!Hn(o))throw K.create("not-registered");const i=o.authToken;if(!t&&Ti(i))return o;if(i.requestStatus===1)return n=Ei(e,t),o;{if(!navigator.onLine)throw K.create("app-offline");const a=_i(o);return n=Si(e,a),a}});return n?await n:r.authToken}async function Ei(e,t){let n=await xt(e.appConfig);for(;n.authToken.requestStatus===1;)await xn(100),n=await xt(e.appConfig);const r=n.authToken;return r.requestStatus===0?ot(e,t):r}function xt(e){return Se(e,t=>{if(!Hn(t))throw K.create("not-registered");const n=t.authToken;return Ii(n)?Object.assign(Object.assign({},t),{authToken:{requestStatus:0}}):t})}async function Si(e,t){try{const n=await wi(e,t),r=Object.assign(Object.assign({},t),{authToken:n});return await fe(e.appConfig,r),n}catch(n){if(Cn(n)&&(n.customData.serverCode===401||n.customData.serverCode===404))await jn(e.appConfig);else{const r=Object.assign(Object.assign({},t),{authToken:{requestStatus:0}});await fe(e.appConfig,r)}throw n}}function Hn(e){return e!==void 0&&e.registrationStatus===2}function Ti(e){return e.requestStatus===2&&!Ai(e)}function Ai(e){const t=Date.now();return t<e.creationTime||e.creationTime+e.expiresIn<t+Xo}function _i(e){const t={requestStatus:1,requestTime:Date.now()};return Object.assign(Object.assign({},e),{authToken:t})}function Ii(e){return e.requestStatus===1&&e.requestTime+On<Date.now()}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Oi(e){const t=e,{installationEntry:n,registrationPromise:r}=await st(t);return r?r.catch(console.error):ot(t).catch(console.error),n.fid}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ri(e,t=!1){const n=e;return await vi(n),(await ot(n,t)).token}async function vi(e){const{registrationPromise:t}=await st(e);t&&await t}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ci(e){if(!e||!e.options)throw Ne("App Configuration");if(!e.name)throw Ne("App Name");const t=["projectId","apiKey","appId"];for(const n of t)if(!e.options[n])throw Ne(n);return{appName:e.name,projectId:e.options.projectId,apiKey:e.options.apiKey,appId:e.options.appId}}function Ne(e){return K.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Un="installations",Di="installations-internal",ki=e=>{const t=e.getProvider("app").getImmediate(),n=Ci(t),r=tt(t,"heartbeat");return{app:t,appConfig:n,heartbeatServiceProvider:r,_delete:()=>Promise.resolve()}},Ni=e=>{const t=e.getProvider("app").getImmediate(),n=tt(t,Un).getImmediate();return{getId:()=>Oi(n),getToken:s=>Ri(n,s)}};function Pi(){z(new M(Un,ki,"PUBLIC")),z(new M(Di,Ni,"PRIVATE"))}Pi();L(In,nt);L(In,nt,"esm2017");/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Bi="/firebase-messaging-sw.js",xi="/firebase-cloud-messaging-push-scope",qn="BDOU99-h67HcA6JeFXHbSNMu7e2yNNu3RzoMj8TM4W88jITfq7ZmPvIM1Iv-4_l2LxQcYwhqby2xGpWwzjfAnG4",Fi="https://fcmregistrations.googleapis.com/v1",Vn="google.c.a.c_id",Li="google.c.a.c_l",Mi="google.c.a.ts",ji="google.c.a.e",Ft=1e4;var Lt;(function(e){e[e.DATA_MESSAGE=1]="DATA_MESSAGE",e[e.DISPLAY_NOTIFICATION=3]="DISPLAY_NOTIFICATION"})(Lt||(Lt={}));/**
 * @license
 * Copyright 2018 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under the License
 * is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
 * or implied. See the License for the specific language governing permissions and limitations under
 * the License.
 */var ee;(function(e){e.PUSH_RECEIVED="push-received",e.NOTIFICATION_CLICKED="notification-clicked"})(ee||(ee={}));/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function N(e){const t=new Uint8Array(e);return btoa(String.fromCharCode(...t)).replace(/=/g,"").replace(/\+/g,"-").replace(/\//g,"_")}function $i(e){const t="=".repeat((4-e.length%4)%4),n=(e+t).replace(/\-/g,"+").replace(/_/g,"/"),r=atob(n),s=new Uint8Array(r.length);for(let o=0;o<r.length;++o)s[o]=r.charCodeAt(o);return s}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Pe="fcm_token_details_db",Hi=5,Mt="fcm_token_object_Store";async function Ui(e){if("databases"in indexedDB&&!(await indexedDB.databases()).map(o=>o.name).includes(Pe))return null;let t=null;return(await ye(Pe,Hi,{upgrade:async(r,s,o,i)=>{var a;if(s<2||!r.objectStoreNames.contains(Mt))return;const f=i.objectStore(Mt),u=await f.index("fcmSenderId").get(e);if(await f.clear(),!!u){if(s===2){const l=u;if(!l.auth||!l.p256dh||!l.endpoint)return;t={token:l.fcmToken,createTime:(a=l.createTime)!==null&&a!==void 0?a:Date.now(),subscriptionOptions:{auth:l.auth,p256dh:l.p256dh,endpoint:l.endpoint,swScope:l.swScope,vapidKey:typeof l.vapidKey=="string"?l.vapidKey:N(l.vapidKey)}}}else if(s===3){const l=u;t={token:l.fcmToken,createTime:l.createTime,subscriptionOptions:{auth:N(l.auth),p256dh:N(l.p256dh),endpoint:l.endpoint,swScope:l.swScope,vapidKey:N(l.vapidKey)}}}else if(s===4){const l=u;t={token:l.fcmToken,createTime:l.createTime,subscriptionOptions:{auth:N(l.auth),p256dh:N(l.p256dh),endpoint:l.endpoint,swScope:l.swScope,vapidKey:N(l.vapidKey)}}}}}})).close(),await ve(Pe),await ve("fcm_vapid_details_db"),await ve("undefined"),qi(t)?t:null}function qi(e){if(!e||!e.subscriptionOptions)return!1;const{subscriptionOptions:t}=e;return typeof e.createTime=="number"&&e.createTime>0&&typeof e.token=="string"&&e.token.length>0&&typeof t.auth=="string"&&t.auth.length>0&&typeof t.p256dh=="string"&&t.p256dh.length>0&&typeof t.endpoint=="string"&&t.endpoint.length>0&&typeof t.swScope=="string"&&t.swScope.length>0&&typeof t.vapidKey=="string"&&t.vapidKey.length>0}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Vi="firebase-messaging-database",zi=1,te="firebase-messaging-store";let Be=null;function zn(){return Be||(Be=ye(Vi,zi,{upgrade:(e,t)=>{switch(t){case 0:e.createObjectStore(te)}}})),Be}async function Ki(e){const t=Kn(e),r=await(await zn()).transaction(te).objectStore(te).get(t);if(r)return r;{const s=await Ui(e.appConfig.senderId);if(s)return await it(e,s),s}}async function it(e,t){const n=Kn(e),s=(await zn()).transaction(te,"readwrite");return await s.objectStore(te).put(t,n),await s.done,t}function Kn({appConfig:e}){return e.appId}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Wi={"missing-app-config-values":'Missing App configuration value: "{$valueName}"',"only-available-in-window":"This method is available in a Window context.","only-available-in-sw":"This method is available in a service worker context.","permission-default":"The notification permission was not granted and dismissed instead.","permission-blocked":"The notification permission was not granted and blocked instead.","unsupported-browser":"This browser doesn't support the API's required to use the Firebase SDK.","indexed-db-unsupported":"This browser doesn't support indexedDb.open() (ex. Safari iFrame, Firefox Private Browsing, etc)","failed-service-worker-registration":"We are unable to register the default service worker. {$browserErrorMessage}","token-subscribe-failed":"A problem occurred while subscribing the user to FCM: {$errorInfo}","token-subscribe-no-token":"FCM returned no token when subscribing the user to push.","token-unsubscribe-failed":"A problem occurred while unsubscribing the user from FCM: {$errorInfo}","token-update-failed":"A problem occurred while updating the user from FCM: {$errorInfo}","token-update-no-token":"FCM returned no token when updating the user to push.","use-sw-after-get-token":"The useServiceWorker() method may only be called once and must be called before calling getToken() to ensure your service worker is used.","invalid-sw-registration":"The input to useServiceWorker() must be a ServiceWorkerRegistration.","invalid-bg-handler":"The input to setBackgroundMessageHandler() must be a function.","invalid-vapid-key":"The public VAPID key must be a string.","use-vapid-key-after-get-token":"The usePublicVapidKey() method may only be called once and must be called before calling getToken() to ensure your VAPID key is used."},I=new we("messaging","Messaging",Wi);/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Ji(e,t){const n=await ct(e),r=Wn(t),s={method:"POST",headers:n,body:JSON.stringify(r)};let o;try{o=await(await fetch(at(e.appConfig),s)).json()}catch(i){throw I.create("token-subscribe-failed",{errorInfo:i==null?void 0:i.toString()})}if(o.error){const i=o.error.message;throw I.create("token-subscribe-failed",{errorInfo:i})}if(!o.token)throw I.create("token-subscribe-no-token");return o.token}async function Gi(e,t){const n=await ct(e),r=Wn(t.subscriptionOptions),s={method:"PATCH",headers:n,body:JSON.stringify(r)};let o;try{o=await(await fetch(`${at(e.appConfig)}/${t.token}`,s)).json()}catch(i){throw I.create("token-update-failed",{errorInfo:i==null?void 0:i.toString()})}if(o.error){const i=o.error.message;throw I.create("token-update-failed",{errorInfo:i})}if(!o.token)throw I.create("token-update-no-token");return o.token}async function Xi(e,t){const r={method:"DELETE",headers:await ct(e)};try{const o=await(await fetch(`${at(e.appConfig)}/${t}`,r)).json();if(o.error){const i=o.error.message;throw I.create("token-unsubscribe-failed",{errorInfo:i})}}catch(s){throw I.create("token-unsubscribe-failed",{errorInfo:s==null?void 0:s.toString()})}}function at({projectId:e}){return`${Fi}/projects/${e}/registrations`}async function ct({appConfig:e,installations:t}){const n=await t.getToken();return new Headers({"Content-Type":"application/json",Accept:"application/json","x-goog-api-key":e.apiKey,"x-goog-firebase-installations-auth":`FIS ${n}`})}function Wn({p256dh:e,auth:t,endpoint:n,vapidKey:r}){const s={web:{endpoint:n,auth:t,p256dh:e}};return r!==qn&&(s.web.applicationPubKey=r),s}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const Yi=7*24*60*60*1e3;async function Qi(e){const t=await ea(e.swRegistration,e.vapidKey),n={vapidKey:e.vapidKey,swScope:e.swRegistration.scope,endpoint:t.endpoint,auth:N(t.getKey("auth")),p256dh:N(t.getKey("p256dh"))},r=await Ki(e.firebaseDependencies);if(r){if(ta(r.subscriptionOptions,n))return Date.now()>=r.createTime+Yi?Zi(e,{token:r.token,createTime:Date.now(),subscriptionOptions:n}):r.token;try{await Xi(e.firebaseDependencies,r.token)}catch(s){console.warn(s)}return jt(e.firebaseDependencies,n)}else return jt(e.firebaseDependencies,n)}async function Zi(e,t){try{const n=await Gi(e.firebaseDependencies,t),r=Object.assign(Object.assign({},t),{token:n,createTime:Date.now()});return await it(e.firebaseDependencies,r),n}catch(n){throw n}}async function jt(e,t){const r={token:await Ji(e,t),createTime:Date.now(),subscriptionOptions:t};return await it(e,r),r.token}async function ea(e,t){const n=await e.pushManager.getSubscription();return n||e.pushManager.subscribe({userVisibleOnly:!0,applicationServerKey:$i(t)})}function ta(e,t){const n=t.vapidKey===e.vapidKey,r=t.endpoint===e.endpoint,s=t.auth===e.auth,o=t.p256dh===e.p256dh;return n&&r&&s&&o}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function $t(e){const t={from:e.from,collapseKey:e.collapse_key,messageId:e.fcmMessageId};return na(t,e),ra(t,e),sa(t,e),t}function na(e,t){if(!t.notification)return;e.notification={};const n=t.notification.title;n&&(e.notification.title=n);const r=t.notification.body;r&&(e.notification.body=r);const s=t.notification.image;s&&(e.notification.image=s);const o=t.notification.icon;o&&(e.notification.icon=o)}function ra(e,t){t.data&&(e.data=t.data)}function sa(e,t){var n,r,s,o,i;if(!t.fcmOptions&&!(!((n=t.notification)===null||n===void 0)&&n.click_action))return;e.fcmOptions={};const a=(s=(r=t.fcmOptions)===null||r===void 0?void 0:r.link)!==null&&s!==void 0?s:(o=t.notification)===null||o===void 0?void 0:o.click_action;a&&(e.fcmOptions.link=a);const f=(i=t.fcmOptions)===null||i===void 0?void 0:i.analytics_label;f&&(e.fcmOptions.analyticsLabel=f)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function oa(e){return typeof e=="object"&&!!e&&Vn in e}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ia(e){if(!e||!e.options)throw xe("App Configuration Object");if(!e.name)throw xe("App Name");const t=["projectId","apiKey","appId","messagingSenderId"],{options:n}=e;for(const r of t)if(!n[r])throw xe(r);return{appName:e.name,projectId:n.projectId,apiKey:n.apiKey,appId:n.appId,senderId:n.messagingSenderId}}function xe(e){return I.create("missing-app-config-values",{valueName:e})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */class aa{constructor(t,n,r){this.deliveryMetricsExportedToBigQueryEnabled=!1,this.onBackgroundMessageHandler=null,this.onMessageHandler=null,this.logEvents=[],this.isLogServiceStarted=!1;const s=ia(t);this.firebaseDependencies={app:t,appConfig:s,installations:n,analyticsProvider:r}}_delete(){return Promise.resolve()}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function ca(e){try{e.swRegistration=await navigator.serviceWorker.register(Bi,{scope:xi}),e.swRegistration.update().catch(()=>{}),await ua(e.swRegistration)}catch(t){throw I.create("failed-service-worker-registration",{browserErrorMessage:t==null?void 0:t.message})}}async function ua(e){return new Promise((t,n)=>{const r=setTimeout(()=>n(new Error(`Service worker not registered after ${Ft} ms`)),Ft),s=e.installing||e.waiting;e.active?(clearTimeout(r),t()):s?s.onstatechange=o=>{var i;((i=o.target)===null||i===void 0?void 0:i.state)==="activated"&&(s.onstatechange=null,clearTimeout(r),t())}:(clearTimeout(r),n(new Error("No incoming service worker found.")))})}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function la(e,t){if(!t&&!e.swRegistration&&await ca(e),!(!t&&e.swRegistration)){if(!(t instanceof ServiceWorkerRegistration))throw I.create("invalid-sw-registration");e.swRegistration=t}}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function fa(e,t){t?e.vapidKey=t:e.vapidKey||(e.vapidKey=qn)}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function Jn(e,t){if(!navigator)throw I.create("only-available-in-window");if(Notification.permission==="default"&&await Notification.requestPermission(),Notification.permission!=="granted")throw I.create("permission-blocked");return await fa(e,t==null?void 0:t.vapidKey),await la(e,t==null?void 0:t.serviceWorkerRegistration),Qi(e)}/**
 * @license
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function da(e,t,n){const r=ha(t);(await e.firebaseDependencies.analyticsProvider.get()).logEvent(r,{message_id:n[Vn],message_name:n[Li],message_time:n[Mi],message_device_time:Math.floor(Date.now()/1e3)})}function ha(e){switch(e){case ee.NOTIFICATION_CLICKED:return"notification_open";case ee.PUSH_RECEIVED:return"notification_foreground";default:throw new Error}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function pa(e,t){const n=t.data;if(!n.isFirebaseMessaging)return;e.onMessageHandler&&n.messageType===ee.PUSH_RECEIVED&&(typeof e.onMessageHandler=="function"?e.onMessageHandler($t(n)):e.onMessageHandler.next($t(n)));const r=n.data;oa(r)&&r[ji]==="1"&&await da(e,n.messageType,r)}const Ht="@firebase/messaging",Ut="0.12.15";/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */const ma=e=>{const t=new aa(e.getProvider("app").getImmediate(),e.getProvider("installations-internal").getImmediate(),e.getProvider("analytics-internal"));return navigator.serviceWorker.addEventListener("message",n=>pa(t,n)),t},ga=e=>{const t=e.getProvider("messaging").getImmediate();return{getToken:r=>Jn(t,r)}};function ba(){z(new M("messaging",ma,"PUBLIC")),z(new M("messaging-internal",ga,"PRIVATE")),L(Ht,Ut),L(Ht,Ut,"esm2017")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */async function wa(){try{await yn()}catch{return!1}return typeof window<"u"&&wn()&&xs()&&"serviceWorker"in navigator&&"PushManager"in window&&"Notification"in window&&"fetch"in window&&ServiceWorkerRegistration.prototype.hasOwnProperty("showNotification")&&PushSubscription.prototype.hasOwnProperty("getKey")}/**
 * @license
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function ya(e,t){if(!navigator)throw I.create("only-available-in-window");return e.onMessageHandler=t,()=>{e.onMessageHandler=null}}/**
 * @license
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */function Ea(e=Lo()){return wa().then(t=>{if(!t)throw I.create("unsupported-browser")},t=>{throw I.create("indexed-db-unsupported")}),tt(Ze(e),"messaging").getImmediate()}async function Sa(e,t){return e=Ze(e),Jn(e,t)}function Ta(e,t){return e=Ze(e),ya(e,t)}ba();const Aa={apiKey:"AIzaSyC5YfSaBGQ4wNpKA82IOBtV1Q2-juAr8EE",authDomain:"sparklem-management.firebaseapp.com",projectId:"sparklem-management",storageBucket:"sparklem-management.firebasestorage.app",messagingSenderId:"858863366626",appId:"1:858863366626:web:4073a2909f2038ac4949bb",measurementId:"G-SGC8YBNVCS"},_a=Tn(Aa),Gn=Ea(_a);function Ia(){var e=new Audio("/happy-bell-notification.wav");console.log(e),e.play()}const Oa=()=>({deviceToken:"",notificationPermission:!1,init(){this.requestPermission()},requestPermission(){"Notification"in window?Notification.requestPermission().then(e=>{e==="granted"?(this.notificationPermission=!0,this.getToken()):console.log(e==="denied"?"Notification permission denied.":"Notification permission request was dismissed.")}):console.log("This browser does not support notifications.")},async getToken(){try{const t=await Sa(Gn,{vapidKey:"BAG3h0uJp2_kakuaD4Qkg1fFIwD2-Ehd9485cz5Vhiw-QT_OvmzjIXKLSiIaqx5l-V1ak6_9he9peF9CQJuKjN0"});t?(this.deviceToken=t,this.$refs.token.value=this.deviceToken,this.$refs.token.dispatchEvent(new Event("input")),console.log("Device Token:",this.deviceToken)):console.warn("No registration token available. Request permission to generate one.")}catch(e){console.error("An error occurred while retrieving token:",e)}}});window.firebaseHandler=Oa;Ta(Gn,e=>{console.log("Message received: ",e),Livewire.dispatch("notification-received"),Ia()});"serviceWorker"in navigator&&navigator.serviceWorker.register("/firebase-messaging-sw.js").then(e=>{console.log("Service Worker registered successfully with scope:",e.scope)}).catch(e=>{console.error("Service Worker registration failed:",e)});
