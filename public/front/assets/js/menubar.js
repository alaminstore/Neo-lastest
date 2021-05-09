function openNav() {
    document.getElementById("mySidenavLarge").style.width = "280px";
    //document.getElementById("dark-bg").style.display = 'block';
}

function closeNav() {
    document.getElementById("mySidenavLarge").style.width = "0";
    //document.getElementById("dark-bg").style.display = 'none';
}
function openNav2() {
    document.getElementById("mySidenavMobile").style.width = "280px";
    //document.getElementById("dark-bg").style.display = 'block';
}

function closeNav2() {
    document.getElementById("mySidenavMobile").style.width = "0";
    //document.getElementById("dark-bg").style.display = 'none';
}
$(document).ready(function (){
    //more nav list large
    $(".open-more-large").click(function() {
        $(".main-nav-list-large, .more-nav-list-large").addClass("more-active");
    })
    $(".more-nav-list-btn-back-large").click(function() {
        $(".main-nav-list-large, .more-nav-list-large").removeClass("more-active");
    })

    //more nav list mobile
    $(".open-more-mobile").click(function() {
        $(".main-nav-list-mobile, .more-nav-list-mobile").addClass("more-active");
    })
    $(".more-nav-list-btn-back-mobile").click(function() {
        $(".main-nav-list-mobile, .more-nav-list-mobile").removeClass("more-active");
    })

    // mobile menu sub category toggle
    $(".mobile-categories").click(function() {
        $(this).toggleClass("sub-ctg-active");
    })
});

  $(document).ready(function () {
    //header search click to expand
    $(".cs-btn-submit").click(function() {
      $(".cs-txt-livesearch").addClass("sopen");
      $(".cs-btn-close").addClass("cs-show");
      $(".cs-btn-submit").addClass("cs-hide");
    })

    $(".cs-btn-close").click(function() {
      $(".cs-txt-livesearch").removeClass("sopen");
      $(".cs-btn-close").removeClass("cs-show");
      $(".cs-btn-submit").removeClass("cs-hide");
      $('#search-product-header').val('');
      $('.cs-prd-wrapper').css('display','none');
    })

    //select multiple quantity options
    $(".shop-page").on("click", ".qt-select-open.qt-multiple-open", function() {
        $(this).parents(".product-thumb").children('div.qt-drop-wrapper.qt-multiple').css("transform","translateY(0)");
    });
    $(".shop-page").on("click", ".qt-btn-close.qt-multiple-close",function() {
        $(this).parents(".product-thumb").children('div.qt-drop-wrapper.qt-multiple').css("transform","translateY(100%)");
    });

  //mobile footer search activation
  $('.footer-search-open').click(function(e){
      e.preventDefault();
      $('#mobile-header-search').toggleClass('mobile-open');
  })


  //mobile footer cart activation
  $('.footer-cart-open').click(function(e){
      e.preventDefault();
      $('#mobile-cart').toggleClass('cart-open');
  })
  });







