(this["webpackJsonpip-check2"]=this["webpackJsonpip-check2"]||[]).push([[0],{18:function(e,t,a){e.exports=a(43)},24:function(e,t,a){},42:function(e,t,a){},43:function(e,t,a){"use strict";a.r(t);var n=a(0),r=a.n(n),o=a(16),s=a.n(o),c=(a(23),a(24),a(2)),i=a(3),l=a(6),p=a(4),u=a(5),d=a(17),m=a.n(d),h=function(e){Object(u.a)(a,e);var t=Object(p.a)(a);function a(e){var n;return Object(c.a)(this,a),(n=t.call(this,e)).state={butt:"Copy"},n.handleClick=n.handleClick.bind(Object(l.a)(n)),n}return Object(i.a)(a,[{key:"handleClick",value:function(){this.setState((function(e,t){return{butt:"Copied!"}})),setTimeout(function(){this.setState((function(e,t){return{butt:"Copy"}}))}.bind(this),1e3),navigator.clipboard.writeText(this.props.datta.sharingUrl).then((function(){console.log("Async: Copying to clipboard was successful!")}),(function(e){console.error("Async: Could not copy text: ",e)}))}},{key:"render",value:function(){return r.a.createElement("div",{className:"row m5ip__top-row"},r.a.createElement("div",{className:"col-md-4"},r.a.createElement("h2",null,"IP: ",this.props.datta.appUserIp)),r.a.createElement("div",{className:"col-md-8"},r.a.createElement("div",{className:"input-group"},r.a.createElement("input",{type:"text",className:"form-control",placeholder:this.props.datta.sharingUrl,readOnly:!0}),r.a.createElement("div",{className:"input-group-append"},r.a.createElement("button",{className:"btn btn-outline-secondary",type:"button",onClick:this.handleClick},this.state.butt),r.a.createElement("a",{href:this.props.datta.pageUrl,className:"btn btn-outline-secondary",type:"button"},"Test Again")))))}}]),a}(r.a.Component),b=function(e){Object(u.a)(a,e);var t=Object(p.a)(a);function a(e){return Object(c.a)(this,a),t.call(this,e)}return Object(i.a)(a,[{key:"render",value:function(){var e=this.props.datta.response,t="https://maps.googleapis.com/maps/api/staticmap?center="+e.lat+","+e.lon+"&zoom=9&size=900x400&maptype=terrain&markers=color:blue|label:S|"+e.lat+","+e.lon+"&key=AIzaSyCaSzFRjmMS_37Y79GNKcXRssf0_NGdX3Y";return r.a.createElement("div",{className:"row m5ip__locator-row"},r.a.createElement("div",{className:"col-md-12"},e&&r.a.createElement("img",{src:t,alt:"Location",width:"600",height:"400"})))}}]),a}(r.a.Component),v=function(e){Object(u.a)(a,e);var t=Object(p.a)(a);function a(e){return Object(c.a)(this,a),t.call(this,e)}return Object(i.a)(a,[{key:"render",value:function(){var e=this.props.datta.response,t={country:"Country",regionName:"Region",city:"City",lat:"Lattitude",lon:"Longitude",as:"ASN",isp:"ISP",zip:"ZIP",org:"Internet Provider",timezone:"Timezone"},a=Object.keys(e).map((function(a,n){return!!t[a]&&r.a.createElement("tr",{key:n},r.a.createElement("td",null,r.a.createElement("strong",null,t[a])),r.a.createElement("td",null,e[a]))}));return r.a.createElement("div",{className:"row m5ip__details-row"},r.a.createElement("div",{className:"col-md-12"},r.a.createElement("div",{className:"table-responsive-md"},r.a.createElement("table",{className:"table table-striped table-hover table-sm"},r.a.createElement("tbody",null,a)))))}}]),a}(r.a.Component),f=(a(42),function(e){Object(u.a)(a,e);var t=Object(p.a)(a);function a(e){var n;Object(c.a)(this,a),n=t.call(this,e);var r=new URLSearchParams(window.location.search),o="";return r.has("user")&&(o=r.get("user")),n.state={appUserHash:o,appUserIp:"",sharingUrl:"",pageUrl:document.location.origin+document.location.pathname,response:""},n.validateIPaddress=n.validateIPaddress.bind(Object(l.a)(n)),n}return Object(i.a)(a,[{key:"validateIPaddress",value:function(e){return e=window.atob(e),!!/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(e)}},{key:"componentDidMount",value:function(){var e=this,t="";this.validateIPaddress(this.state.appUserHash)&&(t=window.atob(this.state.appUserHash)),m.a.get("https://vpntester.net/wp-json/m5/ipaddr/",{params:{ip:t}}).then((function(t){var a=window.btoa(t.data.ip_data.query);e.setState((function(e,n){return{appUserHash:a,appUserIp:t.data.ip_data.query,sharingUrl:e.pageUrl+"?user="+a,response:t.data.ip_data}}))})).catch((function(e){console.log(e)}))}},{key:"render",value:function(){return r.a.createElement("div",{className:"m5ip__app-wrr"},r.a.createElement("div",{className:"container-fluid"},r.a.createElement(h,{datta:this.state}),r.a.createElement(b,{datta:this.state}),r.a.createElement(v,{datta:this.state})))}}]),a}(r.a.Component));Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));s.a.render(r.a.createElement(r.a.StrictMode,null,r.a.createElement(f,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()})).catch((function(e){console.error(e.message)}))}},[[18,1,2]]]);
//# sourceMappingURL=main.a6d182e4.chunk.js.map