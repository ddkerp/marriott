function createCookie(e,i,t){if(t){var r=new Date;r.setTime(r.getTime()+24*t*60*60*1e3);var n=";domain="+window.location.hostname+";expires="+r.toGMTString()}else var n="";document.cookie=e+"="+i+n+";path=/"}function readCookie(e){for(var i=e+"=",t=document.cookie.split(";"),r=0;r<t.length;r++){for(var n=t[r];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(i))return n.substring(i.length,n.length)}return null}function eraseCookie(e){createCookie(e,"",-1)}function getUrlVars(){for(var e,i=[],t=window.location.href.slice(window.location.href.indexOf("?")+1).split("&"),r=0;r<t.length;r++)e=t[r].split("="),i.push(e[0]),i[e[0]]=e[1];return i}function fnSetCookie(e,i){if(0==i){var t=[],r={Did:getUrlVars().did,Cid:getUrlVars().cid,Sid:getUrlVars().sid,Rid:getUrlVars().rid,Chnl:getUrlVars().chl,Dtx:new Date};t.push(r),void 0!=r.Did&&createCookie(e,JSON.stringify(t),30)}else{var n=readCookie(e),o=JSON.parse(n);if(void 0!=getUrlVars().sid&&null!=getUrlVars().sid&&void 0!=getUrlVars().chl&&null!=getUrlVars().chl&&o.length>0){var r={Did:getUrlVars().did,Cid:getUrlVars().cid,Sid:getUrlVars().sid,Rid:getUrlVars().rid,Chnl:getUrlVars().chl,Dtx:new Date};o.push(r),createCookie(e,JSON.stringify(o),30)}}}function JsonSort(e){return e.sort(function(e,i){var t=new Date(e.Dtx),r=new Date(i.Dtx);return t>r?-1:r>t?1:0})}function fnMCST(){var e=document.getElementsByClassName("l-m2");if(e.length>0)for(var i=0;i<e.length;++i){var t=e[i];t.addEventListener("click",function(){return fnTrackUrl3rdParty("crmsft01"),RioTracking.click(300386706)},!1)}}function fnAmxSubmitDetails(){var e=getUrlVars().did;if("cust_c8cfcc5d_07dc_4f4f_9a75_433fefdde7b1"==e){document.getElementById("btnSumitDetails"),document.getElementsByClassName("verifyBg")}}function fnShowTNCPage(e,i){$("#ancHiddenSecond").attr("href","https://www.americanexpressindia.co.in/amex-website/credit-card-single-form/common-consent.html?partnername="+e+"&card="+i);var t=getUrlVars().did;"cust_c8cfcc5d_07dc_4f4f_9a75_433fefdde7b1"==t&&fnTrackUrl3rdParty("ancHiddenSecond"),$("#ancHiddenSecond").trigger("click")}function fnTrackUrl3rdParty(e){cookiename="ResData";window.location;null==readCookie(cookiename)?fnSetCookie(cookiename,0):fnSetCookie(cookiename,1);var i,t=readCookie(cookiename);if(null!=t){var r=JSON.parse(t),n=JsonSort(r)[0],o=n.Cid,d=n.Sid,a=n.Did,c=n.Chnl,l=(n.Dtx,window.location,""),s="";"cust_c8cfcc5d_07dc_4f4f_9a75_433fefdde7b1"==a?(l=n.Rid,s=document.getElementById(e).href,s=s.replace("&","@@")):(l=document.getElementById(e).innerHTML,s=document.getElementById(e).href),void 0!=t&&(i=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP"),void 0!=o&&void 0!=a&&(i.open("GET","https://run.resulticks.com/EdmTrack/ConversionTracking?cid="+o+"&sid="+d+"&did="+a+"&rid="+l+"&chl="+c+"&pUrl="+s,!0),i.send()))}}function fnTrackUrl(e){e="ResData";var i=window.location;-1!=i.host.indexOf("www.microsoft.com")&&setTimeout(function(){fnMCST()},2e3),-1!=i.host.indexOf("www.americanexpressindia.co.in")&&setTimeout(function(){fnAmxSubmitDetails()},2e3),null==readCookie(e)?fnSetCookie(e,0):fnSetCookie(e,1);var t,r=readCookie(e);if(null!=r){var n=JSON.parse(r),o=JsonSort(n)[0],d=(o.Cid,o.Sid,o.Did,o.Rid,o.Chnl,o.Dtx,window.location);d.protocol+"//"+d.host+d.pathname;void 0!=r&&(t=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP"))}}function fnTrackUrl_jq(e){void 0==$.cookie(e)?fnSetCookie(e,0):fnSetCookie(e,1);var i,t=$.cookie(e),r=JSON.parse(t),n=r.Cid,o=r.Sid,d=r.Did,a=r.Rid,c=r.Chnl,l=window.location,s=l.protocol+"//"+l.host+l.pathname;void 0!=t&&(i=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP"),void 0!=n&&void 0!=d&&(i.open("GET","https://aps.resulticks.com/EdmTrack/ConversionTracking?cid="+n+"&sid="+o+"&did="+d+"&rid="+a+"&chl="+c+"&pUrl="+s,!0),i.send()))}function fnSetCookie_jq(e,i){if(0==i){var t={Sid:getUrlVars().sid,Cid:getUrlVars().cid,Did:getUrlVars().did,Rid:getUrlVars().rid,Chnl:getUrlVars().chl};$.cookie(e,JSON.stringify(t),{path:"/"})}else{var r=$.cookie(e),n=JSON.parse(r);if(void 0!=getUrlVars().sid&&null!=getUrlVars().sid&&void 0!=getUrlVars().chl&&null!=getUrlVars().chl&&null!=n.Chnl&&void 0!=n.Chnl&&n.Chnl!=getUrlVars().chl){var t={Sid:getUrlVars().sid,Cid:getUrlVars().cid,Did:getUrlVars().did,Rid:getUrlVars().rid,Chnl:getUrlVars().chl};$.cookie(e,JSON.stringify(t),{path:"/"})}}}var ocg="";