/*
  スマホでトグルメニューのJavaScript
*/
function clickToggleMenu(){
  var toggleButton = document.getElementById('js-toggle-button');
  if(!toggleButton) return;
  toggleButton.addEventListener('click',function(){
    if(document.body.classList.contains('nav-open')){
      document.body.classList.remove('nav-open');
    } else {
      document.body.classList.add('nav-open');
    }
  });
};
clickToggleMenu();

/*
  CSS読み込み遅延
*/
var fontawesome = "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css";
var googlefont = "https://fonts.googleapis.com/css?family=Open+Sans:400,600,800";
function lazyLoadContents(href) {
  var link = document.createElement('link'); link.rel = 'stylesheet';
  link.href = href;
  document.head.appendChild(link);
};
var requestAnimationFrameMethod = requestAnimationFrame || mozRequestAnimationFrame ||
    webkitRequestAnimationFrame || msRequestAnimationFrame;
if (requestAnimationFrameMethod) {
  requestAnimationFrameMethod(function (){
    lazyLoadContents(fontawesome);
    lazyLoadContents(googlefont);
  });
} else {
  window.addEventListener('load', function(){
    lazyLoadContents(fontawesome);
    lazyLoadContents(googlefont);
  });
}
/*
  シェア数をカウントするJS
*/
// コールバック関数
function getJson(json) {
  var hatebuCount = json;
  var allSelector = document.getElementsByClassName('hatebu-count');
  for(var i=0;i<allSelector.length;i++){
    allSelector[i].innerHTML = hatebuCount;
  }
}
//　ここは即時関数で他のコードに影響が出ない様に。
(function(){
  var now = new Date();
  var url = location.href;
  getResponse("//graph.facebook.com/?id=",'facebook-count','json',callbackFb);
  // はてブのjsonpを受け取る
  var script = document.createElement('script');
  script.src = 'http://api.b.st-hatena.com/entry.count?url='+encodeURIComponent(url)+'&callback=getJson&timestamp='+now.getTime();
  document.body.appendChild(script);
  // 通信用の関数（あとで再利用するかもなので関数化）
  function getResponse(reqUrl,selector,type,callback){
    var data = null;
    var xhr = new XMLHttpRequest();
    xhr.ontimeout = function() {
      xhr.abort(); // 中止
      callback(data,selector);
    };
    // 通信エラー時の処理
    xhr.onerror = function(){callback(data,selector);};
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 ) {
        if(xhr.status == 200) {
          data = xhr.response;
        }
        callback(data,selector);
      }
    }
    xhr.open('GET',reqUrl+encodeURIComponent(url),true);
    xhr.timeout = 15000 ;
    xhr.responseType = type;
    xhr.send();
  }
  // 各SNSのコールバック関数
  function callbackFb(obj,selector) {
    var allSelector = document.getElementsByClassName(selector);
    if(!obj.share || !obj.share.share_count) {
      for(var i=0;i<allSelector.length;i++){
        allSelector[i].innerHTML = 0;
      }
    } else {
      for(var i=0;i<allSelector.length;i++){
        allSelector[i].innerHTML = obj.share.share_count;
      }
    }
  }
  // YouTube画像化
  var youtube = document.querySelectorAll('.youtube');
    for(var i=0;i<youtube.length;i++){
      youtube[i].addEventListener('click',function(){
        video = '<iframe src="'+ this.getAttribute('data-video') +'" frameborder="0" width="480" height="270"></iframe>';
        this.outerHTML = video;
    });
  }
}());
