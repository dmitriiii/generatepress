(this["webpackJsonpmy-app"]=this["webpackJsonpmy-app"]||[]).push([[0],{1:function(e,t,a){e.exports={main:"App_main__2tcVU",wrapper:"App_wrapper__qKjoD",title:"App_title__1vL0-",logo:"App_logo__2UVIN",radios:"App_radios__3UOer",label:"App_label__3voF8",checkmark:"App_checkmark__FXw-p",input_box:"App_input_box__1CVSd",message_box:"App_message_box__2o9Nl",footer:"App_footer__36BX6",success:"App_success__1UEB2",error:"App_error__3WyXX"}},43:function(e,t,a){"use strict";a.r(t);var s=a(4),c=a.n(s),n=a(14),i=a.n(n),h=a(15),r=a(16),l=a(3),o=a(19),d=a(18),j=a(17),p=a.n(j),m=a(1),b=a.n(m),u=a(0),O=function(e){Object(o.a)(a,e);var t=Object(d.a)(a);function a(e){var s;return Object(h.a)(this,a),(s=t.call(this,e)).state={email:"test@mail.com",pass:"12345m",chosen:"email",error:!1,accounts:[],request_done:!1},s.handleChange=s.handleChange.bind(Object(l.a)(s)),s.handleCheck=s.handleCheck.bind(Object(l.a)(s)),s.handleRadio=s.handleRadio.bind(Object(l.a)(s)),s.validateEmail=s.validateEmail.bind(Object(l.a)(s)),s}return Object(r.a)(a,[{key:"validateEmail",value:function(e){return/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(e)}},{key:"handleChange",value:function(e){var t=e.target.name,a=e.target.value,s={};s[t]=a.trim(),this.setState(s)}},{key:"handleRadio",value:function(e){this.setState({request_done:!1,chosen:e.target.value,error:!1})}},{key:"handleCheck",value:function(){var e=this.state.chosen;if(""===this.state[e])return this.setState({error:"Please fill required field!"}),!1;if("email"===e&&!this.validateEmail(this.state.email))return this.setState({error:"Please enter valid email address!"}),!1;var t={headers:{Authorization:"Bearer ".concat("eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDM1NjBmMzFjNjczYjY2YmFjZGQwZDc2YTExZWU1MGQ5NWFkNzk5OWJmYTcwNGIzZmI0ZTA4MWZmYWFhMzc2YWFhMjljODA2NGE1YTZjYmUiLCJpYXQiOjE2MTIyOTQ5OTMsIm5iZiI6MTYxMjI5NDk5MywiZXhwIjoxNjQzODMwOTkzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JcXJzjFu0Yo6zPYr9fvSy1tSS0XsCJrHx-y3ISBgSITAalwQ9ZQTIAqLTdcfpqCrCFrK4ITKkcEAUin5P-7Ac37Kfy1NT3-Oe1q71p3WykNEd7fSqUeyjKqePqL88wcE2A_hJ5CeCsNjsxsf6kkn_-bQLN11ETPTFJ5oApXUoL5ytvN9xxYCMC_Uuww7OpM_clVsK_sAas10F9rExA2yGqN5WAzYOBys_wCAVQTOBYLROwokR3Ouv1_3SL93yg-F1yodFhS4w22fBPGSN1gpBqG-LtkR8CnfX0Q8hPbzUe36wVHKJ3Q8OcdzydAyxteCOuwcPNadDMcHEvd3P6OLp0zU-ayFCuxd1n-x9asvmknOaJrZC3smbfNydjOiiavohHGH96UIYoc2wZjXpDNtFeYCmsndAznYNXNNN1nNIXL4WDfkPpmvCebUsUdiqiLtSce-eIJ4ja104kqy1xNaIUGkL8pqYTKk0z175NV5P70aDSRQJnt-l0p6RGDFPCaGjzodehY1bWhnjLndUKe990_rM4LgbuD5Shg9WYfrFipIcfRADRm5FQwpbx9WsvTu7usCxso8ZUNxRkdk7GNUNWuSGoRmHM9_EVaNlmFJH8pfB30Iy98VFtvKqQKYwAOx8w5qylj2Hc7NFttk-dIbtPL_WXIxHVChCDPlhBNrMuA")}},a=this,s={field:e,value:a.state[e]};p.a.post("https://api.pro24web.site/api/account",s,t).then((function(e){a.setState({error:e.data.error,request_done:!0,accounts:e.data.accounts})})).catch(console.log)}},{key:"render",value:function(){var e,t,a=this.state.chosen,s=this.state.accounts,c=this.state.request_done;if(this.state.error)t=Object(u.jsx)("p",{className:b.a.error,children:this.state.error});else if(c&&s.length>0){var n=1===s.length?"":"s",i="pass"===a?"password":"email",h="pass"===a?"email":"password",r=s.map((function(e,t){return Object(u.jsx)("span",{children:e.result},t)}));t=Object(u.jsxs)("p",{className:b.a.success,children:["We found "+h+n+" connected to "+i+" that you entered!",Object(u.jsx)("br",{}),r]})}else t=c&&0===s.length?Object(u.jsxs)("p",{className:b.a.success,children:["Nothing found. ",Object(u.jsx)("br",{})," Your account is safe!"]}):Object(u.jsx)("p",{});return e="email"===a?Object(u.jsx)("input",{type:"email",name:"email",onChange:this.handleChange,value:this.state.email}):Object(u.jsx)("input",{type:"text",name:"pass",onChange:this.handleChange,value:this.state.pass}),Object(u.jsx)("div",{className:b.a.main,children:Object(u.jsxs)("div",{className:b.a.wrapper,children:[Object(u.jsx)("svg",{id:"Capa_1",className:b.a.logo,enableBackground:"new 0 0 512 512",height:"512",viewBox:"0 0 512 512",width:"512",xmlns:"http://www.w3.org/2000/svg",children:Object(u.jsx)("g",{children:Object(u.jsxs)("g",{children:[Object(u.jsx)("path",{d:"m387.737 72.646c5.522 0 10-4.478 10-10s-4.478-10-10-10h-.057c-5.522 0-9.972 4.478-9.972 10s4.507 10 10.029 10z"}),Object(u.jsx)("path",{d:"m441.708 72.646c5.522 0 10-4.478 10-10s-4.478-10-10-10h-.057c-5.522 0-9.972 4.478-9.972 10s4.507 10 10.029 10z"}),Object(u.jsx)("path",{d:"m333.767 72.646c5.522 0 10-4.478 10-10s-4.478-10-10-10h-.057c-5.522 0-9.972 4.478-9.972 10s4.506 10 10.029 10z"}),Object(u.jsx)("path",{d:"m70.263 72.646h150.262c5.523 0 10-4.478 10-10s-4.477-10-10-10h-150.262c-5.523 0-10 4.478-10 10s4.477 10 10 10z"}),Object(u.jsx)("path",{d:"m479.919.007h-447.837c-17.69 0-32.082 14.391-32.082 32.081v370.283c0 17.689 14.392 32.081 32.082 32.081h80.034c6.382 9.662 13.789 18.739 22.168 27.118 32.516 32.516 75.742 50.423 121.716 50.423 45.975 0 89.201-17.907 121.717-50.423 8.43-8.431 15.8-17.526 22.112-27.118h80.09c17.689 0 32.081-14.392 32.081-32.081v-370.283c0-17.69-14.392-32.081-32.081-32.081zm-447.837 20h447.837c6.661 0 12.081 5.42 12.081 12.081v73.224h-472v-73.224c0-6.661 5.42-12.081 12.082-12.081zm447.837 394.445h-68.793c30.719-64.037 19.591-143.285-33.409-196.286-26.946-26.945-61.105-43.851-98.785-48.889-36.468-4.874-74.189 2.196-106.219 19.912-4.833 2.674-6.584 8.758-3.911 13.591s8.759 6.583 13.59 3.911c58.975-32.621 133.479-22.086 181.182 25.617 59.309 59.309 59.309 155.812 0 215.119-28.738 28.738-66.942 44.565-107.574 44.565s-78.836-15.827-107.574-44.565c-47.696-47.695-58.23-122.188-25.618-181.152 2.673-4.833.922-10.917-3.911-13.591-4.831-2.673-10.917-.922-13.59 3.911-17.716 32.029-24.787 69.747-19.912 106.205 2.431 18.175 7.632 35.528 15.383 51.651h-68.696c-6.662 0-12.082-5.42-12.082-12.081v-277.06h472v277.06c0 6.662-5.42 12.082-12.081 12.082z"}),Object(u.jsx)("path",{d:"m255.986 397.489c5.523 0 10-4.478 10-10v-23.867c0-5.522-4.478-10-10-10s-10 4.478-10 10v23.867c0 5.523 4.477 10 10 10z"}),Object(u.jsx)("path",{d:"m255.986 454.493c47.246 0 85.683-38.438 85.683-85.684v-38.239c0-12.938-9.303-23.738-21.57-26.078v-26.22c0-29.521-24.018-53.539-53.54-53.539h-21.146c-29.521 0-53.539 24.018-53.539 53.539v26.224c-12.269 2.348-21.571 13.144-21.571 26.074v38.239c-.001 47.247 38.437 85.684 85.683 85.684zm-44.112-176.221c0-18.493 15.045-33.539 33.539-33.539h21.146c18.494 0 33.54 15.046 33.54 33.539v25.744h-88.225zm-21.572 52.298c0-3.553 3.015-6.554 6.583-6.554h118.23c3.553 0 6.554 3.001 6.554 6.554v38.239c0 36.218-29.465 65.684-65.683 65.684s-65.684-29.466-65.684-65.684z"}),Object(u.jsx)("path",{d:"m134.284 218.166c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.119-.977 7.071-2.929l.028-.028c3.905-3.905 3.891-10.223-.014-14.128s-10.25-3.892-14.156.013z"})]})})}),Object(u.jsx)("h4",{className:b.a.title,children:"Try out your VPN account's email or password"}),Object(u.jsxs)("div",{className:b.a.radios,children:[Object(u.jsxs)("label",{className:b.a.label,children:[Object(u.jsx)("input",{type:"radio",value:"email",name:"chosen",onChange:this.handleRadio,checked:"email"===this.state.chosen}),Object(u.jsx)("span",{className:b.a.checkmark}),Object(u.jsx)("em",{children:"Email"})]}),Object(u.jsxs)("label",{className:b.a.label,children:[Object(u.jsx)("input",{type:"radio",value:"pass",name:"chosen",onChange:this.handleRadio,checked:"pass"===this.state.chosen}),Object(u.jsx)("span",{className:b.a.checkmark}),Object(u.jsx)("em",{children:"Password"})]})]}),Object(u.jsxs)("div",{className:b.a.input_box,children:[e,Object(u.jsx)("button",{onClick:this.handleCheck,children:"Check!"})]}),Object(u.jsx)("div",{className:b.a.message_box,children:t}),Object(u.jsx)("div",{className:b.a.footer,children:Object(u.jsxs)("small",{children:["Made with \u2764\ufe0f by ",Object(u.jsx)("em",{children:Object(u.jsx)("a",{href:"http://vpntester.net/",children:"vpntester.net"})})]})})]})})}}]),a}(c.a.Component),x=function(e){e&&e instanceof Function&&a.e(3).then(a.bind(null,44)).then((function(t){var a=t.getCLS,s=t.getFID,c=t.getFCP,n=t.getLCP,i=t.getTTFB;a(e),s(e),c(e),n(e),i(e)}))};i.a.render(Object(u.jsx)(c.a.StrictMode,{children:Object(u.jsx)(O,{})}),document.getElementById("root")),x()}},[[43,1,2]]]);
//# sourceMappingURL=main.4b3e4db1.chunk.js.map