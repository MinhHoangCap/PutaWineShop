// get JSON url
var WpJsonUrl = document.querySelector('link[rel="https://api.w.org/"]').href;
// get link home page
var homeurl = WpJsonUrl.replace('/wp-json/','');
//get link admin ajax
var admin_ajax_url =homeurl + "/wp-admin/admin-ajax.php";
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
var primary_img = document.querySelector(".splide.primary_img");
if(primary_img){
    document.addEventListener( 'DOMContentLoaded', function() {
        if(primary_img){
            var primary_slide = new Splide( '.splide.primary_img',{
                dots: false,
                pagination: false,
                wheel: true,
                arrows: false,
                speed: 1000,
                heightRatio : 0.4,
            } );
            
        }
        var secondary_img = document.querySelector(".splide.secondary_img");
        if(secondary_img){
            
            var secondary_slide = new Splide( '.splide.secondary_img',{
                
                dots: false,
                pagination: false,
                wheel: true,
                arrows: false,
                perPage: 4,
                speed: 1000,
                isNavigation: true,
                heightRatio : 0.5,
                gap: '10px', 
            } );
            
        }
        primary_slide.sync( secondary_slide );
        primary_slide.mount();
        secondary_slide.mount();
    } );
}
if(document.querySelector(".logos")){
    var logos_length = Number(document.querySelector(".logos").getAttribute("partner_size"));
    if(logos_length > 5){
        logos_length = 5;
    }
    // console.log(logos_length);
    $('.logos').slick({
        
        // slidesToScroll: 1,
        autoplay: true,
        speed: 1000,
        infinite: true,
        autoplaySpeed: 1000,
        wheel: true,
        // draggable: true,
        swipeToSlide:true,
        responsive: [
            {
                
                breakpoint: 10000,
                settings: {
                    slidesToShow: logos_length,
                    dots: true
                }
            },
            {
            breakpoint: 1024,
            settings: {
                // slidesToShow: logos_length - 1,
                slidesToShow: 4,
                dots: true
                }
            },
            // {
            //     breakpoint: 800,
            //     settings: {
            //         // slidesToShow: logos_length - 1,
            //         slidesToShow: 3,
            //     }
            // },
            // {
            //     breakpoint: 552,
            //     settings: {
                    
            //         slidesToShow: 2,
            //         // slidesToShow: logos_length - 2,
                    
            //     }
            // }
        ]
    });
}
if(document.querySelector(".splide.blog")){

    document.addEventListener( 'DOMContentLoaded', function() {
        var splide = new Splide( '.splide.blog', {
            // direction: 'ttb',
            pagination: false,
            breakpoints: {
                10000:{
                    perPage: 2,
                    // gap: '50px',
                    height   : '30rem',
                    direction: 'ttb',
                },
                1600:{
                    perPage: 2,
                    // gap: '50px',
                    height   : '30rem',
                    direction: 'ttb',
                },
                992:{
                    perPage: 1,
                    height   : '19rem',
                    direction: 'ttb',
                },
                576: {
                    perPage: 1,
                    direction: 'ltr',
                    // heightRatio : 0.3,
                    // gap: '0px',
                    height   : '20rem',
                    // pagination: true,
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
            rewind: true,
            autoplay: true,
            arrows: false,
            pagination: false,
            responsive: [
                {
                    breakpoint: 480,
                        settings: {
                        drag   : 'free',
                        perMove: 1,
                        }
                }
            ]
        } );
        splide.mount();
    } );
}


if(document.querySelector(".taxonomy__list")){
    $(document).ready(function(){
        $('.taxonomy__list').slick({
            dots: true,
            speed: 1000,
            swipeToSlide:true,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
    responsive: [
        {
            
            breakpoint: 10000,
            settings: {
                slidesToShow: 4,
                dots: true
            }
        },
        {
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            dots: true
            }
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 577,
            settings: {
                slidesToShow: 1,
                
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
        // var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'buy_list',
                id : element.id,
                count : 1
            }
        $.post(admin_ajax_url,data,function(response){
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
            var data = {
                action : 'buy_list',
                id : element.parentElement.parentElement.getAttribute("product_id"),
                count : 1
            }
        $.post(admin_ajax_url,data,function(response){
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
            },1250);
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
            element.style.display = "none";
            element.parentElement.querySelector(".loader").style.display = "block";
            var ul_element=element.parentElement.parentElement;
            var sum_product = parseInt(ul_element.querySelector('.sum_product').getAttribute("sum_product"));
            // var url = homeurl + "/wp-admin/admin-ajax.php";
                var data = {
                    action : 'remove_cart',
                    id : element.id,
                };
            $.post(admin_ajax_url,data,function(response){
                element.style.display = "block";
                element.parentElement.querySelector(".loader").style.display = "none";
                element.parentElement.parentElement.remove();
                document.querySelector('.sum_cart').setAttribute('sum_cart',sum_cart-=sum_product); 
                document.querySelector('.sum_cart').textContent= vietnamese_currency_format(sum_cart) ;
                
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
        // var url = homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'update_cart',
            data : JSON.stringify(cart_update)
        
        };
        $.post(admin_ajax_url,data,function(response){
            
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
        // var url = homeurl + "/wp-admin/admin-ajax.php";
        var name = document.querySelector("#contact_name").value;
        var phone = document.querySelector("#contact_phone").value;
        var message = document.querySelector("#contact_message").value;

        var data ={
            action: 'contact_form',
            name : name,
            phone : phone,
            message : message,

        }
        $.post(admin_ajax_url,data,function(response){
            var timeWait = 1200;
            
            setTimeout(()=>{

                document.querySelector(".loader").style.display="none";
                document.querySelector("#contact-form__btn").style.display="block";
                
                var status =  response.split(":");
                toast({
                    title: status[0],
                    message: status[1],
                    type: status[0],
                    duration: 1000
                });
            },timeWait);
        })
    }
    
    }
}

var display_search_btn = document.querySelector('.search_icon');
display_search_btn.addEventListener('click',(e)=>{
    var form_search = document.querySelector('.form_search');
    form_search.classList.toggle("show");
})
//Event processing when on the cart page
var sum_cart_exist = document.querySelector(".sum_cart");
if(sum_cart_exist){
    var products = document.querySelectorAll('.product_element');
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
            
        })
    });

}
//Process the like button
var list_btn = document.querySelectorAll(".like__btn");
list_btn.forEach((element)=>{
    element.addEventListener('click',(e)=>{
        e.preventDefault(); 
        // var url = homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'favourite_list',
            id : element.id,
        }
        $.post(admin_ajax_url,data,function(response) {
            
            var cart= JSON.parse(response)
            
            if(cart.includes(element.id)){
                var cartCount =Number(document.querySelector(".like_count--text").textContent);
                cartCount++;
                
                document.querySelector(".like_count--text").innerHTML = cartCount;
                element.querySelector('i').classList.remove("fa-regular");
                element.querySelector('i').classList.add("fa-solid");
                element.querySelector('i').classList.toggle("in-favourite");
                if(cartCount!==0){
                    document.querySelector(".like_count--text").parentElement.style.display = "block";
                }

            }
            else{
                
                var cartCount =Number(document.querySelector(".like_count--text").textContent);
                cartCount--;
                document.querySelector(".like_count--text").innerHTML = cartCount;

                element.querySelector('i').classList.remove("fa-solid");
                element.querySelector('i').classList.add("fa-regular");
                element.querySelector('i').classList.toggle("in-favourite");
                
                if(cartCount==0){
                    document.querySelector(".like_count--text").parentElement.style.display = "none";
                }
            }
        })
    })
})
//Handling the number of items that have been preferred in the header
var likeCount = Number(document.querySelector(".like_count--text").textContent);
if(likeCount==0){
    document.querySelector(".like_count--text").parentElement.style.display="none";
}
//Event processing at the payment button
var payment_btn = document.querySelector(".payment_btn");
if(payment_btn){
    //The law set for the payment form
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
    //Events when pressing the Payment button
    payment_btn.addEventListener('click',(e)=>{
        e.preventDefault();
        var payment_product_list = document.querySelectorAll('.payment_product');
        var payment_list = new Array();
        payment_product_list.forEach(product=>{
            var id = product.getAttribute('product_id');
            var count = product.getAttribute('count');
            payment_list.push({id,count});
        })
        //Check if the form Payment has satisfied all conditions
        if($("#payment-form").valid()){
			var loader = payment_btn.parentElement.querySelector(".loader");
			loader.style.display="block";
			payment_btn.style.display="none";
            // var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'payment',
                name: document.getElementsByName("name")[0].value,
                email: document.getElementsByName("email")[0].value,
                phone: document.getElementsByName("phone")[0].value,
                address: document.getElementsByName("address")[0].value,
                note: document.getElementsByName("note")[0].value,
                payment_list : payment_list,
                
            };
            console.log(data);
            $.post(admin_ajax_url,data,function(response){
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
        // If no conditions are not satisfied, notify
        else{
            toast({
                title: "Thiếu dữ liệu",
                message: "Bạn nên nhập dữ liệu đúng",
                type: "error",
                duration: 1000
            });
        }
    })
}
// Show menu in mobile
var menu_btn = document.querySelector('.menu_btn');
if(menu_btn){

    menu_btn.addEventListener('click',()=>{
        
        document.querySelector('.menu_in_mobile').style.transform = "translate(0, 0)";
    
       
    })
}
// Close the menu at Mobile
var close_menu_btn = document.querySelector(".close_menu_btn");
if(close_menu_btn){
    
        close_menu_btn.addEventListener('click',()=>{
            document.querySelector('.menu_in_mobile').style.transform = "translate(-100%, 0)";
        })
}
// Buy at product details
var product_detail = document.querySelector(".product_detail_other-info");
if(product_detail){
    
    product_detail.querySelector(".increase_btn").addEventListener('click',()=>{
        var value = product_detail.querySelector('.product_count').value;
        value++;
        
        product_detail.querySelector('.product_count').setAttribute("value",value);
    });
    
    product_detail.querySelector(".decrease_btn").addEventListener('click',()=>{
            if(product_detail.querySelector('.product_count').value > 1){
            var value = product_detail.querySelector('.product_count').value;
            value--;
            product_detail.querySelector('.product_count').setAttribute("value",value);
            
            }
    
        });
    var product_detail_btn = product_detail.querySelector(".count__button").querySelector("button");
    product_detail_btn.addEventListener('click',(e)=>{
        e.preventDefault(); 
        
        // var url =homeurl + "/wp-admin/admin-ajax.php";
        var data = {
            action : 'buy_list',
            id : product_detail_btn.id,
            count : product_detail.querySelector('.product_count').value
        }
        
      
        $.post(admin_ajax_url,data,function(response){
            
            response = JSON.parse(response);
            document.querySelector('.cart_count').style.display = 'block';
            document.querySelector('.cart_count--text').textContent = Object.keys(response).length;
            toast({
                title: "Thêm vào giỏ hàng",
                message: "Đã thêm vào giỏ hàng thành công",
                type: "success",
                duration: 1000
            });
            setTimeout(()=>{
                document.location.href = homeurl + "/cart";
            },1250);
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
// Processing events when hover in the item menu
var home_menu_item = document.querySelector(".menu-item");
if(!home_menu_item.classList.contains("current-menu-item")){
    var all_menu_item = document.querySelectorAll(".menu-item a");
    all_menu_item.forEach(a_link => {
        a_link.style.color = "black";
        a_link.style.transition = "linear 0.2s";
        a_link.parentElement.addEventListener('mouseover',function(){
            a_link.style.color = "orangered";
        })
        a_link.parentElement.addEventListener('mouseout',function(){
            a_link.style.color = "black";
            if(a_link.parentElement.classList.contains("current-menu-item")){
                a_link.style.color = "orangered";
            }
        })
        if(a_link.parentElement.classList.contains("current-menu-item")){
            a_link.style.color = "orangered";
        }
    })
    var social_icons =document.querySelectorAll(".social_icon");
    social_icons.forEach(social_icon=>{
        
        social_icon.style.border = "black 1px solid";
        var tag_a = social_icon.querySelector("a");
        if(tag_a){
            tag_a.style.color = "black";
            if(tag_a.parentElement.classList.contains("facebook") || tag_a.parentElement.classList.contains("twitter")|| tag_a.parentElement.classList.contains("youtube")){
                tag_a.style.color = "white";
            }
        }
        var tag_p = social_icon.querySelector("p");
        if(tag_p){

            tag_p.style.color = "black";
            if(tag_p.classList.contains("like_count--text") || tag_p.classList.contains("cart_count--text")){
                tag_p.style.color = "white";
            }
        }
    })
   
}
// function to show up notice
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
// Muslier event in header
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
// Handling motion when scroll comes at the product summary page
var products = document.querySelectorAll(".product__list .product__element");

var observer = new IntersectionObserver(entries =>{
    entries.forEach(entry=>entry.target.classList.toggle("show",entry.isIntersecting))
},{threshold: 0.02}
)
products.forEach(product=>{
    observer.observe(product);
})
// Handling the phenomenon when scrolled on links and gifts
var link_promotions = document.querySelectorAll(".link_promotion .content a");
link_promotions.forEach(link=>{
    observer.observe(link);
})
// Processing event when deleting your favorite products on your favorite product site
var favourite_deletes = document.querySelectorAll(".favourite_delete");
if(favourite_deletes){
    favourite_deletes.forEach(favourite_delete=>{
        favourite_delete.addEventListener("click",()=>{
            favourite_delete.style.display = "none";
            favourite_delete.parentElement.querySelector(".loader").style.display = "block";
            // var url = homeurl + "/wp-admin/admin-ajax.php";
            var data = {
                action : 'favourite_list',
                id : favourite_delete.id,
            }
            $.post(admin_ajax_url,data,function(response) {
                favourite_delete.parentElement.parentElement.remove();
                var like_count = Number(document.querySelector(".like_count--text").textContent);
                document.querySelector(".like_count--text").innerHTML = like_count - 1;
            })
        })
    })
}
// Process the like button when responsive
function responsive992px(x) {
    if (!x.matches) 
    {
    // document.body.style.backgroundColor = "pink";
    var list_btn = document.querySelectorAll(".like__btn");


    list_btn.forEach((element)=>{
    var like_icon = element.querySelector("i");
    if(like_icon){
        
        like_icon.addEventListener('mouseenter',mouseenterEvent = function(e) {
            
            if(!like_icon.classList.contains("in-favourite")){
                like_icon.classList.toggle("fa-solid");
            }
            else{
                like_icon.style.filter = "drop-shadow(0 0 0.75rem crimson)";
            }
        })
        like_icon.addEventListener('mouseleave',mouseLeaveEvent = function(e)  {
            
            if(!like_icon.classList.contains("in-favourite")){
                like_icon.classList.toggle("fa-solid");
            }
            else{
                like_icon.style.filter = "drop-shadow(0 0 0 crimson)";
            }
        })

    }
    })
}
}
var x = window.matchMedia("(max-width: 992px)")
responsive992px(x) // Call listener function at run time
x.addListener(responsive992px)