let images = document.querySelectorAll(".goodWrapper__photos__miniImg img");
let mainImage = document.querySelector(".goodWrapper__photos__img img");
if(images && mainImage) {
   images.forEach((image, i) => {
      image.addEventListener("click", () => {
         mainImage.setAttribute("src", image.getAttribute("src")); 
      })
   })
   let i = 0;
   function changingImage() {
      mainImage.setAttribute("src", images[i].getAttribute("src")); 
      if(i<images.length-1) {
         i++;
      }else {
         i=0;
      }
   }
   
   setInterval(() => {
      changingImage() ;
   }, 4000);
}

let addCart = document.querySelector(".goodWrapper__details__btn button");
let cartSelect = document.querySelector(".goodWrapper__details__order__select select");

if(addCart && cartSelect) {
  
   cartSelect.addEventListener("change", (e) => {
      if(e.target.value == "none") {
         addCart.disabled = true;
         addCart.textContent = "Bu mal hazırda stokda yoxdur";
      } else {
         addCart.disabled = false;
         addCart.textContent = "Sepete Ekle";
      }
   })
   let goodCount = document.querySelectorAll(".goodCount input");
   
   let plus = document.querySelector(".goodCount__plus");
   let minus = document.querySelector(".goodCount__minus");
   function min() {
      goodCount.forEach(input => {
         if(input.value < 1) {
            input.value=1;
         }
      })
    
   }
   plus.addEventListener("click", () => {
      goodCount.forEach(input => {
         input.value = +input.value+1
      })
   
   })
   minus.addEventListener("click", () => {
      goodCount.forEach(input => {
         input.value = +input.value-1
      })
      min();
   })
}

