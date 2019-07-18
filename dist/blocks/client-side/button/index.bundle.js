!function(){"use strict";function u(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var e={themeName:"desenvolvimentoDeployWpTheme",themeId:"dd",themeColors:[{id:"skyblue",label:"Skyblue",code:"skyblue",contrastingColorId:"black"},{id:"darkred",label:"Darkred",code:"darkred",contrastingColorId:"white"},{id:"black",label:"Black",code:"#000000",contrastingColorId:"white"},{id:"white",label:"White",code:"#FFFFFF",contrastingColorId:"black"}]};var t,s=(function(e){!function(){var a={}.hasOwnProperty;function c(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var r=typeof n;if("string"===r||"number"===r)e.push(n);else if(Array.isArray(n)&&n.length){var o=c.apply(null,n);o&&e.push(o)}else if("object"===r)for(var l in n)a.call(n,l)&&n[l]&&e.push(l)}}return e.join(" ")}e.exports?(c.default=c,e.exports=c):window.classNames=c}()}(t={exports:{}},t.exports),t.exports),d=(wp.blocks.registerBlockType,wp.editor.InnerBlocks,wp.element.Fragment,e.themeColors.map(function(e){return{name:e.label,color:e.code}})),f=function(e,t,n){return e.find(function(e){return e[t]===n})}.bind(null,e.themeColors),g=wp.i18n.__,n=wp.blocks.registerBlockType,r=wp.editor,b=r.BlockAlignmentToolbar,m=r.BlockControls,p=r.InspectorControls,h=r.URLInput,k=r.RichText,o=wp.components,y=o.PanelBody,C=o.ColorPalette,v=o.ToggleControl,w=o.BaseControl,I=wp.element.Fragment,l={padding:"10px 15px",display:"inline-flex"},R=function(e){var t=f("id",e.backgroundColorId),n=t&&t.contrastingColorId&&f("id",t.contrastingColorId);return function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{},r=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(r=r.concat(Object.getOwnPropertySymbols(n).filter(function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),r.forEach(function(e){u(t,e,n[e])})}return t}({},l,{backgroundColor:t?t.code:"transparent",color:n?n.code:"inherit"})};n("".concat(e.themeId,"/button"),{title:g("Botão"),category:e.themeId,attributes:{href:{type:"string",default:""},target:{type:"string",default:"_self"},text:{type:"string",default:null},backgroundColorId:{type:"string",default:e.themeColors[0].id},horizontalAlignment:{type:"string",default:"left"}},edit:function(e){var t=e.attributes,n=e.setAttributes,r=e.className,o=t.href,l=t.target,a=t.text,c=t.backgroundColorId,i=t.horizontalAlignment,u=f("id",c);return React.createElement(I,null,React.createElement(p,null,React.createElement(y,null,React.createElement(w,{label:g("Link")},React.createElement(h,{value:o,onChange:function(e){return n({href:e})}})),React.createElement(v,{label:g("Abrir em nova aba"),checked:"_blank"===l,onChange:function(){return n({target:"_blank"===l?"_self":"_blank"})}}),React.createElement(C,{colors:d,value:u&&u.code,onChange:function(e){var t=f("code",e);n({backgroundColorId:t?t.id:null})}}))),React.createElement(m,null,React.createElement(b,{value:i,onChange:function(e){return n({horizontalAlignment:e})}})),React.createElement("div",{className:"".concat(r)},React.createElement("div",{style:R(t)},React.createElement(k,{placeholder:g("Texto do botão"),value:a,onChange:function(e){return n({text:e})},keepPlaceholderOnFocus:!0}))))},save:function(e){var t,n=e.attributes,r=e.className,o=n.href,l=n.target,a=n.text,c=n.backgroundColorId,i=n.horizontalAlignment;"bg-".concat(n.backgroundColorId);return React.createElement("div",{className:s((t={},u(t,r,Boolean(r)),u(t,"d-flex",Boolean(i)),u(t,"justify-content-start","left"===i),u(t,"justify-content-end","right"===i),u(t,"justify-content-center","center"===i),t))},React.createElement("a",{className:"btn bg-".concat(c),target:l,href:o,rel:"noreferrer noopener"},a))}})}();