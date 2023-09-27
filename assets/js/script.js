function addClass(element, className = "active") {
    element.classList.add(className);
}
function removeClass(element, className = "active") {
    element.classList.remove(className);
}
function toggleClass(element, className = "active") {
    element.classList.toggle(className);
}
//Khai báo thư viện
setTimeout(function () {
    AOS.init();
}, 250);
AOS.init({
    duration: 750,
    offset: 75,
});
new VenoBox({
    selector: ".venobox",
    navigation: true,
});
function vietnamese_currency_format(money){
    const config = {minimumFractionDigits: 0, maximumFractionDigits: 9};
    const formated = new Intl.NumberFormat('vi-VN', config).format(money) + "đ";
    return formated;
}
if(document.querySelector(".splide.blog")){

    document.addEventListener( 'DOMContentLoaded', function() {
        var splide = new Splide( '.splide.blog', {
            
            
            direction: 'ttb',
            // wheel    : true,
            pagination: false,
            breakpoints: {
                1600:{
                    perPage: 2,
                    gap: '50px',
                    height   : '30rem',
                },
                992:{
                    perPage: 1,
                    // gap: "0",
                    
                    height   : '19rem',
                },
                769: {
                    perPage: 1,
                    // gap: "0",
                    
                    height   : '19rem',
                },
            },
            classes: {
                arrows: 'splide__arrows blogs-arrows',
                arrow : 'splide__arrow blog-arrow',
                prev  : 'splide__arrow--prev blog-prev',
                next  : 'splide__arrow--next blog-next',
          },
    
        } );
        splide.mount();
    } );
}
if(document.querySelector(".splide.feedback")){
    document.addEventListener( 'DOMContentLoaded', function() {
        var splide = new Splide( '.splide.feedback', {
            // type  : 'fade',
            rewind: true,
            autoplay: true,


            responsive: [
               
                
                {
                  breakpoint: 480,
                  settings: {
                    drag   : 'free',
                    perMove: 1,

                    // slidesToScroll: 1
                  }
                }
            
              ]
               


        } );
        splide.mount();
    } );
}

    // blogs.mount();
// get JSON url
var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href
// then take out the '/wp-json/' part
var homeurl = WpJsonUrl.replace('/wp-json/','');
if(document.querySelector(".taxonomy__list")){
    $(document).ready(function(){
        $('.taxonomy__list').slick({
            dots: true,
      infinite: false,
      speed: 1000,
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 2000,
    //   gap: 5,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            // slidesToScroll: 1,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            // slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            // slidesToScroll: 1
          }
        }
    
      ]
        });
    });

}

var buy_btns= document.querySelectorAll('.buy__btn');
buy_btns.forEach((element)=>{
    element.addEventListener('click',(e)=>{

        e.preventDefault(); 

        var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'buy_list',
                id : element.id,
                count : 1
            }
        $.post(url,data,function(response){
			toast({
                title: "Thêm vào giỏ hàng",
                message: "Đã thêm vào giỏ hàng thành công",
                type: "success",
                duration: 1000
              });
            response = JSON.parse(response);
            document.querySelector('.cart_count').style.display = 'block';
            document.querySelector('.cart_count--text').textContent = Object.keys(response).length;

        })
    })
    
})

var buy_favourite_btns= document.querySelectorAll('.buy__favourite_btn');
buy_favourite_btns.forEach((element)=>{
    element.addEventListener('click',(e)=>{

        e.preventDefault(); 
        console.log(element.parentElement.parentElement.getAttribute("product_id"));
        var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'buy_list',
                id : element.parentElement.parentElement.getAttribute("product_id"),
                count : 1
            }
        $.post(url,data,function(response){
			// show_add_cart();
            toast({
                title: "Thêm vào giỏ hàng",
                message: "Đã thêm vào giỏ hàng",
                type: "success",
                duration: 1000
              });
            response = JSON.parse(response);
            document.querySelector('.cart_count').style.display = 'block';
            document.querySelector('.cart_count--text').textContent = Object.keys(response).length;
            setTimeout(()=>{
                document.location.href = homeurl + "/cart";
            },2000);
        })
    })
    
})
if(document.querySelector('.cart_count').textContent !== '')
    document.querySelector('.cart_count').style.backgroundColor  = 'red';
