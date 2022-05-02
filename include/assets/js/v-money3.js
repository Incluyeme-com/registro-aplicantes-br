var X=Object.defineProperty;var Y=(l,a,g)=>a in l?X(l,a,{enumerable:!0,configurable:!0,writable:!0,value:g}):l[a]=g;var R=(l,a,g)=>(Y(l,typeof a!="symbol"?a+"":a,g),g);(function(l,a){typeof exports=="object"&&typeof module!="undefined"?a(exports,require("vue")):typeof define=="function"&&define.amd?define(["exports","vue"],a):(l=typeof globalThis!="undefined"?globalThis:l||self,a(l["v-money3"]={},l.Vue))})(this,function(l,a){"use strict";const g=["+","-"],E=["decimal","thousands","prefix","suffix"];function m(t){return Math.max(0,Math.min(t,1e3))}function w(t,e){return t=t.padStart(e+1,"0"),e===0?t:`${t.slice(0,-e)}.${t.slice(-e)}`}function V(t){return t=t?t.toString():"",t.replace(/\D+/g,"")||"0"}function q(t,e){return t.replace(/(\d)(?=(?:\d{3})+\b)/gm,`$1${e}`)}function U(t,e,n){return e?t+n+e:t}function y(t,e){return g.includes(t)?(console.warn(`v-money3 "${e}" property don't accept "${t}" as a value.`),!1):/\d/g.test(t)?(console.warn(`v-money3 "${e}" property don't accept "${t}" (any number) as a value.`),!1):!0}function L(t){for(const e of E)if(!y(t[e],e))return!1;return!0}function S(t){for(const e of E){t[e]=t[e].replace(/\d+/g,"");for(const n of g)t[e]=t[e].replaceAll(n,"")}return t}function $(t){const e=t.length,n=t.indexOf(".");return e-(n+1)}function O(t){return t.replace(/^(-?)0+(?!\.)(.+)/,"$1$2")}function F(t){return/^-?[\d]+$/g.test(t)}function I(t){return/^-?[\d]+(\.[\d]+)$/g.test(t)}function D(t,e,n){return e>t.length-1?t:t.substring(0,e)+n+t.substring(e+1)}function A(t,e){const n=e-$(t);if(n>=0)return t;let i=t.slice(0,n);const u=t.slice(n);if(i.charAt(i.length-1)==="."&&(i=i.slice(0,-1)),parseInt(u.charAt(0),10)>=5){for(let s=i.length-1;s>=0;s-=1){const o=i.charAt(s);if(o!=="."&&o!=="-"){const c=parseInt(o,10)+1;if(c<10)return D(i,s,c);i=D(i,s,"0")}}return`1${i}`}return i}function H(t,e){const n=()=>{t.setSelectionRange(e,e)};t===document.activeElement&&(n(),setTimeout(n,1))}function P(t){return new Event(t,{bubbles:!0,cancelable:!1})}function r({debug:t=!1},...e){t&&console.log(...e)}var d={debug:!1,masked:!1,prefix:"",suffix:"",thousands:",",decimal:".",precision:2,disableNegative:!1,disabled:!1,min:null,max:null,allowBlank:!1,minimumNumberOfCharacters:0,modelModifiers:{number:!1},shouldRound:!0};class N{constructor(e){R(this,"number",0n);R(this,"decimal",0);this.setNumber(e)}getNumber(){return this.number}getDecimalPrecision(){return this.decimal}setNumber(e){this.decimal=0,typeof e=="bigint"?this.number=e:typeof e=="number"?this.setupString(e.toString()):this.setupString(e)}toFixed(e=0,n=!0){let i=this.toString();const u=e-this.getDecimalPrecision();return u>0?(i.includes(".")||(i+="."),i.padEnd(i.length+u,"0")):u<0?n?A(i,e):i.slice(0,u):i}toString(){let e=this.number.toString();if(this.decimal){let n=!1;return e.charAt(0)==="-"&&(e=e.substring(1),n=!0),e=e.padStart(e.length+this.decimal,"0"),e=`${e.slice(0,-this.decimal)}.${e.slice(-this.decimal)}`,e=O(e),(n?"-":"")+e}return e}lessThan(e){const[n,i]=this.adjustComparisonNumbers(e);return n<i}biggerThan(e){const[n,i]=this.adjustComparisonNumbers(e);return n>i}isEqual(e){const[n,i]=this.adjustComparisonNumbers(e);return n===i}setupString(e){if(e=O(e),F(e))this.number=BigInt(e);else if(I(e))this.decimal=$(e),this.number=BigInt(e.replace(".",""));else throw new Error(`BigNumber has received and invalid format for the constructor: ${e}`)}adjustComparisonNumbers(e){let n;e.constructor.name!=="BigNumber"?n=new N(e):n=e;const i=this.getDecimalPrecision()-n.getDecimalPrecision();let u=this.getNumber(),s=n.getNumber();return i>0?s=n.getNumber()*10n**BigInt(i):i<0&&(u=this.getNumber()*10n**BigInt(i*-1)),[u,s]}}function k(t,e=d,n=""){r(e,"utils format() - caller",n),r(e,"utils format() - input1",t),t==null?t="":typeof t=="number"?e.shouldRound?t=t.toFixed(m(e.precision)):t=t.toFixed(m(e.precision)+1).slice(0,-1):e.modelModifiers&&e.modelModifiers.number&&F(t)&&(t=Number(t).toFixed(m(e.precision))),r(e,"utils format() - input2",t);const i=e.disableNegative?"":t.indexOf("-")>=0?"-":"";let u=t.replace(e.prefix,"").replace(e.suffix,"");r(e,"utils format() - filtered",u),!e.precision&&e.thousands!=="."&&I(u)&&(u=A(u,0),r(e,"utils format() - !opt.precision && isValidFloat()",u));const s=V(u);r(e,"utils format() - numbers",s),r(e,"utils format() - numbersToCurrency",i+w(s,e.precision));const o=new N(i+w(s,e.precision));r(e,"utils format() - bigNumber1",o.toString()),e.max&&o.biggerThan(e.max)&&o.setNumber(e.max),e.min&&o.lessThan(e.min)&&o.setNumber(e.min);const c=o.toFixed(m(e.precision),e.shouldRound);if(r(e,"utils format() - bigNumber2",o.toFixed(m(e.precision))),/^0(\.0+)?$/g.test(c)&&e.allowBlank)return"";let[h,v]=c.split(".");const M=v!==void 0?v.length:0;h=h.padStart(e.minimumNumberOfCharacters-M,"0"),h=q(h,e.thousands);const x=e.prefix+U(h,v,e.decimal)+e.suffix;return r(e,"utils format() - output",x),x}function B(t,e=d,n=""){r(e,"utils unformat() - caller",n),r(e,"utils unformat() - input",t);const i=e.disableNegative?"":t.indexOf("-")>=0?"-":"",u=t.replace(e.prefix,"").replace(e.suffix,"");r(e,"utils unformat() - filtered",u);const s=V(u);r(e,"utils unformat() - numbers",s);const o=new N(i+w(s,e.precision));r(e,"utils unformat() - bigNumber1",s.toString()),e.max&&o.biggerThan(e.max)&&o.setNumber(e.max),e.min&&o.lessThan(e.min)&&o.setNumber(e.min);let c=o.toFixed(m(e.precision),e.shouldRound);return e.modelModifiers&&e.modelModifiers.number&&(c=parseFloat(c)),r(e,"utils unformat() - output",c),c}const C=(t,e,n)=>{if(r(e,"directive setValue() - caller",n),!L(e)){r(e,"directive setValue() - validateRestrictedOptions() return false. Stopping here...",t.value);return}let i=t.value.length-(t.selectionEnd||0);t.value=k(t.value,e,n),i=Math.max(i,e.suffix.length),i=t.value.length-i,i=Math.max(i,e.prefix.length),H(t,i),t.dispatchEvent(P("change"))},_=(t,e)=>{const n=t.currentTarget,i=t.code==="Backspace"||t.code==="Delete",u=n.value.length-(n.selectionEnd||0)==0;if(r(e,"directive onkeydown() - el.value",n.value),r(e,"directive onkeydown() - backspacePressed",i),r(e,"directive onkeydown() - isAtEndPosition",u),e.allowBlank&&i&&u&&B(n.value,e,"directive onkeydown allowBlank")===0&&(r(e,'directive onkeydown() - set el.value = ""',n.value),n.value="",n.dispatchEvent(P("change"))),r(e,"directive onkeydown() - e.key",t.key),t.key==="+"){r(e,"directive onkeydown() - unformat el.value",n.value);let s=B(n.value,e,"directive onkeydown +");typeof s=="string"&&(s=parseFloat(s)),s<0&&(n.value=String(s*-1))}},j=(t,e)=>{const n=t.currentTarget;r(e,"directive oninput()",n.value),/^[1-9]$/.test(n.value)&&(n.value=w(n.value,m(e.precision)),r(e,"directive oninput() - is 1-9",n.value)),C(n,e,"directive oninput")};var p={mounted(t,e){if(!e.value)return;const n=S({...d,...e.value});if(r(n,"directive mounted() - opt",n),t.tagName.toLocaleUpperCase()!=="INPUT"){const i=t.getElementsByTagName("input");i.length!==1||(t=i[0])}t.onkeydown=i=>{_(i,n)},t.oninput=i=>{j(i,n)},r(n,"directive mounted() - el.value",t.value),C(t,n,"directive mounted")},updated(t,e){if(!e.value)return;const n=S({...d,...e.value});t.onkeydown=i=>{_(i,n)},t.oninput=i=>{j(i,n)},r(n,"directive updated() - el.value",t.value),r(n,"directive updated() - opt",n),C(t,n,"directive updated")},beforeUnmount(t){t.onkeydown=null,t.oninput=null,t.onfocus=null}};const K=["id","value","disabled"],W={inheritAttrs:!1,name:"Money3",directives:{money3:p}},T=a.defineComponent({...W,props:{debug:{required:!1,type:Boolean,default:!1},id:{required:!1,type:[Number,String],default:()=>{const t=a.getCurrentInstance();return t?t.uid:null}},modelValue:{required:!0,type:[Number,String]},modelModifiers:{required:!1,type:Object,default:()=>({number:!1})},masked:{type:Boolean,default:!1},precision:{type:Number,default:()=>d.precision},decimal:{type:String,default:()=>d.decimal,validator(t){return y(t,"decimal")}},thousands:{type:String,default:()=>d.thousands,validator(t){return y(t,"thousands")}},prefix:{type:String,default:()=>d.prefix,validator(t){return y(t,"prefix")}},suffix:{type:String,default:()=>d.suffix,validator(t){return y(t,"suffix")}},disableNegative:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},max:{type:[Number,String],default:()=>d.max},min:{type:[Number,String],default:()=>d.min},allowBlank:{type:Boolean,default:()=>d.allowBlank},minimumNumberOfCharacters:{type:Number,default:()=>d.minimumNumberOfCharacters},shouldRound:{type:Boolean,default:()=>d.shouldRound}},emits:["update:model-value"],setup(t,{emit:e}){const n=t,{modelValue:i,modelModifiers:u,masked:s,precision:o,shouldRound:c}=a.toRefs(n);r(n,"component setup()",n);let h=i.value;u.value&&u.value.number&&(c.value?h=Number(i.value).toFixed(m(o.value)):h=Number(i.value).toFixed(m(o.value)+1).slice(0,-1));const v=a.ref(k(h,n,"component setup"));r(n,"component setup() - data.formattedValue",v.value),a.watch(i,M);function M(b){r(n,"component watch() -> value",b);const f=k(b,S({...n}),"component watch");f!==v.value&&(r(n,"component watch() changed -> formatted",f),v.value=f)}let x=null;function z(b){let f=b.target?.value;r(n,"component change() -> evt.target.value",f),s.value&&!u.value.number||(f=B(f,S({...n}),"component change")),f!==x&&(x=f,r(n,"component change() -> update:model-value",f),e("update:model-value",f))}const G=a.useAttrs(),J=a.computed(()=>{const b={...G};return delete b["onUpdate:modelValue"],b});return(b,f)=>{const Q=a.resolveDirective("money3");return a.withDirectives((a.openBlock(),a.createElementBlock("input",a.mergeProps({id:`${t.id}`},a.unref(J),{type:"tel",class:"v-money3",value:v.value,disabled:n.disabled,onChange:z}),null,16,K)),[[Q,{precision:a.unref(o),decimal:n.decimal,thousands:n.thousands,prefix:n.prefix,suffix:n.suffix,disableNegative:n.disableNegative,min:n.min,max:n.max,allowBlank:n.allowBlank,minimumNumberOfCharacters:n.minimumNumberOfCharacters,debug:n.debug,modelModifiers:a.unref(u),shouldRound:a.unref(c)}]])}}});var Z={install(t){t.component("money3",T),t.directive("money3",p)}};l.BigNumber=N,l.Money=T,l.Money3=T,l.Money3Component=T,l.Money3Directive=p,l.VMoney=p,l.VMoney3=p,l.default=Z,l.format=k,l.unformat=B,Object.defineProperty(l,"__esModule",{value:!0}),l[Symbol.toStringTag]="Module"});