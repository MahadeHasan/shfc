(function ($) {
    ("use strict");
    // Page loading
    $(window).on("load", function () {
        $("#preloader-active").addClass('preloader-hide');
    });
    /*-----------------
        Menu Stick
    -----------------*/
    var header = $(".sticky-bar");
    var win = $(window);

    var win_height = win.height();
    var doc_height = $(document).height();

    win.on("scroll", function () {
        var scroll = win.scrollTop();

        if (scroll < 300) {
            header.removeClass("stick");
            header.removeClass("bg-gray-850");
        } else {
            header.addClass("stick");
            header.addClass("bg-gray-850");
        }
    });

    /* count control */
    $(document).on('click', '.count-control', function () {
        var $quantity_input = $(this).closest('.quantity').find('.qty');
        var old = parseInt($quantity_input.val());
        if ($(this).hasClass('plus')) {
            if (parseInt($quantity_input.attr('max')) != -1) {
                if ((parseInt($quantity_input.attr('max')) - 1) >= old) {
                    $quantity_input.val(old + 1);
                }
            } else {
                $quantity_input.val(old + 1);
            }

        } else {
            if (old > 1) {
                $quantity_input.val(old - 1);
            }
        }

        $(this).closest('form').find('button[type="submit"]').prop('disabled', false);
        return false;
    });

    /*------ Wow Active ----*/
    new WOW().init();
    //sidebar sticky
    if ($(".sticky-sidebar").length) {
        $(".sticky-sidebar").theiaStickySidebar();
    }

    //calendar table
    if ($('.wp-calendar-table')) {
        $('.wp-calendar-table').addClass('table table-dark');
    }

    /*====== Sidebar menu Active ======*/
    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            wrapper4 = $("body");
        wrapper4.prepend('<div class="body-overlay-1"></div>');
        navbarTrigger.on("click", function (e) {
            navbarTrigger.toggleClass("burger-close");
            e.preventDefault();
            container.toggleClass("sidebar-visible");
            wrapper4.toggleClass("mobile-menu-active");
        });
        endTrigger.on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });
        $(".body-overlay-1").on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
            navbarTrigger.removeClass("burger-close");
        });
    }
    mobileHeaderActive();
    /*---------------------
        Mobile menu active
    ------------------------ */
    var $offCanvasNav = $(".mobile-menu"),
        $offCanvasNavSubMenu = $offCanvasNav.find(".sub-menu");
    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fi-rr-caret-down"></i></span>');
    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();
    /*Category Sub Menu Toggle*/
    $offCanvasNav.on("click", "li a, li .menu-expand", function (e) {
        var $this = $(this);
        if (
            $this
                .parent()
                .attr("class")
                .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
            ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
        ) {
            e.preventDefault();
            if ($this.siblings("ul:visible").length) {
                $this.parent("li").removeClass("active");
                $this.siblings("ul").slideUp();
            } else {
                $this.parent("li").addClass("active");
                $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                $this.closest("li").siblings("li").find("ul:visible").slideUp();
                $this.siblings("ul").slideDown();
            }
        }
    });

    /* --- SwiperJS --- */
    $(".swiper-group-6").each(function () {
        var swiper_5_items = new Swiper(this, {
            spaceBetween: 16,
            slidesPerView: 6,
            slidesPerGroup: 1,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-style-2",
                prevEl: ".swiper-button-prev-style-2"
            },

            autoplay: {
                delay: 10000
            },
            breakpoints: {
                1299: {
                    slidesPerView: 6
                },
                1150: {
                    slidesPerView: 4
                },
                750: {
                    slidesPerView: 3
                },
                600: {
                    slidesPerView: 2
                },
                550: {
                    slidesPerView: 1
                },
                300: {
                    slidesPerView: 1
                },
                200: {
                    slidesPerView: 1
                }
            }
        });
    });

    $(".swiper-group-5").each(function () {
        var swiper_5_items = new Swiper(this, {
            spaceBetween: 20,
            slidesPerView: 5,
            slidesPerGroup: 1,
            loop: false,
            navigation: {
                nextEl: ".swiper-button-next-style-1",
                prevEl: ".swiper-button-prev-style-1"
            },

            autoplay: {
                delay: 3000
            },
            breakpoints: {
                1299: {
                    slidesPerView: 5
                },
                1150: {
                    slidesPerView: 4
                },
                750: {
                    slidesPerView: 3
                },
                600: {
                    slidesPerView: 2
                },
                550: {
                    slidesPerView: 1
                },
                300: {
                    slidesPerView: 1
                },
                200: {
                    slidesPerView: 1
                }
            }
        });
    });
    $(".swiper-group-3").each(function () {
        var swiper_5_items = new Swiper(this, {
            spaceBetween: 20,
            slidesPerView: 3,
            slidesPerGroup: 1,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-style-3",
                prevEl: ".swiper-button-prev-style-3"
            },

            autoplay: {
                delay: 10000
            },
            breakpoints: {
                1299: {
                    slidesPerView: 3
                },
                1150: {
                    slidesPerView: 3
                },
                750: {
                    slidesPerView: 2
                },
                600: {
                    slidesPerView: 2
                },
                550: {
                    slidesPerView: 1
                },
                300: {
                    slidesPerView: 1
                },
                200: {
                    slidesPerView: 1
                }
            }
        });
    });

    $(".swiper-group-1").each(function () {
        var swiper_1_items = new Swiper(this, {
            spaceBetween: 20,
            slidesPerView: 5,
            slidesPerGroup: 1,
            loop: true,
            autoplay: {
                delay: 2000
            },
            breakpoints: {
                1299: {
                    slidesPerView: 5
                },
                1150: {
                    slidesPerView: 5
                },
                750: {
                    slidesPerView: 3
                },
                600: {
                    slidesPerView: 2
                },
                550: {
                    slidesPerView: 1
                },
                300: {
                    slidesPerView: 1
                },
                200: {
                    slidesPerView: 1
                }
            }
        });
    });

    $(".swiper-group-2").each(function () {
        var swiper_1_items = new Swiper(this, {
            slidesPerView: 1,
            slidesPerGroup: 1,
            loop: true,
            autoplay: {
                delay: 2000
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
        });
    });

    //Mobile left sideba
    function mobileLeftSidebar() {
        var width = $(window).width();
        if (width < 992) {
            $(".menu-texts li.has-children > a").removeAttr("href");
            $(".menu-texts li.has-children > a").on("click", function (e) {
                $(this).parent().toggleClass("submenu-open");
                $(this).parent().siblings().removeClass("submenu-open");
            });
        }
    }
    mobileLeftSidebar();

    $(document).on('click', function (event) {
        var menu_text = $(".menu-texts");
        var btnOpen = $(".btn-search");
        var formSearch = $(".form-search");
        if (!menu_text.is(event.target) && menu_text.has(event.target).length === 0) {
            menu_text.addClass("menu-close");
            menu_text.css("style", "");
        }
        if (!formSearch.is(event.target) && formSearch.has(event.target).length === 0 && !btnOpen.is(event.target) && btnOpen.has(event.target).length === 0) {
            $(".form-search").slideUp();
        }
    });

    // btn search
    $(".btn-search").on('click', function (e) {
        e.preventDefault();
        var _form_search = $(".form-search");
        if (_form_search.css('display') == 'none') {
            _form_search.slideDown();
        } else {
            _form_search.slideUp();
        }
    });
    $(".viewpass").on("click", function () {
        var _password = $(".password");
        if (_password.attr('type') == 'password') {
            _password.attr("type", "text");
        } else {
            _password.attr("type", "password");

        }
    });
    // Go top
    $(".progressCounter").progressScroll();

    $(".progressCounter").on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    /*Data Fillter*/
    $(".btn-filter").on("click", (e) => {
        const dataFilter = $(e.target).attr("data-filter");
        const filter = dataFilter.split(" ");
        const items = $(".item-content").parent();

        for (item of items) {
            const dataCategories = $(item).attr("data-category");
            const dataArray = dataCategories.split(" ");
            if (filter == "") {
                $(item).addClass("animate__animated animate__fadeIn");
                $(item).parent().addClass("animate__animated animate__fadeIn");
                $(item).removeClass("d-none");
                $(item).parent().removeClass("d-none");
            } else if (dataArray.includes(filter[0])) {
                $(item).addClass("animate__animated animate__fadeIn");
                $(item).parent().addClass("animate__animated animate__fadeIn");
                $(item).removeClass("d-none");
                $(item).parent().removeClass("d-none");
            } else {
                $(item).addClass("d-none");
                $(item).parent().addClass("d-none");
                $(item).removeClass("animate__animated animate__fadeIn");
                $(item).parent().removeClass("animate__animated animate__fadeIn");
            }
        }
    });

    $(".btn-filter").on("click", function () {
        $(".btn-filter").removeClass("active")
        $(this).addClass("active");
    });

    $('[name="archive-dropdown"], [name="cat"]').addClass('form-select');
    $('table:not(.shop_table )').addClass('table table-dark table-striped');





    // Color mode switcher
    function genzColorMode(selector) {

        if (!selector.is(':checked')) {
            $('html').attr('data-theme', 'light');
            window.localStorage.setItem("genzColorMode", "light");
        } else {
            $('html').attr('data-theme', 'dark');
            window.localStorage.setItem("genzColorMode", "dark");
        }
    }

    function genzColorActiveMode(selector) {
        let activeMode = window.localStorage.getItem("genzColorMode");
        if (activeMode == 'light') {
            selector.prop('checked', false);
        } else {
            selector.prop('checked', true);
        }
    }

    if ($('#genzColorMode').length > 0) {

        genzColorMode($('#genzColorMode'));
        genzColorActiveMode($('#genzColorMode'));


        $(document).on('change', '#genzColorMode', function () {
            window.localStorage.removeItem("genzColorMode");
            genzColorMode($(this));
        });
    }


    $(document).on('click', '.genz-posts-pagination-yes .pagination .page-link', function (e) {
        e.preventDefault();
        let active_page = parseInt($(this).closest('.pagination').find('.page-link.active').text());
        var paged,
            wrapper = $(this).closest('.genz-posts-pagination-yes');



        wrapper.addClass('posts-loading');
        wrapper.css({
            '--card-height': wrapper.find('.card-list-posts').first().height() + 'px'
        });

        if ($(this).hasClass('page-next')) {
            paged = active_page + 1;
        } else if ($(this).hasClass('page-prev')) {
            paged = active_page - 1;
        } else {
            paged = parseInt($(this).text());
        }




        var data = {
            'action': 'genz_posts_action',
            'paged': paged,     // We pass php values differently!,
            'settings': $(this).closest('.genz-posts-pagination-yes').data('settings')
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(GENZ.ajax_url, data, function (response) {
            $('html, body').scrollTop(wrapper.offset().top - 100);
            wrapper.empty().html(response);
            wrapper.removeClass('posts-loading');

        });


        return false;
    });

})(jQuery);