else{
    document.querySelector('.cart_count').style.backgroundColor  = 'transparent';
}
var cart_delete_btns= document.querySelectorAll('.cart_delete');
var sum_cart_exist = document.querySelector(".sum_cart");
if(sum_cart_exist){
    var sum_cart= (parseInt(document.querySelector('.sum_cart').getAttribute('sum_cart')));
    cart_delete_btns.forEach((element)=>{
        element.addEventListener('click',(e)=>{
            e.preventDefault(); 
            var ul_element=element.parentElement.parentElement;
            var sum_product = parseInt(ul_element.querySelector('.sum_product').getAttribute("sum_product"));
            console.log(sum_product);
            document.querySelector('.sum_cart').setAttribute('sum_cart',sum_cart-=sum_product); 
            document.querySelector('.sum_cart').textContent= Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(sum_cart) ;
            var url = homeurl + "/wp-admin/admin-ajax.php";
                var data = {
                    action : 'remove_cart',
                    id : element.id,
                };
            $.post(url,data,function(response){
                
                console.log(response);
                element.parentElement.parentElement.remove();
    
                if(document.querySelector('.cart_list').rows.length === 1){
                    document.querySelector('.cart_list').remove();
                    document.querySelector('.display_sum_cart').remove();
                    document.querySelector('.message').innerHTML ="Không có mặt hàng trong giỏ hàng";
                    document.querySelector('.cart_count--text').parentElement.style.display='none';
                    document.querySelector('.update_btn').style.display='none';
                }
                else{
                    document.querySelector('.cart_count--text').textContent = document.querySelector('.cart_list').rows.length -1 ;
    
                }
            })
           
        })
    })
}


var update_btn =document.querySelector('.update_btn');

if(update_btn){
    update_btn.addEventListener('click',(e)=>{
        e.preventDefault();
        var products = document.querySelectorAll('.product_element');
        var cart_update = Array();
        products.forEach( (product) => {
            var count = product.querySelector('.product_count').value;
            var number_click = product.getAttribute('number_click');
            if(Number(number_click)!==0){
                var product_id = product.getAttribute('product_id').toString();
                cart_update.push({[product_id] : count});
            }
        });
    
        var url = homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'update_cart',
            data : JSON.stringify(cart_update)
        
        };
        $.post(url,data,function(response){
            console.log(response);
            location.replace(homeurl + "/thanh-toan/");
        });
        
    
    })
}


var button_exist = document.querySelector("#contact-form__btn");
if(button_exist){
 
    document.querySelector("#contact-form__btn").onclick = (e)=>{
    e.preventDefault();
    
    $("#contact-form").validate({
        rules: {
            name: "required",
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            message: "required"
        },
        messages: {
            name: {
                required: "Bạn phải nhập tên",
               
            },
            phone: {
                required: "Bạn phải nhập số điện thoại",
                minlength: "Số điện thoại không được dưới 10 ký tự",
                maxlength: "Số điện thoại không được trên 10 ký tự",
                number: "Số điện thoại phải là chữ số"
            },
            message: "Bạn phải nhập nội dung"
        }
    }); 
    if($("#contact-form").valid())
    {
        setTimeout(()=>{
            document.querySelector(".loader").style.display="block";
            document.querySelector("#contact-form__btn").style.display="none";
        },0)
        var url = homeurl + "/wp-admin/admin-ajax.php";
        var name = document.querySelector("#contact_name").value;
        var phone = document.querySelector("#contact_phone").value;
        var message = document.querySelector("#contact_message").value;

        var data ={
            action: 'contact_form',
            name : name,
            phone : phone,
            message : message,

        }
        $.post(url,data,function(response){
            var timeWait = 2000;
            
            setTimeout(()=>{

                document.querySelector(".loader").style.display="none";
                document.querySelector("#contact-form__btn").style.display="block";
                console.log(response);
                var status =  response.split(":");
                toast({
                    title: status[0],
                    message: status[1],
                    type: status[0],
                    duration: 2000
                  });
                
                       
                

            },timeWait);
        })
    }
    
    }
}

var display_search_btn = document.querySelector('.search_icon');
console.log(display_search_btn);
display_search_btn.addEventListener('click',(e)=>{
    var form_search = document.querySelector('.form_search');
    form_search.classList.toggle("show");
})


