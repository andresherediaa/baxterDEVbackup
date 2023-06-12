!function(){var e={107:function(e,t,n){"use strict";var o=n(307),s=n(444);const i=(0,o.createElement)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,o.createElement)(s.Path,{d:"M6.9 7L3 17.8h1.7l1-2.8h4.1l1 2.8h1.7L8.6 7H6.9zm-.7 6.6l1.5-4.3 1.5 4.3h-3zM21.6 17c-.1.1-.2.2-.3.2-.1.1-.2.1-.4.1s-.3-.1-.4-.2c-.1-.1-.1-.3-.1-.6V12c0-.5 0-1-.1-1.4-.1-.4-.3-.7-.5-1-.2-.2-.5-.4-.9-.5-.4 0-.8-.1-1.3-.1s-1 .1-1.4.2c-.4.1-.7.3-1 .4-.2.2-.4.3-.6.5-.1.2-.2.4-.2.7 0 .3.1.5.2.8.2.2.4.3.8.3.3 0 .6-.1.8-.3.2-.2.3-.4.3-.7 0-.3-.1-.5-.2-.7-.2-.2-.4-.3-.6-.4.2-.2.4-.3.7-.4.3-.1.6-.1.8-.1.3 0 .6 0 .8.1.2.1.4.3.5.5.1.2.2.5.2.9v1.1c0 .3-.1.5-.3.6-.2.2-.5.3-.9.4-.3.1-.7.3-1.1.4-.4.1-.8.3-1.1.5-.3.2-.6.4-.8.7-.2.3-.3.7-.3 1.2 0 .6.2 1.1.5 1.4.3.4.9.5 1.6.5.5 0 1-.1 1.4-.3.4-.2.8-.6 1.1-1.1 0 .4.1.7.3 1 .2.3.6.4 1.2.4.4 0 .7-.1.9-.2.2-.1.5-.3.7-.4h-.3zm-3-.9c-.2.4-.5.7-.8.8-.3.2-.6.2-.8.2-.4 0-.6-.1-.9-.3-.2-.2-.3-.6-.3-1.1 0-.5.1-.9.3-1.2s.5-.5.8-.7c.3-.2.7-.3 1-.5.3-.1.6-.3.7-.6v3.4z"}));t.Z=i},779:function(e,t){var n;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/!function(){"use strict";var o={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var l=s.apply(null,n);l&&e.push(l)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var a in n)o.call(n,a)&&n[a]&&e.push(a);else e.push(n.toString())}}return e.join(" ")}e.exports?(s.default=s,e.exports=s):void 0===(n=function(){return s}.apply(t,[]))||(e.exports=n)}()},318:function(){},682:function(e,t,n){"use strict";n.d(t,{iU:function(){return o},V6:function(){return s},GK:function(){return i},c$:function(){return l},R$:function(){return a},qD:function(){return r},px:function(){return u}});const o="font_base",s="font_base_default",i="font_headings",l="font_headings_default",a="font_pairings",r="font_options",u="blogname"},517:function(e,t,n){"use strict";var o=n(818),s=n(701),i=n.n(s),l=n(819);t.Z=(e,t)=>{i()((()=>{const n={};let s={};const i={};e.forEach((e=>{i[e]=`--${e.replace("_","-")}`}));let a=null;(0,o.subscribe)((()=>{const r=(0,o.select)("core/editor").__unstableIsEditorReady;if(r&&!1===r())return;if(a||(a=document.createElement("style"),document.body.appendChild(a)),e.forEach((e=>{n[e]=t(e)})),(0,l.isEmpty)(n)||(0,l.isEqual)(n,s))return;s={...n};let u="";Object.keys(n).forEach((e=>{u+=`${i[e]}:${n[e]};`})),a.textContent=`.edit-post-visual-editor .editor-styles-wrapper{${u}}`}))}))}},296:function(e,t,n){"use strict";var o=n(307),s=n(609),i=n(736),l=n(630),a=n(779),r=n.n(a),u=n(409);const __=i.__;t.Z=e=>{let{fontPairings:t,fontBase:n,fontHeadings:i,update:a}=e;return(0,o.createElement)(o.Fragment,null,(0,o.createElement)("h3",null,__("Font Pairings","full-site-editing")),t&&i&&n?(0,o.createElement)("div",{className:"style-preview__font-options"},(0,o.createElement)("div",{className:"style-preview__font-options-desktop"},t.map((e=>{let{label:t,headings:u,base:c}=e;const p=u===i&&c===n;return(0,o.createElement)(s.Button,{className:r()("style-preview__font-option",{"is-selected":p}),onClick:()=>a({headings:u,base:c}),onKeyDown:e=>e.keyCode===l.ENTER?a({headings:u,base:c}):null,key:t},(0,o.createElement)("span",{className:"style-preview__font-option-contents"},(0,o.createElement)("span",{style:{fontFamily:u,fontWeight:700}},u)," / ",(0,o.createElement)("span",{style:{fontFamily:c}},c)))})))):(0,o.createElement)(u.Z,{unsupportedFeature:__("font pairings","full-site-editing")}))}},529:function(e,t,n){"use strict";var o=n(307),s=n(609),i=n(736),l=n(409);const __=i.__;t.Z=e=>{let{fontBase:t,fontBaseDefault:n,fontHeadings:i,fontHeadingsDefault:a,fontBaseOptions:r,fontHeadingsOptions:u,updateBaseFont:c,updateHeadingsFont:p}=e;return r&&u?(0,o.createElement)(o.Fragment,null,(0,o.createElement)(s.SelectControl,{label:__("Heading Font","full-site-editing"),value:i,options:u,onChange:e=>p(e),style:{fontFamily:"unset"!==i?i:a}}),(0,o.createElement)(s.SelectControl,{label:__("Base Font","full-site-editing"),value:t,options:r,onChange:e=>c(e),style:{fontFamily:"unset"!==t?t:n}}),(0,o.createElement)("hr",null)):(0,o.createElement)(l.Z,{unsupportedFeature:__("custom font selection","full-site-editing")})}},464:function(e,t,n){"use strict";var o=n(307),s=n(609),i=n(818),l=n(67),a=n(736),r=n(107),u=n(483),c=n(682),p=n(296),f=n(529);const __=a.__,d="ANY_PROPERTY",g=e=>{if("object"==typeof e){const{label:t,value:n,prop:o=d}=e;return{label:t,value:n,prop:o}}return{label:e,value:e,prop:d}},m=e=>null!==e.value&&null!==e.label,h=(e,t)=>e?e.map(g).filter(m).filter((e=>t=>t.prop===d||t.prop===e)(t)):[],y=e=>{let{hasLocalChanges:t,resetAction:n,publishAction:i,className:l=null}=e;return(0,o.createElement)("div",{className:l},(0,o.createElement)(s.Button,{disabled:!t,isDefault:!0,onClick:n},__("Reset","full-site-editing")),(0,o.createElement)(s.Button,{className:"global-styles-sidebar__publish-button",disabled:!t,isPrimary:!0,onClick:i},__("Publish","full-site-editing")))};t.Z=e=>{let{fontHeadings:t,fontHeadingsDefault:n,fontBase:d,fontBaseDefault:g,fontPairings:m,fontOptions:O,siteName:E,publishOptions:b,updateOptions:w,hasLocalChanges:_,resetLocalChanges:v}=e;(0,o.useEffect)((()=>{"global-styles"===(0,u.getQueryArg)(window.location.href,"openSidebar")&&(0,i.dispatch)("core/edit-post").openGeneralSidebar("jetpack-global-styles/global-styles")}),[]);const P=()=>b({[c.iU]:d,[c.GK]:t});return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(l.PluginSidebarMoreMenuItem,{icon:r.Z,target:"global-styles"},__("Global Styles","full-site-editing")),(0,o.createElement)(l.PluginSidebar,{icon:r.Z,name:"global-styles",title:__("Global Styles","full-site-editing"),className:"global-styles-sidebar"},(0,o.createElement)(s.PanelBody,null,(0,o.createElement)("p",null,(0,a.sprintf)(__("You are customizing %s.","full-site-editing"),E)),(0,o.createElement)("p",null,__("Any change you make here will apply to the entire website.","full-site-editing")),_?(0,o.createElement)("div",null,(0,o.createElement)("p",null,(0,o.createElement)("em",null,__("You have unsaved changes.","full-site-editing"))),(0,o.createElement)(y,{hasLocalChanges:_,publishAction:P,resetAction:v})):null),(0,o.createElement)(s.PanelBody,{title:__("Font Selection","full-site-editing")},(0,o.createElement)(f.Z,{fontBase:d,fontBaseDefault:g,fontHeadings:t,fontHeadingsDefault:n,fontBaseOptions:h(O,c.iU),fontHeadingsOptions:h(O,c.GK),updateBaseFont:e=>w({[c.iU]:e}),updateHeadingsFont:e=>w({[c.GK]:e})}),(0,o.createElement)(p.Z,{fontHeadings:t,fontBase:d,fontPairings:m,update:e=>{let{headings:t,base:n}=e;return w({[c.GK]:t,[c.iU]:n})}})),(0,o.createElement)(s.PanelBody,null,_?(0,o.createElement)("p",null,(0,o.createElement)("em",null,__("You have unsaved changes.","full-site-editing"))):null,(0,o.createElement)(y,{hasLocalChanges:_,publishAction:P,resetAction:v,className:"global-styles-sidebar__panel-action-buttons"}))))}},409:function(e,t,n){"use strict";var o=n(307),s=n(736);const __=s.__;t.Z=e=>{let{unsupportedFeature:t}=e;return(0,o.createElement)("p",null,(0,s.sprintf)(__("Your active theme doesn't support %s.","full-site-editing"),t))}},942:function(e,t,n){"use strict";var o=n(989),s=n.n(o),i=n(818);let l={},a=!1;const r={*publishOptions(e){return yield{type:"IO_PUBLISH_OPTIONS",options:e},{type:"PUBLISH_OPTIONS",options:e}},updateOptions:e=>({type:"UPDATE_OPTIONS",options:e}),fetchOptions:()=>({type:"IO_FETCH_OPTIONS"}),resetLocalChanges:()=>({type:"RESET_OPTIONS",options:l})};t.Z=(e,t)=>{(0,i.registerStore)(e,{reducer(e,t){switch(t.type){case"UPDATE_OPTIONS":case"RESET_OPTIONS":case"PUBLISH_OPTIONS":return{...e,...t.options}}return e},actions:r,selectors:{getOption:(e,t)=>e?e[t]:void 0,hasLocalChanges:e=>!!e&&Object.keys(l).some((t=>l[t]!==e[t]))},resolvers:{*getOption(e){if(a)return;let t;try{a=!0,t=yield r.fetchOptions()}catch(n){t={}}return l=t,{type:"UPDATE_OPTIONS",options:t}}},controls:{IO_FETCH_OPTIONS:()=>s()({path:t}),IO_PUBLISH_OPTIONS(e){let{options:n}=e;return l=n,s()({path:t,method:"POST",data:{...n}})}}})}},819:function(e){"use strict";e.exports=window.lodash},989:function(e){"use strict";e.exports=window.wp.apiFetch},609:function(e){"use strict";e.exports=window.wp.components},333:function(e){"use strict";e.exports=window.wp.compose},818:function(e){"use strict";e.exports=window.wp.data},701:function(e){"use strict";e.exports=window.wp.domReady},67:function(e){"use strict";e.exports=window.wp.editPost},307:function(e){"use strict";e.exports=window.wp.element},736:function(e){"use strict";e.exports=window.wp.i18n},630:function(e){"use strict";e.exports=window.wp.keycodes},817:function(e){"use strict";e.exports=window.wp.plugins},444:function(e){"use strict";e.exports=window.wp.primitives},483:function(e){"use strict";e.exports=window.wp.url}},t={};function n(o){var s=t[o];if(void 0!==s)return s.exports;var i=t[o]={exports:{}};return e[o](i,i.exports,n),i.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})};var o={};!function(){"use strict";n.r(o);var e=n(333),t=n(818),s=n(817),i=n(682),l=n(517),a=n(464),r=n(942);n(318);const{PLUGIN_NAME:u,STORE_NAME:c,REST_PATH:p}=JETPACK_GLOBAL_STYLES_EDITOR_CONSTANTS;(0,r.Z)(c,p),(0,l.Z)([i.iU,i.GK],(0,t.select)(c).getOption),(0,s.registerPlugin)(u,{render:(0,e.compose)((0,t.withSelect)((e=>({siteName:e(c).getOption(i.px),fontHeadings:e(c).getOption(i.GK),fontHeadingsDefault:e(c).getOption(i.c$),fontBase:e(c).getOption(i.iU),fontBaseDefault:e(c).getOption(i.V6),fontPairings:e(c).getOption(i.R$),fontOptions:e(c).getOption(i.qD),hasLocalChanges:e(c).hasLocalChanges()}))),(0,t.withDispatch)((e=>({updateOptions:e(c).updateOptions,publishOptions:e(c).publishOptions,resetLocalChanges:e(c).resetLocalChanges}))))(a.Z)})}(),window.EditingToolkit=o}();