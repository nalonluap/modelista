function sliders() {
    const state = {
        sliders: [
            // main page
            {
                selector: '.js-site-header-slider',
                config: {
                    slidesToShow: 3,
                    arrows: false,
                    variableWidth: true,
                    variableHeight: false,
                    autoplay: true,
                    autoplaySpeed: 2000,
                },
            },
            {
                selector: '.js-site-footer-slider',
                config: {
                    slidesToShow: 3,
                    arrows: false,
                    variableWidth: true,
                    variableHeight: false,
                    autoplay: true,
                    autoplaySpeed: 2000,
                },
            },
            //
            {
                selector: '.js-small-item-slider',
                config: {
                    slidesToShow: 1,
                    arrows: true,
                    // prevArrow: '.js-small-item-slider-prev',
                    // nextArrow: '.js-small-item-slider-next',
                    // variableWidth: true,
                    variableHeight: false,
                    autoplay: false,
                },
            },

        ],
        init(slider, $sliderElem) {
            $sliderElem.slick(slider.config);
            slider.init = true;
        },
        destroy(slider, $sliderElem) {
            $sliderElem.slick('unslick');
            slider.init = false;
        },
        initAll() {
            this.sliders.forEach((slider) => {
                const $sliderElem = $(slider.selector);
                if(!$sliderElem.length) return

                // постоянно активен
                if(!slider.destroyOn && !slider.createOn) {
                    this.init(slider, $sliderElem);
                    return
                }

                // активен не на всех разрешениях
                if(window.innerWidth < slider.destroyOn) {
                    this.init(slider, $sliderElem);
                }

                if(window.innerWidth > slider.createOn) {
                    this.init(slider, $sliderElem);
                }

                $(window).on('resize', () => {
                    // up
                    if(window.innerWidth < slider.destroyOn && !slider.init) {
                        if(!$sliderElem.hasClass('slick-initialized')) this.init(slider, $sliderElem);
                    } else if(window.innerWidth >= slider.destroyOn && slider.init) {
                        this.destroy(slider, $sliderElem);
                    }

                    //down
                    if(window.innerWidth >= slider.createOn && !slider.init) {
                        if(!$sliderElem.hasClass('slick-initialized')) this.init(slider, $sliderElem);
                    } else if(window.innerWidth < slider.createOn && slider.init) {
                        this.destroy(slider, $sliderElem);
                    }
                });
            })
        },
        addListeners() {
            this.sliders.forEach((slider) => {
                if(slider.initListeners) slider.initListeners();
            })
        }
    };


    state.addListeners();
    state.initAll();

}