var products = document.querySelectorAll('.product_element');
var sum_cart_exist = document.querySelector(".sum_cart");
if(sum_cart_exist){
var sum_cart= (parseInt(document.querySelector('.sum_cart').getAttribute('sum_cart')));

products.forEach((product) => {
    var numberClicked = 0;
    product.setAttribute('number_click',numberClicked);
    var count = parseInt(product.querySelector('.product_count').value);
    product.querySelector('.product_count').disabled= true;
    var unit_price = product.querySelector('.unit_price').getAttribute('unit_price');
    var decrease_btn = product.querySelector('.decrease_btn');

    decrease_btn.addEventListener('click',(e)=>{
        if(count>1)
        {
            numberClicked++;
            product.setAttribute('number_click',numberClicked);

            count--;
            
            product.querySelector('.product_count').setAttribute('value',count);
        
            product.querySelector('.sum_product').textContent= vietnamese_currency_format(count * unit_price) ;
            product.querySelector('.sum_product').setAttribute("sum_product",count * unit_price) ;
            
            document.querySelector('.sum_cart').setAttribute('sum_cart',sum_cart-=parseInt(unit_price)); 
            document.querySelector('.sum_cart').textContent= vietnamese_currency_format(sum_cart) ;
        }
    })
    var increase_btn = product.querySelector('.increase_btn');
    increase_btn.addEventListener('click',(e)=>{
        numberClicked++;
        product.setAttribute('number_click',numberClicked);
        count++;
        product.querySelector('.product_count').setAttribute('value',count);
        product.querySelector('.sum_product').textContent= vietnamese_currency_format(count * unit_price);
        product.querySelector('.sum_product').setAttribute("sum_product",count * unit_price) ;
        document.querySelector('.sum_cart').setAttribute('sum_cart',sum_cart+=parseInt(unit_price)); 
        document.querySelector('.sum_cart').textContent= vietnamese_currency_format(sum_cart) ;
        console.log(sum_cart);
    })
});
console.log(sum_cart);
}
var list_btn = document.querySelectorAll(".like__btn");

// console.log(list_btn);
list_btn.forEach((element)=>{
    element.addEventListener('click',(e)=>{
        e.preventDefault(); 
        // console.log(element.id);
        var url = homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'favourite_list',
            id : element.id,
        }
        $.post(url,data,function(response) {
            console.log(response);
            var cart= JSON.parse(response)
            console.log(typeof(cart));
            console.log(cart.includes(element.id));
            if(cart.includes(element.id)){
                var cartCount =Number(document.querySelector(".like_count--text").textContent);
                cartCount++;
                console.log(cartCount);
                document.querySelector(".like_count--text").innerHTML = cartCount;
                element.querySelector('i').classList.remove("fa-regular");
                element.querySelector('i').classList.add("fa-solid");
                element.querySelector('i').classList.toggle("in-favourite");
                if(cartCount!==0){
                    document.querySelector(".like_count--text").parentElement.style.display = "block";
                }

            }
            else{
                //da loai bo khoi like cart
                var cartCount =Number(document.querySelector(".like_count--text").textContent);
                cartCount--;
                document.querySelector(".like_count--text").innerHTML = cartCount;

                element.querySelector('i').classList.remove("fa-solid");
                element.querySelector('i').classList.add("fa-regular");
                element.querySelector('i').classList.toggle("in-favourite");
                console.log("Cart count :" + cartCount);
                if(cartCount==0){
                    document.querySelector(".like_count--text").parentElement.style.display = "none";
                }
            }


        })

    })
    // element.addEventListener('m',(e)=>{
    var like_icon = element.querySelector("i");
    if(like_icon){
        // like_icon = element.querySelector("i");
        like_icon.addEventListener('mouseenter',(e) => {
            
            if(!like_icon.classList.contains("in-favourite")){
                like_icon.classList.toggle("fa-solid");
            }
            else{
                like_icon.style.filter = "drop-shadow(0 0 0.75rem crimson)";
            }
        })
        like_icon.addEventListener('mouseleave',(e) => {
            // like_icon = element.querySelector("i");
            if(!like_icon.classList.contains("in-favourite")){
                like_icon.classList.toggle("fa-solid");
            }
            else{
                like_icon.style.filter = "drop-shadow(0 0 0 crimson)";
            }
        })

    }
})
var likeCount = Number(document.querySelector(".like_count--text").textContent);
if(likeCount==0){
    document.querySelector(".like_count--text").parentElement.style.display="none";
}
var payment_btn = document.querySelector(".payment_btn");
if(payment_btn){
    $("#payment-form").validate({
        rules:{
            name:"required",
            email:{
                required: true,
                email: true,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            address:"required",
            
        },
        messages:{
            name: "Bạn hãy nhập họ và tên",
            email:{
                required: "Bạn hãy nhập email",
                email: "Đây không phải định dạng của email",

            },
            phone:{
                required: "Bạn phải nhập số điện thoại",
                minlength: "Số điện thoại không được dưới 10 ký tự",
                maxlength: "Số điện thoại không được trên 10 ký tự",
                number: "Số điện thoại phải là chữ số"
            },
            address: "Bạn hãy nhập địa chỉ",
            
        }
    })
    payment_btn.addEventListener('click',(e)=>{
        e.preventDefault();
        var payment_product_list = document.querySelectorAll('.payment_product');
        var payment_list = new Array();
        payment_product_list.forEach(product=>{
            var id = product.getAttribute('product_id');
            var count = product.getAttribute('count');
            payment_list.push({id,count});
        })
        
        if($("#payment-form").valid()){
			var loader = payment_btn.parentElement.querySelector(".loader");
            
			loader.style.display="block";
			payment_btn.style.display="none";
            var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'payment',
                payment_list : payment_list,
                // count : count
            };
            $.post(url,data,function(response){
                    console.log("da post");
                    console.log(response);
                    var status =  response.split(":");
                    if(status[0]== "success"){
                        setTimeout(()=>{
							 loader.style.display="none";
							 payment_btn.style.display="block";
                             document.location.href = homeurl;
                    },2000);                  

                    }
            toast({
                title: status[0],
                message: status[1],
                type: status[0],
                duration: 1000
              });
				
                })

        }

})
}

