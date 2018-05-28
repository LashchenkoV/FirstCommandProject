let handlePagination = {
  init:function () {
      this.bindEvent()
  },
  bindEvent:function () {
      document.addEventListener("click",function (e) {
          if(e.target.closest("#navigation")!==null){
              e.preventDefault();
              if(!e.target.hasAttributes("href")) return false;
              let href = e.target.getAttribute("href");
              let content = document.querySelector(".content");
              content = content === null || content===undefined?document.body:content;
              if(href === null) return false;
              AJAX.get(href, function (text) {
                  content.innerText = '';
                  content.innerHTML = text;
              }, function (error) {console.log("ERROR"+error)});
          }
      })
  }

};