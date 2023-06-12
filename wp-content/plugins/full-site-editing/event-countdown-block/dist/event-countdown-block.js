!function(){"use strict";var e={129:function(){},448:function(){},829:function(e,t,n){var i=n(307),o=n(609),l=n(771),a=n(736),r=n(292),s=n.n(r),c=n(515);const __=a.__,u="YYYY-MM-DDTHH:mm:ss";function d(e,t){let n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:u;return s()(e,n).utcOffset(60*t,!0)}t.Z=e=>{let{attributes:t,setAttributes:n,className:a}=e;const r=(0,l.__experimentalGetSettings)();let m,v=__("Choose Date","full-site-editing");if(t.eventTimestamp)v=(0,l.dateI18n)(r.formats.datetimeAbbreviated,new Date(1e3*t.eventTimestamp)),m=s()(1e3*t.eventTimestamp).utcOffset(60*r.timezone.offset).format(u);else if(t.eventDate){const e=d(t.eventDate,Number.parseFloat(r.timezone.offset));v=(0,l.dateI18n)(r.formats.datetimeAbbreviated,e),m=t.eventDate}return(0,i.createElement)(o.Placeholder,{label:__("Event Countdown","full-site-editing"),instructions:__("Count down to an event. Set a title and pick a time and date.","full-site-editing"),icon:(0,i.createElement)(c.p,null),className:a},(0,i.createElement)("div",null,(0,i.createElement)("strong",null,__("Title:","full-site-editing")),(0,i.createElement)("br",null),(0,i.createElement)("input",{type:"text",value:t.eventTitle,onChange:e=>n({eventTitle:e.target.value}),placeholder:__("Event Title","full-site-editing"),className:"event-countdown__event-title","aria-label":__("Event Title","full-site-editing")})),(0,i.createElement)("div",null,(0,i.createElement)("strong",null,__("Date:","full-site-editing")),(0,i.createElement)("br",null),(0,i.createElement)(o.Dropdown,{position:"bottom left",renderToggle:e=>{let{onToggle:t,isOpen:n}=e;return(0,i.createElement)(o.Button,{onClick:t,"aria-expanded":n,"aria-live":"polite",isSecondary:!0},v)},renderContent:()=>(0,i.createElement)(o.DateTimePicker,{key:"event-countdown-picker",onChange:e=>n({eventTimestamp:d(e,r.timezone.offset).unix()}),currentDate:m})})))}},515:function(e,t,n){n.d(t,{p:function(){return l}});var i=n(307),o=n(609);const l=()=>(0,i.createElement)(o.SVG,{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24"},(0,i.createElement)(o.Path,{d:"M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"}))},196:function(e,t,n){var i=n(981),o=n(736),l=n(829),a=n(515),r=n(674);n(129),n(448);const __=o.__;(0,i.registerBlockType)("jetpack/event-countdown",{title:__("Event Countdown","full-site-editing"),description:__("Count down to your favorite next thing, and celebrate with fireworks when the time is right!","full-site-editing"),icon:a.p,category:"widgets",supports:{align:["wide","full"]},example:{attributes:{eventTimestamp:1318874398,eventTitle:"Total Solar Eclipse"}},attributes:{eventTitle:{type:"string",source:"text",selector:".event-countdown__event-title"},eventTimestamp:{type:"number"}},edit:e=>e.isSelected?(0,l.Z)(e):(0,r.Z)({...e,isEditView:!0}),save:r.Z,deprecated:[{attributes:{eventTitle:{type:"string",source:"text",selector:".event-countdown__event-title"},eventDate:{type:"string"}},save:r.Z}]})},674:function(e,t,n){var i=n(307),o=n(736);const __=o.__,_x=o._x;t.Z=e=>{let{attributes:t,className:n,isEditView:o}=e,l="&nbsp;",a="&nbsp;",r="&nbsp;",s="&nbsp;";if(o){let e;l=a=r=s=0,e=t.eventTimestamp?1e3*t.eventTimestamp:new Date(t.eventDate).getTime();const n=e-Date.now();if(n>0){let e=Math.round(n/1e3);l=Math.floor(e/86400),e-=24*l*60*60,a=Math.floor(e/3600),e-=60*a*60,r=Math.floor(e/60),e-=60*r,s=e}}return(0,i.createElement)("div",{className:n},(0,i.createElement)("div",{className:"event-countdown__date"},t.eventTimestamp||t.eventDate),(0,i.createElement)("div",{className:"event-countdown__counter"},(0,i.createElement)("p",null,(0,i.createElement)("strong",{className:"event-countdown__day"},l)," ",_x("days","Countdown days remaining","full-site-editing")),(0,i.createElement)("p",null,(0,i.createElement)("span",null,(0,i.createElement)("strong",{className:"event-countdown__hour"},a)," ",_x("hours","Countdown hours remaining","full-site-editing")),(0,i.createElement)("span",null,(0,i.createElement)("strong",{className:"event-countdown__minute"},r)," ",_x("minutes","Countdown minutes remaining","full-site-editing")),(0,i.createElement)("span",null,(0,i.createElement)("strong",{className:"event-countdown__second"},s)," ",_x("seconds","Countdown seconds remaining","full-site-editing"))),(0,i.createElement)("p",null,__("until","full-site-editing"))),(0,i.createElement)("div",{className:"event-countdown__event-title"},(0,i.createElement)("p",null,t.eventTitle)))}},292:function(e){e.exports=window.moment},981:function(e){e.exports=window.wp.blocks},609:function(e){e.exports=window.wp.components},771:function(e){e.exports=window.wp.date},307:function(e){e.exports=window.wp.element},736:function(e){e.exports=window.wp.i18n}},t={};function n(i){var o=t[i];if(void 0!==o)return o.exports;var l=t[i]={exports:{}};return e[i](l,l.exports,n),l.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var i in t)n.o(t,i)&&!n.o(e,i)&&Object.defineProperty(e,i,{enumerable:!0,get:t[i]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})};var i={};!function(){n.r(i);n(196)}(),window.EditingToolkit=i}();