var menu_btn = document.querySelector('.menu_btn');
if(menu_btn){

    menu_btn.addEventListener('click',()=>{
        // if(document.querySelector('.menu_home').style.transform == 'none')
        //     document.querySelector('.menu_home').style.display = 'flex';
        // else
        //     document.querySelector('.menu_home').style.display = 'none';
        
        document.querySelector('.menu').style.transform = "translate(0, 0)";
    
       
    })
}
var close_menu_btn = document.querySelector(".close_menu_btn");
if(close_menu_btn){
    close_menu_btn.addEventListener('click',()=>{
        document.querySelector('.menu').style.transform = "translate(-100%, 0)";
    })
}
var product_detail = document.querySelector(".product_detail_other-info");
if(product_detail){
    
    product_detail.querySelector(".increase_btn").addEventListener('click',()=>{
        var value = product_detail.querySelector('.product_count').value;
        value++;
        // product_detail.querySelector('.product_count').textContent = value++ ;
        product_detail.querySelector('.product_count').setAttribute("value",value);
    });
    
    product_detail.querySelector(".decrease_btn").addEventListener('click',()=>{
            if(product_detail.querySelector('.product_count').value > 1){
            var value = product_detail.querySelector('.product_count').value;
            value--;
            product_detail.querySelector('.product_count').setAttribute("value",value);
            // product_detail.querySelector('.product_count').value = value
            }
    
        });
    var product_detail_btn = product_detail.querySelector(".count__button").querySelector("button");
    product_detail_btn.addEventListener('click',(e)=>{
        e.preventDefault(); 
        // console.log("dax gui");
        var url =homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'buy_list',
            id : product_detail_btn.id,
            count : product_detail.querySelector('.product_count').value
        }
        
      
        $.post(url,data,function(response){
            console.log(response);
            toast({
                title: "Thêm vào giỏ hàng",
                message: "Đã thêm vào giỏ hàng thành công",
                type: "success",
                duration: 1000
              });
        })
    })
}

