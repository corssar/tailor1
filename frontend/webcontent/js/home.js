var Page = {
    slideTo: null,
    navigateTo: null,
    initHomeCarousel: function (_time) {
        var $carousel = $('#homeCarousel');
        var $slides = $('.slides li', $carousel);
        var slidesNumber = $slides.length;
        var currentSlide = 0;
        var switchTime = _time || 5000;
        var $btnNext = $('.btn-next', $carousel);
        var $btnPrev = $('.btn-prev', $carousel);
        var isSwitching = false;
        var _timer;

        $slides.each(function () {
            var $img = $('img', this);
            $img
			.attr('src', $img.data('src'))
			.one('load', function () {
			    arrangeImage($img);
			});
        });

        $btnNext.click(function () {
            nextSlide();
        });

        $btnPrev.click(function () {
            nextSlide(-1);
        });

        $(window).resize(function () {
            $slides.each(function () {
                arrangeImage($('img', this));
            });
        });

        _timer = setTimeout(nextSlide, switchTime);

        function nextSlide(_dir, index) {
            if (isSwitching) { return; }
            isSwitching = true;
            clearTimeout(_timer);
            var dir = _dir || 1;
            var $slide = $('li:eq(' + currentSlide + ')', $carousel);
            var $content = $('.content', $slide);
            $slide.animate({ 'left': -dir * 15, 'opacity': 0 }, { duration: 600, complete: function () { $(this).hide(); } });
            $content.animate({ 'margin-left': -511 - dir * 15, 'opacity': 0 }, 800);
            currentSlide = currentSlide + dir;
            if (index == undefined) {
                if (currentSlide == slidesNumber) { currentSlide = 0; }
                if (currentSlide == -1) { currentSlide = slidesNumber - 1; }
            } else
                currentSlide = index;
            var $slide = $('li:eq(' + currentSlide + ')', $carousel);
            var $content = $('.content', $slide);
            $slide.css({ 'left': dir * 15, 'opacity': 0 }).show().animate({ 'left': 0, 'opacity': 1 }, 600);
            $content.css({ 'margin-left': -511 + dir * 15, 'opacity': 0 }).animate({ 'margin-left': -511, 'opacity': 1 }, 800);
            arrangeImage($('img', $slide));
            setTimeout(function () {
                isSwitching = false;
                SetSliderNavigation(currentSlide);
                _timer = setTimeout(nextSlide, switchTime);
            }, 800);

        }
        Page.slideTo = nextSlide;
        Page.navigateTo = function (e) {
            var index = $(e).attr('data-index') * 1;
            nextSlide(0, index);
        };
        function SetSliderNavigation(currentSlide) {
            $(".slidesjs-pagination li .active").removeClass("active");
            $($(".slidesjs-pagination li a")[currentSlide]).addClass("active");
        }
        function arrangeImage(_img) {
            var W = $carousel.width();
            var H = $carousel.height();
            _img.css({ 'width': '100%', 'height': 'auto' });
            if (_img.height() < H) {
                _img.css({ 'height': H, 'width': 'auto' });
            }
            _img.css({ 'margin-left': (W - _img.width()) / 2 });
        }
    }
}