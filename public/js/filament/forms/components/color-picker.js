var l=(r,t=0,o=1)=>r>o?o:r<t?t:r,a=(r,t=0,o=Math.pow(10,t))=>Math.round(o*r)/o;var nt={grad:360/400,turn:360,rad:360/(Math.PI*2)},B=r=>J(x(r)),x=r=>(r[0]==="#"&&(r=r.substr(1)),r.length<6?{r:parseInt(r[0]+r[0],16),g:parseInt(r[1]+r[1],16),b:parseInt(r[2]+r[2],16),a:1}:{r:parseInt(r.substr(0,2),16),g:parseInt(r.substr(2,2),16),b:parseInt(r.substr(4,2),16),a:1}),it=(r,t="deg")=>Number(r)*(nt[t]||1),lt=r=>{let o=/hsla?\(?\s*(-?\d*\.?\d+)(deg|rad|grad|turn)?[,\s]+(-?\d*\.?\d+)%?[,\s]+(-?\d*\.?\d+)%?,?\s*[/\s]*(-?\d*\.?\d+)?(%)?\s*\)?/i.exec(r);return o?ct({h:it(o[1],o[2]),s:Number(o[3]),l:Number(o[4]),a:o[5]===void 0?1:Number(o[5])/(o[6]?100:1)}):{h:0,s:0,v:0,a:1}},F=lt,ct=({h:r,s:t,l:o,a:e})=>(t*=(o<50?o:100-o)/100,{h:r,s:t>0?2*t/(o+t)*100:0,v:o+t,a:e}),X=r=>pt(L(r)),Y=({h:r,s:t,v:o,a:e})=>{let s=(200-t)*o/100;return{h:a(r),s:a(s>0&&s<200?t*o/100/(s<=100?s:200-s)*100:0),l:a(s/2),a:a(e,2)}};var u=r=>{let{h:t,s:o,l:e}=Y(r);return`hsl(${t}, ${o}%, ${e}%)`},b=r=>{let{h:t,s:o,l:e,a:s}=Y(r);return`hsla(${t}, ${o}%, ${e}%, ${s})`},L=({h:r,s:t,v:o,a:e})=>{r=r/360*6,t=t/100,o=o/100;let s=Math.floor(r),n=o*(1-t),i=o*(1-(r-s)*t),E=o*(1-(1-r+s)*t),q=s%6;return{r:a([o,i,n,n,E,o][q]*255),g:a([E,o,o,i,n,n][q]*255),b:a([n,n,E,o,o,i][q]*255),a:a(e,2)}},_=r=>{let{r:t,g:o,b:e}=L(r);return`rgb(${t}, ${o}, ${e})`},U=r=>{let{r:t,g:o,b:e,a:s}=L(r);return`rgba(${t}, ${o}, ${e}, ${s})`};var A=r=>{let o=/rgba?\(?\s*(-?\d*\.?\d+)(%)?[,\s]+(-?\d*\.?\d+)(%)?[,\s]+(-?\d*\.?\d+)(%)?,?\s*[/\s]*(-?\d*\.?\d+)?(%)?\s*\)?/i.exec(r);return o?J({r:Number(o[1])/(o[2]?100/255:1),g:Number(o[3])/(o[4]?100/255:1),b:Number(o[5])/(o[6]?100/255:1),a:o[7]===void 0?1:Number(o[7])/(o[8]?100:1)}):{h:0,s:0,v:0,a:1}},G=A,N=r=>{let t=r.toString(16);return t.length<2?"0"+t:t},pt=({r,g:t,b:o})=>"#"+N(r)+N(t)+N(o),J=({r,g:t,b:o,a:e})=>{let s=Math.max(r,t,o),n=s-Math.min(r,t,o),i=n?s===r?(t-o)/n:s===t?2+(o-r)/n:4+(r-t)/n:0;return{h:a(60*(i<0?i+6:i)),s:a(s?n/s*100:0),v:a(s/255*100),a:e}};var I=(r,t)=>{if(r===t)return!0;for(let o in r)if(r[o]!==t[o])return!1;return!0},d=(r,t)=>r.replace(/\s/g,"")===t.replace(/\s/g,""),K=(r,t)=>r.toLowerCase()===t.toLowerCase()?!0:I(x(r),x(t));var Q={},v=r=>{let t=Q[r];return t||(t=document.createElement("template"),t.innerHTML=r,Q[r]=t),t},m=(r,t,o)=>{r.dispatchEvent(new CustomEvent(t,{bubbles:!0,detail:o}))};var h=!1,R=r=>"touches"in r,ut=r=>h&&!R(r)?!1:(h||(h=R(r)),!0),W=(r,t)=>{let o=R(t)?t.touches[0]:t,e=r.el.getBoundingClientRect();m(r.el,"move",r.getMove({x:l((o.pageX-(e.left+window.pageXOffset))/e.width),y:l((o.pageY-(e.top+window.pageYOffset))/e.height)}))},dt=(r,t)=>{let o=t.keyCode;o>40||r.xy&&o<37||o<33||(t.preventDefault(),m(r.el,"move",r.getMove({x:o===39?.01:o===37?-.01:o===34?.05:o===33?-.05:o===35?1:o===36?-1:0,y:o===40?.01:o===38?-.01:0},!0)))},p=class{constructor(t,o,e,s){let n=v(`<div role="slider" tabindex="0" part="${o}" ${e}><div part="${o}-pointer"></div></div>`);t.appendChild(n.content.cloneNode(!0));let i=t.querySelector(`[part=${o}]`);i.addEventListener("mousedown",this),i.addEventListener("touchstart",this),i.addEventListener("keydown",this),this.el=i,this.xy=s,this.nodes=[i.firstChild,i]}set dragging(t){let o=t?document.addEventListener:document.removeEventListener;o(h?"touchmove":"mousemove",this),o(h?"touchend":"mouseup",this)}handleEvent(t){switch(t.type){case"mousedown":case"touchstart":if(t.preventDefault(),!ut(t)||!h&&t.button!=0)return;this.el.focus(),W(this,t),this.dragging=!0;break;case"mousemove":case"touchmove":t.preventDefault(),W(this,t);break;case"mouseup":case"touchend":this.dragging=!1;break;case"keydown":dt(this,t);break}}style(t){t.forEach((o,e)=>{for(let s in o)this.nodes[e].style.setProperty(s,o[s])})}};var $=class extends p{constructor(t){super(t,"hue",'aria-label="Hue" aria-valuemin="0" aria-valuemax="360"',!1)}update({h:t}){this.h=t,this.style([{left:`${t/360*100}%`,color:u({h:t,s:100,v:100,a:1})}]),this.el.setAttribute("aria-valuenow",`${a(t)}`)}getMove(t,o){return{h:o?l(this.h+t.x*360,0,360):360*t.x}}};var H=class extends p{constructor(t){super(t,"saturation",'aria-label="Color"',!0)}update(t){this.hsva=t,this.style([{top:`${100-t.v}%`,left:`${t.s}%`,color:u(t)},{"background-color":u({h:t.h,s:100,v:100,a:1})}]),this.el.setAttribute("aria-valuetext",`Saturation ${a(t.s)}%, Brightness ${a(t.v)}%`)}getMove(t,o){return{s:o?l(this.hsva.s+t.x*100,0,100):t.x*100,v:o?l(this.hsva.v-t.y*100,0,100):Math.round(100-t.y*100)}}};var Z=":host{display:flex;flex-direction:column;position:relative;width:200px;height:200px;user-select:none;-webkit-user-select:none;cursor:default}:host([hidden]){display:none!important}[role=slider]{position:relative;touch-action:none;user-select:none;-webkit-user-select:none;outline:0}[role=slider]:last-child{border-radius:0 0 8px 8px}[part$=pointer]{position:absolute;z-index:1;box-sizing:border-box;width:28px;height:28px;transform:translate(-50%,-50%);background-color:#fff;border:2px solid #fff;border-radius:50%;box-shadow:0 2px 4px rgba(0,0,0,.2)}[part$=pointer]::after{display:block;content:'';position:absolute;left:0;top:0;right:0;bottom:0;border-radius:inherit;background-color:currentColor}[role=slider]:focus [part$=pointer]{transform:translate(-50%,-50%) scale(1.1)}";var tt="[part=hue]{flex:0 0 24px;background:linear-gradient(to right,red 0,#ff0 17%,#0f0 33%,#0ff 50%,#00f 67%,#f0f 83%,red 100%)}[part=hue-pointer]{top:50%;z-index:2}";var ot="[part=saturation]{flex-grow:1;border-color:transparent;border-bottom:12px solid #000;border-radius:8px 8px 0 0;background-image:linear-gradient(to top,#000,transparent),linear-gradient(to right,#fff,rgba(255,255,255,0));box-shadow:inset 0 0 0 1px rgba(0,0,0,.05)}[part=saturation-pointer]{z-index:3}";var S=Symbol("same"),rt=Symbol("color"),et=Symbol("hsva"),O=Symbol("change"),P=Symbol("update"),st=Symbol("parts"),f=Symbol("css"),g=Symbol("sliders"),c=class extends HTMLElement{static get observedAttributes(){return["color"]}get[f](){return[Z,tt,ot]}get[g](){return[H,$]}get color(){return this[rt]}set color(t){if(!this[S](t)){let o=this.colorModel.toHsva(t);this[P](o),this[O](t)}}constructor(){super();let t=v(`<style>${this[f].join("")}</style>`),o=this.attachShadow({mode:"open"});o.appendChild(t.content.cloneNode(!0)),o.addEventListener("move",this),this[st]=this[g].map(e=>new e(o))}connectedCallback(){if(this.hasOwnProperty("color")){let t=this.color;delete this.color,this.color=t}else this.color||(this.color=this.colorModel.defaultColor)}attributeChangedCallback(t,o,e){let s=this.colorModel.fromAttr(e);this[S](s)||(this.color=s)}handleEvent(t){let o=this[et],e={...o,...t.detail};this[P](e);let s;!I(e,o)&&!this[S](s=this.colorModel.fromHsva(e))&&this[O](s)}[S](t){return this.color&&this.colorModel.equal(t,this.color)}[P](t){this[et]=t,this[st].forEach(o=>o.update(t))}[O](t){this[rt]=t,m(this,"color-changed",{value:t})}};var ht={defaultColor:"#000",toHsva:B,fromHsva:X,equal:K,fromAttr:r=>r},T=class extends c{get colorModel(){return ht}};var z=class extends T{};customElements.define("hex-color-picker",z);var mt={defaultColor:"hsl(0, 0%, 0%)",toHsva:F,fromHsva:u,equal:d,fromAttr:r=>r},y=class extends c{get colorModel(){return mt}};var V=class extends y{};customElements.define("hsl-string-color-picker",V);var ft={defaultColor:"rgb(0, 0, 0)",toHsva:G,fromHsva:_,equal:d,fromAttr:r=>r},w=class extends c{get colorModel(){return ft}};var j=class extends w{};customElements.define("rgb-string-color-picker",j);var M=class extends p{constructor(t){super(t,"alpha",'aria-label="Alpha" aria-valuemin="0" aria-valuemax="1"',!1)}update(t){this.hsva=t;let o=b({...t,a:0}),e=b({...t,a:1}),s=t.a*100;this.style([{left:`${s}%`,color:b(t)},{"--gradient":`linear-gradient(90deg, ${o}, ${e}`}]);let n=a(s);this.el.setAttribute("aria-valuenow",`${n}`),this.el.setAttribute("aria-valuetext",`${n}%`)}getMove(t,o){return{a:o?l(this.hsva.a+t.x):t.x}}};var at=`[part=alpha]{flex:0 0 24px}[part=alpha]::after{display:block;content:'';position:absolute;top:0;left:0;right:0;bottom:0;border-radius:inherit;background-image:var(--gradient);box-shadow:inset 0 0 0 1px rgba(0,0,0,.05)}[part^=alpha]{background-color:#fff;background-image:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill-opacity=".05"><rect x="8" width="8" height="8"/><rect y="8" width="8" height="8"/></svg>')}[part=alpha-pointer]{top:50%}`;var k=class extends c{get[f](){return[...super[f],at]}get[g](){return[...super[g],M]}};var gt={defaultColor:"rgba(0, 0, 0, 1)",toHsva:A,fromHsva:U,equal:d,fromAttr:r=>r},C=class extends k{get colorModel(){return gt}};var D=class extends C{};customElements.define("rgba-string-color-picker",D);function xt({isAutofocused:r,isDisabled:t,state:o}){return{state:o,init:function(){this.state===null||this.state===""||this.setState(this.state),r&&this.togglePanelVisibility(this.$refs.input),this.$refs.input.addEventListener("change",e=>{this.setState(e.target.value)}),this.$refs.panel.addEventListener("color-changed",e=>{this.setState(e.detail.value)})},togglePanelVisibility:function(){t||this.$refs.panel.toggle(this.$refs.input)},setState:function(e){this.state=e,this.$refs.input.value=e,this.$refs.panel.color=e},isOpen:function(){return this.$refs.panel.style.display==="block"}}}export{xt as default};