// Get the button:
let movetopbutton = document.getElementById("moveTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    movetopbutton.style.display = "block";
  } else {
    movetopbutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
////mua trong chi tiết san phẩm
// var buy_single_btn= document.querySelector('.buy__single_btn');
// if(buy_single_btn){
//     buy_single_btn.addEventListener('click',(e)=>{
        
//         e.preventDefault(); 
        
//         var url = homeurl + "/wp-admin/admin-ajax.php";
//             var data = {
//                 action : 'buy_list',
//                 id : buy_single_btn.id,
//                 count : Number(buy_single_btn.parentElement.querySelector('.count_wrapper').querySelector('.product_count').value)
//             }
//         console.log(data.count);
//         $.post(url,data,function(response){
//             console.log(response);
//             response = JSON.parse(response);
//             document.querySelector('.cart_count').style.display = 'block';
//             document.querySelector('.cart_count--text').textContent = Object.keys(response).length;
//             toast({
//                 title: "Thành công",
//                 message: "Đã bỏ vào giỏ hàng",
//                 type: "success",
//                 duration: 1000
//             });
//             setTimeout(()=>{
//                 // document.location.href =homeurl+"/cart";
//             },1500)
            
//             // document.location.href = homeurl;
//         })
//     })
// }
    
function show_add_cart() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
function show_payment() {
    var x = document.getElementById("payment_alert");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
function show_contact() {
    var x = document.getElementById("contact_alert");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
var home_menu_item = document.querySelector(".menu-item");
// console.log(curent_menu_item.querySelector("a").textContent);
if(!home_menu_item.classList.contains("current-menu-item")){
    // console.log(curent_menu_item.querySelector("a").textContent)
    var all_menu_item = document.querySelectorAll(".menu-item a");
    all_menu_item.forEach(a_link => {
        // console.log(a_link.textContent);
        a_link.style.color = "black";
        a_link.style.transition = "linear 0.2s";
        a_link.parentElement.addEventListener('mouseover',function(){
            a_link.style.color = "orangered";
        })
        a_link.parentElement.addEventListener('mouseout',function(){
            a_link.style.color = "black";
        })
        if(a_link.parentElement.classList.contains("current-menu-item")){
            a_link.style.color = "orangered";
        }
    })
    // document.querySelector(".cura").style.color = "orangered";
    var social_icons =document.querySelectorAll(".social_icon");
    social_icons.forEach(social_icon=>{
        console.log(social_icon);
        social_icon.style.border = "black 1px solid";
        var tag_a = social_icon.querySelector("a");
        if(tag_a){
            tag_a.style.color = "black";
            if(social_icon.classList.contains("like")){
                tag_a.style.color = "red";
            }
        }
        var tag_p = social_icon.querySelector("p");
        if(tag_p){
            tag_p.style.color = "black";
        }
    })
    var social_icons = document.querySelectorAll(".social_icon");
    social_icons.forEach(social_icon=>{
        social_icon.style.border = "black 1px solid";
        // social_icon.querySelector("p").style.color = "black";
        // social_icon.querySelector("a").style.color = "black";

    })
}
// Toast function
function toast({ title = "", message = "", type = "info", duration = 3000 }) {
    const main = document.getElementById("toast");
    if (main) {
      const toast = document.createElement("div");
  
      // Auto remove toast
      const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
      }, duration + 1000);
  
      // Remove toast when clicked
      toast.onclick = function (e) {
        if (e.target.closest(".toast__close")) {
          main.removeChild(toast);
          clearTimeout(autoRemoveId);
        }
      };
  
      const icons = {
        success: "fas fa-check-circle",
        info: "fas fa-info-circle",
        warning: "fas fa-exclamation-circle",
        error: "fas fa-exclamation-circle"
    };
    const icon = icons[type];
    const delay = (duration / 1000).toFixed(2);

    toast.classList.add("toast", `toast--${type}`);
    toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;
    

    toast.innerHTML = `
                    <div class="toast__icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">${title}</h3>
                        <p class="toast__msg">${message}</p>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times"></i>
                    </div>
                `;
    main.appendChild(toast);
    }
}
if(document.querySelector(".imgs")){
    $(document).ready(function(){
        $('.imgs').slick({
            dots: false,
            infinite: true,
            speed: 500,
            autoplay: true,
            fade: true,
            cssEase: 'linear',
            adaptiveHeight: true
        });
    });

}
var product_detail_list_imgs = document.querySelectorAll(".product_detail_list--imgs .product_detail_element--img");
product_detail_list_imgs.forEach(img => {
    img.addEventListener('click',()=>{
        console.log(img.getAttribute("src"));
        var bigImg = document.querySelector(".product_detail_feature__img img");
        bigImg.setAttribute("src",img.getAttribute("src"));
    })
})
var products = document.querySelectorAll(".product__list .product__element");

var observer = new IntersectionObserver(entries =>{
    // console.log(entries);
    entries.forEach(entry=>entry.target.classList.toggle("show",entry.isIntersecting))
},{threshold: 0.02}
)
products.forEach(product=>{
    // product.style.transitionDelay = 
    observer.observe(product);
})
var link_promotions = document.querySelectorAll(".link_promotion .content a");
link_promotions.forEach(link=>{
    observer.observe(link);
})

//responsive
function responsive992px(x) {
    if (x.matches) { // If media query matches
        var menu = document.querySelector(".menu");
        menu.style.width = "100vw";
        // var menu_items = menu.querySelectorAll(".menu-item");
        // menu_items.forEach(menu_item =>{
        //     menu_item.addEventListener('mouseover',()=>{
        //         menu_item.querySelector("a").style.color="orangered";
        //     })
        //     menu_item.addEventListener('mouseleave',()=>{
        //         menu_item.querySelector("a").style.color="black";
        //     })
        // })
    }
    // var menu_btn =  document.querySelector(".menu_btn");
    // menu_btn.addEventListener('click',()=>{
        
    // })
    // } else {
    // //   document.body.style.backgroundColor = "pink";
    // }
}

var x = window.matchMedia("(max-width: 992px)")
responsive992px(x) // Call listener function at run time
x.addListener(responsive992px) // Attach listener function on state changes